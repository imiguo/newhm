@extends('layouts.front')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Make Withdraw</div>
                <div class="panel-body">
                    <form class="form-horizontal" action="{{ url('payment/withdraw_process') }}" method="POST">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="amount" class="col-md-4 control-label">Withdraw Amount</label>

                            <div class="col-md-6">
                                <input id="amount" type="number" class="form-control" name="amount" value="" required autofocus>
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