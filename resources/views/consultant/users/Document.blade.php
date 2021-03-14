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
      <h1 class="h2">Mes Documents</h1>
      <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
          <h1 class="h5">Bonjour   
            {{ Auth::user()->name }} <span class="caret"></span>
        </a></h1>
        </div>
       
      </div>
    </div>
    <form action="{{route('fileUpload')}}" method="post" enctype="multipart/form-data">
      <h3 class="text-center mb-5">Partager un document sur votre espace</h3>
        @csrf
        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <strong>{{ $message }}</strong>
        </div>
      @endif
      @if ($message = Session::get('warning'))
      <div class="alert alert-warning">
          <strong>{{ $message }}</strong>
      </div>
    @endif

      @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
      @endif
  
        <div class="custom-file">
            <input type="file" name="file" class="custom-file-input" id="chooseFile">
            <label class="custom-file-label" for="chooseFile">Select file</label>
        </div>
        
        
          
               <div class="form-check">
               <input type="hidden" name="type_users[]" value="{{1}}">
               <input type="hidden" name="Users[]" value="{{Auth::user()->id}}"></td>
                   
               </div>
        
        
        <button type="submit" name="submit" class="btn btn-primary btn-block mt-4">
            Upload Files
        </button>
    </form>
    <hr>
      @foreach ($documents as $documents)

    <div class="document danger">
        <div class="document-body">
            <a href="{{url('/')}}/{{ Storage::disk('local')->url('uploads/' .$documents ->name  )}}"><i class="fa fa-file" aria-hidden="true"></i></a>
        </div>
        <div class="document-footer">
            <span class="document-name"> {{$documents ->name}}</span>
            <span class="document-description"> {{$documents ->file_size}} Ko </span>
        </div>
    </div>
    @endforeach
  </main>
</div>
</div>

  
  @endsection