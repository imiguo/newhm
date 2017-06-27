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
            <form class="form-horizontal" action="{{ url('packages/', $package->id) }}" method="POST">
                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name" class="col-md-4 control-label">Name</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control" name="name" value="{{ old('name') ?: $package->name }}" required autofocus>

                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('unit') ? ' has-error' : '' }}">
                    <label for="unit" class="col-md-4 control-label">Unit</label>

                    <div class="col-md-6">
                        <div class="radio-inline">
                            <label>
                                <input type="radio" name="unit" value="1" {{ old('unit', $package->unit ?: 1) == 1 ? 'checked' : '' }}> day
                            </label>
                        </div>
                        <div class="radio-inline">
                            <label>
                                <input type="radio" name="unit" value="2" {{ old('unit', $package->unit ?: 1) == 2 ? 'checked' : '' }}> week
                            </label>
                        </div>
                        <div class="radio-inline">
                            <label>
                                <input type="radio" name="unit" value="3" {{ old('unit', $package->unit ?: 1) == 3 ? 'checked' : '' }}> month
                            </label>
                        </div>
                        @if ($errors->has('unit'))
                            <span class="help-block">
                                <strong>{{ $errors->first('unit') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('num') ? ' has-error' : '' }}">
                    <label for="num" class="col-md-4 control-label">How Long</label>

                    <div class="col-md-6">
                        <input id="num" type="number" class="form-control" name="num" value="{{ old('num') ?: $package->num }}" required autofocus>

                        @if ($errors->has('num'))
                            <span class="help-block">
                                <strong>{{ $errors->first('num') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('once') ? ' has-error' : '' }}">
                    <label for="once" class="col-md-4 control-label">Once</label>

                    <div class="col-md-6">
                        <div class="radio-inline">
                            <label>
                                <input type="radio" name="once" value="0" {{ old('once', $package->once) == 0 ? 'checked' : '' }}> no
                            </label>
                        </div>
                        <div class="radio-inline">
                            <label>
                                <input type="radio" name="once" value="1" {{ old('once', $package->once) == 1 ? 'checked' : '' }}> yes
                            </label>
                        </div>

                        @if ($errors->has('once'))
                            <span class="help-block">
                                <strong>{{ $errors->first('once') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('commission_rate') ? ' has-error' : '' }}">
                    <label for="commission_rate" class="col-md-4 control-label">Commission Rate</label>

                    <div class="col-md-6">
                        <input id="commission_rate" type="number" class="form-control" name="commission_rate" value="{{ old('commission_rate') ?: $package->commission_rate ?: 0 }}" required autofocus>

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
                                <input type="radio" name="status" value="1" {{ old('status', $package->status ?: 1) ? 'checked' : '' }}> opened
                            </label>
                        </div>
                        <div class="radio-inline">
                            <label>
                                <input type="radio" name="status" value="0" {{ !old('status', $package->status ?: 1) ? 'checked' : '' }}> closed
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
                        <textarea class="form-control" name="description" rows="3">{{ old('description') ?: $package->description }}</textarea>

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
