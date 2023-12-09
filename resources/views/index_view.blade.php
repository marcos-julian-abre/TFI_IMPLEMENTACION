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
<!--<div class="container-fluid px-4">
  <div class="row">
    <div class="col-md-8 offset-md-2">
      <h1 class="display-4 text-center my-5">Nutra</h1>
      <div class="text-center mb-5">
		  <p class="lead">Bienvenido {{$nombreUsuario}}, disfruta de nuestras funcionalidades!</p>
      </div>
    </div>
  </div>
</div> -->
    <header class="py-5">
        <div class="container px-lg-5">
            <div class="p-4 p-lg-5 bg-success rounded-3 text-center">
                <div class="m-4 m-lg-5">
                    <h1 class="display-5 fw-bold text-light">Bienvenido {{$nombreUsuario}}!</h1>
                    <p class="fs-4 text-light">¿Estas listo para mejorar tu salud? Descubre Nutra a traves de nuestras funcionalidades!</p>
                </div>
            </div>
        </div>
    </header>
  </div><!--
  <div class="d-flex flex-row justify-content-around">        
        <div class="col-md-1 pl-10">
          <a href="/goals" class="card" >
            <div class="icon"><i class="fas fa-bullseye"></i></div>
            <div class="text">Establecer Metas</div>
          </a>
        </div>        
        <div class="col-md-1">
          <a href="/basket_form" class="card h-100">
            <div class="icon"><i class="fas fa-shopping-basket"></i></div>
              <div class="text">Nueva Canasta</div>
          </a>
        </div>        
        <div class="col-md-1">
          <a href="/functionality3" class="card h-100">
            <div class="icon"><i class="fas fa-icon3"></i></div>
            <div class="text">Functionality 3</div>
          </a>
        </div>        
        <div class="col-md-1">
          <a href="/functionality4" class="card h-100">
            <div class="icon"><i class="fas fa-icon4"></i></div>
            <div class="text">Functionality 4</div>
          </a>
        </div>
      </div>-->
      <section class="pt-4">
            <div class="container px-lg-5">
                <!-- Page Features-->
                <div class="row gx-lg-5">
                    <a class="col-lg-6 col-xxl-4 mb-5" href="/basket_form">
                        <div class="card bg-dark border-0 h-100">
                            <div class="card-body text-center p-4 p-lg-5 pt-0 pt-lg-0">
                                <div class="feature bg-success bg-gradient text-white rounded-3 mb-4 mt-n4"><i class="fas fa-shopping-basket"></i></div>
                                <h2 class="fs-4 fw-bold text-light">Nueva Canasta</h2>
                                <p class="mb-0 text-light">Rastrea las variables nutricionales de tu compra.</p>
                            </div>
                        </div>
                    </a>
                    <a class="col-lg-6 col-xxl-4 mb-5" href="/goals">
                        <div class="card bg-dark border-0 h-100">
                            <div class="card-body text-center p-4 p-lg-5 pt-0 pt-lg-0">
                                <div class="feature bg-success bg-gradient text-white rounded-3 mb-4 mt-n4"><i class="fas fa-bullseye"></i></div>
                                <h2 class="fs-4 fw-bold text-light">Establecer Metas</h2>
                                <p class="mb-0 text-light">Selecciona que variables nutricionales te interesa rastrear y establece tus metas.</p>
                            </div>
                        </div>
                    </a>
                    <a class="col-lg-6 col-xxl-4 mb-5" href="/product_list">
                        <div class="card bg-dark border-0 h-100">
                            <div class="card-body text-center p-4 p-lg-5 pt-0 pt-lg-0">
                                <div class="feature bg-success bg-gradient text-white rounded-3 mb-4 mt-n4"><i class="fa-solid fa-rectangle-list"></i></div>
                                <h2 class="fs-4 fw-bold text-light">Lista de Productos</h2>
                                <p class="mb-0 text-light">Encuentra informacion sobre los productos en nuestra base de datos.</p>
                            </div>
                        </div>
                    </a>
                    <a class="col-lg-6 col-xxl-4 mb-5" href="/smart_basket_form">
                        <div class="card bg-dark border-0 h-100">
                            <div class="card-body text-center p-4 p-lg-5 pt-0 pt-lg-0">
                                <div class="feature bg-success bg-gradient text-white rounded-3 mb-4 mt-n4"><i class="fa-solid fa-brain"></i></div>
                                <h2 class="fs-4 fw-bold text-light">Canasta Inteligente</h2>
                                <p class="mb-0 text-light">Genera una canasta automaticamente en funcion de tus metas.</p>
                            </div>
                        </div>
                    </a>
                    <a class="col-lg-6 col-xxl-4 mb-5" href="/mentor_view">
                        <div class="card bg-dark border-0 h-100">
                            <div class="card-body text-center p-4 p-lg-5 pt-0 pt-lg-0">
                                <div class="feature bg-success bg-gradient text-white rounded-3 mb-4 mt-n4"><i class="fa-solid fa-users"></i></div>
                                <h2 class="fs-4 fw-bold text-light">Mentores</h2>
                                <p class="mb-0 text-light">Descubre los productos recomendados por los usuarios mas influyentes.</p>
                            </div>
                        </div>
                    </a>
                    <div class="col-lg-6 col-xxl-4 mb-5">
                        <div class="card bg-dark border-0 h-100">
                            <div class="card-body text-center p-4 p-lg-5 pt-0 pt-lg-0">
                                <div class="feature bg-success bg-gradient text-white rounded-3 mb-4 mt-n4"><i class="fas fa-icon3"></i></div>
                                <h2 class="fs-4 fw-bold text-light">Funcionalidad 6</h2>
                                <p class="mb-0 text-light">Proximamente.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>     


   

    @if ($alertaIndex == 2) 
    <div class="alert alert-success" role="alert">
    Usuario Modificado Con Exito  
    </div>
    @endif


    @if ($alertaIndex == 1) 
    <div class="alert alert-success" role="alert">
    Usuario Cargado Con Exito  
    </div>
    @endif


      <?php $random1a = rand(1,8);?>
      <?php $random1b = $random1a; 
      while($random1b === $random1a){$random1b = rand(1,8);}      
      ?>
      <?php $random2a = rand(1,8);?>
      <?php $random2b = $random2a; 
      while($random2b === $random2a){$random2b = rand(1,8);}      
      ?>
    <div class="row">
        <div class ="col">        
        <canvas id="myScatterChart"></canvas>
        </div>
        <div class ="col"> 
          <canvas id="myScatterChart2"></canvas> 
        </div>
    </div>
    <div class="row">
    <div class="col text-center">
        <a>Eje X - {{$miProductView[4][1][$random1a]['descripcion_variable_nutricional']}}/ Eje Y - {{$miProductView[4][1][$random1b]['descripcion_variable_nutricional']}}</a>
    </div>
    <div class="col text-center">
        <a>Eje X - {{$miProductView[5][1][$random2a]['descripcion_variable_nutricional']}}/ Eje Y - {{$miProductView[5][1][$random2b]['descripcion_variable_nutricional']}}</a>
    </div>
    </div>
    <br>

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
      var random1a = <?php echo json_encode($random1a); ?>;
      var random1b = <?php echo json_encode($random1b); ?>;
      var label1 = <?php echo json_encode($miProductView[4][1][$random1a]['nombre_producto']); ?>;
      var dato1a = <?php echo json_encode($miProductView[4][1][$random1a]['cantidad_cien_gr']); ?>;
      var dato1b = <?php echo json_encode($miProductView[4][1][$random1b]['cantidad_cien_gr']); ?>;
      var label2 = <?php echo json_encode($miProductView[4][2][$random1a]['nombre_producto']); ?>;
      var dato2a = <?php echo json_encode($miProductView[4][2][$random1a]['cantidad_cien_gr']); ?>;
      var dato2b = <?php echo json_encode($miProductView[4][2][$random1b]['cantidad_cien_gr']); ?>;
      var label3 = <?php echo json_encode($miProductView[4][3][$random1a]['nombre_producto']); ?>;
      var dato3a = <?php echo json_encode($miProductView[4][3][$random1a]['cantidad_cien_gr']); ?>;
      var dato3b = <?php echo json_encode($miProductView[4][3][$random1b]['cantidad_cien_gr']); ?>;
      var datoanombre = <?php echo json_encode($miProductView[4][1][$random1a]['descripcion_variable_nutricional']); ?>;
      var datobnombre = <?php echo json_encode($miProductView[4][1][$random1b]['descripcion_variable_nutricional']); ?>;     



        // Obtener el contexto del canvas
        var ctx = document.getElementById('myScatterChart').getContext('2d');

        // Configuración del gráfico
        const data = {
            datasets: [{
                label: label1,
                data: [{
                    x: dato1a,
                    y: dato1b
                }],
                backgroundColor: 'rgb(255, 99, 132)',
                pointRadius: 8
            },{
                label: label2,
                data: [{
                    x: dato2a,
                    y: dato2b
                }],
                backgroundColor: 'rgb(255, 47, 0)',
                pointRadius: 8
            },
            {
                label: label3,
                data: [{
                    x: dato3a,
                    y: dato3b
                }],
                backgroundColor: 'rgb(0, 99, 132)',
                pointRadius: 8
            },
          ],
        };

        const config = {
            type: 'scatter',
            data: data,
            options: {
                scales: {
                    x: {
                        type: 'linear',
                        position: 'bottom'
                        
                      }
                }
            }
        };
        // Crear el gráfico
        var myScatterChart = new Chart(ctx, config);
    </script>

<script>
        var random2a = <?php echo json_encode($random1a); ?>;
      var random2b = <?php echo json_encode($random1b); ?>;
      var label4 = <?php echo json_encode($miProductView[5][1][$random2a]['nombre_producto']); ?>;
      var dato4a = <?php echo json_encode($miProductView[5][1][$random2a]['cantidad_cien_gr']); ?>;
      var dato4b = <?php echo json_encode($miProductView[5][1][$random2b]['cantidad_cien_gr']); ?>;
      var label5 = <?php echo json_encode($miProductView[5][2][$random2a]['nombre_producto']); ?>;
      var dato5a = <?php echo json_encode($miProductView[5][2][$random2a]['cantidad_cien_gr']); ?>;
      var dato5b = <?php echo json_encode($miProductView[5][2][$random2b]['cantidad_cien_gr']); ?>;
      var label6 = <?php echo json_encode($miProductView[5][3][$random2a]['nombre_producto']); ?>;
      var dato6a = <?php echo json_encode($miProductView[5][3][$random2a]['cantidad_cien_gr']); ?>;
      var dato6b = <?php echo json_encode($miProductView[5][3][$random2b]['cantidad_cien_gr']); ?>;
      var datoanombre2 = <?php echo json_encode($miProductView[5][1][$random2a]['descripcion_variable_nutricional']); ?>;
      var datobnombre2 = <?php echo json_encode($miProductView[5][1][$random2b]['descripcion_variable_nutricional']); ?>; 
        // Obtener el contexto del canvas
        var ctx2 = document.getElementById('myScatterChart2').getContext('2d');

        // Configuración del gráfico
        const data2 = {
            datasets: [{
                label: label4,
                data: [{
                    x: dato4a,
                    y: dato4b
                }],
                backgroundColor: 'rgb(255, 99, 132)',
                pointRadius: 8
            },{
                label: label5,
                data: [{
                    x: dato5a,
                    y: dato5b
                }],
                backgroundColor: 'rgb(255, 47, 0)',
                pointRadius: 8
            },
            {
                label: label6,
                data: [{
                    x: dato6a,
                    y: dato6b
                }],
                backgroundColor: 'rgb(0, 99, 132)',
                pointRadius: 8
            },
          ],
        };


        const config2 = {
            type: 'scatter',
            data: data2,
            options: {
                scales: {
                    x: {
                        type: 'linear',
                        position: 'bottom'
                    }
                }
            }
        };
        // Crear el gráfico
        var myScatterChart2 = new Chart(ctx2, config2);
    </script>

</html>

