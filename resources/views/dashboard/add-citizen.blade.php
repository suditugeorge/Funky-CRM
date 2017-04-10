@extends('layouts.master')

@section('title')
Adaugă cetățean
@endsection


@section('content')
<main>

<div class="card card-cascade narrower mb-r">
  <div class="admin-panel info-admin-panel">
      <!--Card image-->
      <div class="view primary-color">
          <h5>Adaugă cetățean</h5>
      </div>
      <!--/Card image-->
      <!--Card content-->
      <div class="card-block">

        <form>
            <div class="row">
                <!--First column-->
                <div class="col-md-4">
                    <div class="md-form">
                        <input type="text" id="prenume" class="form-control validate">
                        <label for="prenume">Prenume</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="md-form">
                        <input type="text" id="nume" class="form-control validate">
                        <label for="nume">Nume</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="md-form">
                        <input type="text" id="site" class="form-control validate">
                        <label for="site">Site</label>
                    </div>
                </div>          
            </div>

            <div class="row">
              <div class="col-md-4">
                  <div class="md-form">
                      <i class="fa fa-envelope prefix"></i>
                      <input type="email" id="email" class="form-control validate">
                      <label for="email">Adresă email 1</label>
                  </div>
              </div>
              <div class="col-md-4">
                  <div class="md-form">
                      <i class="fa fa-envelope prefix"></i>
                      <input type="email" id="email2" class="form-control validate">
                      <label for="email2">Adresă email 2</label>
                  </div>
              </div>
              <div class="col-md-4">
                  <div class="md-form">
                      <i class="fa fa-phone prefix"></i>
                      <input type="text" id="telefon" class="form-control validate">
                      <label for="telefon">Telefon</label>
                  </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                  <div class="md-form">
                      <i class="fa fa-facebook prefix"></i>
                      <input type="text" id="facebook_profil" class="form-control validate">
                      <label for="facebook_profil">Profil Facebook</label>
                  </div>
              </div>
              <div class="col-md-6">
                  <div class="md-form">
                      <i class="fa fa-facebook prefix"></i>
                      <input type="text" id="facebook_pagina" class="form-control validate">
                      <label for="facebook_pagina">Pagină Facebook</label>
                  </div>
              </div>
              <div class="col-md-12">
                  <div class="md-form">
                      <textarea type="text" id="observatii" class="md-textarea" style="resize:vertical;"></textarea>
                      <label for="observatii">Observații</label>
                  </div>
              </div>              
            </div>

            <div class="row">
                <div class="col-md-12 text-center">
                    <i class="fa fa-spinner fa-spin fa-3x fa-fw hidden"></i><button class="btn btn-primary" id="add-citizen">Adaugă cetățean</button>
                </div>
            </div>
        </form>

      </div>
      <!--/.Card content-->
  </div>
</div>


</main>



@endsection

@push('scripts')
    <script type="text/javascript" src="{{ URL::asset('js/add-citizen.js') }}"></script>
@endpush