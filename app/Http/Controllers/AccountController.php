<?php

namespace App\Http\Controllers;

use App\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Db;
use App\Http\Requests\AccountRequest;

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

        // Retrieve the full account list
        $accountsList = DB::connection($this->getUser()->getRole())->table('accounts')->paginate(20);

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
     * @param  \Illuminate\Http\AccountRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AccountRequest $request)
    {
        $this->getUser()->hasPermission(['insert', 'update'], 'accounts');

        // Set the connection to use after having checked the permissions
        $account = new Account();
        $account->setConnection($this->getUser()->getRole());

        // Assign data
        $account->balance = $request->input('balance', 0);
        $account->history = json_encode(array(array(
            'transactionName' => 'Initial deposit',
            'newBalance' => $account->balance
        )));
        if ($account->save()) {
            return redirect()->route('accounts.index')->with('success', 'Account successfully created');
        } else {
            return back()->withErrors('An error occurred while saving the account. Please try again later.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int  $idAccount
     * @return \Illuminate\Http\Response
     */
    public function show(int $idAccount)
    {
        $this->getUser()->hasPermission(['select'], 'accounts');

        $account = new Account();
        $account->setConnection($this->getUser()->getRole());
        $account = $account->findOrFail($idAccount);

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
    public function edit(int $idAccount)
    {
        $this->getUser()->hasPermission(['select'], 'accounts');

        $account = new Account();
        $account->setConnection($this->getUser()->getRole());

        $account = $account->findOrFail($idAccount);

        return view('accounts.edit', ['account' => $account]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\AccountRequest  $request
     * @param  \App\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function update(AccountRequest $request, Account $account)
    {
        $this->getUser()->hasPermission(['update'], 'accounts');

        $account->setConnection($this->getUser()->getRole());

        $account->balance = $request->input('balance', 0);

        $decodedHistory = json_decode($account->history);
        array_push($decodedHistory, array(
            'transactionName' => 'Updated balance',
            'newBalance' => $account->balance
        ));
        $account->history = json_encode($decodedHistory);

        if ($account->save()) {
            return redirect()->route('accounts.show', ['idAccount' => $account->id])->with('success', 'Account successfully updated');
        } else {
            return back()->withErrors('An error occurred while saving the account. Please try again later.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $account
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, int $idAccount)
    {
        $this->getUser()->hasPermission(['delete'], 'accounts');

        if ($idAccount !== 0) {
            $account = new Account();
            $account->setConnection($this->getUser()->getRole());
            $account = $account->findOrFail($idAccount);

            if ($account->delete()) {
                return redirect()->route('accounts.index')->with('success', 'Account successfully deleted');
            } else {
                return back()->with('errors', 'An error occurred while deleting the account');
            }
        } else {
            $accountsToDelete = $request->input('list');
            $result = true;

            foreach($accountsToDelete as $key => $accountId) {
                $account = new Account();
                $account->setConnection($this->getUser()->getRole());
                $account = $account->findOrFail($accountId);

                if ($account->delete()) {
                    continue;
                } else {
                    $result = false;
                    break;
                }
            }

            if ($result) {
                $request->session()->flash('success', 'The selected accounts were successfully deleted');
            } else {
                $request->session()->flash('errors', 'An error occurred while deleting the selected accounts');
            }

            return 'accounts';
        }
    }
}
