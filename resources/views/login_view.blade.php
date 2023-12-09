<!doctype html>
	<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">		<link rel="stylesheet" href="{{ asset('css/index_style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
	body,
	html {
		margin: 0;
		padding: 0;
		height: 100%;
		background: #f5f5f5; /* Light gray background */
	}
	.user_card {
		height: 400px;
		width: 350px;
		margin-top: auto;
		margin-bottom: auto;
		background: #ffffff; /* White background */
		position: relative;
		display: flex;
		justify-content: center;
		flex-direction: column;
		padding: 10px;
		box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
		border-radius: 5px;
	}

	.brand_logo_container {
		position: absolute;
		height: 170px;
		width: 170px;
		top: -75px;
		border-radius: 50%;
		background: #3EC58F; /* Green color associated with nutrition */
		padding: 10px;
		text-align: center;
	}

	.brand_logo {
		height: 150px;
		width: 150px;
		border-radius: 50%;
		border: 2px solid white;
	}

	.form_container {
		margin-top: 100px;
	}

	.login_btn {
		width: 100%;
		background: #3EC58F !important; /* Green color associated with nutrition */
		color: white !important;
	}

	.login_btn:focus {
		box-shadow: none !important;
		outline: 0px !important;
	}

	.login_container {
		padding: 0 2rem;
	}

	.input-group-text {
		background: #3EC58F !important; /* Green color associated with nutrition */
		color: white !important;
		border: 0 !important;
		border-radius: 0.25rem 0 0 0.25rem !important;
	}

	.input_user,
	.input_pass:focus {
		box-shadow: none !important;
		outline: 0px !important;
	}

	.custom-checkbox .custom-control-input:checked~.custom-control-label::before {
		background-color: #3EC58F !important; /* Green color associated with nutrition */
	}

  h2 {
        font-size: 2.5rem; /* Tamaño del texto */
        color: #3EC58F; /* Color del texto */
        font-weight: bold; /* Negrita */
    }

    .sub-title {
        font-size: 1.2rem; /* Tamaño del texto para el subtítulo */
        color: #555; /* Color del texto para el subtítulo */
        margin-bottom: -20px; /* Ajuste de margen negativo para superponerlo al título */
    }
</style>
    <title>Login</title>

 	</head>
<body>	
  
        <br><br>
        <br><br>
<div class="container">
    <div class="row">
      <div class="col-md-6 offset-md-3">
        <h2 class="text-center text-dark mt-5 mb-2">Nutra</h2>
        <div class="text-center mb-n9 text-dark">Seminario de Aplicacion Profesional</div>
        </div>
        </div>
        </div>
        <br><br>
        <br><br>
        <br><br>


<div class="container">  
		<div class="d-flex justify-content-center h-100">
			<div class="user_card">
				<div class="d-flex justify-content-center">
					<div class="brand_logo_container">
						<img src="/img/nutra.png" class="brand_logo" alt="Logo"><br><br>
            <h4 class="font-weight-bold">Ingresar</h4>
					</div>
				</div>
				<div class="d-flex justify-content-center form_container">          
					<form action="/login" method="post">            
          @csrf
						<div class="input-group mb-3">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-user"></i></span>
							</div>
              <input name="usuario" type="text" class="form-control" id="Username" aria-describedby="emailHelp"placeholder="Nombre de Usuario">
						</div>
						<div class="input-group mb-2">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-key"></i></span>
							</div>
							<input name="contraseña" type="password" class="form-control" id="password" placeholder="Password">
						</div>
						<div class="form-group">
							<div class="custom-control custom-checkbox">
								<input type="checkbox" class="custom-control-input" id="customControlInline">
								<label class="custom-control-label" for="customControlInline">Recordarme</label>
							</div>
						</div>
							<div class="d-flex justify-content-center mt-3 login_container">
				 	<button type="submit" name="button" class="btn login_btn">Ingresar</button>
				   </div>
					</form>
				</div><!--
		
				<div class="mt-4">
					<div class="d-flex justify-content-center links">
						Don't have an account? <a href="#" class="ml-2">Sign Up</a>
					</div>
					<div class="d-flex justify-content-center links">
						<a href="#">Forgot your password?</a>
					</div>
				</div>-->
			</div>
		</div>
	</div> 
  @if ($alertaLogin==1) 
    <div class="alert alert-primary" role="alert">
    Credenciales Invalidas  
    </div>
  @endif






    </body>

</html>