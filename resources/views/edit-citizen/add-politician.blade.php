	<div class="card card-cascade narrower mb-r hidden" id="new-politician">
  <div class="admin-panel info-admin-panel">
      <!--Card image-->
      <div class="view primary-color">
          <h5>Adaugă politician</h5>
      </div>
      <!--/Card image-->
      <!--Card content-->
      <div class="card-block">

        <form>
            <div class="row">
              <div class="col-md-6">
                  <div class="md-form">
                      <input type="text" id="new-politician-position"></input>
                      <label for="new-politician-position">Poziție actuală</label>
                  </div>
              </div> 
              <div class="col-md-6">
                  <div class="md-form">
                      <input type="text" id="new-politician-liason"></input>
                      <label for="new-politician-liason">Liason Funky</label>
                  </div>
              </div> 
              <div class="col-md-6">
                <select class="mdb-select" id="new-politician-domains" multiple>
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
                <div class="md-form">
                  <input type="text" id="new-politician-link" class="form-control">
                  <label for="new-politician-link">Link</label>    
                </div>            
              </div>                       

              <div class="col-md-6">
                  <div class="md-form">
                      <textarea type="text" id="new-politician-intersections_at_events" class="md-textarea" style="resize:vertical;"></textarea>
                      <label for="new-politician-intersections_at_events">Intersecție la evenimente</label>
                  </div>
              </div>               
              <div class="col-md-6">
                  <div class="md-form">
                      <textarea type="text" id="new-politician-known_for" class="md-textarea" style="resize:vertical;"></textarea>
                      <label for="new-politician-known_for">Cunoscut pentru</label>
                  </div>
              </div> 
              <div class="col-md-6">
                <select id="new-politician-reasonability_rating">
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                </select>
                <label>Rating rezonabil</label>                
              </div> 
              <div class="col-md-6">
                <select id="new-politician-openness_rating">
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                </select>
                <label>Rating deschidere dialog</label>                
              </div> 
            </div>                          

            <div class="row">
                <div class="col-md-12 text-center">
                    <i class="fa fa-spinner fa-spin fa-3x fa-fw hidden" id="add-politician-spinner"></i><button class="btn btn-primary" id="add-politician">Adaugă politician</button>
                </div>
            </div>
        </form>

      </div>
      <!--/.Card content-->
  </div>
</div>