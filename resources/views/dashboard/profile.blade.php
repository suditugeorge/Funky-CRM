@extends('layouts.master')

@section('title')
Profil
@endsection


@section('content')

<main class="">
<div class="container-fluid">
    <!-- Section: Edit Account -->
    <section class="section">
        <!-- First row -->
        <div class="row">
            <!-- First column -->
            <div class="col-lg-4">

                <!-- Card -->
                <div class="card contact-card card-cascade narrower mb-r">
                    <div class="admin-panel info-admin-panel">
                        <!-- Card title -->
                        <div class="view primary-color">
                            <h5>Profil</h5>
                        </div>
                        <!-- /.Card title -->

                        <!-- Card content -->
                        <div class="card-block text-center">
                            @if (file_exists(public_path('images/users/'.$user->id.'.jpg')))
                            <img src="{{URL::asset('images/users/'.$user->id.'.jpg')}}" alt="User Photo" class="rounded-circle contact-avatar my-2 mx-auto" />
                            @else
                                <img src="{{URL::asset('images/users/default.png')}}" alt="User Photo" class="rounded-circle contact-avatar my-2 mx-auto" />
                            @endif
                            <p class="text-muted"><small>{{App\Http\Controllers\UserController::getBasicInfo()}}</small></p>

                            <form role="form" method="POST" action="/change-profile-photo" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{{Session::token()}}">
                                <div class="file-field">
                                    <div class="btn btn-primary btn-block">
                                        <span>Alege poză</span>
                                        <input type="file" name="profilePicture" onchange="this.form.submit();">
                                    </div>
                                    <br/><br/><br/>
                                </div>
                            </form>
                        </div>

                        <!-- /.Card content -->

                    </div>
                </div>
                <!-- /.Card -->

            </div>
            <!-- /.First column -->
            <!-- Second column -->
            <div class="col-lg-8">
                <!--Card-->
                <div class="card card-cascade narrower mb-r">
                    <div class="admin-panel info-admin-panel">
                        <!--Card image-->
                        <div class="view primary-color">
                            <h5>Informații utilizator</h5>
                        </div>
                        <!--/Card image-->
                        <!--Card content-->
                        <div class="card-block">
                            <!-- Edit Form -->
                            @include('dashboard.edit-profile')
                        </div>
                        <!--/.Card content-->
                    </div>
                </div>
                <!--/.Card-->
            </div>
            <!-- /.Second column -->
        </div>
        <!-- /.First row -->
    </section>
    <!-- /.Section: Edit Account -->
</div>
</main>

@endsection

@push('scripts')
    <script type="text/javascript" src="{{ URL::asset('js/profile.js') }}"></script>
@endpush
