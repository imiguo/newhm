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
                    <th>Batch</th>
                </tr>
                @foreach($withdraws as $withdraw)
                    <tr>
                        <td>{{ $withdraw->id }}</td>
                        <td>{{ $withdraw->investor->username }}</td>
                        <td>{{ abs($withdraw->amount) }}</td>
                        <td>{{ $withdraw->date }}</td>
                        <td>{{ $withdraw->payment_batch_num or '-' }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <h3 id="total-amount">Total: $<span>{{ $total }}</span></h3>
        </div>
        <!-- /.box-body -->
    </div>
@endsection
