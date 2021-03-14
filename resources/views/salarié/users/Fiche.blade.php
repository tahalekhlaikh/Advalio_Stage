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
    
    <table class="table table-striped">
      <thead>
        <tr class="table-primary">
          <th>Profile <i class="fa fa-user fa-lg" aria-hidden="true"></i></th>
          <th></th>
          <th>
        
            <a  href="{{ route('salarié.dashboard.edit', Auth::user()->id)}}" >
              Modifier
             </a></td>
          </th>
        </tr>
      </thead>
      <tbody>
       
        <tr>
          <td>Nom</td>
          <td >{{ Auth::user()->name }}</td>
          <td></td>
          
        </tr>
           
        <tr>
          <td>Email</td>
          <td>{{ Auth::user()->email }}</td>
          <td> </td>
           
        </tr>
        <tr>
          <td>CIN</td>
          <td>{{ Auth::user()->CIN }}</td>
         <td></td>
        </tr>
        <tr>
          <td>Numéro Cnss</td>
          <td>{{ Auth::user()->numéro_CNSS}}</td>
         <td></td>
        </tr>
        <tr>
          <td>Numéro téléphone</td>
          <td>{{ Auth::user()->téléphone}}</td>
         <td></td>
        </tr>
        <tr class="table-primary">
          <th> Adresse et Situation familiale <i class="fa fa-home fa-lg" aria-hidden="true"></i></th>
          <th></th>
          <th>
            <a  href="/salarié/dashboard/{{ Auth::user()->id}}/Adresse_Famille_Edit" >
              Modifier


             </a></td>
          </th>
        </tr>
        <tr>
          <td>Situation Familliale</td>
          <td>{{ Auth::user()->situation_familiale }}</td>
         <td></td>
        </tr>
        <tr>
          <td>Nombre D'enfant</td>
          <td>{{ Auth::user()->nbr_enfant }}</td>
         <td></td>
        </tr>
        <tr>
          <td>Adresse</td>
          <td>{{ Auth::user()->Adresse }}</td>
         <td></td>
        </tr>
        <tr class="table-primary">
          <th>Entreprise <i class="fa fa-briefcase fa-lg" aria-hidden="true"></i></th>
          <th></th>
          <th>
            <a  href="/salarié/dashboard/{{ Auth::user()->id}}/Entreprise_Edit" >
              Modifier
             </a></td>
          </th>
        </tr>
        <tr>
          <td>Date Entrée</td>
          <td>{{ Auth::user()->Date_entrée }}</td>
         <td></td>
        </tr>
        <tr class="bg-success">
          <td  >Matériel Mis à disposition par l'Entreprise:</td>
          <td></td>
         <td></td>
        </tr>
        <tr>
          <td>Télephone </td>
          <td>{{ Auth::user()->Materiel_Télé}}</td>
         <td></td>
        </tr>
        <tr>
          <td>Voiture </td>
          <td>{{ Auth::user()->Materiel_Voiture}}</td>
         <td></td>
        </tr>
        <tr>
          <td>Pc </td>
          <td>{{ Auth::user()->Materiel_Pc}}</td>
         <td></td>
        </tr>
     
      </tbody>
    </table>
  </div>
  
 
</main>
</div>

@endsection
