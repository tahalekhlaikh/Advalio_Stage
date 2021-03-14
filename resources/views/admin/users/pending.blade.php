@extends('layouts.app')
 <!-- JQuery DataTable Css -->
 <link href="{{ asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">



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
        <h1 class="h2">Gestion des Utilisateurs</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group mr-2">
            <h1 class="h5">Bonjour   
              {{ Auth::user()->name }} <span class="caret"></span>
          </a></h1>
          </div>
         
        </div>
      </div>
   
    <div class="container-fluid">
    
        <!-- Exportable Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-lg-12 col-lg-12 col-lg-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Tous le documents
                            <span class="badge bg-blue">{{ $documents->count() }}</span>
                        </h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nom</th>
                                   
                                
                                    <th>Approbation</th>
                                    <th>Auteur</th>
                                    <th>Type Auteur</th>
                                    
                                   
                                    <th>Created At</th>
                                    {{--<th>Updated At</th>--}}
                                    <th>Action</th>
                                </tr>
                                </thead>
                              
                                <tbody>
                                    @foreach($documents as $post)
                                        <tr>
                                            <td>{{ $post->id }}</td>
                                           
                                            <td><a href="{{url('/')}}/{{ Storage::disk('local')->url('uploads/' .$post->name  )}}">{{ $post->name }}</a> </td>
                                          
                                            <td>
                                                @if($post->is_approved == true)
                                                    <span class="badge bg-blue">Approuvé</span>
                                                @else
                                                    <span class="badge bg-pink">En attente</span>
                                                @endif
                                            </td>
                                            <td>{{ $post->users()->first()->name }}</td>
                                            <td>{{  $post->users()->first()->type_users }}</td>
                                            <td>{{ $post->created_at }}</td>
                                            {{--<td>{{ $post->updated_at }}</td>--}}
                                            <td >
                                                @if($post->is_approved == false)
                                                    <button type="button" class="btn btn-success waves-effect" onclick="approvePost({{ $post->id }})">
                                                        <i class="material-icons">Approuver </i>
                                                    
                                                        
                                                    </button>
                                                    <hr>
                                                    <form method="post" action="{{ route('admin.post.approve',$post->id) }}" id="approval-form-{{ $post->id }}" style="display: none">
                                                        @csrf
                                                        @method('PUT')
                                                        
                                                    </form>
            
                                                @endif
                                               
                                                       <form action="{{route('admin.post.destroydocument',$post->id)}}" method="POST">
                                                   
                                                   
                                                      
                                                            @csrf
                                                          {{method_field('DELETE')}}
                                                             <button type="submit" class="btn btn-danger">Supprimer</button>
                                                        </form>
                                               
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Exportable Table -->
    </div>
</div>
</div>

@endsection


    <!-- Jquery DataTable Plugin Js -->
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.print.min.js') }}"></script>

    <script src="{{ asset('assets/backend/js/pages/tables/jquery-datatable.js') }}"></script>
    <script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>
    <script type="text/javascript">
        function deletePost(id) {
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    
                    document.getElementById('delete-form-'+id).submit();
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    swal(
                        'Cancelled',
                        'Your data is safe :)',
                        'error'
                    )
                }
            })
        }
        function approvePost(id) {
            swal({
                title: 'Are you sure?',
                text: "You went to approve this post ",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Oui, Approuver!',
                cancelButtonText: 'No, Annuler!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    document.getElementById('approval-form-'+ id).submit();
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    swal(
                        'Cancelled',
                        'The post remain pending :)',
                        'info'
                    )
                }
            })
        }
    </script>
