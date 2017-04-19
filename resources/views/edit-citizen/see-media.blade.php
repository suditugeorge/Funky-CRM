	<div class="card card-cascade narrower mb-r media" data-id="{{$media->id}}">
  <div class="admin-panel info-admin-panel">
      <!--Card image-->
      <div class="view primary-color">
          <h5>Modifică media</h5>
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
                <select class="mdb-select" id="media-domains-{{$media->id}}" multiple>
                    <option value="" disabled selected>Alege domenii de interes</option>
                    @foreach($media->domains as $domain)
                      @if($domain->name == 'Politică')
                        <option value="Politică" selected>Politică</option>
                        @php
                          if(($key = array_search('Politică', $domain_values)) !== false) {
                              unset($domain_values[$key]);
                          }
                        @endphp
                      @endif
                      @if($domain->name == 'Finanțe')
                        <option value="Finanțe" selected>Finanțe</option>
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
                @php
                    $channel_values = ['Blogger','Redactor','Autor'];
                @endphp
                <select class="mdb-select" id="media-channels-{{$media->id}}" multiple>
                    <option value="" disabled selected>Alege canal</option>
                    @foreach($media->channels as $channel)
                      @if($channel->name == 'Blogger')
                        <option value="Blogger" selected>Blogger</option>
                        @php
                          if(($key = array_search('Blogger', $channel_values)) !== false) {
                              unset($channel_values[$key]);
                          }
                        @endphp
                      @endif
                      @if($channel->name == 'Redactor')
                        <option value="Redactor" selected>Redactor</option>
                        @php
                          if(($key = array_search('Redactor', $channel_values)) !== false) {
                              unset($channel_values[$key]);
                          }
                        @endphp                        
                      @endif                      
                      @if($channel->name == 'Autor')
                        <option value="Autor" selected>Autor</option>
                        @php
                          if(($key = array_search('Autor', $channel_values)) !== false) {
                              unset($channel_values[$key]);
                          }
                        @endphp                           
                      @endif                                                     
                    @endforeach
                    @foreach($channel_values as $remains)
                      <option value="{{$remains}}">{{$remains}}</option>
                    @endforeach
                </select>
                <label>Canale</label>                
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                @php
                  $users_def = App\Http\Controllers\UserController::getUsers();
                @endphp
                <select class="mdb-select" id="media-liason-{{$media->id}}" multiple>
                    <option value="" disabled selected>Alege liason</option>
                    @foreach($media->liasons as $liason)
                      <option value="{{$liason->user_id}}" selected>{{$users_def[$liason->user_id]['name']}}</option>
                      @php
                            unset($users_def[$liason->user_id]);
                      @endphp              
                    @endforeach
                    @foreach($users_def as $remains)
                      <option value="{{$remains['id']}}">{{$remains['name']}}</option>
                    @endforeach
                </select>
                <label>Liason Funky</label> 
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="md-form">
                  <input type="text" id="media-affliation-{{$media->id}}" class="form-control" value="{{$media->affiliation}}">
                  <label for="media-affliation-{{$media->id}}">Afiliere</label>    
                </div>            
              </div>                    
              <div class="col-md-6">
                <fieldset class="form-group">
                  @if($media->office_check_in == 0)
                    <input type="checkbox" id="media-check-in-{{$media->id}}">
                  @else
                    <input type="checkbox" id="media-check-in-{{$media->id}}" checked>
                  @endif
                  <label for="media-check-in-{{$media->id}}">Colivia check-in</label>      
                </fieldset>       
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <select id="media-rating-{{$media->id}}" class="media-rating">
                  @if($media->rating == 1)
                    <option value="1" selected>1</option>
                  @else
                    <option value="1">1</option>
                  @endif
                  @if($media->rating == 2)
                    <option value="2" selected>2</option>
                  @else
                    <option value="2">2</option>
                  @endif
                  @if($media->rating == 3)
                    <option value="3" selected>3</option>
                  @else
                    <option value="3">3</option>
                  @endif
                  @if($media->rating == 4)
                    <option value="4" selected>4</option>
                  @else
                    <option value="4">4</option>
                  @endif
                  @if($media->rating == 5)
                    <option value="5" selected>5</option>
                  @else
                    <option value="5">5</option>
                  @endif                                                      
                </select>
                <label>Rating interacțiune</label>
              </div>
            </div>

            <div class="row">
              @foreach($media->links as $link)
                <div class="col-md-6">
                  <div class="md-form">
                    <input type="text" id="media-link-{{$media->id}}-{{$link->id}}" class="form-control media-link-{{$media->id}}" data-link_id="{{$link->id}}" value="{{$link->url}}">
                    <label for="media-link-{{$media->id}}-{{$link->id}}">Link</label>    
                  </div>                    
                </div>
              @endforeach
              <div class="col-md-6">
                <div class="md-form">
                  <input type="text" id="media-link-{{$media->id}}-new" class="form-control media-link-new-{{$media->id}}" data-link_id="new">
                  <label for="media-link-{{$media->id}}-new">Link nou</label>    
                </div>                    
              </div>              
            </div>

            <div class="row">
                <div class="col-md-12 text-center hidden" id="edit-media-spinner-{{$media->id}}"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>
                <div class="col-md-10 text-right">
                    <button class="btn btn-primary edit-media" data-id="{{$media->id}}" id="edit-media-{{$media->id}}">Modifică media</button>
                </div>
                <div class="col-md-2 text-right">
                    <button type="button" class="btn btn-danger delete-media" data-id="{{$media->id}}" id="delete-media-{{$media->id}}">Șterge</button>
                </div>
            </div>
        </form>

      </div>
      <!--/.Card content-->
  </div>
</div>