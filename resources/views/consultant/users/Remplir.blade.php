@extends('layouts.app')

@section('content')
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
        <h1 class="h2">Feuille De Temps</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group mr-2">
            <h1 class="h5">Bonjour   
              {{ Auth::user()->name }} <span class="caret"></span>
          </a></h1>
          </div>
         
        </div>
      </div>
      
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Veuillez remplir les informations suivantes:') }}</div>

                <div class="card-body">
                    <form method="Post" action="{{ route('consultant.dashboard.TimeSheet') }}" enctype="multipart/form-data">
                        @csrf
                        <table class="table">
                          <tbody>
                            <tr>
                              @if ($message = Session::get('Danger'))
                              <div class="alert alert-danger">
                                  <strong>{{ $message }}</strong>
                              </div>
                            @endif
                              <td>
                       
                            <label >{{ __('Date') }}</label>
                        </td>
                        <td>
                         
                                <input name="date" type="Date" class="date" value="2020-05-19" >

                                
                          
                          </td>
                          <tr>
                          <td>
                         
                              <label >{{ __('Service client') }}</label>
                            </td>
                            <td>
                         
                                  <input name="service" type="texte"  >
                              </td>
                              <tr>
                              <td>
                                Logo Client:
                              </td>
                              <td>
                           
                                <input type="file" class="form-control-file" name="file" id="exampleFormControlFile1">
                        
                              
                              </td>
                            </tr>
                          </tr>
                          <td></td>
                          <td>             <button type="submit" class="btn btn-primary">
                            {{ __('Ajouter') }}
                        </button>
                
            </form></td>
                          <td></td>
                            </tbody>
                          </table>
                        </div>
                        
                  
                        
                 
                              
                          </div>
                      </div>

                     
                 
                       

                        
                     
                    

                </div>
            </div>
        </div>
    </div>
</div>
</main>
@endsection