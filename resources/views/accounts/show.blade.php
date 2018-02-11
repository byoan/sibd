<h1>Account details</h1>

<h2>Account id : {{ $account->id }}</h2>
<h2>Account balance : {{ $account->balance }}</h2>
<h2>Account history</h2>
<ul>
    @if (empty($account->history))
    <li>No transactions available</li>
    @else
        @foreach ($account->history as $id => $row)
            <li>{{ $row->transactionName }} : {{ $row->newBalance }}</li>
        @endforeach
    @endif
</ul>
