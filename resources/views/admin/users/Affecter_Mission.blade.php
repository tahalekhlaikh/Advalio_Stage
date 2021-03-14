
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
        <h1 class="h2">Gestion des Missions</h1>
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
                <div class="card-header">{{ __('Gérer les utilisateurs') }}</div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                          <tr>
                         
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                          
                            <th scope="col">Roles</th>
                            <th scope="col">Mission Actuelle</th>
                            <th scope="col">Actions</th>
                            
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <th>  {{$user->name}}</th>
                                <th>  {{$user->email}}</th>
                                
                                
                                <th>   {{$user->type_users}}</th>
                                <th>  @if($user->is_affected == false)
                                  <p class="text-warning">Pas de Mission en Cours</p>
                                
                                 @else 
                                 <p class="text-success">En cours de mission</p>
                                  @endif
                                </th>
                                
                               
                                <th>  
                                    <form     action="{{route('admin.users.destroyMission',App\User::Mission_id($user->id) )}}"  id="delete-form-{{ App\User::Mission_id($user->id) }}"  style="display: none" method="POST">
                                  
                                   
                                      
                                            @csrf
                                          {{method_field('DELETE')}}
                                        </form>
                                     
                                        @if($user->is_affected == false)
                                        <a  href="/admin/users/{{ $user->id}}/missions" >
                                          <button type="button" class="btn btn-success">Affecter Mission</button>
                                         </a>
                                         <hr>
                                         @endif
                                         @if($user->is_affected == true)
                                         
                                          <button type="button" class="btn btn-primary" data-toggle="modal" @if($user->type_users == 'salarié') data-target="#exampleModalCenter1-{{$user->id}}"     @else  data-target="#exampleModalCenter2-{{$user->id}}" @endif  >Détail Mission</button>

                                                
                                 
                          



                    
                     
                                         <hr>
                                         @endif
                                       
                                         <!-- Modeeeeeel Consultant -->
<div class="modal fade" id="exampleModalCenter2-{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
     <div class="modal-content">
       <div class="modal-header">
  <h5 class="modal-title" id="exampleModalLongTitle">Missions\Consultant</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
 </button>
  </div>
<div class="modal-body">
  @if($user->is_affected == true)
  <table class="table table-striped">
    <thead>
      
    <tbody>
  
      <tr>
          <td>Client</td>
          <td>{{$user->name }}</td>
         <td></td>
        </tr>
         
     
          <tr>
              <td>Intitulé Mission</td>
              <td>{{App\User::Mission($user->id)->Intitulé_Mission}}</td>
             <td></td>
            </tr>
            <tr>
              <td>Responsable</td>
              <td>{{App\User::Mission($user->id)->Responsable}}</td>
             <td></td>
            </tr>
            
              <tr>
                <td>Date Debut de Mission</td>
                <td>{{App\User::Mission($user->id)->Date_Debut}}</td>
               <td></td>
              </tr>
              <tr>
                <td>Date Fin</td>
                <td>{{App\User::Mission($user->id)->Date_Fin}}</td>
               <td></td>
              </tr>
              <tr>
                <td>Numéro de bon de command en cours</td>
                <td>{{App\User::Mission($user->id)->numéro_Bncmd_encours}}</td>
               <td></td>
              </tr>

       
       

          </tbody>
          </table>
          @endif
</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

</div>
</div>
</div>
</div>
<!-- End Modeeeeeel -->





                                        <!-- Modeeeeeel Salarié -->
                                      <div class="modal fade" id="exampleModalCenter1-{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                           <div class="modal-content">
                                             <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Mission\Salarié</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                     <span aria-hidden="true">&times;</span>
                                       </button>
                                        </div>
                                      <div class="modal-body">
                                        @if($user->is_affected == true)
                                        <table class="table table-striped">
                                          <thead>
                                            
                                          <tbody>
                                        
                                            <tr>
                                                <td>Client</td>
                                                <td>{{App\User::Mission($user->id)->Client }}</td>
                                               <td></td>
                                              </tr>
                                               
                                           
                                                <tr>
                                                    <td>Intitulé Mission</td>
                                                    <td>{{App\User::Mission($user->id)->Intitulé_Mission}}</td>
                                                   <td></td>
                                                  </tr>
                                                  <tr>
                                                    <td>Responsable</td>
                                                    <td>{{App\User::Mission($user->id)->Responsable}}</td>
                                                   <td></td>
                                                  </tr>
                                             
                                             
                                      
                                                </tbody>
                                                </table>
                                                @endif
                                    </div>
                              <div class="modal-footer">
                                   <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
           
                         </div>
                  </div>
                     </div>
                       </div>

                    <!-- End Modeeeeeel -->
                  
                                         @if($user->is_affected == true)
                                             <button type="submit" class="btn btn-danger" onclick="deleteMission({{App\User::Mission_id($user->id) }})" >Supprimer</button>
                                             @endif
                                            
                                        </th>
                            </tr>
                           
                                
                            @endforeach
                          
                        </tbody>
                      </table>
                     
                   </th>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
    </div>
    
@endsection
<script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>
<script type="text/javascript">
    function deleteMission(id) {
        swal({
            title: 'Êtes-vous sûr?',
            text: "Vous ne pourrez pas revenir en arrière!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Oui,Supprimmer!',
            cancelButtonText: 'No, Annuler!',
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
                    'Annulé',
                    'Vos données sont en sécurité :)',
                    'error'
                )
            }
        })
    }
  </script>