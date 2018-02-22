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
        $this->checkIfAllowed();

        return view('database.index');
    }

    /**
     * Displays the database error logs
     *
     * @return string
     */
    public function logs()
    {
        $this->checkIfAllowed();

        if (readlink('../storage/logs/error.log')) {
            // We have created a symlink to the actual MySQL log file
            $logs = explode("\n", file_get_contents(readlink('../storage/logs/error.log')));
            return view('database.logs', array(
                'title' => 'Error',
                'logs' => $logs
            ));
        } else {
            return 'Could not open the error.log file. Please check that it is properly placed and readable.';
        }
    }

    /**
     * Displays the database slow queries log
     *
     * @return string
     */
    public function slowQueries()
    {
        $this->checkIfAllowed();

        if (readlink('../storage/logs/slow-queries.log')) {
            // We have created a symlink to the actual MySQL log file
            $logs = explode("\n", file_get_contents(readlink('../storage/logs/slow-queries.log')));
            return view('database.logs', array(
                'title' => 'Slow Queries',
                'logs' => $logs
            ));
        } else {
            return 'Could not open the slow-queries.log file. Please check that it is properly placed and readable.';
        }
    }

    /**
     * Inspects all the databases
     *
     * @return void
     */
    public function inspect()
    {
        $this->checkIfAllowed();
        $config = $this->retrieveDbCredentialsFromConfig();

        return view('database.maintenance', array(
            'name' => 'Inspection of the databases',
            'result' => shell_exec('/usr/bin/mysqlcheck -e ' . $config['database'] . ' -u ' . $config['username'] . " -p" . $config['password'])
        ));
    }

    /**
     * Checks the app database with the quick flag
     *
     * @return void
     */
    public function checkQuick()
    {
        $this->checkIfAllowed();
        $config = $this->retrieveDbCredentialsFromConfig();

        return view('database.maintenance', array(
            'name' => 'Quick inspection of the database ' . $config['database'],
            'result' => shell_exec('/usr/bin/mysqlcheck -q ' . $config['database'] . ' -u ' . $config['username'] . " -p" . $config['password'])
        ));
    }

    /**
     * Checks the app database with the extended flag
     *
     * @return void
     */
    public function checkExtended()
    {
        $this->checkIfAllowed();
        $config = $this->retrieveDbCredentialsFromConfig();

        return view('database.maintenance', array(
            'name' => 'Extended inspection of the database ' . $config['database'],
            'result' => shell_exec('/usr/bin/mysqlcheck -e ' . $config['database'] . ' -u ' . $config['username'] . " -p" . $config['password'])
        ));
    }

    /**
     * Analyzes the app database's tables
     *
     * @return void
     */
    public function analyze()
    {
        $this->checkIfAllowed();
        $config = $this->retrieveDbCredentialsFromConfig();

        return view('database.maintenance', array(
            'name' => 'Analysis of the database ' . $config['database'] . '\'s tables',
            'result' => shell_exec('/usr/bin/mysqlanalyze ' . $config['database'] . ' -u ' . $config['username'] . " -p" . $config['password'])
        ));
    }

    /**
     * Repairs the app database's tables
     *
     * @return void
     */
    public function repair()
    {
        $this->checkIfAllowed();
        $config = $this->retrieveDbCredentialsFromConfig();

        return view('database.maintenance', array(
            'name' => 'Repair of the database ' . $config['database'] . '\'s tables',
            'result' => shell_exec('/usr/bin/mysqlrepair ' . $config['database'] . ' -u ' . $config['username'] . " -p" . $config['password'])
        ));
    }

    /**
     * Optimizes the app database's tables
     *
     * @return void
     */
    public function optimize()
    {
        $this->checkIfAllowed();
        $config = $this->retrieveDbCredentialsFromConfig();

        return view('database.maintenance', array(
            'name' => 'Optimization of the database ' . $config['database'] . '\'s tables',
            'result' => shell_exec('/usr/bin/mysqloptimize ' . $config['database'] . ' -u ' . $config['username'] . " -p" . $config['password'])
        ));
    }

    /**
     * Displays the MySQL's server variables to the user
     *
     * @return string
     */
    public function serverVariables()
    {
        $this->checkIfAllowed();
        $config = $this->retrieveDbCredentialsFromConfig();

        return view('database.mysqladmin', [
            'title' => 'variables',
            'logs' => shell_exec("/usr/bin/mysqladmin -u " . $config['username'] . " -p" . $config['password'] . " variables")
        ]);
    }

    /**
     * Displays the MySQL's server process list to the user
     *
     * @return string
     */
    public function serverProcessList()
    {
        $this->checkIfAllowed();
        $config = $this->retrieveDbCredentialsFromConfig();

        return view('database.mysqladmin', [
            'title' => 'process list',
            'logs' => shell_exec("/usr/bin/mysqladmin -u " . $config['username'] . " -p" . $config['password'] . " processlist")
        ]);
    }

    /**
     * Displays the MySQL's server status to the user
     *
     * @return string
     */
    public function serverStatus()
    {
        $this->checkIfAllowed();
        $config = $this->retrieveDbCredentialsFromConfig();

        return view('database.mysqladmin', [
            'title' => 'status',
            'logs' => shell_exec("/usr/bin/mysqladmin -u " . $config['username'] . " -p" . $config['password'] . " status")
        ]);
    }

    /**
     * Retrieves the database connection that matches the current User's role
     *
     * @return array
     */
    private function retrieveDbCredentialsFromConfig()
    {
        $credentials = config('database.connections.' . $this->getUser()->getRole->name);
        if (empty($credentials)) {
            abort(500, 'An error occurred while retrieving the MySQL credentials associated to your account\'s role');
        }

        return $credentials;
    }

    /**
     * Checks that the current user's role is allowed to access the database management area based on the role name
     *
     * @return void
     */
    private function checkIfAllowed()
    {
        if (!in_array($this->getUser()->getRole->name, ['automatedTask', 'admin'])) {
            abort(403, 'You are not allowed to access this area of the application');
        }
    }
}
