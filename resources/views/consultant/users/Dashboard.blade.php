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
    <div class="container-fluid">
 
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h5 > <a href="#" >Documents</a></h5>
 
         
          
         </div>
    <!-- Icon Cards-->
    <div class="row">
     
      <div class="col-xl-3 col-sm-6 mb-3">
        <div class="card text-white bg-warning o-hidden h-100">
          <div class="card-body">
            <div class="card-body-icon">
              <i class="fa fa-file-text-o"></i>
            </div>
            <div class="mr-5">{{$No_Doc_No_approved}} En Attente D'Approbation!</div>
          </div>
          <button type="button" class="btn btn-sucess text-white float-left" data-toggle="modal" data-target="#exampleModalCenter1">
            Détails<i class="fa fa-angle-right float-right"></i>
          </button>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6 mb-3">
        <div class="card text-white bg-success o-hidden h-100">
          <div class="card-body">
            <div class="card-body-icon">
              <i class="fa fa-file-text-o"></i>
            </div>
            <div class="mr-5">{{$No_Doc_approved}} Document Approuvés!</div>
          </div>
          <button type="button" class="btn btn-sucess text-white float-left" data-toggle="modal" data-target="#exampleModalCenter">
            Détails<i class="fa fa-angle-right float-right"></i>
          </button>
        </div>
      </div>
     


<!--Documents Approuvé-Pop-up-->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Document Approuvés</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
           
              <div class="list-group">
                @foreach($Doc_approved as $Doc_approved )
                <a  href="{{url('/')}}/{{ Storage::disk('local')->url('uploads/' .$Doc_approved->name  )}}" class="list-group-item list-group-item-action">{{$Doc_approved->name}}</a>
            @endforeach
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
             
            </div>
          </div>
        </div>
      </div>
<!--End Documents Approuvé-Pop-up-->




<!--Documents En attente d'Approbation-Pop-up-->
<div class="modal fade" id="exampleModalCenter1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Document En attente d'Approbation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="list-group">
          @foreach($Doc_No_approved as $Doc_No_approved )
          <a  href="{{url('/')}}/{{ Storage::disk('local')->url('uploads/' .$Doc_No_approved->name  )}}" class="list-group-item list-group-item-action">{{$Doc_No_approved->name}}</a>
      @endforeach
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
       
      </div>
    </div>
  </div>
</div>
</div>
<!--End Documents Approuvé-Pop-up-->


  
</form>

  

<br>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
 <h5 > <a href="#" >Missions</a></h5>
 <div class="col-sm-1">
  <h5 > <a href="#" >{{$month}}</a></h5>
</div>
 <div class="btn-toolbar mb-0 mb-0 md-0">
  <div class="btn-group mr-3">
    <h4> <a   href="#" >Mois:   </a></h4>
        <div class="col-sm-10">
          <select class="form-control" id="select_id" onchange="Select_mois()">
            <option value="-">--choisir--</option>
            @foreach (range(1, 12) as $i) {
            <option value="{{$i}}">{{$i}}</option>
            @endforeach
          
          </select>
        </div>
        
      
        
      
      
  </div></div>
  
   
  </div>


  
  <!-- Icon Cards-->
  <div class="row">
    <div class="col-xl-3 col-sm-6 mb-3">
      <div class="card text-white bg-success o-hidden h-100">
        <div class="card-body">
          <div class="card-body-icon">
            <i class="fa fa-briefcase "></i>
          </div>
          <div class="mr-5">Mission En Cours!</div>
        </div>
        <button type="button" class="btn btn-sucess text-white float-left" data-toggle="modal" data-target="#exampleModalCenter3">
          Détails<i class="fa fa-angle-right float-right"></i>
        </button>
      </div>
    </div>


    
    <div class="col-xl-3 col-sm-6 mb-3">
      <div class="card text-white bg-primary o-hidden h-100">
        <div class="card-body">
          <div class="card-body-icon">
            <i class="fa fa-clock-o"></i>
          </div>
          <div class="mr-5">{{$No_jour_travaillé}} Jours De Travail!</div>
        </div>
      
      </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-3">
      <div class="card text-white bg-dark o-hidden h-100">
        <div class="card-body">
          <div class="card-body-icon">
            <i class="fa fa-clock-o"></i>
          </div>
          <div class="mr-5">{{$No_heure_mois }} Heures De Travails!</div>
        </div>
        
      </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-3">
      <div class="card text-white  o-hidden h-100 purple">
        <div class="card-body">
          <div class="card-body-icon">
            <i class="fa fa-clock-o"></i>
          </div>
          <div class="mr-5">{{$No_jour_Jours_Fériés}} Jours Fériés!</div>
        </div>
      
      </div>
    </div>

   
<!-- Missions en cours-->
<div class="modal fade" id="exampleModalCenter3" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle3" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Missions en cours</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       
          
            
               
        
        <table class="table table-striped">
          <thead>
            
          <tbody>
            @foreach ($mission as $mission)
            <tr>
                <td>Client</td>
                <td>{{$mission->Client}}</td>
               <td></td>
              </tr>
               
           
                <tr>
                    <td>Intitulé Mission</td>
                    <td>{{$mission->Intitulé_Mission}}</td>
                   <td></td>
                  </tr>
                  <tr>
                    <td>Responsable</td>
                    <td>{{$mission->Responsable}}</td>
                   <td></td>
                  </tr>
                  <tr>
                    <td>Date Debut de Mission</td>
                    <td>{{$mission->Date_Debut}}</td>
                   <td></td>
                  </tr>
                  <tr>
                    <td>Date Fin</td>
                    <td>{{$mission->Date_Fin}}</td>
                   <td></td>
                  </tr>
                  <tr>
                    <td>Numéro de bon de command en cours</td>
                    <td>{{$mission->numéro_Bncmd_encours}}</td>
                   <td></td>
                  </tr>
    
             
         @endforeach
                </tbody>
                </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
       
      </div>
    </div>
  </div>
</div>
</div>
<!--End Missions-Pop-up-->

<div class="row">
  <div class="col-xl-3 col-sm-6 mb-3">
    <div class="card text-white  o-hidden h-100 blue">
      <div class="card-body">
        <div class="card-body-icon">
          <i class="fa fa-clock-o"></i>
        </div>
        <div class="mr-5">{{$No_jour_conjé}} Jours Congés!</div>
   
      </div>
    
    </div>
  </div>
  <div class="col-xl-3 col-sm-6 mb-3">
    <div class="card text-white  o-hidden h-100 orange">
      <div class="card-body">
        <div class="card-body-icon">
          <i class="fa fa-clock-o"></i>
        </div>
        <div class="mr-5">{{$No_jour_autre}} Jours pour autres raisons !</div>
   
      </div>
    
    </div>
  </div>
  <div class="col-xl-3 col-sm-6 mb-3">
    <div class="card text-white  o-hidden h-100 pink">
      <div class="card-body">
        <div class="card-body-icon">
          <i class="fa fa-clock-o"></i>
        </div>
        <div class="mr-5">{{$No_jour_Maladie}} Jours pour Maladie</div>
   
      </div>
    
    </div>
  </div>
</div>
    <div>

  </main>
</div>
</div>
</div>
</div>
</div>
  
  @endsection
  <script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>
  <script type="text/javascript">
  function Select_mois()
  {
   

           var id= document.getElementById("select_id").value;
   
           location.href="/consultant/select/"+id+"/Month";
       
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
