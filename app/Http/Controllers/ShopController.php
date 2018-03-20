<?php

namespace App\Http\Controllers;

use App\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ShopRequest;

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

        // Retrieve the full shops list
        $shopsList = DB::connection($this->getUser()->getRole->name)->table('shops')->paginate(20);

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
     * @param  \App\Http\Requests\ShopRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ShopRequest $request)
    {
        $this->getUser()->hasPermission(['insert'], 'shops');
        // Set the connection to use after having checked the permissions
        $shop = new Shop();
        $shop->setConnection($this->getUser()->getRole->name);

        $shop->fill($request->all());

        $validList = $this->validateItemLists($request->input('horseList'));
        if (!$validList) {
            return back()->withErrors('Please enter a valid list of ids for the horses list');
        }
        $shop->horseList = json_encode($validList);

        $validList = $this->validateItemLists($request->input('itemList'));
        if (!$validList) {
            return back()->withErrors('Please enter a valid list of ids for the items list');
        }
        $shop->itemList = json_encode($validList);

        $validList = $this->validateItemLists($request->input('infraList'));
        if (!$validList) {
            return back()->withErrors('Please enter a valid list of ids for the infrastructures list');
        }
        $shop->infraList = json_encode($validList);

        $validList = $this->validateItemLists($request->input('ridingStableList'));
        if (!$validList) {
            return back()->withErrors('Please enter a valid list of ids for the riding stables list');
        }
        $shop->ridingStableList = json_encode($validList);

        $validList = $this->validateItemLists($request->input('horseClubList'));
        if (!$validList) {
            return back()->withErrors('Please enter a valid list of ids for the horse clubs list');
        }
        $shop->horseClubList = json_encode($validList);

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
    public function show(int $idShop)
    {
        $this->getUser()->hasPermission(['select'], 'shops');

        $shop = new Shop();
        $shop->setConnection($this->getUser()->getRole->name);
        $shop = $shop->findOrFail($idShop);

        $shop->horseList = json_decode($shop->horseList);
        $shop->itemList = json_decode($shop->itemList);
        $shop->infraList = json_decode($shop->infraList);
        $shop->ridingStableList = json_decode($shop->ridingStableList);
        $shop->horseClubList = json_decode($shop->horseClubList);

        return view('shops.show', ['shop' => $shop]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $idShop
     * @return \Illuminate\Http\Response
     */
    public function edit(int $idShop)
    {
        $this->getUser()->hasPermission(['select'], 'shops');

        $shop = new Shop();
        $shop->setConnection($this->getUser()->getRole->name);

        $shop = $shop->findOrFail($idShop);
        $shop->horseList = implode('/', json_decode($shop->horseList));
        $shop->itemList = implode('/', json_decode($shop->itemList));
        $shop->infraList = implode('/', json_decode($shop->infraList));
        $shop->ridingStableList = implode('/', json_decode($shop->ridingStableList));
        $shop->horseClubList = implode('/', json_decode($shop->horseClubList));

        return view('shops.edit', array(
            'shop' => $shop
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ShopRequest  $request
     * @param  \App\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function update(ShopRequest $request, Shop $shop)
    {
        $this->getUser()->hasPermission(['update'], 'shops');

        $shop->setConnection($this->getUser()->getRole->name);

        $shop->fill($request->all());

        $validList = $this->validateItemLists($request->input('horseList'));
        if (!$validList) {
            return back()->withErrors('Please enter a valid list of ids for the horses list');
        }
        $shop->horseList = json_encode($validList);

        $validList = $this->validateItemLists($request->input('itemList'));
        if (!$validList) {
            return back()->withErrors('Please enter a valid list of ids for the items list');
        }
        $shop->itemList = json_encode($validList);

        $validList = $this->validateItemLists($request->input('infraList'));
        if (!$validList) {
            return back()->withErrors('Please enter a valid list of ids for the infrastructures list');
        }
        $shop->infraList = json_encode($validList);

        $validList = $this->validateItemLists($request->input('ridingStableList'));
        if (!$validList) {
            return back()->withErrors('Please enter a valid list of ids for the riding stables list');
        }
        $shop->ridingStableList = json_encode($validList);

        $validList = $this->validateItemLists($request->input('horseClubList'));
        if (!$validList) {
            return back()->withErrors('Please enter a valid list of ids for the horse clubs list');
        }
        $shop->horseClubList = json_encode($validList);

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
                $shop->setConnection($this->getUser()->getRole->name);
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

    /**
     * Validates the received string as the items list
     *
     * @param string $list The items list sent in the update/store form
     */
    private function validateItemLists(string $list)
    {
        $valid = true;

        $explodedItemsList = explode('/', $list);
        foreach ($explodedItemsList as $item) {
            $item = (int)$item;
            if (is_int($item) && $item > 0 && $item <= 1000000) {
                continue;
            }
            $valid = false;
        }

        if ($valid) {
            return $explodedItemsList;
        } else {
            return false;
        }
    }
}
