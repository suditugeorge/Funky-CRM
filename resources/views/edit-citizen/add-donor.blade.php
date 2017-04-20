	<div class="card card-cascade narrower mb-r hidden" id="new-donor">
  <div class="admin-panel info-admin-panel">
      <!--Card image-->
      <div class="view primary-color">
          <h5>Adaugă donator</h5>
      </div>
      <!--/Card image-->
      <!--Card content-->
      <div class="card-block">

        <form>
            <div class="row">
              <div class="col-md-6">
                <select class="mdb-select" id="new-donor-recurring_donations">
                    <option value="" disabled selected>Alege o opțiune</option>
                    <option value="1">Da</option>
                    <option value="0">Nu</option>
                </select>
                <label>Donație recurentă</label>                                
              </div>
              <div class="col-md-6">
                <select class="mdb-select" id="new-donor-legal_form">
                    <option value="" disabled selected>Alege o opțiune</option>
                    <option value="Persoană fizică">Persoană fizică</option>
                    <option value="Persoană juridică">Persoană juridică</option>
                </select>
                <label>Formă legală</label>                                
              </div>              
            </div>

 

            <div class="row">
                <div class="col-md-12 text-center">
                    <i class="fa fa-spinner fa-spin fa-3x fa-fw hidden" id="add-donor-spinner"></i><button class="btn btn-primary" id="add-donor">Adaugă donator</button>
                </div>
            </div>
        </form>

      </div>
      <!--/.Card content-->
  </div>
</div>