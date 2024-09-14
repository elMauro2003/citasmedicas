
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sistema de Reserva de Citas Médicas</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page" style="background-image: url({{url('assets/img/login-banner.jpg')}});
        background-repeat: no-repeat; 
        background-size: 100vw 100vh;
        background-attachment: fixed">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="" class="h1"><b>SCM</b>|Cuba</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg"><b>Inicio de sesión</b></p>

      <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="row">
            <div class="col-md-12">
                <div class="form group">
                    <label for="">Email:</label>
                    <input type="email" value="{{old('email')}}" name="email" class="form-control" required>
                    @error('email')
                        <small style="color:red">{{$message}}</small>
                    @enderror
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-12">
                <div class="form group">
                    <label for="">Contraseña:</label>
                    <input type="password" value="{{old('password')}}" name="password" class="form-control" required>
                    @error('password')
                        <small style="color:red">{{$message}}</small>
                    @enderror
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary btn-block">
                    {{ __('Ingresar') }}
                </button>
            </div>
        </div>
        <br>
    </form>
      <p class="mb-0">
        <a href="{{url('register')}}" class="text-center"><b>Crear cuenta!</b></a>
      </p>

    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
