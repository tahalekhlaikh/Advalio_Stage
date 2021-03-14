
<table class="table" id="table1" style="border:2px;" >
   <tr ><th  ></th>
    <th  colspan=8 title="Field #2"><img src="{{ asset('storage/uploads/'.$logo) }}" class="logo-slide float-left" > <h1> &nbsp&nbsp&nbspFEUILLE DE VENTILATION  </h1></th>
    <th colspan=3><img src="{{ asset('img/advalio.png') }}" class="logo-slide" ></th>
    </tr>
    <tbody>
    <tr >
    <td  colspan=8  >FEUILLE DE VENTILATION DU MOIS DE &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp  <strong>{{$mois}}<strong><br><br><strong>Service :</strong>{{$service}}
   <br><br><strong>Société de prestation :</strong> Advalio</td >
 
    
      <td colspan=4 >
        <table class="table" style="border:2px;">
          <tr>
            <td>
           Bon de Commande en cours:
            </td>
         <td colspan=3  style= "text-align:left;" >
  {{$mission->first()->numéro_Bncmd_encours}}
            </td>
          
          </tr>
          <tr>
            <td>
            Quantité commandée du Bc
            </td>
            <td colspan=3 style= "text-align:left;">
             {{$interval}}
             </td>
          </tr>
          <tr>
            <td>
            Quantité Consommée du Bc
            </td>
            <td colspan=3 style= "text-align:left;">
              {{$consommée}}
             </td>
          </tr>
          <tr>
            <td>
             Quantité Restante Du Bc
            </td>
            <td colspan=3 style= "text-align:left;"><span  style="color:red;">
              {{$restante}}</span>
             </td>
          </tr>
        </table>

      </td>
    
  
    </tr>
    
    <table id="table2" class="table">
      <tbody>
    
    <tr>
    <td colspan=9>NOM: {{ Auth::user()->name }}</td>
    
    <td colspan=3>Visa Manager  :</td>
    
    </tr>
    
      </tbody>
    </table>
    <table id="table3" class="table">
      <tbody>
    <tr>
    <td colspan=3>JOUR</td>
    
    <td colspan=1 >DATE</td>
    <td colspan=1>TRAVAILLE</td>
    <td colspan=1>FERIE</td>
    <td colspan=1>CONGE</td>
    <td colspan=1>MALADIE</td>
    <td colspan=1>AUTRE</td>
    <td colspan=3>LIEU/REMARQUES</td>

  
    </tr>
    @foreach($date as $date)
    <tr>
    <td colspan=3>{{\Date::parse($date)->format('l')}}</td>
  
    <td>     
      {{$date}}</td>
   
    <td>{{App\Cra::jour(Auth::user()->id,$date,'Jour Travaillé')}}</td>
    <td data-cell-type="formula">  {{App\Cra::jour(Auth::user()->id,$date,'Jours fériés')}}</td>
    <td>  {{App\Cra::jour(Auth::user()->id,$date,'Congé')}}</td>
    <td>  {{App\Cra::jour(Auth::user()->id,$date,'Maladie')}}</td>
    <td> {{App\Cra::jour(Auth::user()->id,$date,'Autre')}} </td>
    <td colspan=3> {{App\Cra::commentaire(Auth::user()->id,$date)}}</td>
  

    </tr>
  
    @endforeach
  </tbody>
</table>
   

    
   