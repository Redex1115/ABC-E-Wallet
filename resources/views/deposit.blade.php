
<div class="deposit">
    <form action="{{ url('check-out/deposit') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="Amount">Deposit Amount: </label>
            <input type="number" step="0.01" class="form-control" name="amount" id="amount">
        </div>
        <button class="btn btn-primary" type="submit">Submit</button>
    </form>
</div>