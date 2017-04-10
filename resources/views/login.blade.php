@extends('layouts.master-login')

@section('title')
Login
@endsection

@push('scripts')
    <script type="text/javascript" src="{{ URL::asset('js/login.js') }}"></script>
@endpush

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-6 col-lg-5 login-form mx-auto float-none">
            <div class="card">
                <div class="card-block">
                    <div class="form-header">
                        <h3><i class="fa fa-lock"></i> Login:</h3>
                    </div>
                    <div class="md-form">
                        <i class="fa fa-envelope prefix"></i>
                        <input type="text" id="email" class="form-control validate">
                        <label for="email">Email</label>
                    </div>

                    <div class="md-form">
                        <i class="fa fa-lock prefix"></i>
                        <input type="password" id="password" class="form-control validate">
                        <label for="password">Parolă</label>
                    </div>

                    <div class="text-center">
                        <fieldset class="form-group">
                            <input type="checkbox" id="remember" name="remember">
                            <label for="remember">Ține-mă minte</label>
                        </fieldset>
                        <i class="fa fa-spinner fa-spin fa-3x fa-fw hidden"></i><button class="btn btn-primary" id="login">Login</button>
                    </div>

                </div>
                <div class="modal-footer">
                    <div class="options">
                        <p><a href="#" id="forgot-password">Ai uitat parola?</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
