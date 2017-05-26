	<div class="card card-cascade narrower mb-r hidden" id="new-colaborator">
  <div class="admin-panel info-admin-panel">
      <!--Card image-->
      <div class="view primary-color">
          <h5>Adaugă colaborator</h5>
      </div>
      <!--/Card image-->
      <!--Card content-->
      <div class="card-block">

        <form>
            <div class="row">
              <div class="col-md-6">
              <select class="mdb-select" id="new-colaborator-domains" multiple>
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
                  <select id="new-colaborator-skills" multiple style="width: 100%">
                  </select>
                  <label>Adaugă skill-uri</label>
              </div>     
              <div class="col-md-6">
                  <div class="md-form">
                      <textarea type="text" id="new-colaborator-availability" class="md-textarea" style="resize:vertical;"></textarea>
                      <label for="new-colaborator-availability">Disponibilitate</label>
                  </div>
              </div>   
              <div class="col-md-6">
                  <div class="md-form">
                      <input type="text" id="new-colaborator-keyword"></input>
                      <label for="new-colaborator-keyword">Keyword</label>
                  </div>
              </div>                
            </div>                    


            <div class="row">
                <div class="col-md-12 text-center">
                    <i class="fa fa-spinner fa-spin fa-3x fa-fw hidden" id="add-colaborator-spinner"></i><button class="btn btn-primary" id="add-colaborator">Adaugă colaborator</button>
                </div>
            </div>
        </form>

      </div>
      <!--/.Card content-->
  </div>
</div>