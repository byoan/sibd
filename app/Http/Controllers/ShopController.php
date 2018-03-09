<?php

namespace App\Http\Controllers;

use App\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->getUser()->hasPermission(['select'], 'shops');

        // Retrieve the full horse shop list
        $shopsList = DB::connection($this->getUser()->getShop->name)->table('shops')->paginate(20);
        
        return view('shops.index', array(
            'shops' => $shopsList
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->getUser()->hasPermission(['insert'], 'shops');

        return view('shops.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->getUser()->hasPermission(['insert'], 'shops');
        // Set the connection to use after having checked the permissions
        $shop = new Shop();
        $shop->setConnection($this->getUser()->getShop->name);

        $shop->fill($request->all());

        if ($shop->save()) {
            return redirect()->route('shops.index')->with('success', 'Shop successfully created');
        } else {
            return back()->withErrors('An error occurred while saving the shop. Please try again later.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $idShop
     * @return \Illuminate\Http\Response
     */
    public function show(Int $idShop)
    {
        $this->getUser()->hasPermission(['select'], 'shops');

        $shop = new Shop();
        $shop->setConnection($this->getUser()->getShop->name);
        $shop = $shop->findOrFail($idShop);

        return view('shops.show', ['shop' => $shop]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $idShop
     * @return \Illuminate\Http\Response
     */
    public function edit(Int $idShop)
    {
        $this->getUser()->hasPermission(['select'], 'shops');

        $shop = new Shop();
        $shop->setConnection($this->getUser()->getShop->name);

        $shop = $shop->findOrFail($idShop);

        return view('shops.edit', array(
            'shop' => $shop
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shop $shop)
    {
        $this->getUser()->hasPermission(['update'], 'shops');

        $shop->setConnection($this->getUser()->getShop->name);

        $shop->fill($request->all());

        if ($shop->save()) {
            return redirect()->route('shops.show', $shop->id)->with('success', 'Shop successfully updated');
        } else {
            return back()->withErrors('An error occurred while saving the shop. Please try again later.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $idShop
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, int $idShop)
    {
        $this->getUser()->hasPermission(['delete'], 'shops');

        if ($idShop !== 0) {
            $shop = new Shop();
            $shop->setConnection($this->getUser()->getRole->name);
            $shop = $shop->findOrFail($idShop);

            if ($shop->delete()) {
                return redirect()->route('shops.index')->with('success', 'Shop successfully deleted');
            } else {
                return back()->with('errors', 'An error occurred while deleting the shop');
            }
        } else {
            $shopsToDelete = $request->input('list');
            $result = true;

            foreach ($shopsToDelete as $key => $shopId) {
                $shop = new Shop();
                $shop->setConnection($this->getUser()->getShop->name);
                $shop = $shop->findOrFail($shopId);

                if ($shop->delete()) {
                    continue;
                } else {
                    $result = false;
                    break;
                }
            }

            if ($result) {
                $request->session()->flash('success', 'The selected shops were successfully deleted');
            } else {
                $request->session()->flash('errors', 'An error occurred while deleting the selected shop');
            }

            return 'shops';
        }
    }
}
