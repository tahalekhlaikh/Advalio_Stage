@extends('layouts.graphe')

@section('content')

<div class="container-fluid">
  <div class="row">
   
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
  <img src="{{ asset('img/white.png') }}" class="white" >

  <table class="table table-striped">
    <thead>
      <tr class="table-primary">
        <th> Ajouter Une Operation</i></th>
        <th></th>
        <th>
      
         
        </th>
      </tr>
    </thead>
    <tbody>
      <form action="{{url('consultant/dashboard/CreateCra',Auth::user()->id)}}" method="POST">
        @csrf
         
      <tr>
        <td>Jour</td>
        <td >  <select class="form-control" name="Ligne_de_Cr??dit">
          @foreach(["Jour Travaill??" => "Jour Travaill??", "Jours f??ri??s " => "F??ri??","Cong??  " => "Cong?? ","Maladie" => "Maladie ","Autre"=> "Autre"] AS $Ligne_Credit => $contactLabel)    
          <option value="{{$Ligne_Credit }}" >{{ $contactLabel }}</option>
          @endforeach
      </select></td>
        <td></td>
        
      </tr>
      
      <tr>
        <td>Projet</td>
        <td><input type="text" class="form-control" name="Projet"  placeholder="Projet"  required autocomplete="Projet" autofocus></td>
       <td></td>
      </tr>
      <tr>
        <td>Date</td>
        <td><input type="date" class="form-control" name="Date"  placeholder="Date "  required autocomplete="Date" autofocus></td>
       <td></td>
      </tr>
      <tr>
        <td>Nombre D'heures</td>
        <td><input type="text" class="form-control" name="nbr_heures"  placeholder="Nombre D'heures"  required autocomplete="nbr_heures" autofocus>
                        
         
        <td> <input type="hidden" name="Users[]" value="{{Auth::user()->id}}"> </td>
         
      </tr>
      <tr>
        <td>LIEU/REMARQUES</td>
        <td> 
          <textarea class="form-control" name="Commentaire" rows="3"></textarea></td>
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
    
  
  
    <br/><!-- Just so that JSFiddle's Result label doesn't overlap the Chart -->
  
    <div id="update-nav">
      <div id="range-selector"> 
        <input type="button" id="1m" class="period ui-button" value="1m" />
        <input type="button" id="3m" class="period ui-button" value="3m"/>
        <input type="button" id="6m" class="period ui-button" value="6m"/>
        <input type="button" id="1y" class="period ui-button" value="1y"/>
        <input type="button" id="all" class="period ui-button" value="All"/>
  
  
  
  
       
  
      </div>
      <hr>
      <div id="date-selector" class="">
          From:<input type="text" id="fromDate"  class="ui-widget">
          To:<input type="text" id="toDate"  class="ui-widget">
      </div>
    </div>
    
    <br/>
    <div id="chartContainer" style="height: 360px; width: 100%;">
      </div>
  
  <br>
</main>
  </div>
  @endsection
<script type="text/javascript">

    window.onload = function () {
        var dps = [];
    
    var chart = new CanvasJS.Chart("chartContainer",
        {
      title: {
          text: "Tableau De Bord des heures de travail "
      },
      axisX: {
            title: "Date"
        },
      axisY: {
            title: "Nombre D'heure"
        },
      toolTip:{
            shared: true,
            content: "<strong>Ligne de Cr??dit: </strong>{Ligne_de_Cr??dit} </br><strong>Projet: </strong>{Projet} </br> <strong>Date:</strong>{x}</br><strong>Commentaire: </strong>{Commentaire} </br><br> <strong>Nombre D'heures:</strong>{y}</br> "
        },
      data: [
            {
            type: "bubble",
            dataPoints: randomData(new Date(2017, 0, 1), 400)
        }
      ]
    });
    chart.render();
    
    var axisXMin = chart.axisX[0].get("minimum");
    var axisXMax = chart.axisX[0].get("maximum");
    
    function randomData(startX, numberOfY){
    var xValue, yValue = 0;
    @foreach($cra as $cra)
                    dps.push({
      
                        x: new Date('{{$cra->Date}}'),
              z: {{$cra->nbr_heures}},
                        y: {{$cra->nbr_heures}},
              
             Projet: '{{$cra->Projet}}',
             Ligne_de_Cr??dit:'{{$cra->Ligne_de_Cr??dit}}',
             Commentaire:'{{$cra->Commentaire}}'
             
             
                    });
                @endforeach
          return dps;
    }
    
    $( function() {
         $("#fromDate").val(CanvasJS.formatDate(axisXMin, "DD MMM YYYY"));
      $("#toDate").val(CanvasJS.formatDate(axisXMax, "DD MMM YYYY"));
      $("#fromDate").datepicker({dateFormat: "d M yy"});
      $("#toDate").datepicker({dateFormat: "d M yy"});
    });
    
    $("#date-selector").change( function() {
        var minValue = $( "#fromDate" ).val();
      var maxValue = $ ( "#toDate" ).val();
      
      if(new Date(minValue).getTime() < new Date(maxValue).getTime()){  
          chart.axisX[0].set("minimum", new Date(minValue));
          chart.axisX[0].set("maximum", new Date(maxValue));
      }  
    });
    
    $(".period").click( function() {
        var period = this.id;  
      var minValue;
      minValue = new Date(axisXMax);
      
      switch(period){
          case "1m":
          minValue.setMonth(minValue.getMonth() - 1);
          break;
        case "3m":
          minValue.setMonth(minValue.getMonth() - 3);
          break;
        case "6m":
          minValue.setMonth(minValue.getMonth() - 6);
          break;
        case "1y":
          minValue.setYear(minValue.getFullYear() - 1);
          break;
        default:
            minValue = axisXMin;
        }
      
         chart.axisX[0].set("minimum", new Date(minValue));  
      chart.axisX[0].set("maximum", new Date(axisXMax));
    });
    
    }
    </script>
    


    
