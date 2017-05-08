@extends('layouts.admin')

<style>
    @section('styles')
        @parent
    @endsection
</style>

@section('content')
    <div class="panel panel-default">
        <div class="panel-body table-responsive">
            <h3 class="box-title">Deposits History</h3>
            <table class="table table-hover table-striped">
                <tbody>
                <tr class="title">
                    <th>Id</th>
                    <th>User</th>
                    <th>Amount</th>
                    <th>Date</th>
                    <th>Description</th>
                </tr>
                @foreach($deposits as $deposit)
                    <tr>
                        <td>{{ $deposit->id }}</td>
                        <td>{{ isset($deposit->user) ? $deposit->user->username : '' }}</td>
                        <td>{{ abs($deposit->amount) }}</td>
                        <td>{{ $deposit->date }}</td>
                        <td>{{ $deposit->description }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <h3 id="total-amount">Total: <span>{{ $total }}</span></h3>
        </div>
        <!-- /.box-body -->
    </div>
@endsection
