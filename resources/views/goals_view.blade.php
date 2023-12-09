<!DOCTYPE html>
<html>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.2.2/Chart.min.js"></script>

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Metas</title>		        
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
		    <link rel="stylesheet" href="{{ asset('css/app.css') }}"/>
       <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
  </head>

  
    <body class="sb-nav-fixed">
    <style>
    .slidecontainer {
        width: 70%; /* Adjusted width for better visibility */
        margin: 0 auto; /* Center the slider container */
    }

    .form-label {
        font-weight: bold; /* Make labels bold for better readability */
    }

    .form-select, .slider {
        width: 100%; /* Full width for form elements */
    }

    .slider {
        height: 25px;
        background: #d3d3d3;
        outline: none;
        opacity: 0.7;
        -webkit-transition: .2s;
        transition: opacity .2s;
    }

    .slider:hover {
        opacity: 1;
    }

    .slider::-webkit-slider-thumb, .slider::-moz-range-thumb {
        width: 25px;
        height: 25px;
        background: #2ecc71; /* Green background for better visibility */
        border: none;
        border-radius: 50%; /* Rounded slider handle */
        cursor: pointer;
    }
</style>
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
  <div class="row">
    <div class="col-md-8 offset-md-2">
      <h1 class="display-4 text-center my-5">Metas Nutricionales</h1>
      <div class="text-center mb-5">
		  <p class="lead">Edite las metas nutricionales que desea alcanzar</p>
      </div>
    </div>
  </div>
</div>    
<div class="row">
<div class="col-md-7 text-center">
    <form action="/goals" method="post">
        @csrf
        <div class="mb-3 text-center">          
    <h4 class="mb-4">Establecer Meta:</h4>
    <label for="nombreMeta" class="form-label">Seleccione una meta:</label>
    <select class="form-select mx-auto" name="nombreMeta" id="nombreMeta" style="width: 50%;" onchange="actualizarVariable()">
        <option value="" disabled selected>Seleccionar una opción</option>
        @for ($i = 0; $i < $totalMetas; $i++)
            <option value="{{$listaMetas[$i]}}">{{$listaMetas[$i]}}</option>
        @endfor
    </select>
</div>
            <div class="mb-3">
                <label for="rangoMeta" class="form-label">Seleccione un rango:</label>
                <div class="slidecontainer">
                    <input type="range" min="1" max="100" value="50" class="slider" name="rangoMeta" id="rangoMeta">
                    <span id="sliderValue"></span>
                </div>
            </div>

        <div class="text-center">
          <button type="submit" class="btn btn-primary px-4">Añadir Meta</button>
        </div>
    </form>
</div>

    <div class="col-md-4 text-center ">
    @if(!empty($metasActuales[0]))
        <h4 class="mb-4">Metas Actuales:</h4>
        @for($i = 0; !empty($metasActuales[$i]); $i++)
            <div class="card mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title">{{$metasActuales[$i]['descripcion_meta']}}</h5>
                            <p class="card-text">
                                {{
                                    (((($metasActuales[$i]['cantidad_minima(gr)'] - $metasActuales[$i]['cantidad_maxima(gr)']) / 100 ) * $metasActuales[$i]['nivel_restriccion']) + $metasActuales[$i]['cantidad_maxima(gr)'])
                                }}
                                por día
                            </p>
                        </div>
                    <div class="col">
                    <a href="/goals/{{$metasActuales[$i]['id_meta_usuario']}}" class="btn btn-danger">Descartar <i class="fas fa-trash-alt"></i></a>
                    </div>
                </div>
            </div> 
    </div>
    @endfor
        @else    
            <div class="col">
                <p class="lead">No posees ninguna meta</p>
                <a href="/goals" class="btn btn-primary">Actualizar <i class="fas fa-bullseye"></i></a>
            </div>
        @endif

</div>


</div>
        @if ($alert==1)       
          <div class="alert alert-primary" role="alert">
          Meta Inválida 
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
        
        <script>
    function actualizarVariable() {
        // Obtener el valor seleccionado en la lista desplegable
        var selectedValue = document.getElementById("nombreMeta").value;

        var metaArray = @json($listaCompletaMetas);

        var selectedEntry = metaArray.find(function(meta) {
            return meta.descripcion_meta === selectedValue;
        });

        var cantidadMaxima = selectedEntry['cantidad_maxima(gr)'];
        var cantidadMinima = selectedEntry['cantidad_minima(gr)'];
        var masMenos = selectedEntry['mas_menos'];

        var slider = document.getElementById("rangoMeta");
        var sliderValue = document.getElementById("sliderValue");
        
        // Initial value
        sliderValue.textContent = Math.round(((((cantidadMinima - cantidadMaxima ) / 100) * slider.value) + cantidadMaxima)) + " por dia";

        // Event listener for input changes
        slider.addEventListener("input", function() {
            sliderValue.textContent = Math.round(((((cantidadMinima - cantidadMaxima ) / 100) * this.value) + cantidadMaxima)) + " por dia";

            // You can use this.value for real-time updates
            // For example, update some other elements or variables
            // based on the current slider value
        });

        // Actualizar la variable según el valor seleccionado
        // Aquí puedes realizar las operaciones necesarias
        // Por ejemplo, puedes asignar el valor a una variable JavaScript
        // o realizar una llamada AJAX al servidor para obtener datos actualizados
        console.log("Valor seleccionado: " + selectedValue + metaArray + selectedEntry['cantidad_maxima(gr)']);

        // Si deseas enviar el valor al servidor, puedes hacerlo mediante AJAX
        // Aquí un ejemplo básico usando jQuery
        $.ajax({
            type: "POST",
            url: "/actualizarVariable", // Tu ruta de actualización en el servidor
            data: { selectedValue: selectedValue },
            success: function(response) {
                console.log("Variable actualizada en el servidor");
            },
            error: function(error) {
                console.error("Error al actualizar la variable en el servidor");
            }
        });
    }
</script>

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


