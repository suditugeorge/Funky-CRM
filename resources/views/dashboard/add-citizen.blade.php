@extends('layouts.master')

@section('title')
Profil
@endsection


@section('content')
@include('dashboard.navigation')
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
            </div>

            <div class="row">
                <div class="col-md-12 text-center">
                    <i class="fa fa-spinner fa-spin fa-3x fa-fw hidden"></i><button class="btn btn-primary" id="change-user-profile">Schimbă datele</button>
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