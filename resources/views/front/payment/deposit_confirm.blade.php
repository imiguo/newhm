@extends('layouts.front')

@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">Please confirm your deposit</div>
            <div class="panel-body">
                <div class="form-group">
                    <label for="name" class="col-md-4 control-label">Your Account</label>

                    <div class="col-md-6">
                        <p class="form-control-static">
                            {{ $paymentAccount }} ({{ $payment }})
                        </p>

                    </div>
                </div>
                <div class="form-group">
                    <label for="name" class="col-md-4 control-label">Amount</label>

                    <div class="col-md-6">
                        <p class="form-control-static">
                            {{ $amount }} ($US)
                        </p>

                    </div>
                </div>
                @include('laravelperfectmoney::perfectmoney-form', ['payment_amount' => $amount])
            </div>
        </div>
    </div>
</div>
@endsection