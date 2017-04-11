	<div class="card card-cascade narrower mb-r hidden" id="new-volunteer">
  <div class="admin-panel info-admin-panel">
      <!--Card image-->
      <div class="view primary-color">
          <h5>Adaugă voluntariat</h5>
      </div>
      <!--/Card image-->
      <!--Card content-->
      <div class="card-block">

        <form>
            <div class="row">
                <div class="col-md-6">
                <select class="mdb-select" id="new-volunteer-domains" multiple>
                    <option value="" disabled selected>Alege domenii de interes</option>
                    <option value="Politica">Politică</option>
                    <option value="Finante">Finanțe</option>
                    <option value="Transporturi">Transporturi</option>
                    <option value="Civic-tech">Civic-tech</option>
                    <option value="Buna-guvernare">Buna-guvernare</option>
                </select>
                <label>Domenii de interes</label>
              </div>
              <div class="col-md-6">
                  <select id="new-volunteer-skills" multiple style="width: 100%">
                  </select>
                  <label>Adaugă skill-uri</label>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                  <div class="md-form">
                      <input type="text" id="volunteer-event-name"></input>
                      <label for="volunteer-event-name">Nume eveniment</label>
                  </div>
              </div> 
              <div class="col-md-6">
                  <div class="md-form">
                      <textarea type="text" id="volunteer-event-details" class="md-textarea" style="resize:vertical;"></textarea>
                      <label for="volunteer-event-details">Detalii eveniment</label>
                  </div>
              </div> 
            </div>

            <div class="row">
              <div class="col-md-6">
                <select id="volunteer-rating">
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                </select>
                <label>Rating interacțiune</label>
              </div>
              <div class="col-md-6">
                  <div class="md-form">
                      <textarea type="text" id="volunteer-event-availability" class="md-textarea" style="resize:vertical;"></textarea>
                      <label for="volunteer-event-availability">Disponibilitate</label>
                  </div>
              </div>
              
            </div>

            <div class="row">
                <div class="col-md-12 text-center">
                    <i class="fa fa-spinner fa-spin fa-3x fa-fw hidden"></i><button class="btn btn-primary" id="add-volunteer">Adaugă voluntariat</button>
                </div>
            </div>
        </form>

      </div>
      <!--/.Card content-->
  </div>
</div>