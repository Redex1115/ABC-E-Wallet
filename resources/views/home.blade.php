@extends('layouts.main')

@section('content')
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

<div class="container">
  <input type="hidden" name="userID" id="userID" value="{{Auth::user()->id}}">
    <div class="row">
      <div class="col-md-3"></div>
      <div class="col-md-6">
        <div id="reader" width="600px"></div>
      </div>
      <div class="col-md-3"></div>
    </div>
    <br>
    <div class="row">
      <div class="col-md-8">
        <label>History</label>
        <table>
          <thead>
            <tr>
              <th>No.</th>
              <th>Type</th>
              <th>Amount</th>
            </tr>
          </thead>
          <tbody>
            @foreach($walletHistory as $history)
              <tr>
                <td>{{$loop -> iteration}}</td>
                <td>{{$history -> type}}</td>
                <td>{{$history -> amount}}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="col-md-4">
        <label>Wallet</label>
        <div class="row">
          <div class="col-3">
            <label for="">Balance</label>
            <span>{{$wallet -> balance}}</span>
          </div>
          <div class="col-1">
            <label for="">Action</label>
            <span>
              <a href="{{url('deposit')}}" class="btn btn-primary">Deposit</a>
              <br><br>
              <a href="{{url('withdraw')}}" class="btn btn-primary">Withdraw</a>
            </span>
          </div>
        </div>
      </div>
    </div>
</div>

<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
<script type="text/javascript">
  const html5QrCode = new Html5Qrcode("reader");
  function onScanSuccess(decodedText, decodedResult) {
    $id = document.getElementById("userID").value
    if($id === decodedText){
      alert('You showing your own account qr code.');
    }
    else{
      var text = "Successfully scan";
      if(confirm(text) == true){
        window.location.href = "transfer/" + decodedText;
      }
      else{
        location.reload();
      }
    }
  }

  function viewTransfer($id){

    return route('transfer');
  }

  function onScanFailure(error) {
    setTimeout(() => {
      
    }, 10000);
  }

  let html5QrcodeScanner = new Html5QrcodeScanner(
    "reader",
    { fps: 10, qrbox: {width: 250, height: 250} },
    /* verbose= */ false);
  html5QrcodeScanner.render(onScanSuccess, onScanFailure);
</script>
<script>
    document.getElementById('datePicker').valueAsDate = new Date();
</script>

@endsection
