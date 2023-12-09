<!DOCTYPE html>
<html>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.2.2/Chart.min.js"></script>
    <style>

*, body {
    font-family: 'Poppins', sans-serif;
    font-weight: 400;
    -webkit-font-smoothing: antialiased;
    text-rendering: optimizeLegibility;
    -moz-osx-font-smoothing: grayscale;
    background-color: #ffffff;
}

html, body {
    height: 100%;
    background-color: #152733;
    overflow: hidden;
}


.form-holder {
  
  height: 100%;
      display: flex;
      flex-direction: column;
      align-items: center;
      text-align: center;      
}

.form-holder .form-content {
  height: 100%;

    position: relative;
    text-align: center;
    display: -webkit-box;
    display: -moz-box;
    display: -ms-flexbox;
    display: -webkit-flex;
    display: flex;
    -webkit-justify-content: center;
    justify-content: center;
    -webkit-align-items: center;
    align-items: center;
    padding: 60px;
}

.form-content .form-items {
    border: 3px solid #000000;
    padding: 40px;
    display: inline-block;
    width: 100%;
    min-width: 540px;
    -webkit-border-radius: 10px;
    -moz-border-radius: 10px;
    border-radius: 10px;
    text-align: left;
    -webkit-transition: all 0.4s ease;
    transition: all 0.4s ease;
    justify-content: center;
}

.form-content h3 {
    color: #000000;
    text-align: left;
    font-size: 28px;
    font-weight: 600;
    margin-bottom: 5px;
}

.form-content h3.form-title {
    margin-bottom: 30px;
}

.form-content p {
    color: #000000;
    text-align: left;
    font-size: 17px;
    font-weight: 300;
    line-height: 20px;
    margin-bottom: 30px;
}


.form-content label, .was-validated .form-check-input:invalid~.form-check-label, .was-validated .form-check-input:valid~.form-check-label{
    color: #000000;
}

.form-content input[type=text], .form-content input[type=password], .form-content input[type=email], .form-content select {
    width: 100%;
    padding: 9px 20px;
    text-align: left;
    border: 1;
    outline: 1;
    border-radius: 6px;
    background-color: #fff;
    font-size: 15px;
    font-weight: 300;
    color: #000000;
    -webkit-transition: all 0.3s ease;
    transition: all 0.3s ease;
    margin-top: 16px;
}


.btn-primary{
    background-color: #6C757D;
    outline: none;
    border: 0px;
     box-shadow: none;
}

.btn-primary:hover, .btn-primary:focus, .btn-primary:active{
    background-color: #495056;
    outline: none !important;
    border: none !important;
     box-shadow: none;
}

.form-content textarea {
    position: static !important;
    width: 100%;
    padding: 8px 20px;
    border-radius: 6px;
    text-align: left;
    background-color: #fff;
    border: 0;
    font-size: 15px;
    font-weight: 300;
    color: #8D8D8D;
    outline: none;
    resize: none;
    height: 120px;
    -webkit-transition: none;
    transition: none;
    margin-bottom: 14px;
}

.form-content textarea:hover, .form-content textarea:focus {
    border: 0;
    background-color: #ebeff8;
    color: #8D8D8D;
}
.mv-up{
    margin-top: -9px !important;
    margin-bottom: 8px !important;
}

.invalid-feedback{
    color: #ff606e;
}

.valid-feedback{
   color: #2acc80;
}</style>

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Administrar Usuarios</title>		        
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
		    <link rel="stylesheet" href="{{ asset('css/app.css') }}"/>
       <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
  </head>

<body>
<?php	
session_start();
?>
<div class="row">
    <div class="col-md-8 offset-md-2">
      <h1 class="display-4 text-center my-5 mb-n1">Gestionar Usuarios</h1>
      <div class="text-center ">
		  <p class="lead">Actualice los datos del usuario seleccionado.</p>
      </div>
    </div>
  </div>

  <div class="form-body">
        <div class="row">
            <div class="form-holder">
                <div class="form-content">
                    <div class="form-items">
                        <h3>Datos Usuario</h3>
                        <p>Complete los campos.</p>
                        <form class="requires-validation" action="/manage" method="post">
                        @csrf 
                            <div class="col-md-12 text-dark">
                               <input class="form-control" name="idUsuario_update" type="text" id="Username" placeholder="ID Usuario">
                               <div class="valid-feedback">ID valido</div>
                               <div class="invalid-feedback">El Id del usuario no puede queadar vacio!</div>
                            </div>

                            <div class="col-md-12 text-dark">
                                <input class="form-control" name="usuario_update" type="text" maxlength="40" id="Username" placeholder="Nombre de Usuario">
                                 <div class="valid-feedback">Nombre Valido</div>
                                 <div class="invalid-feedback">El nombre es invalido!</div>
                            </div>          

                            <div class="col-md-12 text-dark">
                                <input class="form-control" name="pack_update" type="text" id="Pack" placeholder="Pack Adquirido">
                                 <div class="valid-feedback">Pack Valido</div>
                                 <div class="invalid-feedback">El pack es invalido!</div>
                            </div>
                            

                            <div class="col-md-12 mt-3">
                                <label class="mb-3 mr-1" for="tipo_update">Tipo: </label>

                                <input type="radio" class="btn-check" name="tipo_update" id="administrador" autocomplete="off" value="Administrador">
                                <label class="btn btn-sm btn-outline-secondary" for="administrador">Administrador</label>

                                <input type="radio" class="btn-check" name="tipo_update" id="standard" autocomplete="off" value="Standard">
                                <label class="btn btn-sm btn-outline-secondary" for="standard">Standard</label>
                            </div>
      
                            <div class="col-md-12 mt-3">
                              <label class="mb-3 mr-1" for="estado_update">Estado: </label>

                              <input type="radio" class="btn-check" name="estado_update" id="activo" autocomplete="off" value="Activo">
                              <label class="btn btn-sm btn-outline-secondary" for="activo">Activo</label>

                              <input type="radio" class="btn-check" name="estado_update" id="inactivo" autocomplete="off" value="Inactivo">
                              <label class="btn btn-sm btn-outline-secondary" for="inactivo">Inactivo</label>
                          </div>
                                                      
                            <div class="form-check">
                              <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                              <label class="form-check-label">Confirmo que los datos son correctos.</label>
                            <div class="invalid-feedback">Por favor, confirme que los datos son correctos!</div>
                            </div>
                  

                            <div class="form-button mt-3 text-dark" >
                                <button id="submit" type="submit" class="btn btn-primary">Actualizar</button>                                
                                <div class="text-center"><a href="/index">Atras</a></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>


  @if ($alertaManage==1) 
    <div class="alert alert-primary" role="alert">
    No se ha encontrado ningun usuario con el ID especificado
    </div>
  @endif

  @if ($alertaManage==2) 
    <div class="alert alert-success" role="alert">
    Usuario Actualizado con exito
    </div>
  @endif
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>