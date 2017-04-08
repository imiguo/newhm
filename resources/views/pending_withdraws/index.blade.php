@extends('layouts.app')

@section('styles')
    <style>
        body {
            padding-top: 50px;
        }
        .panel {
            background: #ffffff;
            border-top: 5px solid #6b15a1;
            width: 100%;
            box-shadow: 0 2px 20px rgba(0,0,0,0.2);
        }
        .btn {
            border: 1px solid #6b15a1;
            background: #6b15a1;
            font-size: 14px;
            padding: 7px 24px;
            border-radius: 4px;
            color: #fff;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        @if (session()->has('flash_notification.message'))
            <div class="alert alert-{{ session('flash_notification.level') }}">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

                {!! session('flash_notification.message') !!}
            </div>
        @endif

        <form action="/withdraw/process" method="POST">
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
                        <th>Date</th>
                        <th>Description</th>
                        <th>Select</th>
                    </tr>
                    @foreach($pendings as $pending)
                    <tr>
                        <td>{{ $pending->user->id }}</td>
                        <td>{{ $pending->user->username }}</td>
                        <td>{{ abs($pending->amount) }}</td>
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
    </div>
@endsection

@section('scripts')
    <script>
        $(function() {
            $('#select-all').change(function() {
                var check_all = $('.pending-select').prop('checked');
                $('.pending-select').prop('checked', !check_all);
                var $total = $('#total-amount span');
                var total = 0;
                if (!check_all) {
                    $('.pending-select').each(function() {
                        var $this = $(this);
                        total += parseFloat($this.closest('tr').find('td:eq(2)').html());
                    });
                }
                $total.html(total);
            });
            $('.pending-select').change(function() {
                var $this = $(this);
                var $total = $('#total-amount span');
                var total = parseInt($total.html());
                total += ($this.prop('checked') ? 1 : -1) * parseFloat($this.closest('tr').find('td:eq(2)').html());
                $total.html(total);
            });
        });
    </script>
@endsection
