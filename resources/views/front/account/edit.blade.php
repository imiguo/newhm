@extends('layouts.front')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Account</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="/account/update">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <p class="form-control-static">
                                    {{ Auth::user()->name }}
                                </p>

                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Email</label>

                            <div class="col-md-6">
                                <p class="form-control-static">
                                    {{ Auth::user()->email }}
                                </p>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('full_name') ? ' has-error' : '' }}">
                            <label for="full_name" class="col-md-4 control-label">Full Name</label>

                            <div class="col-md-6">
                                <input id="full_name" type="text" class="form-control" name="full_name" value="{{ old('full_name') ?: Auth::user()->full_name }}" required autofocus>

                                @if ($errors->has('full_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('full_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('perfectmoney') ? ' has-error' : '' }}">
                            <label for="perfectmoney" class="col-md-4 control-label">Perfect Money Account</label>

                            <div class="col-md-6">
                                <input id="perfectmoney" type="text" class="form-control" name="perfectmoney" value="{{ old('perfectmoney') ?: Auth::user()->perfectmoney }}" required autofocus>

                                @if ($errors->has('perfectmoney'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('perfectmoney') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
