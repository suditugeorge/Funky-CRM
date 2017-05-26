	<div class="card card-cascade narrower mb-r politician" data-id="{{$politician->id}}">
  <div class="admin-panel info-admin-panel">
      <!--Card image-->
      <div class="view primary-color">
          <h5>Modifică politician</h5>
      </div>
      <!--/Card image-->
      <!--Card content-->
      <div class="card-block">

        <form>
            <div class="row">
              <div class="col-md-6">
                  <div class="md-form">
                      <input type="text" id="politician-position-{{$politician->id}}" value="{{$politician->position}}"></input>
                      <label for="politician-position-{{$politician->id}}">Poziție actuală</label>
                  </div>
              </div> 
              <div class="col-md-6">
                  <div class="md-form">
                      <input type="text" id="politician-liason-{{$politician->id}}" value="{{$politician->liason}}"></input>
                      <label for="politician-liason-{{$politician->id}}">Liason Funky</label>
                  </div>
              </div> 
              <div class="col-md-6">
                <select id="politician-reasonability_rating-{{$politician->id}}" class="politician-reasonability_rating">
                  @if($politician->reasonability_rating == 1)
                    <option value="1" selected>1</option>
                  @else
                    <option value="1">1</option>
                  @endif
                  @if($politician->reasonability_rating == 2)
                    <option value="2" selected>2</option>
                  @else
                    <option value="2">2</option>
                  @endif
                  @if($politician->reasonability_rating == 3)
                    <option value="3" selected>3</option>
                  @else
                    <option value="3">3</option>
                  @endif
                  @if($politician->reasonability_rating == 4)
                    <option value="4" selected>4</option>
                  @else
                    <option value="4">4</option>
                  @endif
                  @if($politician->reasonability_rating == 5)
                    <option value="5" selected>5</option>
                  @else
                    <option value="5">5</option>
                  @endif                                                      
                </select>
                <label>Rating rezonabil</label>
              </div>      
              <div class="col-md-6">
                <select id="politician-openness_rating-{{$politician->id}}" class="politician-openness_rating">
                  @if($politician->openness_rating == 1)
                    <option value="1" selected>1</option>
                  @else
                    <option value="1">1</option>
                  @endif
                  @if($politician->openness_rating == 2)
                    <option value="2" selected>2</option>
                  @else
                    <option value="2">2</option>
                  @endif
                  @if($politician->openness_rating == 3)
                    <option value="3" selected>3</option>
                  @else
                    <option value="3">3</option>
                  @endif
                  @if($politician->openness_rating == 4)
                    <option value="4" selected>4</option>
                  @else
                    <option value="4">4</option>
                  @endif
                  @if($politician->openness_rating == 5)
                    <option value="5" selected>5</option>
                  @else
                    <option value="5">5</option>
                  @endif                                                      
                </select>
                <label>Rating deschidere dialog</label>
              </div>

              <div class="col-md-6">
                  <div class="md-form">
                      <textarea type="text" id="politician-intersections_at_events-{{$politician->id}}" class="md-textarea" style="resize:vertical;">{{$politician->intersections_at_events}}</textarea>
                      <label for="politician-intersections_at_events-{{$politician->id}}">Intersecție la evenimente</label>
                  </div>
              </div>               
              <div class="col-md-6">
                  <div class="md-form">
                      <textarea type="text" id="politician-known_for-{{$politician->id}}" class="md-textarea" style="resize:vertical;">{{$politician->known_for}}</textarea>
                      <label for="politician-known_for-{{$politician->id}}">Cunoscut pentru</label>
                  </div>
              </div> 

              <div class="col-md-6">
                @php
                    $domain_values = ['Politică','Finanțe','Transporturi','Civic-tech','Buna-guvernare'];
                @endphp
                <select class="mdb-select" id="politician-domains-{{$politician->id}}" multiple>
                    <option value="" disabled selected>Alege domenii de interes</option>
                    @foreach($politician->domains as $domain)
                      @if($domain->name == 'Politică')
                        <option value="Politica" selected>Politică</option>
                        @php
                          if(($key = array_search('Politică', $domain_values)) !== false) {
                              unset($domain_values[$key]);
                          }
                        @endphp
                      @endif
                      @if($domain->name == 'Finanțe')
                        <option value="Finante" selected>Finanțe</option>
                        @php
                          if(($key = array_search('Finanțe', $domain_values)) !== false) {
                              unset($domain_values[$key]);
                          }
                        @endphp                        
                      @endif                      
                      @if($domain->name == 'Transporturi')
                        <option value="Transporturi" selected>Transporturi</option>
                        @php
                          if(($key = array_search('Transporturi', $domain_values)) !== false) {
                              unset($domain_values[$key]);
                          }
                        @endphp                           
                      @endif
                      @if($domain->name == 'Civic-tech')
                        <option value="Civic-tech" selected>Civic-tech</option>
                        @php
                          if(($key = array_search('Civic-tech', $domain_values)) !== false) {
                              unset($domain_values[$key]);
                          }
                        @endphp                           
                      @endif
                      @if($domain->name == 'Buna-guvernare')
                        <option value="Buna-guvernare" selected>Buna-guvernare</option>
                        @php
                          if(($key = array_search('Buna-guvernare', $domain_values)) !== false) {
                              unset($domain_values[$key]);
                          }
                        @endphp                           
                      @endif                                                                  
                    @endforeach
                    @foreach($domain_values as $remains)
                      <option value="{{$remains}}">{{$remains}}</option>
                    @endforeach
                </select>
                <label>Domenii de interes</label>
              </div>      
              @foreach($politician->links as $link)
                <div class="col-md-6">
                  <div class="md-form">
                    <input type="text" id="politician-link-{{$politician->id}}-{{$link->id}}" class="form-control politician-link-{{$politician->id}}" data-link_id="{{$link->id}}" value="{{$link->url}}">
                    <label for="politician-link-{{$politician->id}}-{{$link->id}}">Link</label>    
                  </div>                    
                </div>
              @endforeach  
              <div class="col-md-6">
                <div class="md-form">
                  <input type="text" id="politician-link-{{$politician->id}}-new" class="form-control politician-link-new-{{$politician->id}}" data-link_id="new">
                  <label for="politician-link-{{$politician->id}}-new">Link nou</label>    
                </div>                    
              </div>                                   
            </div>          

            @foreach($politician->parties as $partie)
              <div class="row">
              <div class="col-md-12">
                <hr class="mt-2 mb-2"/>
                <h4><b>Partid #{{$partie->id}}</b></h4>
              </div>
              <div class="col-md-6">
                  <div class="md-form">
                      <input type="text" id="partie_name-{{$partie->id}}" value="{{$partie->name}}"></input>
                      <label for="partie_name-{{$partie->id}}">Nume partid</label>
                  </div>                    
              </div>  
              <div class="col-md-6">
                <div class="md-form">
                  <input type="date" class="datepicker" id="partie_start_date-{{$partie->id}}" value="{{$partie->from}}">
                  <label for="partie_start_date-{{$partie->id}}">De la</label>    
                </div>                    
              </div> 
              <div class="col-md-6">
                <div class="md-form">
                  <input type="date" class="datepicker" id="partie_end_date-{{$partie->id}}" value="{{$partie->until}}">
                  <label for="partie_end_date-{{$partie->id}}">Pana la</label>    
                </div>                    
              </div>   
              </div>    
              <div class="row">
                  <div class="col-md-12 text-center hidden" id="edit-partie-spinner-{{$partie->id}}"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>
                  <div class="col-md-9 text-right">
                      <button class="btn btn-primary edit-partie" data-id="{{$partie->id}}" id="edit-partie-{{$partie->id}}">Modifică partidul #{{$partie->id}}</button>
                  </div>
                  <div class="col-md-3 text-right">
                      <button type="button" class="btn btn-danger delete-partie" data-id="{{$partie->id}}" id="delete-partie-{{$partie->id}}">Șterge partidul #{{$partie->id}}</button>
                  </div>
              </div>                                
            @endforeach            

            <div class="row">
              <div class="col-md-12">
                <hr class="mt-2 mb-2"/>
                <h4><b>Partid nou</b></h4>
              </div>
              <div class="col-md-6">
                  <div class="md-form">
                      <input type="text" id="new_partie_name-{{$politician->id}}"></input>
                      <label for="new_partie_name-{{$politician->id}}">Nume partid</label>
                  </div>                    
              </div>  
              <div class="col-md-6">
                <div class="md-form">
                  <input type="date" class="datepicker" id="new_partie_start_date-{{$politician->id}}">
                  <label for="new_partie_start_date-{{$politician->id}}">De la</label>    
                </div>                    
              </div> 
              <div class="col-md-6">
                <div class="md-form">
                  <input type="date" class="datepicker" id="new_partie_end_date-{{$politician->id}}">
                  <label for="new_partie_end_date-{{$politician->id}}">Pana la</label>    
                </div>                    
              </div>               

                                             
            </div>                            

            <div class="row">
                <div class="col-md-12 text-center hidden" id="edit-politician-spinner-{{$politician->id}}"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>
                <div class="col-md-10 text-right">
                    <button class="btn btn-primary edit-politician" data-id="{{$politician->id}}" id="edit-politician-{{$politician->id}}">Modifică politician</button>
                </div>
                <div class="col-md-2 text-right">
                    <button type="button" class="btn btn-danger delete-politician" data-id="{{$politician->id}}" id="delete-politician-{{$politician->id}}">Șterge</button>
                </div>
            </div>
        </form>

      </div>
      <!--/.Card content-->
  </div>
</div>