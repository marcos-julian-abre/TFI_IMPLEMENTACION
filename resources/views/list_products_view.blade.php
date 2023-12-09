


<!DOCTYPE html>
<html>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>

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
       <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.6/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.6/js/jquery.dataTables.js"></script>
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
            <div class="row mt-10">
    <div class="col-md-6">
        <div class="pl-5">
            <h1 class="display-4 my-5">Lista de Productos</h1>
        </div>
    </div>   
</div>
<div class="row mt-10">   
    <div class="col-md-14">    
        <table class="table" id="tabla">
            <colgroup>
                <col style="width: 10%;">
                <col style="width: 20%;">
                <col style="width: 15%;">
                <col style="width: 10%;">
                <col style="width: 10%;">
                <col style="width: 10%;">
                <col style="width: 10%;">   
                <col style="width: 5%;">
            </colgroup>
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Vegetariano</th>
                    <th scope="col">Vegano</th>
                    <th scope="col">Celiaco</th>
                    <th scope="col">Score</th>      
                    <th scope="col">Perfil</th>                    
                </tr>
            </thead>
<tbody>
    <?php
    $conteoPagos = 0;
    while (!empty($productosLista[$conteoPagos])) {
        $miNumero = $productosLista[$conteoPagos]['nombre_producto'];
        ?>
        <tr>
            <td><?php echo $productosLista[$conteoPagos]['id_producto']; ?></td>
            <td><?php echo $productosLista[$conteoPagos]['nombre_producto']; ?></td>
            <td><?php echo $productosLista[$conteoPagos]['tipo_producto']; ?></td>
            <td> 
                @if($productosLista[$conteoPagos]["apto_vegetariano"] == "1")
                <p><?php echo $productosLista[$conteoPagos]["apto_vegetariano"]; ?> - Apto: <i class="fas fa-check-circle"></i></p> 
                @else
                <p><?php echo $productosLista[$conteoPagos]["apto_vegetariano"]; ?> - Apto: <i class="fas fa-times-circle"></i></p>
            @endif      
            </td>       
            <td> @if($productosLista[$conteoPagos]["apto_vegano"] == "1")
                <p><?php echo $productosLista[$conteoPagos]["apto_vegano"]; ?> - Apto: <i class="fas fa-check-circle"></i></p> 
                @else
                <p><?php echo $productosLista[$conteoPagos]["apto_vegano"]; ?> - Apto: <i class="fas fa-times-circle"></i></p>
            @endif      
            </td> 
            <td> @if($productosLista[$conteoPagos]["apto_celiaco"] == "1")
                <p><?php echo $productosLista[$conteoPagos]["apto_celiaco"]; ?> - Apto: <i class="fas fa-check-circle"></i></p> 
                @else
                <p><?php echo $productosLista[$conteoPagos]["apto_celiaco"]; ?> - Apto: <i class="fas fa-times-circle"></i></p>
            @endif      
            </td> 
            <td><?php echo $productosLista[$conteoPagos]["nutritional_score"]; ?></td>            
            <td>
                <form action="/product_profile" method="get" id="search-form">
                    <input type="hidden" name="nombre_producto" value="<?php echo $miNumero; ?>">
                    <button type="submit">Perfil</button>
                </form>
            </td>
        </tr>
        <?php
        $conteoPagos = $conteoPagos + 1;
    }
    ?>
</tbody>
        </table>
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
  const rowsPerPage = 25;

  const table = document.querySelector('.table');

  // Get all the rows in the table, excluding the table header
  const rows = Array.from(table.querySelectorAll('tbody tr'));

  // Calculate the total number of pages
  const totalPages = Math.ceil(rows.length / rowsPerPage);

  // Function to display the rows for the specified page
  function showPage(page) {
    // Calculate the start and end indices of the rows to be displayed
    const startIndex = (page - 1) * rowsPerPage;
    const endIndex = startIndex + rowsPerPage;

    // Hide all rows
    rows.forEach(row => {
      row.style.display = 'none';
    });

    // Show the rows for the current page
    for (let i = startIndex; i < endIndex; i++) {
      if (rows[i]) {
        rows[i].style.display = 'table-row';
      }
    }
  }

  // Function to update the pagination buttons
  function updatePaginationButtons(currentPage) {
    // Get the pagination container
    const paginationContainer = document.querySelector('.pagination');

    // Clear the existing pagination buttons
    paginationContainer.innerHTML = '';

    // Create the previous button
    const prevButton = document.createElement('button');
    prevButton.textContent = 'Previous';
    prevButton.classList.add('btn', 'btn-primary', 'me-2');
    prevButton.disabled = currentPage === 1;
    prevButton.addEventListener('click', () => {
      showPage(currentPage - 1);
      updatePaginationButtons(currentPage - 1);
    });
    paginationContainer.appendChild(prevButton);

    // Create the next button
    const nextButton = document.createElement('button');
    nextButton.textContent = 'Next';
    nextButton.classList.add('btn', 'btn-primary');
    nextButton.disabled = currentPage === totalPages;
    nextButton.addEventListener('click', () => {
      showPage(currentPage + 1);
      updatePaginationButtons(currentPage + 1);
    });
    paginationContainer.appendChild(nextButton);
  }

  // Show the first page initially
  showPage(1);
  updatePaginationButtons(1);
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

<script>
    $(document).ready( function () {
        $('#tabla').DataTable();
    });
</script>
</html>

