<?php

namespace App\Http\Controllers;

use App\UserShop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\UserShopRequest;

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
        $userShopsList = DB::connection($this->getUser()->getRole->name)->table('user_shops')->paginate(20);

        return view('userShops.index', array(
            'shops' => $userShopsList
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
    public function store(UserShopRequest $request)
    {
        $this->getUser()->hasPermission(['insert'], 'user_shops');
        // Set the connection to use after having checked the permissions
        $shop = new UserShop();
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
        $shop->idUser = (int)$request->input('idUser');

        if ($shop->save()) {
            return redirect()->route('usershops.index')->with('success', 'User shop successfully created');
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

        $shop = new UserShop();
        $shop->setConnection($this->getUser()->getRole->name);
        $shop = $shop->findOrFail($idUserShop);

        $shop->horseList = json_decode($shop->horseList);
        $shop->itemList = json_decode($shop->itemList);
        $shop->infraList = json_decode($shop->infraList);
        $shop->ridingStableList = json_decode($shop->ridingStableList);
        $shop->horseClubList = json_decode($shop->horseClubList);

        return view('usershops.show', ['shop' => $shop]);
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

        $shop = new UserShop();
        $shop->setConnection($this->getUser()->getRole->name);

        $shop = $shop->findOrFail($idUserShop);
        $shop->horseList = implode('/', json_decode($shop->horseList));
        $shop->itemList = implode('/', json_decode($shop->itemList));
        $shop->infraList = implode('/', json_decode($shop->infraList));
        $shop->ridingStableList = implode('/', json_decode($shop->ridingStableList));
        $shop->horseClubList = implode('/', json_decode($shop->horseClubList));

        return view('usershops.edit', array(
            'shop' => $shop
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UserShopRequest  $request
     * @param  int  $userShopId
     * @return \Illuminate\Http\Response
     */
    public function update(UserShopRequest $request, int $userShopId)
    {
        $this->getUser()->hasPermission(['update'], 'user_shops');
        $userShop = new UserShop();
        $userShop->setConnection($this->getUser()->getRole->name);

        $userShop = $userShop->findOrFail($userShopId);
        $userShop->fill($request->all());

        $validList = $this->validateItemLists($request->input('horseList'));
        if (!$validList) {
            return back()->withErrors('Please enter a valid list of ids for the horses list');
        }
        $userShop->horseList = json_encode($validList);

        $validList = $this->validateItemLists($request->input('itemList'));
        if (!$validList) {
            return back()->withErrors('Please enter a valid list of ids for the items list');
        }
        $userShop->itemList = json_encode($validList);

        $validList = $this->validateItemLists($request->input('infraList'));
        if (!$validList) {
            return back()->withErrors('Please enter a valid list of ids for the infrastructures list');
        }
        $userShop->infraList = json_encode($validList);

        $validList = $this->validateItemLists($request->input('ridingStableList'));
        if (!$validList) {
            return back()->withErrors('Please enter a valid list of ids for the riding stables list');
        }
        $userShop->ridingStableList = json_encode($validList);

        $validList = $this->validateItemLists($request->input('horseClubList'));
        if (!$validList) {
            return back()->withErrors('Please enter a valid list of ids for the horse clubs list');
        }
        $userShop->horseClubList = json_encode($validList);
        $userShop->idUser = (int)$request->input('idUser');

        if ($userShop->save()) {
            return redirect()->route('usershops.show', $userShop->id)->with('success', 'User shop successfully updated');
        } else {
            return back()->withErrors('An error occurred while saving the user shop. Please try again later.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $idUserShop
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, int $idUserShop)
    {
        $this->getUser()->hasPermission(['delete'], 'user_shops');

        if ($idUserShop !== 0) {
            $userShop = new UserShop();
            $userShop->setConnection($this->getUser()->getRole->name);
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
                $userShop->setConnection($this->getUser()->getRole->name);
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
