@extends('layouts.master')

@section('title', 'Voluntari')

@section('content')
  @include('dashboard.navigation')
  <main class="">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-3">
          <div class="card-body">
            <a href="{{ route('volunteers.create') }}" class="btn btn-primary btn-lg btn-block">
              <i class="fa fa-plus left"></i> Voluntar nou
            </a>
            <div class="mt-2">
              <small>Ticket categories:</small>
              <ul class="striped">
                <li><span class="bullet green"></span> Invoices <span class="badge bg-primary float-right">14</span></li>
                <li><span class="bullet blue"></span> Advertising <span class="badge bg-primary float-right">1</span></li>
                <li><span class="bullet red"></span> Functions <span class="badge bg-primary float-right">3</span></li>
                <li><span class="bullet yellow"></span> Website <span class="badge bg-primary float-right">9</span></li>
                <li><span class="bullet orange"></span> Clients <span class="badge bg-primary float-right">5</span></li>
                <li><span class="bullet deep-purple"></span> Technical Questions <span class="badge bg-primary label-pill float-right">4</span></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-md-8 offset-md-1 white z-depth-1 py-1 pt-1">
          <div class="row">
            <div class="col-sm-6 col-md-9 py-1 px-1">
              <h4 class="h4-responsive">Voluntari ({{ $volunteers->count() }})</h4>
            </div>
            <div class="col-sm-6 col-md-3">
              <div class="md-form">
                <input placeholder="Search..." type="text" id="form5" class="form-control">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th>
                        <fieldset class="form-group">
                          <input type="checkbox" id="checkbox0">
                          <label for="checkbox0"></label>
                        </fieldset>
                      </th>
                      <th>Nume</th>
                      <th>Email</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($volunteers as $volunteer)
                      <tr>
                        <th scope="row">
                          <fieldset class="form-group">
                            <input type="checkbox" id="checkbox{{ $volunteer->id }}">
                            <label for="checkbox{{ $volunteer->id }}"></label>
                          </fieldset>
                        </th>
                        <td><div class="avatar-placeholder green darken-3">{{ $volunteer->contact->first_name[0] }}</div> {{ $volunteer->contact->first_name . ' ' . $volunteer->contact->last_name }}</td>
                        <td>{{ $volunteer->contact->email }}</td>
                        <td><span class="grey-text"><small><i class="fa fa-clock-o"></i> 5 min</small></span></td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              {{ $volunteers->links() }}
              <div class="dropdown dropup">
                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Selected</button>
                <div class="dropdown-menu dropdown-primary">
                  <a class="dropdown-item" href="#">Remove</a>
                  <a class="dropdown-item" href="#">Mark as read</a>
                  <a class="dropdown-item" href="#">Archive</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
@endsection

@push('scripts')
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
@endpush
