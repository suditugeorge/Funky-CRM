@extends('layouts.master')

@section('title')
Contacte
@endsection


@section('content')

  <main class="">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-3">
          <div class="card-body">
            <div class="mt-2">
              <small>Categorii contacte:</small>
              <ul class="striped">
                <li><span class="bullet green"></span> Voluntari <span class="badge bg-primary float-right">{{ $volunteers_count }}</span></li>
                <li><span class="bullet blue"></span> Media <span class="badge bg-primary float-right">{{$media_count}}</span></li>
                <li><span class="bullet red"></span> Donatori <span class="badge bg-primary float-right">{{$donors_count}}</span></li>
                <li><span class="bullet yellow"></span> Colaboratori <span class="badge bg-primary float-right">{{$colaborator_count}}</span></li>
                <li><span class="bullet orange"></span> Funcționari publici <span class="badge bg-primary float-right">{{$employee_count}}</span></li>
                <li><span class="bullet deep-purple"></span> Politicieni <span class="badge bg-primary label-pill float-right">{{$politicians_count}}</span></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-md-8 offset-md-1 white z-depth-1 py-1 pt-1">
          <div class="row">
            <div class="col-md-9 py-1 px-1">
              <h4 class="h4-responsive">Contacte ({{ $contacts_count }})</h4>
            </div>
          </div>
          <form action="/users" method="post">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">

          <div class="row">
            <div class="col-md-4 py-1 px-1">
              <div class="md-form">
                  <div class="md-form">
                      <input type="text" id="search_email" name="search_email"></input>
                      <label for="search_email">Caută după email</label>
                  </div>
              </div>
            </div>
            <div class="col-md-4">
							<select class="mdb-select colorful-select dropdown-default" id="categorie_cetatean" name="categorie_cetatean">
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
            <div class="col-md-4 text-right py-1 px-1">
              <button class="btn btn-primary" id="search-contact">Caută</button>
          	</div>
          </div>
          </form>
          <div class="row">
            <div class="col-md-12">
							<div class="table-responsive">
							  <table class="table">
							    <thead>
							        <tr>
							            <th>#</th>
							            <th>Prenume</th>
							            <th>Nume</th>
							            <th>Email</th>
							            <th>Profil</th>
							        </tr>
							    </thead>
							    <tbody>
							    	@foreach($contacts as $contact)
								      <tr>
								          <th scope="row">{{$contact->id}}</th>
								          <td>{{$contact->first_name}}</td>
								          <td>{{$contact->last_name}}</td>
								          <td>{{$contact->email}}</td>
								          <td>
								              <a href="/edit-citizen/{{$contact->id}}" class="teal-text" data-toggle="tooltip" data-placement="top" title="Editează"><i class="fa fa-pencil"></i></a>
								          </td>
								      </tr>
							    	@endforeach
							    </tbody>
							  </table>
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
@endpush
