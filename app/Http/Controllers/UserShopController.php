<?php

namespace App\Http\Controllers;

use App\UserShop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->getUser()->hasPermission(['select'], 'user_shops');

        // Retrieve the full horse shop list
        $userShopsList = DB::connection($this->getUser()->getUserShop->name)->table('userShops')->paginate(20);
        
        return view('userShops.index', array(
            'userShops' => $userShopsList
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->getUser()->hasPermission(['insert'], 'user_shops');

        return view('userShops.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->getUser()->hasPermission(['insert'], 'user_shops');
        // Set the connection to use after having checked the permissions
        $userShop = new Shop();
        $userShop->setConnection($this->getUser()->getUserShop->name);

        $userShop->fill($request->all());

        if ($userShop->save()) {
            return redirect()->route('userShops.index')->with('success', 'user shop successfully created');
        } else {
            return back()->withErrors('An error occurred while saving the user shop. Please try again later.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $idUserShop
     * @return \Illuminate\Http\Response
     */
    public function show(int $idUserShop)
    {
        $this->getUser()->hasPermission(['select'], 'user_shops');

        $userShop = new UserShop();
        $userShop->setConnection($this->getUser()->getUserShop->name);
        $userShop = $userShop->findOrFail($idUserShop);

        return view('userShops.show', ['userShop' => $userShop]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $idUserShop
     * @return \Illuminate\Http\Response
     */
    public function edit(int $idUserShop)
    {
        $this->getUser()->hasPermission(['select'], 'user_shops');

        $userShop = new UserShop();
        $userShop->setConnection($this->getUser()->getUserShop->name);

        $userShopshop = $userShop->findOrFail($idUseShop);

        return view('userShops.edit', array(
            'userShop' => $userShop
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserShop  $userShop
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserShop $userShop)
    {
        $this->getUser()->hasPermission(['update'], 'user_shops');

        $userShop->setConnection($this->getUser()->getUserShop->name);

        $userShop->fill($request->all());

        if ($userShop->save()) {
            return redirect()->route('usershops.show', $shop->id)->with('success', 'User shop successfully updated');
        } else {
            return back()->withErrors('An error occurred while saving the user shop. Please try again later.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $idUserShop
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, int $idUserShop)
    {
        $this->getUser()->hasPermission(['delete'], 'user_shops');

        if ($idUserShop !== 0) {
            $userShop = new Shop();
            $userShop->setConnection($this->getUser()->getUserShop->name);
            $userShop = $userShop->findOrFail($idUserShop);

            if ($userShop->delete()) {
                return redirect()->route('usershops.index')->with('success', 'User shop successfully deleted');
            } else {
                return back()->with('errors', 'An error occurred while deleting the user shop');
            }
        } else {
            $userShopsToDelete = $request->input('list');
            $result = true;

            foreach ($userShopsToDelete as $key => $userShopId) {
                $userShop = new UserShop();
                $userShop->setConnection($this->getUser()->getUserShop->name);
                $userShop = $userShop->findOrFail($userShopId);

                if ($userShop->delete()) {
                    continue;
                } else {
                    $result = false;
                    break;
                }
            }

            if ($result) {
                $request->session()->flash('success', 'The selected user shops were successfully deleted');
            } else {
                $request->session()->flash('errors', 'An error occurred while deleting the selected user shop');
            }

            return 'usershops';
        }
    }
}