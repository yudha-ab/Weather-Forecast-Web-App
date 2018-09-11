@extends('layouts.app')

@section('page')
<div class="hero" data-bg-image="{{ asset('images/banner.png') }}">
    <div class="container">
        <table class="rwd-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Daftar Kota</th>
                    <th>Status</th>
                    <th>Total Hits</th>
                </tr>
            </thead>
            <tbody>
                @php
                $i = 1;
                @endphp
                @foreach($data AS $key=>$value)
                <tr>
                    <td data-th="#">{{ $i }}</td>
                    <td data-th="Daftar Kota">{{ ucwords($key) }}</td>
                    <td data-th="Status">{{ $value['status'] }}</td>
                    <td data-th="Total Hits">{{ $value['total_hits'] }}</td>
                </tr>
                @php
                $i++;
                @endphp
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection