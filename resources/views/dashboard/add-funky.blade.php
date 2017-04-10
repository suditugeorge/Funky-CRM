@extends('layouts.master')

@section('title')
Adaugă membru Funky
@endsection


@section('content')

<main class="">
<div class="container-fluid">
    <section class="section">
        <!-- First row -->
        <div class="row">
            <!-- Second column -->
            <div class="col-lg-12">
                <!--Card-->
                <div class="card card-cascade narrower mb-r">
                    <div class="admin-panel info-admin-panel">
                        <!--Card image-->
                        <div class="view primary-color">
                            <h5>Adaugă membri Funky</h5>
                        </div>
                        <!--/Card image-->
                        <!--Card content-->
                        <div class="card-block">
                            <!-- Edit Form -->
                            <form>
                                <!--Second row-->
                                <div class="row">
                                    <!--First column-->
                                    <div class="col-md-12">

                                        <div class="md-form">
                                            <textarea type="text" id="emails" class="md-textarea" style="resize:vertical;"></textarea>
                                            <label for="emails">Adrese de email</label>
                                        </div>

                                    </div>
                                </div>
                                <!-- Fourth row -->
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <button class="btn btn-primary" id="add-admins">Adaugă membri</button>
                                    </div>
                                </div>
                                <!-- /.Fourth row -->
                            </form>

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
    <script type="text/javascript" src="{{ URL::asset('js/add-funky.js') }}"></script>
@endpush