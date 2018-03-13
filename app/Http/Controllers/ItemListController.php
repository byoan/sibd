<?php

namespace App\Http\Controllers;

use App\ItemList;
use Illuminate\Http\Request;
use App\Http\Requests\ItemListRequest;
use Illuminate\Support\Facades\DB;

class ItemListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->getUser()->hasPermission(['select'], 'item_lists');

        // Retrieve the full items relations lists list
        $itemListsList = DB::connection($this->getUser()->getRole->name)->table('item_lists')->paginate(20);

        return view('itemLists.index', array(
            'itemLists' => $itemListsList
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->getUser()->hasPermission(['insert'], 'item_lists');

        return view('itemLists.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ItemListRequest $request)
    {
        $this->getUser()->hasPermission(['insert'], 'item_lists');
        // Set the connection to use after having checked the permissions
        $itemList = new ItemList();
        $itemList->setConnection($this->getUser()->getRole->name);

        $itemList->fill($request->all());

        if ($itemList->save()) {
            return redirect()->route('itemslist.index')->with('success', 'Item-Horse relation successfully created');
        } else {
            return back()->withErrors('An error occurred while saving the relation. Please try again later.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $idItemList
     * @return \Illuminate\Http\Response
     */
    public function show(int $idItemList)
    {
        $this->getUser()->hasPermission(['select'], 'item_lists');

        $itemList = new ItemList();
        $itemList->setConnection($this->getUser()->getRole->name);
        $itemList = $itemList->findOrFail($idItemList);

        return view('itemLists.show', ['itemList' => $itemList]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $idItemList
     * @return \Illuminate\Http\Response
     */
    public function edit(int $idItemList)
    {
        $this->getUser()->hasPermission(['select'], 'item_lists');

        $itemList = new ItemList();
        $itemList->setConnection($this->getUser()->getRole->name);

        $itemList = $itemList->findOrFail($idItemList);

        return view('itemLists.edit', array(
            'itemList' => $itemList
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ItemListRequest  $request
     * @param  int  $idItemList
     * @return \Illuminate\Http\Response
     */
    public function update(ItemListRequest $request, int $idItemList)
    {
        $this->getUser()->hasPermission(['update'], 'item_lists');
        $itemList = new ItemList();
        $itemList->setConnection($this->getUser()->getRole->name);
        $itemList = $itemList->findOrFail($idItemList);
        $itemList->fill($request->all());

        if ($itemList->save()) {
            return redirect()->route('itemslist.show', ['idItemList' => $itemList->id])->with('success', 'ItemList successfully updated');
        } else {
            return back()->withErrors('An error occurred while saving the itemList. Please try again later.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ItemList  $itemList
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, int $idItemList)
    {
        $this->getUser()->hasPermission(['delete'], 'item_lists');

        if ($idItemList !== 0) {
            $itemList = new ItemList();
            $itemList->setConnection($this->getUser()->getRole->name);
            $itemList = $itemList->findOrFail($idItemList);

            if ($itemList->delete()) {
                return redirect()->route('itemslist.index')->with('success', 'The Item-Horse relation was successfully deleted');
            } else {
                return back()->with('errors', 'An error occurred while deleting the relation');
            }
        } else {
            $itemListsToDelete = $request->input('list');
            $result = true;

            foreach ($itemListsToDelete as $key => $itemListId) {
                $itemList = new ItemList();
                $itemList->setConnection($this->getUser()->getRole->name);
                $itemList = $itemList->findOrFail($itemListId);

                if ($itemList->delete()) {
                    continue;
                } else {
                    $result = false;
                    break;
                }
            }

            if ($result) {
                $request->session()->flash('success', 'The selected relations were successfully deleted');
            } else {
                $request->session()->flash('errors', 'An error occurred while deleting the selected relations');
            }

            return 'itemslist';
        }
    }
}
