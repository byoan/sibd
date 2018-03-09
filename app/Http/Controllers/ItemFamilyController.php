<?php

namespace App\Http\Controllers;

use App\ItemFamily;
use Illuminate\Http\Request;
use App\Http\Requests\ItemFamilyRequest;
use Illuminate\Support\Facades\DB;

class ItemFamilyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->getUser()->hasPermission(['select'], 'item_families');

        // Retrieve the full ads list
        $itemFamilysList = DB::connection($this->getUser()->getRole->name)->table('item_families')->paginate(20);

        return view('itemFamilies.index', array(
            'itemFamilies' => $itemFamiliesList
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->getUser()->hasPermission(['insert'], 'item_families');

        return view('itemFamilies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ItemFamilyRequest $request)
    {
        $this->getUser()->hasPermission(['insert'], 'item_families');
        // Set the connection to use after having checked the permissions
        $itemFamily = new ItemFamily();
        $itemFamily->setConnection($this->getUser()->getRole->name);

        $itemFamily->fill($request->all());

        if ($itemFamily->save()) {
            return redirect()->route('itemfamilies.index')->with('success', 'Item family successfully created');
        } else {
            return back()->withErrors('An error occurred while saving the Item family. Please try again later.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ItemFamily  $ItemFamily
     * @return \Illuminate\Http\Response
     */
    public function show(int $idItemFamily)
    {
        $this->getUser()->hasPermission(['select'], 'item_families');

        $itemFamily = new ItemFamily();
        $itemFamily->setConnection($this->getUser()->getRole->name);
        $itemFamily = $itemFamily->findOrFail($idItemFamily);

        return view('itemFamilies.show', ['itemFamily' => $itemFamily]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $idItemFamily
     * @return \Illuminate\Http\Response
     */
    public function edit(int $idItemFamily)
    {
        $this->getUser()->hasPermission(['select'], 'item_families');

        $itemFamily = new ItemFamily();
        $itemFamily->setConnection($this->getUser()->getRole->name);

        $itemFamily = $itemFamily->findOrFail($idItemFamily);

        return view('itemFamilies.edit', array(
            'itemFamily' => $itemFamily
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ItemFamilyRequest  $request
     * @param  \App\ItemFamily  $ItemFamily
     * @return \Illuminate\Http\Response
     */
    public function update(ItemFamilyRequest $request, ItemFamily $itemFamily)
    {
        $this->getUser()->hasPermission(['update'], 'item_families');

        $itemFamily->setConnection($this->getUser()->getRole->name);

        $itemFamily->fill($request->all());

        if ($itemFamily->save()) {
            return redirect()->route('itemfamilies.show', ['idItemFamily' => $itemFamily->id])->with('success', 'Item family successfully updated');
        } else {
            return back()->withErrors('An error occurred while saving the item family. Please try again later.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ItemFamily  $itemFamily
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, int $idItemFamily)
    {
        $this->getUser()->hasPermission(['delete'], 'item_families');

        if ($idItemFamily !== 0) {
            $itemFamily = new ItemFamily();
            $itemFamily->setConnection($this->getUser()->getRole->name);
            $itemFamily = $itemFamily->findOrFail($idItemFamily);

            if ($itemFamily->delete()) {
                return redirect()->route('itemfamilies.index')->with('success', 'Item family successfully deleted');
            } else {
                return back()->with('errors', 'An error occurred while deleting the item family');
            }
        } else {
            $itemFamiliesToDelete = $request->input('list');
            $result = true;

            foreach ($itemFamiliesToDelete as $key => $itemFamilyId) {
                $itemFamily = new ItemFamily();
                $itemFamily->setConnection($this->getUser()->getRole->name);
                $itemFamily = $itemFamily->findOrFail($itemFamilyId);

                if ($itemFamily->delete()) {
                    continue;
                } else {
                    $result = false;
                    break;
                }
            }

            if ($result) {
                $request->session()->flash('success', 'The selected item families were successfully deleted');
            } else {
                $request->session()->flash('errors', 'An error occurred while deleting the selected item families');
            }

            return 'itemfamilies';
        }
    }
}
