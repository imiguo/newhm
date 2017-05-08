@extends('layouts.admin')

<style>
    @section('styles')
        @parent
    @endsection
</style>

@section('content')
    <div class="panel panel-default">
        <div class="panel-body table-responsive">
            <h3 class="box-title">Withdraws History</h3>
            <table class="table table-hover table-striped">
                <tbody>
                <tr class="title">
                    <th>Id</th>
                    <th>User</th>
                    <th>Amount</th>
                    <th>Date</th>
                    <th>Batch</th>
                </tr>
                @foreach($withdraws as $withdraw)
                    <tr>
                        <td>{{ $withdraw->id }}</td>
                        <td>{{ isset($withdraw->user) ? $withdraw->user->username : '' }}</td>
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
