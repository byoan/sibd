<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->getUser()->hasPermission(['select'], 'roles');

        // Retrieve the full horse role list
        $rolesList = DB::connection($this->getUser()->getRole->name)->table('roles')->paginate(20);
        
        return view('roles.index', array(
            'roles' => $rolesList
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->getUser()->hasPermission(['insert'], 'roles');

        return view('roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->getUser()->hasPermission(['insert'], 'roles');
        // Set the connection to use after having checked the permissions
        $role = new Role();
        $role->setConnection($this->getUser()->getRole->name);

        $role->fill($request->all());

        if ($role->save()) {
            return redirect()->route('roles.index')->with('success', 'Role successfully created');
        } else {
            return back()->withErrors('An error occurred while saving the role. Please try again later.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $idRole
     * @return \Illuminate\Http\Response
     */
    public function show(Int $idRole)
    {
        $this->getUser()->hasPermission(['select'], 'roles');

        $role = new Role();
        $role->setConnection($this->getUser()->getRole->name);
        $role = $role->findOrFail($idRole);

        return view('roles.show', ['role' => $role]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $idRole
     * @return \Illuminate\Http\Response
     */
    public function edit(Int $idRole)
    {
        $this->getUser()->hasPermission(['select'], 'roles');

        $role = new Role();
        $role->setConnection($this->getUser()->getRole->name);

        $role = $role->findOrFail($idRole);

        return view('roles.edit', array(
            'role' => $role
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $this->getUser()->hasPermission(['update'], 'roles');

        $role->setConnection($this->getUser()->getRole->name);

        $role->fill($request->all());

        if ($role->save()) {
            return redirect()->route('roles.show', $role->id)->with('success', 'Role successfully updated');
        } else {
            return back()->withErrors('An error occurred while saving the role. Please try again later.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $idRole
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, int $idROle)
    {
        $this->getUser()->hasPermission(['delete'], 'roles');

        if ($idRole !== 0) {
            $role = new Role();
            $role->setConnection($this->getUser()->getRole->name);
            $role = $role->findOrFail($idRole);

            if ($role->delete()) {
                return redirect()->route('roles.index')->with('success', 'Role successfully deleted');
            } else {
                return back()->with('errors', 'An error occurred while deleting the role');
            }
        } else {
            $rolesToDelete = $request->input('list');
            $result = true;

            foreach ($rolesToDelete as $key => $roleId) {
                $role = new Role();
                $role->setConnection($this->getUser()->getRole->name);
                $role = $role->findOrFail($roleId);

                if ($role->delete()) {
                    continue;
                } else {
                    $result = false;
                    break;
                }
            }

            if ($result) {
                $request->session()->flash('success', 'The selected roles were successfully deleted');
            } else {
                $request->session()->flash('errors', 'An error occurred while deleting the selected role');
            }

            return 'roles';
        }
    }
}
