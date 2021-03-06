@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="row">
    <nav class="col-sm-18  bg-light sidebar">
      <div class="p-4 mb-1 bg-dark text-white col-sm-14 " >Espace Consultant</div>
      <div class="sidebar-sticky">
        <ul class="nav flex-column">
          
          <li class="nav-item">
            <a class="nav-link active"  href="{{ route('consultant.dashboard.index') }}">
             
              <span data-feather="home"></span>
              Dashboard <i class="fa fa-tachometer fa-lg" aria-hidden="true"></i><span class="sr-only">(current)</span> 
              
            </a>
            
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('consultant.fiche') }}">
              <span data-feather="file"></span>
              Fiche Identification <i class="fa fa-fw fa-user fa-lg"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('consultant.missions') }}">
              <span data-feather="shopping-cart"></span>
              Missions <i class="fa fa-briefcase fa-lg" aria-hidden="true"></i></i> 
            </a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
             Documents<i class="fa fa-file-text-o fa-lg" aria-hidden="true"></i>
            </a>
            <div class="dropdown-menu bg-light sidebar" aria-labelledby="navbarDropdown">
              <a class="dropdown-item"  href="{{ route('consultant.documents') }}"> Documents</a>
              
           
              <a class="dropdown-item" href="{{ route('consultant.remplir') }}">Feuille De Temps</a>
            
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Cra  <i class="fa fa-clock-o  fa-lg" aria-hidden="true"></i>
            </a>
            <div class="dropdown-menu bg-light sidebar" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="{{ route('consultant.cra') }}"> Cra</a>
              
           
              <a class="dropdown-item"  href="{{ route('consultant.tableau') }}">Tableau de bord</a>
            
          </li>
         
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="layers"></span>
              NDF<i class="fal fa-quidditch"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="layers"></span>
              Salaires <i class="fa fa-usd fa-lg" aria-hidden="true"></i>
            </a>
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
    <h1 class="h2">Mes Informations</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
      <div class="btn-group mr-2">
        <h1 class="h5">Bonjour   
          {{ Auth::user()->name }} <span class="caret"></span>
      </a></h1>
      </div>
     
    </div>
  </div>
  <div class="container">

    
           
               
                    <form action="{{url('consultant/dashboard/UpdateProfile',Auth::user()->id)}}" method="POST">
                      @csrf
                       {{method_field('PUT')}}
              
                   
                       
                        
                     
                      
                
                   
                        
                        
                      
                   
                   
                     
                      
                      
                   
                  
                    
              
         


  
<table class="table table-striped">
  <thead>
    <tr class="table-primary">
      <th> Adresse et Situation familiale <i class="fa fa-home fa-lg" aria-hidden="true"></i></th>
      <th></th>
      <th>
    
       
      </th>
    </tr>
  </thead>
  <tbody>
   
    <tr>
      <td>Situation familiale</td>
      <td >  <select class="form-control" name="situation_familiale">
        @foreach(["C??libataire" => "C??libataire", "divorc??(e)" => "divorc??(e)","mari??(??)"=> "mari??(??)","Veuf(ve)"=> "Veuf(ve)"] AS $situation_familiale => $contactLabel)    
        <option value="{{ $situation_familiale }}" {{ old("type_users",Auth::user()->situation_familiale) == $situation_familiale ? "selected" : "" }}>{{ $contactLabel }}</option>
        @endforeach
    </select></td>
      <td></td>
      
    </tr>
       
    <tr>
      <td>Nombre D'enfants</td>
      <td><input type="text" class="form-control" name="nbr_enfant"  placeholder="Votre Email" value="{{ Auth::user()->nbr_enfant }}" required autocomplete="nbr_enfant" autofocus>
                      
       
      <td> </td>
       
    </tr>
    <tr>
      <td>Adresse</td>
      <td><input type="text" class="form-control" name="Adresse"  placeholder="Votre Adresse" value="{{ Auth::user()->Adresse }}" required autocomplete="Adresse" autofocus></td>
     <td></td>
    </tr>
    
    <tr>
      <td></td>
      <td><button type="submit" class="btn btn-primary btn-lg">
        Update
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
    