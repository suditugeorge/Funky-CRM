@extends('layouts.master')

@section('title', 'Voluntari')

@section('content')
  @include('dashboard.navigation')
  <main class="">
    <div class="container-fluid">
      <section class="section">
        <div class="row">
          <div class="col-lg-12">
            <div class="card card-cascade narrower mb-r">
              <div class="admin-panel info-admin-panel">
                <div class="view primary-color">
                  <h5>Adăugare voluntar</h5>
                </div>
                <div class="card-block">
                  {{ Form::open(['route' => 'volunteers.store', 'class' => 'form-horizontal']) }}
                    <div class="row">
                      <div class="col-md-6">
                        <div class="md-form">
                          {{ Form::text('first_name', null, ['class' => 'form-control validate']) }}
                          {{ Form::label('first_name', 'Prenume') }}
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="md-form">
                          {{ Form::text('last_name', null, ['class' => 'form-control validate']) }}
                          {{ Form::label('last_name', 'Nume') }}
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="md-form">
                          {{ Form::text('email', null, ['class' => 'form-control validate']) }}
                          {{ Form::label('email', 'E-mail') }}
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="md-form">
                          {{ Form::text('secondary_email', null, ['class' => 'form-control validate']) }}
                          {{ Form::label('secondary_email', 'E-mail secundar') }}
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="md-form">
                          {{ Form::text('phone', null, ['class' => 'form-control validate']) }}
                          {{ Form::label('phone', 'Telefon') }}
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="md-form">
                          {{ Form::text('facebook_profile', null, ['class' => 'form-control validate']) }}
                          {{ Form::label('facebook_profile', 'Profil Facebook') }}
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="md-form">
                          {{ Form::text('facebook_page', null, ['class' => 'form-control validate']) }}
                          {{ Form::label('facebook_page', 'Pagină Facebook') }}
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="md-form">
                          {{ Form::text('website', null, ['class' => 'form-control validate']) }}
                          {{ Form::label('website', 'Website') }}
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="md-form">
                          {{ Form::textarea('observations', null, ['class' => 'md-textarea']) }}
                          {{ Form::label('observations', 'Observații') }}
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="md-form">
                          {{ Form::textarea('availability', null, ['class' => 'md-textarea']) }}
                          {{ Form::label('availability', 'Disponibilitate') }}
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="md-form">
                          {{ Form::text('rating', null, ['class' => 'form-control validate']) }}
                          {{ Form::label('rating', 'Rating') }}
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12 text-center">
                        {{ Form::submit('Adaugă voluntar', ['class' => 'btn btn-primary']) }}
                      </div>
                    </div>
                  {{ Form::close() }}
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
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
