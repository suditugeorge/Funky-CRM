	<div class="card card-cascade narrower mb-r hidden" id="new-media">
  <div class="admin-panel info-admin-panel">
      <!--Card image-->
      <div class="view primary-color">
          <h5>Adaugă media</h5>
      </div>
      <!--/Card image-->
      <!--Card content-->
      <div class="card-block">

        <form>
            <div class="row">
              <div class="col-md-6">
              <select class="mdb-select" id="new-media-domains" multiple>
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
                <select class="mdb-select" id="new-media-channel" multiple>
                    <option value="" disabled selected>Alege canal</option>
                    <option value="Blogger">Blogger</option>
                    <option value="Redactor">Redactor</option>
                    <option value="Autor">Autor</option>
                </select>
                <label>Canale</label>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <select class="mdb-select" id="new-media-liason" multiple>
                    <option value="" disabled selected>Alege Liason</option>
                    @foreach($users as $user)
                      <option value="{{$user->id}}">{{$user->name}}</option>
                    @endforeach
                </select>
                <label>Liason Funky</label>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="md-form">
                  <input type="text" id="affliation" class="form-control">
                  <label for="affliation">Afiliere</label>    
                </div>            
              </div>
              <div class="col-md-6">
                <fieldset class="form-group">
                  <input type="checkbox" id="new-media-check-in">
                  <label for="new-media-check-in">Colivia check-in</label>      
                </fieldset>       
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                  <div class="md-form">
                      <textarea type="text" id="new-media-observations" class="md-textarea" style="resize:vertical;"></textarea>
                      <label for="new-media-observations">Observații Funky</label>
                  </div>
              </div>        
              <div class="col-md-6">
                <select id="new-media-rating">
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                </select>
                <label>Rating interacțiune</label>                
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="md-form">
                  <input type="text" id="new-media-link" class="form-control">
                  <label for="new-media-link">Link</label>    
                </div>            
              </div> 

            </div>

            <div class="row">
                <div class="col-md-12 text-center">
                    <i class="fa fa-spinner fa-spin fa-3x fa-fw hidden" id="add-media-spinner"></i><button class="btn btn-primary" id="add-media">Adaugă media</button>
                </div>
            </div>
        </form>

      </div>
      <!--/.Card content-->
  </div>
</div>