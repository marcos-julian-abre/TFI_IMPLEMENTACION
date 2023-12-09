<!DOCTYPE html>
<html>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.2.2/Chart.min.js"></script>

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Home</title>		        
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
		    <link rel="stylesheet" href="{{ asset('css/app.css') }}"/>
       <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
  </head>
  
    <body class="sb-nav-fixed">
    <?php session_start(); 
     ?>
<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
  <a class="navbar-brand ps-3" href="/index">Home</a>
  <div class="search-container">
    <form action="/product_profile" method="get" id="search-form">
      @csrf 
      <div class="input-container">
        <input type="text" name="nombre_producto" id="fruit" placeholder="Buscar Producto">
        <button type="submit" id="search-button"><i class="fas fa-search"></i></button>
      </div>
      <div class="suggestions">
        <ul></ul>
      </div>
    </form>
  </div>
  <ul class="navbar-nav ml-auto">
    <li class="nav-item">
      <a class="nav-link" href="/logout">
        <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
      </a>
    </li>
    <li class="nav-item">  
        <a class="nav-link text-white" href="/aboutUs">About Us</a>
    </li>  
  </ul>
</nav>
      <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Canastas</div>
                              @if(!empty($canastasActuales[0]))
                                @for($i = 0; !empty($canastasActuales[$i]); $i++)
                                <div class="basket-item">
                                <a class="nav-link" href="/basket/{{$canastasActuales[$i]['id_canasta']}}">
                                    <div class="sb-nav-link-icon"><i class="fas fa-shopping-basket" style="color: #ffffff;"></i></div>
                                    {{$canastasActuales[$i]['nombre_canasta']}}
                                </a>                                
                            </div>
                                @endfor
                              @endif
                              <a class="nav-link" href="/basket_form">
                                <div class="sb-nav-link-icon bag-plus-fill"><i class="fas fa-plus" style="color: #ffffff;"></i></i></div>
                                Nueva Canasta
                              </a>
                            @if($tipoUsuario=='Administrador')
                            <div class="sb-sidenav-menu-heading">Gestion</div>
                            <a class="nav-link" href="/signup">
                                <div class="sb-nav-link-icon bag-plus-fill"><i class="fas fa-edit" style="color: #ffffff;"></i></i></div>
                                Registrar Usuario
                            </a>
                            <a class="nav-link" href="/manage">
                                <div class="sb-nav-link-icon bag-plus-fill"><i class="fas fa-edit" style="color: #ffffff;"></i></i></div>
                                Gestionar Usuarios
                            </a>
                            @endif
                            </div>
                        </div>
                </nav>
            </div>         


            <div id="layoutSidenav_content">
            <main>
<div class="container px-4 py-5">

<?php if(!isset($datosProductosMentor[3][0]['mentor'])){
    $datosProductosMentor[3][0]['mentor'] = 0;
}  ?>
<div class="container">
    @if($datosProductosMentor[3][0]['mentor'] == 0)
        <div class="row mt-5">
            <div class="col-md-8 offset-md-2 text-center">
                <h1 class="display-4">Perfil de Mentor</h1>
                <p class="lead">Busque a un mentor por su nombre para visualizar sus productos recomendados.</p>
            </div>
        </div>
    @else
        <div class="row mt-5">
            <div class="col-md-8 offset-md-2 text-center">
                <h1 class="display-4">Perfil de {{$nombreMentor['usuario']}} | Reviews: {{$nombreMentor['cantidad_reviews']}}</h1>
                <p class="lead">Descubra las recomendaciones del mentor.</p>
            </div>
        </div>
    @endif

  <div class="row">
    <div class="col">
      <form action="/mentor_profile" method="post" id="search-form2" class="mb-3">
          @csrf
          <div class="input-group">
              <input type="text" name="nombre_usuario" id="fruit2" placeholder="Buscar Producto" class="form-control" aria-label="Buscar Producto">
              <div class="input-group-append">                                        
                  <input type="hidden" name='menu' value="1">                     
                  <button type="submit" class="btn btn-primary" id="search-button2">Buscar</button>
              </div>
              <div class="suggestions" id="suggestions2">
                  <ul></ul>
              </div>
          </div>
      </form>
    </div>

    
  @if($menu == 1)
    <div class="col-md-auto">
      @if($datosEstadoMentor[0]['mentor'] == 0)
          <form action="/mentor_update" method="post">
              @csrf
              <div class="row  align-items-center">
                  <div class="col-auto">
                      <h5>Tu perfil es actualmente </h5>
                  </div>
                  <div class="col-auto">
                      <input type="hidden" name='estado_mentor' value="1">
                      <button type="submit" class="btn btn-primary">Privado <i class="fas fa-lock"></i></button>
                  </div>
              </div>
          </form>
      @else
          <form action="/mentor_update" method="post">
              @csrf
              <div class="row  align-items-center">
                  <div class="col-auto">
                      <h5>Su perfil es actualmente </h5>
                  </div>
                  <div class="col-auto">
                      <input type="hidden" name='estado_mentor' value="0">
                      <button type="submit" class="btn btn-primary">Público <i class="fas fa-eye"></i></button>
                  </div>
              </div>
          </form>
      @endif
    </div>
  </div>

    @if($datosProductosMentor[3][0]['mentor'] == 1)
    <div class="row mt-5">
        <div class="col-md-12 text-center">
            <i class="fas fa-thumbs-up fa-3x" style="color: #5ac93b;"></i>
            <h4 class="mt-3">Productos Recomendados por el Mentor:</h4>
        </div>
    </div>

    <div class="row">
        @for($i=0;!empty($datosProductosMentor[2][$i]);$i++)
            <div class="col-md-4 mt-4">
                <a class="card" href="/product_profile?nombre_producto={{ $datosProductosMentor[2][$i]['nombre_producto'] }}">
                    <img src="{{ asset('img/products/' . $datosProductosMentor[2][$i]['id_producto'] . '.png') }}" class="card-img-top img-fluid" alt="Product Image">
                    <div class="card-body">
                        <h5 class="card-title">{{$datosProductosMentor[2][$i]['nombre_producto']}}</h5>
                        <p class="card-text">{{$datosProductosMentor[2][$i]['tipo_producto']}}</p>
                    </div>
                </a>
            </div>
        @endfor
    </div>

    <div class="row mt-5">
        <div class="col-md-12 text-center">
            <i class="fas fa-thumbs-down fa-3x" style="color: #db2929;"></i>
            <h4 class="mt-3">Productos Desaconsejados por el Mentor:</h4>
        </div>
    </div>

    <div class="row">
        @for($i=0;!empty($datosProductosMentor[1][$i]);$i++)
            <div class="col-md-4 mt-4">
                <a class="card" href="/product_profile?nombre_producto={{ $datosProductosMentor[1][$i]['nombre_producto'] }}">
                    <img src="{{ asset('img/products/' . $datosProductosMentor[1][$i]['id_producto'] . '.png') }}" class="card-img-top img-fluid" alt="Product Image">
                    <div class="card-body">
                      <h5 class="card-title">{{$datosProductosMentor[1][$i]['nombre_producto']}}</h5>
                      <p class="card-text">{{$datosProductosMentor[1][$i]['tipo_producto']}}</p>
                    </div>
                </a>
            </div>
        @endfor
    </div>
</div>
@endif

    @if($datosProductosMentor[3][0]['mentor'] == 0)
    <br><br>
      <div class="alert alert-primary" role="alert">
      Mentor no encontrado.  
      </div>
    @endif

    
    @if($datosProductosMentor[3][0]['mentor'] == 1)
    @if(!empty($canastasMentor[0][0]['nombre_producto']))
    <div class="row mt-5">
        <div class="col-md-12 text-center">
            <h4 class="mt-3">Canastas del Mentor:</h4>
        </div>
    </div>
    @else
    <div class="row mt-5">
            <div class="col-md-8 offset-md-2 text-center">
                <h3 class="display-4">El mentor no posee canastas <i class="fa-regular fa-face-frown"></i></i></h3>
            </div>
        </div>
    @endif
    <div class="row row-cols-1 row-cols-md-4">
    @for($i=0;!empty($canastasMentor[$i]);$i++)
        <div class="col mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-shopping-basket"></i> {{$canastasMentor[$i]['datos_canasta'][0]['nombre_canasta']}}</h5>
                    <p class="card-text">Días: {{$canastasMentor[$i]['datos_canasta'][0]['tiempo_canasta']}}</p>

                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Cantidad</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for($j=0;!empty($canastasMentor[$i][$j]);$j++)
                                <tr>
                                    <td>{{$canastasMentor[$i][$j]['nombre_producto']}}</td>
                                    <td>{{$canastasMentor[$i][$j]['cantidad']}}</td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>

                    <form action="/import_canasta" method="post">
                        @csrf
                        <input type="hidden" name='tiempo_canasta' value="{{$canastasMentor[$i]['datos_canasta'][0]['tiempo_canasta']}}">    
                        <input type="hidden" name='nombre_canasta' value="{{$canastasMentor[$i]['datos_canasta'][0]['nombre_canasta']}}">                        
                        <input type="hidden" name='id_canasta' value="{{$canastasMentor[$i]['datos_canasta'][0]['id_canasta']}}">
                        <button type="submit" class="btn btn-primary mt-3">Importar <i class="fas fa-shopping-basket"></i></button>
                    </form>
                </div>
            </div> 
        </div>
    @endfor
    
  </div>
  
  <form action="/mentor_profile" method="post">
              @csrf
              <input type="hidden" name='menu' value="0">              
              <input type="hidden" name='nombre_usuario' value="0">
              <button type="submit" class="btn btn-primary mt-3">Atras</i></button>
          </form>
  @endif

@else
<br><br><br>
<div class="container">
  <div class="row">
    
  <div class="col-md-2">
  </div>
    <div class="col-md-auto">
      <h2 class="text-center mb-4">Top Mentores</h2>
      <!-- Tu bucle for con Bootstrap mejorado -->
      @for($i=0; $i<=4; $i++)
        <div class="card mb-3 text-center">
          <div class="card-body">
            <div class="media">
              <span class="mr-3 align-self-center font-weight-bold text-primary" style="font-size: 1.5rem;">{{$i + 1}}</span>
              <i class="fas fa-user-circle fa-3x mr-3 text-secondary align-self-center"></i>
              <div class="media-body">
                <h5 class="mt-0">{{$topMentores[$i]['usuario']}}</h5>
              </div>
            </div>
          </div>
        </div>
      @endfor
    </div>
    
  <div class="col-md-3">
  </div>
    <div class="col-md-auto">
      <h2 class="text-center mb-4">Otros Mentores</h2>
      <table class="table">
        <tbody>
          @for($i=5; $i<=19; $i++)
            <tr>
              <td>{{$topMentores[$i]['usuario']}}</td>
            </tr>
          @endfor
        </tbody>
      </table>
    </div>
  </div>
</div>


@endif


</div> 


</main>

                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Datos de Sesion | Usuario: {{$nombreUsuario}} - Tipo: {{$tipoUsuario}} - ID: {{$idSesion}}</div>
                            <?php
                                if ($tipoUsuario === "Administrador"){
                                    ?> 
                            <div>
                                <a href="/signup">Registrar Usuario</a>
                                &middot;
                                <a href="/manage">Gestionar Usuarios</a>
                                &middot;
                                <a href="/logout">Cerrar Sesion</a>
                            </div>
                            <?php }
                            else{
                                ?>
                                 <a href="/logout">Cerrar Sesion</a>

                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </footer>
                
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>

</body>


<script>
const input = document.querySelector('#fruit');
const suggestions = document.querySelector('.suggestions ul');

const fruit = [<?=$listaProductosFinal?>];

function search(str) {
	let results = [];
	const val = str.toLowerCase();

	for (i = 0; i < fruit.length; i++) {
		if (fruit[i].toLowerCase().indexOf(val) > -1) {
			results.push(fruit[i]);
		}
	}

	return results;
}

function searchHandler(e) {
	const inputVal = e.currentTarget.value;
	let results = [];
	if (inputVal.length > 0) {
		results = search(inputVal);
	}
	showSuggestions(results, inputVal);
}

function showSuggestions(results, inputVal) {
    
    suggestions.innerHTML = '';

	if (results.length > 0) {
		for (i = 0; i < results.length; i++) {
			let item = results[i];
			// Highlights only the first match
			// TODO: highlight all matches
			const match = item.match(new RegExp(inputVal, 'i'));
			item = item.replace(match[0], `<strong>${match[0]}</strong>`);
			suggestions.innerHTML += `<li>${item}</li>`;
		}
		suggestions.classList.add('has-suggestions');
	} else {
		results = [];
		suggestions.innerHTML = '';
		suggestions.classList.remove('has-suggestions');
	}
}

function useSuggestion(e) {
	input.value = e.target.innerText;
	input.focus();
	suggestions.innerHTML = '';
	suggestions.classList.remove('has-suggestions');
}

input.addEventListener('keyup', searchHandler);
suggestions.addEventListener('click', useSuggestion);
</script>


<script>
const input2 = document.querySelector('#fruit2');
const suggestions2 = document.querySelector('#suggestions2 ul');


const fruit2 = [<?=$listaMentoresFinal?>];

function search2(str) {
  let results = [];
  const val = str.toLowerCase();

  for (i = 0; i < fruit2.length; i++) {
    if (fruit2[i].toLowerCase().indexOf(val) > -1) {
      results.push(fruit2[i]);
    }
  }

  return results;
}

function searchHandler2(e) {
  const inputVal = e.currentTarget.value;
  let results = [];
  if (inputVal.length > 0) {
    results = search2(inputVal);
  }
  showSuggestions2(results, inputVal);
}

function showSuggestions2(results, inputVal) {
  suggestions2.innerHTML = '';

  if (results.length > 0) {
    for (i = 0; i < results.length; i++) {
      let item = results[i];
      const match = item.match(new RegExp(inputVal, 'i'));
      item = item.replace(match[0], `<strong>${match[0]}</strong>`);
      suggestions2.innerHTML += `<li>${item}</li>`;
    }
    suggestions2.classList.add('has-suggestions');
  } else {
    results = [];
    suggestions2.innerHTML = '';
    suggestions2.classList.remove('has-suggestions');
  }
}

function useSuggestion2(e) {
  input2.value = e.target.innerText;
  input2.focus();
  suggestions2.innerHTML = '';
  suggestions2.classList.remove('has-suggestions');
}

input2.addEventListener('keyup', searchHandler2);
suggestions2.addEventListener('click', useSuggestion2);
</script>
</html>

