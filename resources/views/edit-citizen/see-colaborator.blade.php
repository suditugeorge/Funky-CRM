	<div class="card card-cascade narrower mb-r colaborator" data-id="{{$colaborator->id}}">
  <div class="admin-panel info-admin-panel">
      <!--Card image-->
      <div class="view primary-color">
          <h5>Modifică colaborator</h5>
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
                <select class="mdb-select" id="colaborator-domains-{{$colaborator->id}}" multiple>
                    <option value="" disabled selected>Alege domenii de interes</option>
                    @foreach($colaborator->domains as $domain)
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
                  <select id="colaborator-skills-{{$colaborator->id}}" class="colaborator-skills" multiple style="width: 100%">
                  @foreach($colaborator->skills as $skill)
                    <option value="{{$skill->name}}" selected>{{$skill->name}}</option>
                  @endforeach
                  </select>
                  <label>Modifică skill-uri</label>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                  <div class="md-form">
                      <textarea type="text" id="colaborator-availability-{{$colaborator->id}}" class="md-textarea" style="resize:vertical;">{{$colaborator->availability}}</textarea>
                      <label for="colaborator-availability-{{$colaborator->id}}">Disponibilitate</label>
                  </div>
              </div>   
              <div class="col-md-6">
                  <div class="md-form">
                      <input type="text" id="colaborator-keyword-{{$colaborator->id}}" value="{{$colaborator->keyword}}"></input>
                      <label for="colaborator-keyword-{{$colaborator->id}}">Keyword</label>
                  </div>
              </div>   
            </div>

            <div class="row">
                <div class="col-md-12 text-center hidden" id="edit-colaborator-spinner-{{$colaborator->id}}"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>
                <div class="col-md-10 text-right">
                    <button class="btn btn-primary edit-colaborator" data-id="{{$colaborator->id}}" id="edit-colaborator-{{$colaborator->id}}">Modifică colaborator</button>
                </div>
                <div class="col-md-2 text-right">
                    <button type="button" class="btn btn-danger delete-colaborator" data-id="{{$colaborator->id}}" id="delete-colaborator-{{$colaborator->id}}">Șterge</button>
                </div>
            </div>
        </form>
      </div>
      <!--/.Card content-->
  </div>
</div>