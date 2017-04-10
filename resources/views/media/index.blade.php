@extends('layouts.master')

@section('title', 'Media')

@section('content')

    @include('dashboard.navigation')

    @foreach ($media as $row)
        <table>
            <tr>{{ $row->title }}</tr>
        </table>
    @endforeach
@endsection
