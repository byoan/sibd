<?php

namespace App\Http\Controllers;

use App\Account;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAccount;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->getUser()->hasPermission(['select'], 'accounts');

        // Set the mysql connection we'll use using the user role
        $account = new Account();
        $account->setConnection($this->getUser()->getRole());

        // Retrieve the full account list
        $accountsList = $account::all();

        return view('accounts.index', array(
            'accounts' => $accountsList
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->getUser()->hasPermission(['insert'], 'accounts');

        return view('accounts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\StoreAccount  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAccount $request)
    {
        $this->getUser()->hasPermission(['insert', 'update'], 'accounts');

        // Set the connection to use after having checked the permissions
        $account = new Account();
        $account->setConnection($this->getUser()->getRole());

        // Assign data
        $account->balance = $request->input('balance', 0);
        $account->history = json_encode(array(
            'intialBalance' => $account->balance
        ));
        if ($account->save()) {
            return redirect()->route('accounts.index')->with('success', 'Account successfully created');
        } else {
            return back()->withErrors('An error occurred while saving the account. Please try again later.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function show(Account $account)
    {
        $this->getUser()->hasPermission(['select'], 'accounts');
        // Decode transaction history
        $account->history = json_decode($account->history);

        return view('accounts.show', ['account' => $account]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function edit(Account $account)
    {
        $this->getUser()->hasPermission(['select'], 'accounts');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Account $account)
    {
        $this->getUser()->hasPermission(['update'], 'accounts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function destroy(Account $account)
    {
        $this->getUser()->hasPermission(['delete'], 'accounts');
    }
}
