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
                        <div class="md-form{{ $errors->has('first_name') ? ' has-danger' : '' }}">
                          {{ Form::text('first_name', null, ['class' => 'form-control']) }}
                          {{ Form::label('first_name', 'Prenume') }}
                          {!! $errors->first('first_name', '<span class="help-block">:message</span>') !!}
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="md-form{{ $errors->has('last_name') ? ' has-danger' : '' }}">
                          {{ Form::text('last_name', null, ['class' => 'form-control validate']) }}
                          {{ Form::label('last_name', 'Nume') }}
                          {!! $errors->first('last_name', '<span class="help-block">:message</span>') !!}
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="md-form{{ $errors->has('email') ? ' has-danger' : '' }}">
                          {{ Form::text('email', null, ['class' => 'form-control validate']) }}
                          {{ Form::label('email', 'E-mail') }}
                          {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="md-form{{ $errors->has('secondary_email') ? ' has-danger' : '' }}">
                          {{ Form::text('secondary_email', null, ['class' => 'form-control validate']) }}
                          {{ Form::label('secondary_email', 'E-mail secundar') }}
                          {!! $errors->first('secondary_email', '<span class="help-block">:message</span>') !!}
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="md-form{{ $errors->has('phone') ? ' has-danger' : '' }}">
                          {{ Form::text('phone', null, ['class' => 'form-control validate']) }}
                          {{ Form::label('phone', 'Telefon') }}
                          {!! $errors->first('phone', '<span class="help-block">:message</span>') !!}
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="md-form{{ $errors->has('facebook_profile') ? ' has-danger' : '' }}">
                          {{ Form::text('facebook_profile', null, ['class' => 'form-control validate']) }}
                          {{ Form::label('facebook_profile', 'Profil Facebook') }}
                          {!! $errors->first('facebook_profile', '<span class="help-block">:message</span>') !!}
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="md-form{{ $errors->has('facebook_page') ? ' has-danger' : '' }}">
                          {{ Form::text('facebook_page', null, ['class' => 'form-control validate']) }}
                          {{ Form::label('facebook_page', 'Pagină Facebook') }}
                          {!! $errors->first('facebook_page', '<span class="help-block">:message</span>') !!}
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="md-form{{ $errors->has('website') ? ' has-danger' : '' }}">
                          {{ Form::text('website', null, ['class' => 'form-control validate']) }}
                          {{ Form::label('website', 'Website') }}
                          {!! $errors->first('website', '<span class="help-block">:message</span>') !!}
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="md-form{{ $errors->has('observations') ? ' has-danger' : '' }}">
                          {{ Form::textarea('observations', null, ['class' => 'md-textarea']) }}
                          {{ Form::label('observations', 'Observații') }}
                          {!! $errors->first('observations', '<span class="help-block">:message</span>') !!}
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="md-form{{ $errors->has('availability') ? ' has-danger' : '' }}">
                          {{ Form::textarea('availability', null, ['class' => 'md-textarea']) }}
                          {{ Form::label('availability', 'Disponibilitate') }}
                          {!! $errors->first('availability', '<span class="help-block">:message</span>') !!}
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="md-form{{ $errors->has('rating') ? ' has-danger' : '' }}">
                          {{ Form::text('rating', null, ['class' => 'form-control validate']) }}
                          {{ Form::label('rating', 'Rating') }}
                          {!! $errors->first('rating', '<span class="help-block">:message</span>') !!}
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
