	<div class="card card-cascade narrower mb-r volunteer" data-id="{{$volunteer->id}}">
  <div class="admin-panel info-admin-panel">
      <!--Card image-->
      <div class="view primary-color">
          <h5>Modifică voluntariat</h5>
      </div>
      <!--/Card image-->
      <!--Card content-->
      <div class="card-block">

        <form>
            <div class="row">
                <div class="col-md-6">
                @php
                    $domain_values = ['Politică','Finanțe','Transporturi','Civic-tech','Buna-guvernare'];
                @endphp
                <select class="mdb-select" id="volunteer-domains-{{$volunteer->id}}" multiple>
                    <option value="" disabled selected>Alege domenii de interes</option>
                    @foreach($volunteer->domains as $domain)
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
              <div class="col-md-6">
                  <select id="volunteer-skills-{{$volunteer->id}}" class="volunteer-skills" multiple style="width: 100%">
                  @foreach($volunteer->skills as $skill)
                    <option value="{{$skill->name}}" selected>{{$skill->name}}</option>
                  @endforeach
                  </select>
                  <label>Modifică skill-uri</label>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                  <div class="md-form">
                      <input type="text" id="volunteer-event-name-{{$volunteer->id}}" value="{{@$volunteer->attends[0]->event}}"></input>
                      <label for="volunteer-event-name-{{$volunteer->id}}">Nume eveniment</label>
                  </div>
              </div> 
              <div class="col-md-6">
                  <div class="md-form">
                      <textarea type="text" id="volunteer-event-details-{{$volunteer->id}}" class="md-textarea" style="resize:vertical;">{{@$volunteer->attends[0]->details}}</textarea>
                      <label for="volunteer-event-details-{{$volunteer->id}}">Detalii eveniment</label>
                  </div>
              </div> 
            </div>

            <div class="row">
              <div class="col-md-6">
                <select id="volunteer-rating-{{$volunteer->id}}" class="volunteer-rating">
                  @if($volunteer->rating == 1)
                    <option value="1" selected>1</option>
                  @else
                    <option value="1">1</option>
                  @endif
                  @if($volunteer->rating == 2)
                    <option value="2" selected>2</option>
                  @else
                    <option value="2">2</option>
                  @endif
                  @if($volunteer->rating == 3)
                    <option value="3" selected>3</option>
                  @else
                    <option value="3">3</option>
                  @endif
                  @if($volunteer->rating == 4)
                    <option value="4" selected>4</option>
                  @else
                    <option value="4">4</option>
                  @endif
                  @if($volunteer->rating == 5)
                    <option value="5" selected>5</option>
                  @else
                    <option value="5">5</option>
                  @endif                                                      
                </select>
                <label>Rating interacțiune</label>
              </div>
              <div class="col-md-6">
                  <div class="md-form">
                      <textarea type="text" id="volunteer-event-availability-{{$volunteer->id}}" class="md-textarea" style="resize:vertical;">{{$volunteer->availability}}</textarea>
                      <label for="volunteer-event-availability-{{$volunteer->id}}">Disponibilitate</label>
                  </div>
              </div>
              
            </div>

            <div class="row">
                <div class="col-md-12 text-center">
                    <i class="fa fa-spinner fa-spin fa-3x fa-fw hidden"></i><button class="btn btn-primary edit-volunteer" data-id="{{$volunteer->id}}">Modifică voluntariat</button>
                </div>
            </div>
        </form>

      </div>
      <!--/.Card content-->
  </div>
</div>