@extends('layouts.master')

@section('title')
Adaugă cetățean
@endsection


@section('content')

<main>
	<input type="hidden" id="citizen_id" value="{{$contact->id}}">
	<div class="card card-cascade narrower mb-r">
  <div class="admin-panel info-admin-panel">
      <!--Card image-->
      <div class="view primary-color">
          <h5>Modifică cetățean</h5>
      </div>
      <!--/Card image-->
      <!--Card content-->
      <div class="card-block">

        <form>
            <div class="row">
                <!--First column-->
                <div class="col-md-4">
                    <div class="md-form">
                        <input type="text" id="prenume" class="form-control validate" value="{{$contact->last_name}}">
                        <label for="prenume">Prenume</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="md-form">
                        <input type="text" id="nume" class="form-control validate" value="{{$contact->first_name}}">
                        <label for="nume">Nume</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="md-form">
                        <input type="text" id="site" class="form-control validate" value="{{$contact->website}}">
                        <label for="site">Site</label>
                    </div>
                </div>          
            </div>

            <div class="row">
              <div class="col-md-4">
                  <div class="md-form">
                      <i class="fa fa-envelope prefix"></i>
                      <input type="email" id="email" class="form-control validate" value="{{$contact->email}}">
                      <label for="email">Adresă email 1</label>
                  </div>
              </div>
              <div class="col-md-4">
                  <div class="md-form">
                      <i class="fa fa-envelope prefix"></i>
                      <input type="email" id="email2" class="form-control validate" value="{{$contact->secondary_email}}">
                      <label for="email2">Adresă email 2</label>
                  </div>
              </div>
              <div class="col-md-4">
                  <div class="md-form">
                      <i class="fa fa-phone prefix"></i>
                      <input type="text" id="telefon" class="form-control validate" value="{{$contact->phone}}">
                      <label for="telefon">Telefon</label>
                  </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                  <div class="md-form">
                      <i class="fa fa-facebook prefix"></i>
                      <input type="text" id="facebook_profil" class="form-control validate"  value="{{$contact->facebook_profile}}">
                      <label for="facebook_profil">Profil Facebook</label>
                  </div>
              </div>
              <div class="col-md-6">
                  <div class="md-form">
                      <i class="fa fa-facebook prefix"></i>
                      <input type="text" id="facebook_pagina" class="form-control validate" value="{{$contact->facebook_page}}">
                      <label for="facebook_pagina">Pagină Facebook</label>
                  </div>
              </div>
              <div class="col-md-12">
                  <div class="md-form">
                      <textarea type="text" id="observatii" class="md-textarea" style="resize:vertical;" value="{{$contact->observations}}"></textarea>
                      <label for="observatii">Observații</label>
                  </div>
              </div>              
            </div>

            <div class="row">

	            <div class="col-md-6">
								<select class="mdb-select colorful-select dropdown-default" id="adauga-categorie">
									<option value="pick" disabled selected>Alege o categorie</option>
									<option value="voluntar">Voluntar</option>
									<option value="media">Media</option>
									<option value="donator">Donator</option>
                  <option value="politician">Politician</option>
									<option value="colaborator">Colaborator</option>
									<option value="functionar">Funcționar</option>
								</select>
								<label>Adaugă categorie</label>
	            </div>
            	
            </div>

            <div class="row">
                <div class="col-md-12 text-center">
                    <i class="fa fa-spinner fa-spin fa-3x fa-fw hidden"></i><button class="btn btn-primary" id="edit-citizen">Modifică cetățeanul</button>
                </div>
            </div>
        </form>

      </div>
      <!--/.Card content-->
  </div>
</div>

@include('edit-citizen.add-volunteer')
@include('edit-citizen.add-media')
@include('edit-citizen.add-donor')
@include('edit-citizen.add-politician')
@foreach($contact->donor as $don)
  @include('edit-citizen.see-donor',['donor' => $don])
@endforeach
@foreach($contact->volunteer as $vol)
	@include('edit-citizen.see-volunteer',['volunteer' => $vol])
@endforeach
@foreach($contact->media as $med)
  @include('edit-citizen.see-media',['media' => $med])
@endforeach
@foreach($contact->politician as $pol)
  @include('edit-citizen.see-politician',['politician' => $pol])
@endforeach
</main>


@endsection

@push('scripts')
		<script src="{{ URL::asset('js/jquery.barrating.min.js') }}"></script>
		<script src="{{ URL::asset('js/select2js/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/edit-citizen.js') }}"></script>
@endpush

@push('styles')
	<link href="{{ URL::asset('css/select2css/select2.min.css') }}" rel="stylesheet" />
	<link href="{{ URL::asset('css/fontawesome-stars.css') }}" rel="stylesheet" />
@endpush