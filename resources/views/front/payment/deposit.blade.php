@extends('layouts.front')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Make Deposit</div>
                <div class="panel-body">
                    @include('laravelperfectmoney::perfectmoney-form')
                </div>
            </div>
        </div>
    </div>
@endsection