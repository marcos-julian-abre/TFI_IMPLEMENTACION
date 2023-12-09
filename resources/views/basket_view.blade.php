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

			<div class="container px-2 py-5">
    <div class="container-fluid px-2">






	<h1>Canasta "{{$datosCanasta[0]['nombre_canasta']}}" - {{$datosCanasta[0]['tiempo_canasta']}} Días</h1>

<form action="/basket/{{$idCanasta}}" method="post" id="search-form2" class="mb-3">
	@csrf
	<div class="input-group">
		<input type="text" name="nombre_producto" id="fruit2" placeholder="Buscar Producto" class="form-control" aria-label="Buscar Producto">
		<input type="hidden" id="id_canasta" name="id_canasta" value="{{$idCanasta}}">
		<div class="input-group-append">
			<button type="submit" class="btn btn-primary" id="search-button2">Buscar</button>
		</div>
		<div class="suggestions" id="suggestions2">
			<ul></ul>
		</div>
	</div>
</form>
<br>
@if ($listaBusquedaProducto != 0)
	<div class="list-group mt-3">
		@foreach($listaBusquedaProducto as $producto)
			<div class="list-group-item">
				<div class="d-flex justify-content-between align-items-center">
					<div>
						<h5 class="mb-1">{{$producto['nombre_producto']}}</h5>
						<p class="mb-1">{{$producto['peso']}} gr</p>
					</div>
					<div>
						<a href="/basket_add/{{$idCanasta}}/{{$producto['id_producto_paquete']}}" class="btn btn-success">Añadir</a>
					</div>
				</div>
			</div>
		@endforeach
	</div>
@endif


<div class="row">
	<div class="col-md-3 text-center">
		<div class="row mt-3">
			@for($i = 0; !empty($totalVariables[$i]); $i++)
                <div class="card mb-3
                    @if($totalVariables[$i]['pase'] === true) bg-success border-3 border-black
                    @elseif($totalVariables[$i]['pase'] === false) bg-danger border-3 border-black
                    @endif">
                    <div class="card-body">
                        <h5 class="card-title">Meta de {{$totalVariables[$i]['nombre']}}</h5>
                        <p class="card-text">
                            <strong>Meta:</strong> {{$totalVariables[$i]['meta']}} /
                            <strong>Valores Totales:</strong> {{$totalVariables[$i]['cantidad']}} /
                            @if($totalVariables[$i]['pase'] === true)
                                <strong><br>Meta cumplida por:</strong> {{round(abs($totalVariables[$i]['total']))}}
                            @elseif($totalVariables[$i]['pase'] === false)
                                <strong><br>Meta no cumplida por:</strong> {{round(abs($totalVariables[$i]['total']))}}
                            @endif
                        </p>
                    </div>
                </div>
            @endfor
		</div>
		<div class="row mt-3">
			@if(!empty($metasActuales[0]))
				<h4 class="mb-4">Metas Actuales:</h4>
				@foreach($metasActuales as $meta)
					<div class="card mb-3">
						<div class="card-body">
							<div class="row">
								<div class="col">
									<h5 class="card-title">{{$meta['descripcion_meta']}}</h5>
									<p class="card-text">
										{{
											(((($meta['cantidad_minima(gr)'] - $meta['cantidad_maxima(gr)']) / 100 ) * $meta['nivel_restriccion']) + $meta['cantidad_maxima(gr)'])
										}}
										por día
									</p>
								</div>
								<div class="col">
									<a href="/goals" class="btn btn-primary">Actualizar <i class="fas fa-bullseye"></i></a>
								</div>
							</div>
						</div>
					</div>
				@endforeach
			@else
				<div class="alert alert-info" role="alert">
					<p class="lead mb-0">No posees ninguna meta.</p><br>
                    <a href="/goals" class="btn btn-primary">Actualizar <i class="fas fa-bullseye"></i></a>
				</div>
			@endif
		</div>
	</div>
	<div class="col md-8">
	<h5 class="mb-3">Productos Actuales en la Canasta</h5>
                @if (!empty($productosActuales[0]))
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Peso(gr)</th>
                                <th>Tipo</th>
                                <th>ACe</th>
                                <th>AVgt</th>
                                <th>AVga</th>
                                <th>Score</th>
                                <th>Cantidad</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($productosActuales as $producto)
                                <tr>
                                    <td>{{$producto['nombre_producto']}}</td>
                                    <td>{{$producto['peso']}}</td>
                                    <td>{{$producto['tipo_producto']}}</td>
                                    <td>
                                        @if($producto['apto_celiaco'] == 1)
                                            <i class="fas fa-check-circle"></i>
                                        @else
                                            <i class="fas fa-times-circle"></i>
                                        @endif
                                    </td>
                                    <td>
                                        @if($producto['apto_vegetariano'] == 1)
                                            <i class="fas fa-check-circle"></i>
                                        @else
                                            <i class="fas fa-times-circle"></i>
                                        @endif
                                    </td>
                                    <td>
                                        @if($producto['apto_vegano'] == 1)
                                            <i class="fas fa-check-circle"></i>
                                        @else
                                            <i class="fas fa-times-circle"></i>
                                        @endif
                                    </td>
                                    <td>{{$producto['nutritional_score']}}</td>
                                    <td>
                                        <form action="/basket_update/{{$idCanasta}}" method="post" class="d-flex">
                                            @csrf
                                            <input type="number" name="cantidad_producto_canasta" value="{{$producto['cantidad']}}" class="form-control" style="width: 70px;">
                                            <input type="hidden" name="id_canasta_producto" value="{{$producto['id_canasta_producto']}}">
                                            <button type="submit" class="btn btn-primary ml-2">Actualizar</button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="/basket_update/{{$idCanasta}}" method="post" class="d-flex">
                                            @csrf
                                            <input type="hidden" name="cantidad_producto_canasta" value="0">
                                            <input type="hidden" name="id_canasta_producto" value="{{$producto['id_canasta_producto']}}">
                                            <button type="submit" class="btn btn-danger ml-2">Desechar</button>
                                        </form>
                                    </td>
                                </tr>
                                @foreach($producto['variable'] as $variable)
                                    <tr>
                                        <td colspan="7"></td>
                                        <td><strong>{{$variable['nombre']}}</strong></td>
                                        <td>{{$variable['cantidad']}}</td>
                                    </tr>
                                @endforeach
                                @for($h = 0; !empty($producto['variable'][$h]); $h++)
                                    @if($producto['variable'][$h]['max_variable'] == true AND $totalVariables[$h]['pase'] == false)
                                        <tr class="text-danger">
                                            <td colspan="7"></td>
                                            <td colspan="2">Sustituir por: {{$metasActuales[$h]['producto_sustituto']['nombre_producto']}}</td>
                                        </tr>
                                    @endif
                                @endfor
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="lead">No hay productos en la canasta.</p>
                @endif
				<div class="mt-3 text-right">
					<a href="#" class="btn btn-danger" onclick="confirmarEliminacion({{$idCanasta}})">Descartar Canasta <i class="fas fa-trash-alt"></i></a>
				</div>
	</div>
</div>


    </div>
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
    function confirmarEliminacion(idCanasta) {
        var confirmacion = confirm("¿Estás seguro que deseas eliminar la canasta?");
        
        if (confirmacion) {
            // Si el usuario hace clic en Aceptar en la ventana de confirmación,
            // redirige al usuario a la ruta de eliminación
            window.location.href = "/basket_delete/" + idCanasta;
        } 

        // Si el usuario hace clic en Cancelar en la ventana de confirmación,
        // evita que el enlace funcione
        return confirmacion;
    }
</script>

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


const fruit2 = [<?=$listaProductosFinal?>];

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




<!--<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Canasta</title>
</head>
<body>

{{$idCanasta}}



<form action="/basket/{{$idCanasta}}" method="post">
	@csrf  
	<div class="search-container">
		<input type="text" name="nombre_producto" id="fruit2" placeholder="Buscar Producto">
		<input type="hidden" id="id_canasta" name="id_canasta" value="{{$idCanasta}}">
		<div class="suggestions">
			<ul></ul>
		</div>
	</div>
	<div class="text-center"><button type="submit">Buscar</button></div>
</form>


@if ($listaBusquedaProducto != 0)
@for($i = 0; !empty($listaBusquedaProducto[$i]); $i++)

{{$listaBusquedaProducto[$i]['nombre_producto']}}<a> </a>{{$listaBusquedaProducto[$i]['peso']}}<a>gr </a>
<a href="/basket_add/{{$idCanasta}}/{{$listaBusquedaProducto[$i]['id_producto_paquete']}}">Añadir</a>
<br>

@endfor
@endif



@if(!empty($metasActuales[0]))
        Metas Actuales: 
        
        @for($i = 0; !empty($metasActuales[$i]); $i++)
        <br>
        {{$metasActuales[$i]['descripcion_meta']}}
        {{(((($metasActuales[$i]['cantidad_minima(gr)'] - $metasActuales[$i]['cantidad_maxima(gr)']) / 100 ) * $metasActuales[$i]['nivel_restriccion']) + $metasActuales[$i]['cantidad_maxima(gr)'] )}}
        por dia    
        @endfor
        @endif
        @if(empty($metasActuales[0]))
        No posees ninguna meta
@endif

<br>


Nombre - Peso(gr) - Tipo - ACe - AVgt - AVga - Score 
@if (!empty($productosActuales[0]))
@for($h = 0; !empty($productosActuales[0]['variable'][$h]); $h++)	
- {{$productosActuales[0]['variable'][$h]['nombre']}}
@endfor
@endif
- Cantidad

@if (!empty($productosActuales[0]))
	@for($i = 0; !empty($productosActuales[$i]); $i++)
	<br>
	{{$productosActuales[$i]['nombre_producto']}} - {{$productosActuales[$i]['peso']}} - {{$productosActuales[$i]['tipo_producto']}} - {{$productosActuales[$i]['apto_celiaco']}} - {{$productosActuales[$i]['apto_vegetariano']}} - {{$productosActuales[$i]['apto_vegano']}} - {{$productosActuales[$i]['nutritional_score']}}
		@for($h = 0; !empty($productosActuales[$i]['variable'][$h]); $h++)	
		 - {{$productosActuales[$i]['variable'][$h]['cantidad']}}
		@endfor
	<form action="/basket_update/{{$idCanasta}}" method="post" style='display: inline;'> @csrf 
	<input type="number" name="cantidad_producto_canasta" value="{{$productosActuales[$i]['cantidad']}}">
	<input type="hidden" name="id_canasta_producto" value="{{$productosActuales[$i]['id_canasta_producto']}}">
	<button type="submit">Actualizar</button></form>
	<form action="/basket_update/{{$idCanasta}}" method="post" style='display: inline;'> @csrf 
	<input type="hidden" name="cantidad_producto_canasta" value="0">
	<input type="hidden" name="id_canasta_producto" value="{{$productosActuales[$i]['id_canasta_producto']}}">
	<button type="submit">Desechar</button></form>
	</form>
	@for($h = 0; !empty($productosActuales[$i]['variable'][$h]); $h++)
	@if($productosActuales[$i]['variable'][$h]['max_variable'] == true AND $totalVariables[$h]['pase'] == false)
	Sustituya por: {{$metasActuales[$h]['producto_sustituto']['nombre_producto']}} /
	@endif
	@endfor
	@endfor
@endif


@for($i=0; !empty($totalVariables[$i]); $i++)
<br>
Meta de {{$totalVariables[$i]['nombre']}}: {{$totalVariables[$i]['meta']}} / 
Valores Totales de {{$totalVariables[$i]['nombre']}}: {{$totalVariables[$i]['cantidad']}} / 
 @if($totalVariables[$i]['pase'] === true)
 Meta cumplida por: {{abs($totalVariables[$i]['total'])}}
 @endif
 @if ($totalVariables[$i]['pase'] === false)
 Meta no cumplida por: {{abs($totalVariables[$i]['total'])}} 
 @endif
 
@endfor

<br>
<a href="/basket_delete/{{$idCanasta}}">Descartar</a>
<a href="/index">Atras</a>

<?php 




?>


<script>
const input = document.querySelector('#fruit2');
const suggestions = document.querySelector('.suggestions ul');

const fruit2 = [<?=$listaProductos?>];

function search(str) {
	let results = [];
	const val = str.toLowerCase();

	for (i = 0; i < fruit2.length; i++) {
		if (fruit2[i].toLowerCase().indexOf(val) > -1) {
			results.push(fruit2[i]);
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

</body>
</html>
