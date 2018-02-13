<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Db;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->getUser()->hasPermission(['select'], 'users');

        // Retrieve the full users list
        $usersList = DB::connection($this->getUser()->getRole->name)->table('users')->paginate(20);

        return view('users.index', array(
            'users' => $usersList
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $idUser
     * @return \Illuminate\Http\Response
     */
    public function show(int $idUser)
    {
        $this->getUser()->hasPermission(['select'], 'users');

        $user = new User();
        $user->setConnection($this->getUser()->getRole->name);
        $user = $user->findOrFail($idUser);

        return view('users.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\UserRequest  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $this->getUser()->hasPermission(['update'], 'users');

        $user->setConnection($this->getUser()->getRole->name);

        $user->fill($request->all());

        if ($user->save()) {
            return redirect()->route('users.show', ['idUser' => $user->id])->with('success', 'User successfully updated');
        } else {
            return back()->withErrors('An error occurred while saving the user. Please try again later.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
