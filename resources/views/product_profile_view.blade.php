<!DOCTYPE html>
<html lang="en">  
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
  
    <style>
        /* Custom CSS for the nutritional score container */
        .nutritional-score-container {
            background-color: #A8D9A7; /* Light green background color */
            border-radius: 10px; /* Curved border */
            padding: 10px;
            text-align: center;
            color: white; /* White text */
            height: 3%;
        }

        
        .nutritional-score-container2 {
            background-color: #A8D9A7; /* Light green background color */
            border-radius: 10px; /* Curved border */
            padding: 10px;
            text-align: center;
            color: white; /* White text */
            width: 50%;
        }
    </style>
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
  <div class="container-fluid px-4">
  <div class="container">
    @if($alertaBusquedaProducto == 0)
    <div class="row">
        <div class="col">
            <h1>{{$datosProducto[0]['nombre_producto']}}</h1> <!-- Display as a title -->
        </div>
    </div>
    <div class="row">
        <div class="col">
            <img src="{{ asset('img/products/' . $datosProducto[0]['id_producto'] .  '.png') }}" alt="Product Image" class="img-fluid" style="max-width: 300px;"> <!-- Fixed image size -->
        </div>        
        <div class="col">
        <div class="row h-50 nutritional-score-container">
            <p style="font-size: 42px;">{{$datosProducto[0]['nutritional_score']}}</p>
            <p style="font-size: 12px;">Nutritional Score</p>
        </div>
        <div class="row mt-4">
            <div class="col-md-6 mb-2">
                <form action="/product_suggestion" method="get" id="upvote-form">
                    <input type="hidden" name="nombre_producto" value="<?php echo $datosProducto[0]['nombre_producto'] ?>">
                    <input type="hidden" name="recomendacion_producto" value="2">
                    <input type="hidden" name="id_producto" value="<?php echo $datosProducto[0]['id_producto'] ?>">
                    @if($recomendacionProducto[0]['valor_recomendacion'] == 2)
                    <button type="submit" class="btn btn-success w-100">                        
                        <i class="fas fa-thumbs-up"></i> Up
                    </button>
                    @else 
                    <button type="submit" class="btn btn-outline-secondary w-100">                        
                        <i class="fas fa-thumbs-up"></i> Up
                    </button>
                    @endif
                </form>
            </div>
            <div class="col-md-6 mb-2">
                <form action="/product_suggestion" method="get" id="downvote-form">
                    <input type="hidden" name="nombre_producto" value="<?php echo $datosProducto[0]['nombre_producto'] ?>">
                    <input type="hidden" name="recomendacion_producto" value="1">
                    <input type="hidden" name="id_producto" value="<?php echo $datosProducto[0]['id_producto'] ?>">
                    @if($recomendacionProducto[0]['valor_recomendacion'] == 1)
                    <button type="submit" class="btn btn-danger w-100">
                        <i class="fas fa-thumbs-down"></i> Down
                    </button>
                    @else
                    <button type="submit" class="btn btn-outline-secondary w-100">
                        <i class="fas fa-thumbs-down"></i> Down
                    </button>
                    @endif
                </form>
            </div>
        </div>
        <div class="row mt-1">
            <div class="col">
                <div class="card text-center">
                    <div class="card-body"> 
                        @php
                            $resultado = round(100 * ($ratingProducto[0]['votos'] / ($ratingProducto[1]['votos'] + $ratingProducto[0]['votos'])));
                        @endphp
                        <h5 class="card-title">Porcentaje de Votos: {{ $resultado }}%</h5>
                    </div>
                </div>
            </div>
        </div>

        </div>        
        <div class="col">
            <p>ID: {{$datosProducto[0]['id_producto']}}</p>
            <p>Tipo: {{$datosProducto[0]['tipo_producto']}}</p>
            @if($datosProducto[0]['apto_vegetariano'] == "1")
                <p>Apto Vegetariano: <i class="fas fa-check-circle"></i></p> <!-- Assuming you have a checkmark icon for 'apto_vegano' -->
                @else
                <p>Apto Vegetariano: <i class="fas fa-times-circle"></i></p>
            @endif
            @if($datosProducto[0]['apto_vegano'] == "1")
                <p>Apto Vegano: <i class="fas fa-check-circle"></i></p> <!-- Assuming you have a checkmark icon for 'apto_vegetariano' -->
                @else 
                <p>Apto Vegano: <i class="fas fa-times-circle"></i></p> <!-- Assuming you have a checkmark icon for 'apto_vegetariano' -->
            @endif
            @if($datosProducto[0]['apto_celiaco'] == "1")
            <p>Apto Celiaco: <i class="fas fa-check-circle"></i></p> <!-- Assuming you have a checkmark icon for 'apto_celiaco' -->
                @else 
                <p>Apto Celiaco: <i class="fas fa-times-circle"></i></p> <!-- Assuming you have a checkmark icon for 'apto_celiaco' -->
            @endif
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-8">
            <div class="row">
                <div class="col-md-6">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Ingredientes</th>
                                <th>Cantidad x 100gr</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for($i = 0; !empty($ingredientesProducto[$i]); $i++)
                                <tr>
                                    <td>{{$ingredientesProducto[$i]['nombre_ingrediente']}}</td>
                                    <td>{{$ingredientesProducto[$i]['cantidad(gr)']}}</td>                                
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Variable</th>
                                <th>Cantidad x 100gr</th>
                                <th>Referencia</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for($i = 0; !empty($datosProducto[$i]['id_variable_nutricional']); $i++)
                                @for($j = 0; !empty($variablesMetasUsuario[$j]['id_variable_nutricional']); $j++)
                                @if($datosProducto[$i]['id_variable_nutricional'] == $variablesMetasUsuario[$j]['id_variable_nutricional'])
                                <tr>
                                    <td>{{$datosProducto[$i]['descripcion_variable_nutricional']}}</td>
                                    <td>{{$datosProducto[$i]['cantidad_cien_gr']}}</td>
                                    @for($h = 0; !empty($datosVariables[$h]['descripcion_variable_nutricional']); $h++)
                                    @if($datosVariables[$h]['descripcion_variable_nutricional'] == $datosProducto[$i]['descripcion_variable_nutricional'])
                                    <td>{{$datosVariables[$h]['promedio']}}</td>
                                    @endif
                                    @endfor
                                </tr>           
                                @endif
                                @endfor
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-12">
                @for($i = 0; !empty($ingredientesProducto[$i]); $i++)
                    @if($ingredientesProducto[$i]['potencial_negativo'] >= 1)
                        <div class="row justify-content-center">
                            <div class="col">
                                <div class="d-flex align-items-center">
                                    <img src="{{ asset('img/icons/warning_' . $ingredientesProducto[$i]['potencial_negativo'] .  '.png') }}" alt="Warning Icon" style="max-width: 55px;">
                                    <span>{{$ingredientesProducto[$i]['nombre_ingrediente']}} - {{$ingredientesProducto[$i]['adventercia']}}</span>
                                </div>
                            </div>
                        </div>
                    @endif   
                    @if($ingredientesProducto[$i]['potencial_alergeno'] == 1)
                        <div class="row justify-content-center">
                            <div class="col">
                                <div class="d-flex align-items-center">
                                    <img src="{{ asset('img/icons/warning_' . $ingredientesProducto[$i]['potencial_alergeno'] .  '.png') }}" alt="Warning Icon" style="max-width: 55px;">
                                    <span>{{$ingredientesProducto[$i]['nombre_ingrediente']}} - Este producto es un alergeno común.</span>     
                                </div>
                            </div>
                        </div>
                    @endif
                @endfor
            </div>
        </div>
        <div class="col">
            <div class="row">
            <a>Productos Similares</a>
            </div>
            @for($i = 0; $i <= 2; $i++)
            @if(isset($productosAlternativos[$i]))
            <div class="row">
                <div class="row">
                    <a href="/product_profile?nombre_producto={{ $productosAlternativos[$i]['nombre_producto'] }}">
                    {{ $productosAlternativos[$i]['nombre_producto'] }}
                    </a>
                </div>  
                <div class="row">
                    <div class="col">
                    <a href="/product_profile?nombre_producto={{ $productosAlternativos[$i]['nombre_producto'] }}">
                        <img src="{{ asset('img/products/' . $productosAlternativos[$i]['id_producto'] .  '.png') }}" style="max-width: 125px;">
                    </a>
                    </div>
                        <div class="col-10 nutritional-score-container2">
                            <p style="font-size: 30px;">{{$productosAlternativos[$i]['nutritional_score']}}</p>
                            <p style="font-size: 12px;">Nutritional Score</p>
                        </div>
                </div>
            </div>
            @endif
            @endfor
        </div> 
    </div> 
    @endif
</div>


@if ($alertaBusquedaProducto == 1) 
    <div class="alert alert-primary" role="alert">
    No se ha encontrado el producto seleccionado
    </div>
    
<a href="/index">Atras</a>
@endif




</main>
                
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



</html>