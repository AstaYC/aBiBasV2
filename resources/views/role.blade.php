<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>AbiBas</title>
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">

</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">ABiBas</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
          
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                  <a class="nav-link" href="/ajouter">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Dropdown
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Something else here</a>
                  </div>
                </li>
                <li class="nav-item">
                  <a class="nav-link disabled" href="#">Disabled</a>
                </li>
              </ul>
              <form class="d-flex my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
              </form>
            </div>
          </nav>
    </header>
    <main>
      @if(session('status'))
          <div class="alert alert-success">
               {{session('status')}}
          </div>
      @endif
      <ul>

        @foreach ($errors->all() as $errors)
            <li class="alert alert-danger"> {{$errors}}</li>
        @endforeach
      </ul>

      <br><br>
			<div class="container-xl">
        <div class="col-sm-5">
          <h2>Role <b>Management</b></h2>
        </div>
        <div class="col-sm-7">
          <a href="" class="btn btn-primary" data-toggle="modal" data-target="#addCategorieModal"><i class="material-icons">&#xE147;</i> <span>Add New Role</span></a>
          <br><br>				
        </div>
        {{-- add modal --}}
        <div class="modal" id="addCategorieModal">
          <div class="modal-dialog">
            <div class="modal-content">
              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title text-primary">Add New Role</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <div class="modal-body">
                <form method="POST" action="/categorie/add">
                  @csrf
                  <div class="form-group">
                    <label for="CategorieName">Role Name:</label>
                    <input type="text" class="form-control" id="CategorieName" placeholder="CategorieName" name="nom" required>
                  </div>
                  
                  <div class="form-group">
                    <label>Le(s) Route(s):</label>
                    @for($routes as $route)
                    <div class="form-check">
                      <input type="checkbox" class="form-check-input" id="route{{$route['id']}}" name="id" value="{{$route['id']}}">
                      <label class="form-check-label" for="route{{$route['id']}}">{{$route['nom']}}</label>
                    </div>
                    @endforeach
                   
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="add" class="btn btn-primary">Add Role</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>

      <table class="table table-striped table-hover" id="myTable">
        <thead>
          <tr>
            <th>Le Role</th>										
            <th>Action</th>
          </tr>
        </thead>
        <tbody>	
          @foreach($roles as $role)
          <tr>
            <td>{{$role->nom}}</td>
            <td>
                <a href="#" class="settings" title="Settings" data-toggle="modal" data-target="#updateCategoryModal{{$role->id}}">
                  <i class="material-icons">&#xE8B8;</i>
                </a>
                <a href="#" class="delete" title="Delete" data-toggle="modal" data-target="#deleteCategoryModal{{$role->id}}">
                  <i class="material-icons">&#xE5C9;</i>
                </a>
              </td>
          </tr>   
 

          {{-- update model --}}
          <div class="modal" id="updateCategoryModal{{$role->id}}">
            <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Update role "{{$role->nom}}"</h4>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                      <form method="POST" action="/role/update">
                        @csrf
                        <input type="hidden" name="id" value="{{$role->id}}">

                        <div class="form-group">
                          <label for="updateMedicineName">Role Name:</label>
                          <input type="text" class="form-control" id="updateCategoryName" name="nom" value="{{$role->nom}}" required>
                        </div>
                        
                        <label>Le(s) Route(s):</label>
                        @for($routes as $route)
                        <div class="form-check">
                          <input type="checkbox" class="form-check-input" id="route{{$route['id']}}" name="id" value="{{$route['id']}}">
                          <label class="form-check-label" for="route{{$route['id']}}">{{$route['nom']}}</label>
                        </div>
                        @endforeach
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary">Update Categorie</button>
                        </div>
                      </form>
                    </div>
                  </div>
            </div>
          </div>
          
          {{--  delete model --}}
         <div class="modal" id="deleteCategoryModal{{$role->id}}">										
           <div class="modal-dialog">
						  <div class="modal-content">
						  	<!-- Modal Header -->
						  	<div class="modal-header">
						  		<h4 class="modal-title">Delete Role "{{$role->nom}}"</h4>
						  		<button type="button" class="close" data-dismiss="modal">&times;</button>
						  	</div>
						  	<!-- Modal Body -->
						  	<div class="modal-body">
						  		<!-- Delete medicine form -->
						  		<form method="POST" action="/role/delete">
						  			@csrf
                    <input type="hidden" name="id" value="{{$role->id}}">
						  			<p>Are you sure you want to delete this Categorie?</p>
						  			<div class="modal-footer">
						  				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
						  				<button type="submit" class="btn btn-danger">Delete Role</button>
						  			</div>
						  		</form>
						  	</div>
						  	</div>
			        </div>
				</div>
       @endforeach
      </tbody>
    </table>
    </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script>
    $(document).ready( function () {
      $('#myTable').DataTable();
       } );
     </script>

</body>
</html>