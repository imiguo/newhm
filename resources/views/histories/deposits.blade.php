@extends('layouts.admin')

<style>
    @section('styles')
        @parent
    @endsection
</style>

@section('content')
    {{ csrf_field() }}
    <div class="panel panel-heading">
        <div class="panel-header">
            <h3 class="box-title">Deposits History</h3>
        </div>
        <!-- /.box-header -->
        <div class="panel-body table-responsive no-padding">
            <table class="table table-hover">
                <tbody><tr>
                    <th>Id</th>
                    <th>User</th>
                    <th>Amount</th>
                    <th>Date</th>
                    <th>Description</th>
                </tr>
                @foreach($deposits as $deposit)
                    <tr>
                        <td>{{ $deposit->id }}</td>
                        <td>{{ $deposit->investor->username }}</td>
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
