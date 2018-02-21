<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DatabaseController extends Controller
{
    /**
     * Displays the database dashboard
     *
     * @return Response
     */
    public function index()
    {
        if (in_array($this->getUser()->getRole->name, ['automatedTask', 'admin'])) {
            return view('database.index');
        } else {
            abort(403, 'You are not allowed to access this area');
        }
    }
    /**
     * Displays the database erro logs
     *
     * @return void
     */
    public function logs()
    {
        if (in_array($this->getUser()->getRole->name, ['automatedTask', 'admin'])) {
            $logs = explode("\n", file_get_contents('../storage/logs/error.log'));
            return view('database.logs', ['logs' => $logs]);
        } else {
            abort(403, 'You are not allowed to access this area');
        }
    }
}
