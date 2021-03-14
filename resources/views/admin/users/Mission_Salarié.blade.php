@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="row">
   
    <nav class="col-sm-18  bg-light sidebar">
      <div class="p-4 mb-1 bg-dark text-white col-sm-14 " >Espace Admin</div>
      <div class="sidebar-sticky">
        <ul class="nav flex-column">
          
          <li class="nav-item">
            <a class="nav-link active" href="/">
             
              <span data-feather="home"></span>
              Dashboard <i class="fa fa-tachometer fa-lg" aria-hidden="true"></i><span class="sr-only">(current)</span> 
              
            </a>
            
          </li>
         
          <li class="nav-item">
            <a class="nav-link" href="missions">
              <span data-feather="shopping-cart"></span>
              Missions <i class="fa fa-briefcase fa-lg" aria-hidden="true"></i></i> 
            </a>
          </li>
        <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Documents <i class="fa fa-file-text-o fa-lg" aria-hidden="true"></i>
    </a>
    <div class="dropdown-menu bg-light sidebar" aria-labelledby="navbarDropdown">
      <a class="dropdown-item" href="documents"> Documents </a>
      
   
      <a class="dropdown-item" href="pending">Gestion des Documents</a>
    
  </li>
       
         
          <li class="nav-item">
          <a class="nav-link" href="{{ route('logout') }}"
          onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
           {{ __('Logout') }}
           <i class="fa fa-sign-out fa-lg" aria-hidden="true"></i>
       </a>
       <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
      
    </form>
 
       <li >
        </ul>

        
      </div>
    </nav>


  

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    <h1 class="h2">Mission</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
      <div class="btn-group mr-2">
        <h1 class="h5">Bonjour   
          {{ Auth::user()->name }} <span class="caret"></span>
      </a></h1>
      </div>
     
    </div>
  </div>
  <div class="container">

    
           
               
    <form action="{{url('admin/users/CreateMission_Salarié',$user->id)}}" method="POST">
        @csrf
         
              
                   
                       
                        
                     
                      
                
                   
                        
                        
                      
                   
                   
                     
                      
                      
                   
                  
                    
              
         


  
<table class="table table-striped">
  <thead>
    <tr class="bg-success">
      <th>Affecter une Mission à {{$user->name}}</th>
      <th></th>
      <th>
    
       
      </th>
    </tr>
  </thead>
  <tbody>
   
    <tr>
        <td>Client</td>
        <td><input type="text" class="form-control" name="Client"  placeholder="Nom Client(Entreprise)"  required autocomplete="Client" autofocus></td>
       <td></td>
      </tr>
       
    <tr>
        <tr>
            <td>Intitulé Mission</td>
            <td><input type="text" class="form-control" name="Intitulé_Mission"  placeholder="Intitulé_Mission"  required autocomplete="Intitulé_Mission" autofocus>   <input type="hidden" name="Users[]" value="{{$user->id}}"></td>
           <td></td>
          </tr>
          <tr>
            <td>Responsable</td>
            <td><input type="text" class="form-control" name="Responsable"  placeholder="Intitulé_Mission"  value="{{ $user->name }}" required autocomplete="Intitulé_Mission" autofocus></td>
           <td></td>
          </tr>>
         
    
    <tr>
      <td></td>
      <td><button type="submit" class="btn btn-primary btn-lg">
        Ajouter
    </button>
</td>
     <td></td>
    </tr>
    </form>
</main>
</div>
  </div>
</div>
</div>
  
    </div>
@endsection
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="../../assets/js/vendor/popper.min.js"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>

    <!-- Icons -->
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script>
      feather.replace()
    </script>

    <!-- Graphs -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
    