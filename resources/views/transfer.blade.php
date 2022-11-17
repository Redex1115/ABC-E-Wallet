<div class="transfer">
    <form action="{{ url('check-out/transfer') }}" method="POST">
        @csrf
        @foreach($users as $user)
        <input type="hidden" name="userID" id="userID" value="{{$user -> id}}">
        <div class="form-group">
            <input type="text" name="userName" id="userName" value="{{$user -> name}}" readonly>
        </div>
        <div class="form-group">
            <label for="amount">Transfer Amount: </label>
            <input type="number" name="amount" id="amount" class="form-control">
        </div>
        @endforeach
        <button class="btn btn-primary" type="submit">Submit</button>
    </form>
</div>