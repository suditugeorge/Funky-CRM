<form>
    <!--Second row-->
    <div class="row">
        <!--First column-->
        <div class="col-md-6">
            <div class="md-form">
                <input type="email" id="email" class="form-control" disabled value="{{$user->email}}">
                <label for="email" class="disabled">Adresă email</label>
            </div>
        </div>
        <!--Second column-->
        <div class="col-md-6">
            <div class="md-form">
                <input type="text" id="name" class="form-control validate" value="{{$user->name}}">
                <label for="name">Nume</label>
            </div>
        </div>
    </div>
    <!--/.Second row-->
    <!--Second row-->
    <div class="row">
        <!--First column-->
        <div class="col-md-6">
            <div class="md-form">
                <input type="text" id="created_at" class="form-control" disabled value="{{$user->created_at->format('d-m-Y')}}">
                <label for="created_at" class="disabled">Cont creat în</label>
            </div>
        </div>
        <!--Second column-->
        <div class="col-md-6">
            <div class="md-form">
                <input type="text" id="updated_at" class="form-control" disabled value="{{$user->updated_at->format('d-m-Y')}}">
                <label for="updated_at">Modificat la</label>
            </div>
        </div>
    </div>
    <!--/.Second row-->

    <!-- Fourth row -->
    <div class="row">
        <div class="col-md-12 text-center">
            <i class="fa fa-spinner fa-spin fa-3x fa-fw hidden"></i><button class="btn btn-primary" id="change-user-profile">Schimbă datele</button>
        </div>
    </div>
    <!-- /.Fourth row -->

</form>
<!-- Edit Form -->