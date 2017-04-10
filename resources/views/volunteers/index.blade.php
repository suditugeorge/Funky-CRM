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
              <i class="fa fa-plus left"></i> Contact nou
            </a>
            <div class="mt-2">
              <small>Categorii contacte:</small>
              <ul class="striped">
                <li><span class="bullet green"></span> voluntari <span class="badge bg-primary float-right">{{ $volunteers->count() }}</span></li>
                <li><span class="bullet blue"></span> media <span class="badge bg-primary float-right">0</span></li>
                <li><span class="bullet red"></span> donatori <span class="badge bg-primary float-right">0</span></li>
                <li><span class="bullet yellow"></span> colaboratori <span class="badge bg-primary float-right">0</span></li>
                <li><span class="bullet orange"></span> funcționari publici <span class="badge bg-primary float-right">0</span></li>
                <li><span class="bullet deep-purple"></span> politicieni <span class="badge bg-primary label-pill float-right">0</span></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-md-8 offset-md-1 white z-depth-1 py-1 pt-1">
          <div class="row">
            <div class="col-sm-6 col-md-9 py-1 px-1">
              <h4 class="h4-responsive">Contacte ({{ $volunteers->count() }})</h4>
            </div>
            <div class="col-sm-6 col-md-3">
              <div class="md-form">
                <input placeholder="Caută un contact..." type="text" id="form5" class="form-control">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Nume</th>
                      <th>Email</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($volunteers as $volunteer)
                      <tr>
                        <td><div class="avatar-placeholder green darken-3">{{ $volunteer->contact->first_name[0] }}</div> {{ $volunteer->contact->first_name . ' ' . $volunteer->contact->last_name }}</td>
                        <td>{{ $volunteer->contact->email }}</td>
                        <td>
                          <a href="{{ route('volunteers.edit', ['volunteer' => $volunteer->id]) }}" data-toggle="tooltip" title="Editează">
                            <i class="fa fa-pencil"></i>
                          </a>
                          <a href="{{ route('volunteers.edit', ['volunteer' => $volunteer->id]) }}" data-toggle="tooltip" title="Șterge">
                            <i class="fa fa-trash"></i>
                          </a>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              {{ $volunteers->links() }}
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
