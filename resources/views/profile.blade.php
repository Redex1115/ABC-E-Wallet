@foreach($users as $user)
<div class="container">
    <h3>{{$user -> name}}</h3>
    {{QrCode::generate($user -> id)}}

</div>
@endforeach