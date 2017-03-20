@extends('layouts.master')

@section('title')
Dorminator Home
@endsection


@section('styles')
@endsection

@section('content')
@include('dashboard.navigation')

@endsection

@section('scripts')
<script type="text/javascript" src="{{ URL::asset('js/profile.js') }}"></script>
<script>
// Data Picker Initialization
$('.datepicker').pickadate();


// Material Select Initialization
$(document).ready(function() {
    $('.mdb-select').material_select();
});

// Sidenav Initialization
$(".button-collapse").sideNav();
var el = document.querySelector('.custom-scrollbar');
Ps.initialize(el);

// Tooltips Initialization
$(function() {
    $('[data-toggle="tooltip"]').tooltip();
});
</script>
@endsection

