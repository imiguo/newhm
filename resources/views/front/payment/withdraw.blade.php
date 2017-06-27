@extends('layouts.front')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Make Withdraw</div>
                <div class="panel-body">
                    <form class="form-horizontal" action="{{ url('/withdraw_process') }}" method="POST">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="amount" class="col-md-4 control-label">Withdraw Amount</label>

                            <div class="col-md-6">
                                <input id="amount" type="number" class="form-control" name="amount" value="" required autofocus>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('msg') ? ' has-error' : '' }}">
                            <label for="msg" class="col-md-4 control-label">Message</label>

                            <div class="col-md-6">
                                <textarea id="msg" class="form-control" name="msg" rows="3">{{ old('msg') }}</textarea>

                                @if ($errors->has('msg'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('msg') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Proceed
                                </button>
                                <button class="btn btn-primary" onclick="document.location=window.history.go(-1)">
                                    Cancel
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection