@extends('layouts.admin')

<style>
    @section('styles')
        @parent
        .row div {
            margin-top: 10px;
        }
    @endsection
</style>

@section('content')
    <div class="panel panel-default" style="width: 80%; margin: auto">
        <div class="panel-heading">Create Packages</div>
        <div class="panel-body">
            <form class="form-horizontal" action="{{ url('packages') }}" method="POST">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name" class="col-md-4 control-label">Name</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('days') ? ' has-error' : '' }}">
                    <label for="days" class="col-md-4 control-label">Days</label>

                    <div class="col-md-6">
                        <input id="days" type="number" class="form-control" name="days" value="{{ old('days') }}" required autofocus>

                        @if ($errors->has('days'))
                            <span class="help-block">
                                <strong>{{ $errors->first('days') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('commission_rate') ? ' has-error' : '' }}">
                    <label for="commission_rate" class="col-md-4 control-label">Commission Rate</label>

                    <div class="col-md-6">
                        <input id="commission_rate" type="number" class="form-control" name="commission_rate" value="{{ old('commission_rate') ?: 0 }}" required autofocus>

                        @if ($errors->has('commission_rate'))
                            <span class="help-block">
                                <strong>{{ $errors->first('commission_rate') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                    <label for="status" class="col-md-4 control-label">status</label>

                    <div class="col-md-6">
                        <div class="radio-inline">
                            <label>
                                <input type="radio" name="status" value="1" {{ old('status') === 0 ? '' : 'checked' }}> opened
                            </label>
                        </div>
                        <div class="radio-inline">
                            <label>
                                <input type="radio" name="status" value="0" {{ old('status') !== 0 ? '' : 'checked' }}> closed
                            </label>
                        </div>

                        @if ($errors->has('status'))
                            <span class="help-block">
                                <strong>{{ $errors->first('status') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                    <label for="description" class="col-md-4 control-label">Description</label>

                    <div class="col-md-6">
                        <textarea class="form-control" name="description" rows="3">{{ old('description') }}</textarea>

                        @if ($errors->has('description'))
                            <span class="help-block">
                                <strong>{{ $errors->first('description') }}</strong>
                            </span>
                        @endif
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
        <!-- /.box-body -->
    </div>
@endsection

@section('scripts')
@endsection
