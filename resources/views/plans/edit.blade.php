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
        <div class="panel-heading">Edit Plan</div>
        <div class="panel-body">
            <form class="form-horizontal" action="/packages/{{ $plan->package->id }}/plan/{{ $plan->id }}/update" method="POST">
                {{ csrf_field() }}

                <div class="form-group">
                    <label class="col-md-4 control-label">Package Name</label>

                    <div class="col-md-6">
                        <p class="form-control-static">
                            {{ $plan->package->name }}
                        </p>
                    </div>
                </div>

                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name" class="col-md-4 control-label">Name</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control" name="name" value="{{ old('name') ?: $plan->name }}" required autofocus>

                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('min') ? ' has-error' : '' }}">
                    <label for="min" class="col-md-4 control-label">Min</label>

                    <div class="col-md-6">
                        <input id="min" type="number" class="form-control" name="min" value="{{ old('min') ?: $plan->min }}" required autofocus>

                        @if ($errors->has('min'))
                            <span class="help-block">
                                <strong>{{ $errors->first('min') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('max') ? ' has-error' : '' }}">
                    <label for="max" class="col-md-4 control-label">Max</label>

                    <div class="col-md-6">
                        <input id="max" type="number" class="form-control" name="max" value="{{ old('max') ?: $plan->max }}" required autofocus>

                        @if ($errors->has('max'))
                            <span class="help-block">
                                <strong>{{ $errors->first('max') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('percent') ? ' has-error' : '' }}">
                    <label for="percent" class="col-md-4 control-label">Percent</label>

                    <div class="col-md-6">
                        <input id="percent" type="number" class="form-control" name="percent" value="{{ old('percent') ?: $plan->percent }}" required autofocus>

                        @if ($errors->has('percent'))
                            <span class="help-block">
                                <strong>{{ $errors->first('percent') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                    <label for="status" class="col-md-4 control-label">status</label>

                    <div class="col-md-6">
                        <div class="radio-inline">
                            <label>
                                <input type="radio" name="status" value="1" {{ (is_null(old('status')) ? $plan->status : old('status')) === 0 ? '' : 'checked' }}> opened
                            </label>
                        </div>
                        <div class="radio-inline">
                            <label>
                                <input type="radio" name="status" value="0" {{ (is_null(old('status')) ? $plan->status : old('status')) !== 0 ? '' : 'checked' }}> closed
                            </label>
                        </div>

                        @if ($errors->has('status'))
                            <span class="help-block">
                                <strong>{{ $errors->first('status') }}</strong>
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
