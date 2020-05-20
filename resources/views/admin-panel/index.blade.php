@extends('layouts.app')

@section('content')
<div class="container" style="max-width: 100vw;">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <server-dashboard name="Production"></server-dashboard>
        </div>
        <div class="col-md-5">
            <server-dashboard name="Development"></server-dashboard>
        </div>
    </div>
</div>
@endsection
