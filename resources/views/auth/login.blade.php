<!DOCTYPE html>
<html>

<head>
    <title>Inventory | Inicio de Sesión</title>
    @include('include.header')
</head>

<body class="login-page">
    <div class="login-box">
        <div class="logo">
            <a href="javascript:void(0);"><img src="{{ url('images/logo_cardioclinic.png') }}" alt="inventory logo"> </a>
        </div>

        <div class="card">
            <div class="body">

                <form id="sign_in" method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}

                    <div class="msg">Inicio de Sesión</div>

                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="email" placeholder="Correo electrónico" required autofocus>
                        </div>
                        @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" name="password" placeholder="Contraseña" required>
                            @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-8 p-t-5">
                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} id="rememberme" class="filled-in chk-col-pink">
                            <label for="rememberme">Recuérdame</label>
                        </div>
                        <div class="col-xs-4">
                            <button class="btn btn-block bg-pink waves-effect" type="submit">Ingresar</button>
                        </div>
                    </div>

                    <div class="row m-t-15 m-b--20">
                    </div>
                </form>

            </div>
        </div>
    </div>

    @include('include.footer')
</body>

</html>