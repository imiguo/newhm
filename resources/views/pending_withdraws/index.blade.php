@extends('layouts.admin')

<style>
@section('styles')
    @parent
@endsection
</style>

@section('content')
<form action="/withdraw/process" method="POST" id="process-form">
{{ csrf_field() }}
<div class="panel panel-heading">
    <div class="panel-header">
        <h3 class="box-title">Withdraw Pendings</h3>
    </div>
    <!-- /.box-header -->
    <div class="panel-body table-responsive no-padding">
        <table class="table table-hover">
            <tbody><tr>
                <th>UserId</th>
                <th>User</th>
                <th>Amount</th>
                <th>pm</th>
                <th>Date</th>
                <th>Description</th>
                <th>Select</th>
            </tr>
            @foreach($pendings as $pending)
            <tr>
                <td>{{ $pending->investor->id }}</td>
                <td>{{ $pending->investor->username }}</td>
                <td>{{ abs($pending->amount) }}</td>
                <td>{{ $pending->investor->perfectmoney_account }}</td>
                <td>{{ $pending->date }}</td>
                <td>{{ $pending->description }}</td>
                <td>
                    <input name="pendingIds[]" value="{{ $pending->id }}" type="checkbox" class="pending-select">
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
        <div class="checkbox" id="select-all">
            <label>
                <input type="checkbox"> Select All
            </label>
        </div>
        <h3 id="total-amount">Total: $<span>0</span></h3>
        <p><button type="submit" class="btn btn-lg">Process</button></p>
    </div>
    <!-- /.box-body -->
</div>
</form>
@endsection

@section('scripts')
    <script>
        $(function() {
            $('#select-all input').change(function() {
                var check_all = $(this).prop('checked');
                var pending_selects = $('.pending-select');
                pending_selects.prop('checked', check_all);
                var $total = $('#total-amount span');
                var total = 0;
                if (check_all) {
                    pending_selects.each(function() {
                        var $this = $(this);
                        total += parseFloat($this.closest('tr').find('td:eq(2)').html());
                    });
                }
                $total.html(total);
            });
            $('.pending-select').change(function() {
                var $this = $(this);
                var $total = $('#total-amount span');
                var checked = $this.prop('checked');
                if (! checked) {
                    $('#select-all input').prop('checked', false);
                }
                if ($('.pending-select').length == $('.pending-select:checked').length) {
                    $('#select-all input').prop('checked', true);
                }
                var total = parseFloat($total.html());
                total += (checked ? 1 : -1) * parseFloat($this.closest('tr').find('td:eq(2)').html()).toFixed(2);
                $total.html(total);
            });

            $('#process-form').submit(function() {
                if (! $('.pending-select:checked').length) {
                    swal("Oops!", "You have to select least one", "error");
                    event.preventDefault();
                }
            });
        });
    </script>
@endsection
