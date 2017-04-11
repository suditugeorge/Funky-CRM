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
                  {{ Form::model($volunteer, ['route' => ['volunteers.update', $volunteer->id], 'method' => 'PUT', 'class' => 'form-horizontal']) }}
                    <div class="row">
                      <div class="col-md-6">
                        <div class="md-form{{ $errors->has('contact.first_name') ? ' has-danger' : '' }}">
                          {{ Form::text('contact[first_name]', null, ['class' => 'form-control']) }}
                          {{ Form::label('contact[first_name]', 'Prenume') }}
                          {!! $errors->first('contact.first_name', '<span class="help-block">:message</span>') !!}
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="md-form{{ $errors->has('contact.last_name') ? ' has-danger' : '' }}">
                          {{ Form::text('contact[last_name]', null, ['class' => 'form-control validate']) }}
                          {{ Form::label('contact[last_name]', 'Nume') }}
                          {!! $errors->first('contact.last_name', '<span class="help-block">:message</span>') !!}
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="md-form{{ $errors->has('contact.email') ? ' has-danger' : '' }}">
                          {{ Form::text('contact[email]', null, ['class' => 'form-control validate']) }}
                          {{ Form::label('contact[email]', 'E-mail') }}
                          {!! $errors->first('contact.email', '<span class="help-block">:message</span>') !!}
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="md-form{{ $errors->has('contact.secondary_email') ? ' has-danger' : '' }}">
                          {{ Form::text('contact[secondary_email]', null, ['class' => 'form-control validate']) }}
                          {{ Form::label('contact[secondary_email]', 'E-mail secundar') }}
                          {!! $errors->first('contact.secondary_email', '<span class="help-block">:message</span>') !!}
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="md-form{{ $errors->has('contact.phone') ? ' has-danger' : '' }}">
                          {{ Form::text('contact[phone]', null, ['class' => 'form-control validate']) }}
                          {{ Form::label('contact[phone]', 'Telefon') }}
                          {!! $errors->first('contact.phone', '<span class="help-block">:message</span>') !!}
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="md-form{{ $errors->has('contact.facebook_profile') ? ' has-danger' : '' }}">
                          {{ Form::text('contact[facebook_profile]', null, ['class' => 'form-control validate']) }}
                          {{ Form::label('contact[facebook_profile]', 'Profil Facebook') }}
                          {!! $errors->first('contact.facebook_profile', '<span class="help-block">:message</span>') !!}
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="md-form{{ $errors->has('contact.facebook_page') ? ' has-danger' : '' }}">
                          {{ Form::text('contact[facebook_page]', null, ['class' => 'form-control validate']) }}
                          {{ Form::label('contact[facebook_page]', 'Pagină Facebook') }}
                          {!! $errors->first('contact.facebook_page', '<span class="help-block">:message</span>') !!}
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="md-form{{ $errors->has('contact.website') ? ' has-danger' : '' }}">
                          {{ Form::text('contact[website]', null, ['class' => 'form-control validate']) }}
                          {{ Form::label('contact[website]', 'contact[website]') }}
                          {!! $errors->first('contact.website', '<span class="help-block">:message</span>') !!}
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="md-form{{ $errors->has('contact.observations') ? ' has-danger' : '' }}">
                          {{ Form::textarea('contact[observations]', null, ['class' => 'md-textarea']) }}
                          {{ Form::label('contact[observations]', 'Observații') }}
                          {!! $errors->first('contact.observations', '<span class="help-block">:message</span>') !!}
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
                        {{ Form::submit('Editează voluntar', ['class' => 'btn btn-primary']) }}
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
