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
        <h1 class="h2">Gestion des Documents</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group mr-2">
            <h1 class="h5">Bonjour   
              {{ Auth::user()->name }} <span class="caret"></span>
          </a></h1>
          </div>
         
        </div>
      </div>

<div class="container mt-5">
  <form action="{{route('fileUpload')}}" method="post" enctype="multipart/form-data">
    @csrf
      @if ($message = Session::get('success'))
      <div class="alert alert-success">
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
    <table class="table table-striped">
      <thead>
        <tr class="table-primary">
          <th> Partager Un Document </i></th>
          <th></th>
          <th>
          
           
          </th>
        </tr>
      </thead>
      <tbody>
       
      
           
        <tr>
          <td>Choisir un fichier</td>
          <td><div class="custom-file">
            <input type="file" name="file" class="custom-file-input" id="chooseFile" required>
            <label class="custom-file-label" for="chooseFile">Select file</label>
        </div>
                          
      
          <td> </td>
           
        </tr>
        <tr class="bg-warning">
            <td  >Fichier destiné à:</td>
            <td></td>
           <td></td>
          </tr>
          @foreach($type_users as $type_user)
          
      
        <tr>
        
            <td> <label>{{$type_user->name}}</label></td>
            <td >  <div class="form-check">
              
              <input type="checkbox" name="type_users[]"  value="{{$type_user->id}}" ></td>
              <input type="hidden" name="Users[]" value="{{Auth::user()->id}}"></td>
            <td></td>
            
          </tr>
          @endforeach
        <tr>
   
          <td></td>
          <td><button type="submit" name="submit" class="btn btn-primary ">
            Upload Files
        </button>
      
    </td>
         <td></td>
        </tr>
      </tbody>
      </table>
        </form>
   
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
  
      
 

      
      
      
        

      
  
<

  
      
     
  
  @endsection