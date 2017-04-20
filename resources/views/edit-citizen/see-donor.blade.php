	<div class="card card-cascade narrower mb-r donor" data-id="{{$donor->id}}">
  <div class="admin-panel info-admin-panel">
      <!--Card image-->
      <div class="view primary-color">
          <h5>Modifică donator</h5>
      </div>
      <!--/Card image-->
      <!--Card content-->
      <div class="card-block">

        <form>
            <div class="row">
              <div class="col-md-6">
                <select class="mdb-select" id="edit-donor-recurring_donations-{{$donor->id}}">
                    <option value="" disabled>Alege o opțiune</option>
                    @if($donor->recurring_donations == 1)
                      <option value="1" selected>Da</option>
                    @else
                      <option value="1">Da</option>
                    @endif
                    @if($donor->recurring_donations == 0)
                      <option value="0" selected>Nu</option>
                    @else
                      <option value="0">Nu</option>
                    @endif
                </select>
                <label>Donație recurentă</label>                                
              </div>  
              <div class="col-md-6">
                <select class="mdb-select" id="edit-donor-legal_form-{{$donor->id}}">
                    <option value="" disabled>Alege o opțiune</option>
                    @if($donor->legal_form == "Persoană fizică")
                      <option value="Persoană fizică" selected>Persoană fizică</option>
                    @else
                      <option value="Persoană fizică">Persoană fizică</option>
                    @endif
                    @if($donor->legal_form == "Persoană juridică")
                      <option value="Persoană juridică" selected>Persoană juridică</option>
                    @else
                      <option value="Persoană juridică">Persoană juridică</option>
                    @endif                    
                </select>
                <label>Formă legală</label>                                
              </div>                            
            </div>

            <div class="row">
              <div class="col-md-12">
                <hr class="mt-2 mb-2"/>
                <h4><b>Donație nouă</b></h4>
              </div>
              <div class="col-md-6">
                <div class="md-form">
                    <input type="text" id="new-donation-sum-{{$donor->id}}" class="form-control validate">
                    <label for="new-donation-sum-{{$donor->id}}">Suma donată</label>
                </div>     
              </div>  
              <div class="col-md-6">
                <select class="mdb-select" id="new-donation-reward-{{$donor->id}}">
                    <option value="" disabled selected>Alege o opțiune</option>
                    <option value="1">Da</option>
                    <option value="0">Nu</option>
                </select>
                <label>Recompensă</label>                                
              </div>    
              <div class="col-md-6">
                <select class="mdb-select" id="new-donation-after_campaign-{{$donor->id}}">
                    <option value="" disabled selected>Alege o opțiune</option>
                    <option value="1">Da</option>
                    <option value="0">Nu</option>
                </select>
                <label>A donat după campanie?</label>                                
              </div>  
              <div class="col-md-6">
                  <div class="md-form">
                      <textarea type="text" id="new-donation-comment-{{$donor->id}}" class="md-textarea" style="resize:vertical;"></textarea>
                      <label for="new-donation-comment-{{$donor->id}}">Comentarii donator</label>
                  </div>
              </div>                                              
            </div>

            <div class="row">
                <div class="col-md-12 text-center hidden" id="edit-donor-spinner-{{$donor->id}}"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>
                <div class="col-md-10 text-right">
                    <button class="btn btn-primary edit-donor" data-id="{{$donor->id}}" id="edit-donor-{{$donor->id}}">Modifică donator</button>
                </div>
                <div class="col-md-2 text-right">
                    <button type="button" class="btn btn-danger delete-donor" data-id="{{$donor->id}}" id="delete-donor-{{$donor->id}}">Șterge</button>
                </div>
            </div>
        </form>

      </div>
      <!--/.Card content-->
  </div>
</div>