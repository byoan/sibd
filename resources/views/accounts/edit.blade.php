<form action="/accounts/{{ $account->id }}" method="POST">
    @method('PUT')
    {{ csrf_field() }}
    <input type="number" name="balance" value="{{$account->balance}}">
    <button type="submit">Submit</button>
</form>
