@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="row">
   
    <nav class="col-sm-18  bg-light sidebar">
      <div class="p-4 mb-1 bg-dark text-white col-sm-14 " >Espace Salarié</div>
      <div class="sidebar-sticky">
        <ul class="nav flex-column">
          
          <li class="nav-item">
            <a class="nav-link active"  href="{{ route('salarié.dashboard.index') }}">
             
              <span data-feather="home"></span>
              Dashboard <i class="fa fa-tachometer fa-lg" aria-hidden="true"></i><span class="sr-only">(current)</span> 
              
            </a>
            
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('salarié.fiche') }}">
              <span data-feather="file"></span>
              Fiche Identification <i class="fa fa-fw fa-user fa-lg"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('salarié.missions') }}">
              <span data-feather="shopping-cart"></span>
              Missions <i class="fa fa-briefcase fa-lg" aria-hidden="true"></i></i> 
            </a>
          </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('salarié.documents') }}">
              <span data-feather="shopping-cart"></span>
           Documents<i class="fa fa-file-text-o fa-lg" aria-hidden="true"></i>
            </a>
          </li>
       <li class="nav-item">
            <a class="nav-link" href="{{ route('salarié.cra') }}">
              <span data-feather="shopping-cart"></span>
           Cra<i class="fa fa-clock-o  fa-lg" aria-hidden="true"></i>
            </a>
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

    
           
               
                    <form action="{{url('salarié/dashboard/UpdateEntreprise',Auth::user()->id)}}" method="POST">
                      @csrf
                       {{method_field('PUT')}}
              
                   
                       
                        
                     
                      
                
                   
                        
                        
                      
                   
                   
                     
                      
                      
                   
                  
                    
              
         


  
<table class="table table-striped">
  <thead>
    <tr class="table-primary">
      <th> Entreprise <i class="fa fa-home fa-lg" aria-hidden="true"></i></th>
      <th></th>
      <th>
    
       
      </th>
    </tr>
  </thead>
  <tbody>
   

       
    <tr>
      <td>Date entrée</td>
      <td><input type="date" class="form-control" name="Date entrée"  placeholder="Votre Email" value="{{ Auth::user()->nbr_enfant }}" required autocomplete="nbr_enfant" autofocus>
                      
       
      <td> </td>
       
    </tr>
    <tr class="bg-success">
        <td  >Matériel Mis à disposition par l'Entreprise:</td>
        <td></td>
       <td></td>
      </tr>
    <tr>
        <td>Téléphone</td>
        <td >  <select class="form-control" name="Materiel_Télé">
          @foreach(["Samsung" => "Samsung", "Iphone" => "Iphone","Oppo"=> "Oppo"] AS $Materiel_Télé => $contactLabel)    
          <option value="{{ $Materiel_Télé }}" {{ old("type_users",Auth::user()->Materiel_Télé) == $Materiel_Télé ? "selected" : "" }}>{{ $contactLabel }}</option>
          @endforeach
      </select></td>
        <td></td>
        
      </tr>
      <tr>
        <td>Voiture</td>
        <td >  <select class="form-control" name="Materiel_Voiture">
          @foreach(["Peugeot" => "Peugeot", "Nissan" => "Nissan","Renault"=> "Renault"] AS $Materiel_Voiture=> $contactLabel)    
          <option value="{{ $Materiel_Voiture }}" {{ old("type_users",Auth::user()->Materiel_Voiture) == $Materiel_Voiture? "selected" : "" }}>{{ $contactLabel }}</option>
          @endforeach
      </select></td>
        <td></td>
        
      </tr>
      <tr>
        <td>PC</td>
        <td >  <select class="form-control" name="Materiel_Pc">
          @foreach(["Hp" => "Hp", "Azus" => "Azus","Lenovo"=> "Lenovo"] AS $Materiel_Pc => $contactLabel)    
          <option value="{{ $Materiel_Pc }}" {{ old("type_users",Auth::user()->Materiel_Pc) == $Materiel_Pc? "selected" : "" }}>{{ $contactLabel }}</option>
          @endforeach
      </select></td>
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
    