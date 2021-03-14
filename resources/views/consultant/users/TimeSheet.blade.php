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
  <br />
  <div class="container">
 
   
   <div class="row">
    <div class="col-md-7" align="right">
     <h4>Bon de Command</h4>
    </div>
    <div class="col-md-5" align="right">
      


     <input type="button" id="btnExport" class="btn btn-danger"   value="Export" onclick="Export()" />
     <button id="btnExcel" class="btn btn-success" onclick="XLExport('table1','table2','table3')">Rapport Excel</button>
    </div>
   </div>
   <br />


   <div class="table-responsive">
@include('consultant.users.Bon_command')
   </div>
  </div>
</div>
@endsection
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jspdf/0.9.0rc1/jspdf.min."></script>
  <script  type="text/javascript">
      
            
  function Export() {
            html2canvas(document.getElementById('table1'), {
                onrendered: function (canvas) {
                    var data = canvas.toDataURL();
                    var docDefinition = {
                        content: [{
                            image: data,
                            width: 500
                           
                        }]
                    };
                    pdfMake.createPdf(docDefinition).download("Table.pdf");
                }
            }
            );
        }
    function XLExport(tableId,table,table3) {
        var tables=document.getElementById(table3), sumVal = 0;
        sumVal3 = 0;
        sumVal4 = 0;
        sumVal5 = 0;
        sumVal6 = 0;
        
          
           
     
            var tab_text =  '<head><meta charset="UTF-8" />';
              for(var i = 1; i < tables.rows.length; i++)
            {
                sumVal = sumVal + parseInt(tables.rows[i].cells[2].innerHTML);
                sumVal3 = sumVal3 + parseInt(tables.rows[i].cells[3].innerHTML);
                sumVal4 = sumVal4 + parseInt(tables.rows[i].cells[4].innerHTML);
                sumVal5 = sumVal5 + parseInt(tables.rows[i].cells[5].innerHTML);
                sumVal6 = sumVal6 + parseInt(tables.rows[i].cells[6].innerHTML);
            }
            
            
           tab_text = tab_text +"<table border='2px'><tr >";
            var textRange;
            var j = 0;
          
            tab = document.getElementById(tableId);
            for (j = 0 ; j < tab.rows.length ; j++) {
                tab_text = tab_text + tab.rows[j].innerHTML + "</tr>";
            }
            tab_text = tab_text + "</table>";


            tab_text = tab_text +"<br><table border='2px'><tr >";
            var textRange;
            var j = 0;
          
            tab = document.getElementById(table);
            for (j = 0 ; j < tab.rows.length ; j++) {
                tab_text = tab_text + tab.rows[j].innerHTML + "</tr>";
            }
            tab_text = tab_text + "</table>";

            tab_text = tab_text +"<br><table border='2px'><tr >";
            var textRange;
            var j = 0;
          
            tab = document.getElementById(table3);
            for (j = 0 ; j < tab.rows.length ; j++) {
                tab_text = tab_text + tab.rows[j].innerHTML + "</tr>";
            }
   
            tab_text = tab_text + "<tr> <td colspan=3>Total</td><td colspan=1></td><td colspan=1 >"+sumVal+"</td><td colspan=1>"+sumVal3+"</td> <td colspan=1>"+sumVal4+"</td> <td colspan=1>"+sumVal5+"</td> <td colspan=1> "+sumVal6+"</td><td colspan=3></td>  </tr>	</table> </tbody> <strong> Le 03/08/2020	</strong>	<br> <strong> Signé: Mamoun Lamsaaf (Responsable Advalio)	</strong>	";
            
        
            tab_text = tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); // remove input params
            sa = window.open('data:application/vnd.ms-excel,' + encodeURIComponent(tab_text));
            return (sa);
        }
        </script>