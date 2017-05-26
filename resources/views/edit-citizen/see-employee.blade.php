  <div class="card card-cascade narrower mb-r employee" data-id="{{$employee->id}}">
  <div class="admin-panel info-admin-panel">
      <!--Card image-->
      <div class="view primary-color">
          <h5>Modifică funcționar</h5>
      </div>
      <!--/Card image-->
      <!--Card content-->
      <div class="card-block">

        <form>
            <div class="row">
              <div class="col-md-4 col-md-offset-1"></div>
              <div class="col-md-6">
                  <div class="md-form">
                      <input type="text" id="employee-keyword-{{$employee->id}}" value="{{$employee->keyword}}"></input>
                      <label for="employee-keyword-{{$employee->id}}">Keyword</label>
                  </div>
              </div>   
            </div>

            @foreach($employee->institution as $institution)

              <div class="row">
                <div class="col-md-12">
                  <hr class="mt-2 mb-2"/>
                  <h4><b>Instituție #{{$institution->id}}</b></h4>
                </div>
                <div class="col-md-6">
                  <div class="md-form">
                      <input type="text" id="institution-name-{{$institution->id}}" class="form-control validate" value="{{$institution->name}}">
                      <label for="institution-name-{{$institution->id}}">Nume</label>
                  </div>     
                </div>  
                <div class="col-md-6">
                  <div class="md-form">
                      <input type="text" id="institution-job_title-{{$institution->id}}" class="form-control validate" value="{{$institution->job_title}}">
                      <label for="institution-job_title-{{$institution->id}}">Titlul Job-ului</label>
                  </div>     
                </div> 
                <div class="col-md-6">
                    <div class="md-form">
                        <textarea type="text" id="institution-job_description-{{$institution->id}}" class="md-textarea" style="resize:vertical;">{{$institution->job_description}}</textarea>
                        <label for="institution-job_description-{{$institution->id}}">Descrierea Job-ului</label>
                    </div>
                </div> 
                <div class="col-md-6">
                  <div class="md-form">
                    <input type="date" class="datepicker" id="institution_start_date-{{$institution->id}}" value="{{$institution->from}}">
                    <label for="institution_start_date-{{$institution->id}}">De la</label>    
                  </div>                    
                </div> 
                <div class="col-md-6">
                  <div class="md-form">
                    <input type="date" class="datepicker" id="institution_end_date-{{$institution->id}}" value="{{$institution->until}}">
                    <label for="institution_end_date-{{$institution->id}}">Pana la</label>    
                  </div>                    
                </div>                  
              </div> 
              <div class="row">
                  <div class="col-md-12 text-center hidden" id="edit-institution-spinner-{{$institution->id}}"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>
                  <div class="col-md-9 text-right">
                      <button class="btn btn-primary edit-institution" data-id="{{$institution->id}}" id="edit-institution-{{$institution->id}}">Modifică instituția #{{$institution->id}}</button>
                  </div>
                  <div class="col-md-3 text-right">
                      <button type="button" class="btn btn-danger delete-institution" data-id="{{$institution->id}}" id="delete-institution-{{$institution->id}}">Șterge instituția #{{$institution->id}}</button>
                  </div>
              </div>  
            @endforeach

            <div class="row">
              <div class="col-md-12">
                <hr class="mt-2 mb-2"/>
                <h4><b>Instituție nouă</b></h4>
              </div>
              <div class="col-md-6">
                <div class="md-form">
                    <input type="text" id="new-institution-name-{{$employee->id}}" class="form-control validate">
                    <label for="new-institution-name-{{$employee->id}}">Nume</label>
                </div>     
              </div>  
              <div class="col-md-6">
                <div class="md-form">
                    <input type="text" id="new-institution-job_title-{{$employee->id}}" class="form-control validate">
                    <label for="new-institution-job_title-{{$employee->id}}">Titlul Job-ului</label>
                </div>     
              </div> 
              <div class="col-md-6">
                  <div class="md-form">
                      <textarea type="text" id="new-institution-job_description-{{$employee->id}}" class="md-textarea" style="resize:vertical;"></textarea>
                      <label for="new-institution-job_description-{{$employee->id}}">Descrierea Job-ului</label>
                  </div>
              </div> 
              <div class="col-md-6">
                <div class="md-form">
                  <input type="date" class="datepicker" id="new-institution_start_date-{{$employee->id}}">
                  <label for="new-institution_start_date-{{$employee->id}}">De la</label>    
                </div>                    
              </div> 
              <div class="col-md-6">
                <div class="md-form">
                  <input type="date" class="datepicker" id="new-institution_end_date-{{$employee->id}}">
                  <label for="new-institution_end_date-{{$employee->id}}">Pana la</label>    
                </div>                    
              </div>                  
            </div>            

            <div class="row">
                <div class="col-md-12 text-center hidden" id="edit-employee-spinner-{{$employee->id}}"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>
                <div class="col-md-10 text-right">
                    <button class="btn btn-primary edit-employee" data-id="{{$employee->id}}" id="edit-employee-{{$employee->id}}">Modifică funcționar</button>
                </div>
                <div class="col-md-2 text-right">
                    <button type="button" class="btn btn-danger delete-employee" data-id="{{$employee->id}}" id="delete-employee-{{$employee->id}}">Șterge</button>
                </div>
            </div>
        </form>
      </div>
      <!--/.Card content-->
  </div>
</div>