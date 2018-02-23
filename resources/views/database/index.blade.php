@extends('layouts.app')


@section('content')

<h1>Database dashboard</h1>

<div class="container">
    <h2>Inspection</h2>
    <ul>
        <li><a href="{{ route('mysqladminStatus')}}" title="Check MySQL status">Inspect MySQL server status</a></li>
        <li><a href="{{ route('logs')}}" title="Check logs">Inspect MySQL Error log</a></li>
        <li><a href="{{ route('slowQueries')}}" title="Check slow queries">Inspect MySQL Slow Queries log</a></li>
        <li><a href="{{ route('mysqladminProcessList')}}" title="Check MySQL process list">Inspect MySQL process list</a></li>
        <li><a href="{{ route('mysqladminVariables')}}" title="Check MySQL variables">Inspect MySQL variables</a></li>
    </ul>

    <h2>Maintenance</h2>
    <ul>
        <li>
            Check
            <ul>
                <li><a href="{{ route('maintenanceCheckQuick')}}" title="Perform a quick check on the app's tables">Quick check</a></li>
                <li><a href="{{ route('maintenanceCheckExtended')}}" title="Perform an extended check on the app's tables">Extended check</a></li>
            </ul>
        </li>
        <li>
            Analyze
            <ul>
                <li><a href="{{ route('maintenanceAnalyze')}}" title="Perform an analysis on the app's tables">Analyze</a></li>
            </ul>
        </li>
        <li>
            Repair
            <ul>
                <li><a href="{{ route('maintenanceRepair')}}" title="Perform a repair on the app's tables">Repair</a></li>
            </ul>
        </li>
        <li>
            Optimize
            <ul>
                <li><a href="{{ route('maintenanceOptimize')}}" title="Perform an optimisation on the app's tables">Optimize</a></li>
            </ul>
        </li>
    </ul>

    <h2>Cron</h2>
    <ul>
        <li><a href="{{ route('cronInspect')}}" title="Check CRON inspection logs">Inspect MySQL "Inspect" CRON logs</a></li>
        <li><a href="{{ route('cronDefragment')}}" title="Check CRON defragment logs">Inspect MySQL "Defragment" CRON logs</a></li>
        <li><a href="{{ route('cronOptimize')}}" title="Check CRON optimization logs">Inspect MySQL "Optimize" CRON logs</a></li>
    </ul>
</div>

@endsection
