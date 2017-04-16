@extends('layouts.front')

@section('content')
    <div class="content">
        <div class="title m-b-md" style="font-size: 42px;">
            Your referral link: {{ config('app.url') }}?ref={{ auth()->user()->name }}
        </div>
    </div>
@endsection