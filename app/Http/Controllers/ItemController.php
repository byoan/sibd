<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;
use App\Http\Requests\ItemRequest;
use Illuminate\Support\Facades\DB;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->getUser()->hasPermission(['select'], 'items');

        // Retrieve the full ads list
        $itemsList = DB::connection($this->getUser()->getRole->name)->table('items')->paginate(20);

        return view('items.index', array(
            'items' => $itemsList
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->getUser()->hasPermission(['insert'], 'items');

        return view('items.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ItemRequest $request)
    {
        $this->getUser()->hasPermission(['insert'], 'items');
        // Set the connection to use after having checked the permissions
        $item = new Item();
        $item->setConnection($this->getUser()->getRole->name);

        $item->fill($request->all());

        if ($item->save()) {
            return redirect()->route('items.index')->with('success', 'Item successfully created');
        } else {
            return back()->withErrors('An error occurred while saving the item. Please try again later.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(int $idItem)
    {
        $this->getUser()->hasPermission(['select'], 'items');

        $item = new Item();
        $item->setConnection($this->getUser()->getRole->name);
        $item = $item->findOrFail($idItem);

        return view('items.show', ['item' => $item]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $idItem
     * @return \Illuminate\Http\Response
     */
    public function edit(int $idItem)
    {
        $this->getUser()->hasPermission(['select'], 'items');

        $item = new Item();
        $item->setConnection($this->getUser()->getRole->name);

        $item = $item->findOrFail($idItem);

        return view('items.edit', array(
            'item' => $item
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ItemRequest  $request
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(ItemRequest $request, Item $item)
    {
        $this->getUser()->hasPermission(['update'], 'items');

        $item->setConnection($this->getUser()->getRole->name);

        $item->fill($request->all());

        if ($item->save()) {
            return redirect()->route('items.show', ['idItem' => $item->id])->with('success', 'Item successfully updated');
        } else {
            return back()->withErrors('An error occurred while saving the item. Please try again later.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, int $idItem)
    {
        $this->getUser()->hasPermission(['delete'], 'items');

        if ($idItem !== 0) {
            $item = new Item();
            $item->setConnection($this->getUser()->getRole->name);
            $item = $item->findOrFail($idItem);

            if ($item->delete()) {
                return redirect()->route('items.index')->with('success', 'Item successfully deleted');
            } else {
                return back()->with('errors', 'An error occurred while deleting the item');
            }
        } else {
            $itemsToDelete = $request->input('list');
            $result = true;

            foreach ($itemsToDelete as $key => $itemId) {
                $item = new Item();
                $item->setConnection($this->getUser()->getRole->name);
                $item = $item->findOrFail($itemId);

                if ($item->delete()) {
                    continue;
                } else {
                    $result = false;
                    break;
                }
            }

            if ($result) {
                $request->session()->flash('success', 'The selected items were successfully deleted');
            } else {
                $request->session()->flash('errors', 'An error occurred while deleting the selected items');
            }

            return 'items';
        }
    }
}
