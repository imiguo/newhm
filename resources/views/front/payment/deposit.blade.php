@extends('layouts.front')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Make Deposit</div>
                <div class="panel-body">
                    <form class="form-horizontal" action="{{ url('/deposit_confirm') }}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="payment_amount" class="col-md-4 control-label">Amount to Deposit</label>

                            <div class="col-md-6">
                                <input id="payment_amount" type="number" class="form-control" name="amount" value="" required autofocus>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="payment_amount" class="col-md-4 control-label">Select Plan</label>

                            <div class="col-md-6">
                                <select class="form-control" name="package">
                                    @foreach($packages as $package)
                                        <option value="{{$package->id}}">{{$package->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="payment_amount" class="col-md-4 control-label">Deposit From</label>

                            <div class="col-md-6">
                                <select class="form-control" name="payment">
                                    @foreach($payments as $key => $payment)
                                        <option value="{{$key}}">{{$payment}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Proceed
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection