@extends('layouts.admin')

<style>
    @section('styles')
        @parent
    @endsection
</style>

@section('content')
    <div class="panel panel-default">
        <div class="panel-body table-responsive">
            <a class="btn btn-info pull-right" href="{{ url('packages/create') }}">create new</a>
            <h3 class="box-title">Plan Packages</h3>
            <table class="table table-hover table-striped">
                <tbody>
                <tr class="title">
                    <th>Package Id</th>
                    <th>Name</th>
                    <th>Days</th>
                    <th>Commission Rate</th>
                    <th>status</th>
                    <th>Actions</th>
                </tr>
                @foreach($packages as $package)
                    <tr>
                        <td>{{ $package->id }}</td>
                        <td>{{ $package->name }}</td>
                        <td>{{ $package->days }}</td>
                        <td>{{ $package->commission_rate }}</td>
                        <td>{{ $package->status ? 'opened' : 'closed' }}</td>
                        <td>
                            <a class="btn btn-default" href="/packages/{{ $package->id }}/edit" role="button">edit</a>
                            <a class="btn btn-default" href="/packages/{{ $package->id }}/plan/create" role="button">create plan</a>
                            <a class="btn btn-default delete" href="/packages/{{ $package->id }}" role="button" onclick="event.preventDefault();">delete</a>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6" class="text-center">
                            @if (count($package->plans))
                                <table class="table">
                                    <tr class="info">
                                        <td>Plan Id</td>
                                        <td>Plan Name</td>
                                        <td>Range</td>
                                        <td>Percent</td>
                                        <td>Status</td>
                                        <td>Actions</td>
                                    </tr>
                                    @foreach($package->plans as $plan)
                                        <tr>
                                            <td>{{ $plan->id }}</td>
                                            <td>{{ $plan->name }}</td>
                                            <td>${{ $plan->max }} - ${{ $plan->max }}</td>
                                            <td>{{ $plan->percent }}%</td>
                                            <td>{{ $plan->status ? 'opened' : 'closed' }}</td>
                                            <td>
                                                <a class="btn btn-default" href="/packages/{{ $package->id }}/plan/{{ $plan->id }}/edit" role="button">edit</a>
                                                <a class="btn btn-default delete" href="/packages/{{ $package->id }}/plan/{{ $plan->id }}" role="button" onclick="event.preventDefault();">delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            @else
                                no plans
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
@endsection

@section('scripts')
<script>
$(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('.delete').on('click', function() {
        var $this = $(this);
        $.ajax({
            url: $this.attr('href'),
            type: 'POST',
            data: {_method: 'DELETE'},
        }).done(function() {
            window.location.reload();
        });
    });
});
</script>
@endsection
