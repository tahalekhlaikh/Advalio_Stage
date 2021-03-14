<?php

namespace App\Http\Controllers\Consultant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Missions;
use App\documents;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Date;
use App\Cra;
use DateTime;
use App\Exports\UsersExportView;
use Illuminate\support\Facades\Auth;
use Intervention\Image\Facades\Image;

class ConsultantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
 
    public function fiche()
    {   
        return view('consultant.users.fiche');
    }
        public function index()
    {
     
        $date = new Date();

    return view('consultant.users.dashboard')->with('Doc_approved',documents:: Documents_Approuvés(Auth::user()->id))->with('Doc_No_approved',documents:: Documents_Non_Approuvés(Auth::user()->id))
    ->with(['mission'=>Missions:: Missions(Auth::user()->id)])
    ->with('No_Doc_approved',documents:: No_Documents_Approuvés(Auth::user()->id))
    ->with('No_Doc_No_approved',documents:: No_Documents_Non_Approuvés(Auth::user()->id))
    ->with('No_heure_mois',Cra::nbre_heures_mois(Auth::user()->id,"09"))
    ->with('No_jour_Maladie',Cra:: nbre_jours_Maladie(Auth::user()->id,ucfirst(trans($date->format('F')))))
    ->with('No_jour_conjé',Cra:: nbre_jours_congé(Auth::user()->id,ucfirst(trans($date->format('F')))))
    ->with('No_jour_autre',Cra:: nbre_jours_autre(Auth::user()->id,ucfirst(trans($date->format('F')))))
    ->with('No_jour_travaillé',Cra:: nbre_jours_travaillé(Auth::user()->id,ucfirst(trans($date->format('F')))))
    ->with('No_jour_Jours_Fériés',Cra:: nbre_jours_fériés(Auth::user()->id,ucfirst(trans($date->format('F')))))
    ->with('No_jour_Frais_généraux',Cra:: nbre_jours_Frais_généraux(Auth::user()->id,ucfirst(trans($date->format('F')))))
    ->with('month', ucfirst(trans($date->format('F'))));
    }
    public function Select_Month($month)
    {    

        Date::setLocale('fr');
        
$dateObj   = Date::createFromFormat('!m', $month);
$monthName = $dateObj->format('F'); // March
        return view('consultant.users.dashboard')->with('Doc_approved',documents:: Documents_Approuvés(Auth::user()->id))->with('Doc_No_approved',documents:: Documents_Non_Approuvés(Auth::user()->id))
        ->with(['mission'=>Missions:: Missions(Auth::user()->id)])
        ->with('No_Doc_approved',documents:: No_Documents_Approuvés(Auth::user()->id))
        ->with('No_Doc_No_approved',documents:: No_Documents_Non_Approuvés(Auth::user()->id))
        ->with('No_heure_mois',Cra::nbre_heures_mois(Auth::user()->id,$month))
        ->with('No_jour_travaillé',Cra:: nbre_jours_travaillé(Auth::user()->id,$month))
        ->with('No_jour_conjé',Cra:: nbre_jours_congé(Auth::user()->id,$month))
        ->with('No_jour_Maladie',Cra:: nbre_jours_Maladie(Auth::user()->id,$month))
        ->with('No_jour_autre',Cra:: nbre_jours_autre(Auth::user()->id,$month))
        ->with('No_jour_Jours_Fériés',Cra:: nbre_jours_fériés(Auth::user()->id,$month))
        
        ->with('No_jour_Frais_généraux',Cra::nbre_jours_Frais_généraux(Auth::user()->id,$month))
        ->with('month',ucfirst(trans($monthName)));

    }
    public function document()
    {   
        return view('consultant.users.document')->with(['documents'=>documents:: Documents_Consultant()]);
    }
    public function tableau()
    {   
        return view('consultant.users.tableau')->with(['cra'=>CRA::CRA(Auth::user()->id)]);
    }
    public function mission()
    {   
        return view('consultant.users.missions')->with(['mission'=>Missions:: Missions(Auth::user()->id)]);
    }
    public function CRA()
    {     
        return view('consultant.users.CRA')->with(['mission'=>Missions:: Missions(Auth::user()->id)])->with(['interval'=>Missions:: Soustraire_Date(Auth::user()->id)])->with(['consommée'=>Missions:: Soustraire_Date_Today(Auth::user()->id)])
        ->with(['restante'=>Missions:: restante(Auth::user()->id)]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'Client' =>'required',
            'Responsable' =>'required',
            'Intitulé_Mission' =>'required',
            'Date_Debut' =>'required',
            'numéro_Bncmd_encours' =>'required',
         


        ]);
       $user =new Missions;
       $user->Client=$request->input('Client');
       $user->Responsable=$request->input('Responsable');
       $user->Date_Debut=$request->input('Date_Debut');
       $user->Intitulé_Mission=$request->input('Intitulé_Mission');
       $user->numéro_Bncmd_encours=$request->input('numéro_Bncmd_encours');
   
  
       $user->save();
        return redirect()->route('consultant.dashboard.index');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth::user()->id ==$id)
        {
            return view('consultant.users.Profile')->with(['user'=>User::find($id)]);
            
        }
        //
    }
    public function Remplir()
    {   
        return view('consultant.users.Remplir');
    }
    
 
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function Adresse_Famille_Edit($id)
    {
        if(Auth::user()->id ==$id)
        {
            return view('consultant.users.Adresse_Famille')->with(['user'=>User::find($id)]);
            
        }
        //
    }
    public function Entreprise_Edit($id)
    {
        if(Auth::user()->id ==$id)
        {
            return view('consultant.users.Entreprise')->with(['user'=>User::find($id)]);
            
        }
        //
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    { if(Auth::user()->id ==$id)
        {
            $request->validate([
                'name' =>'nullable',
                'email' =>'nullable',
                'CIN' =>'nullable',
                'numéro_CNSS' =>'nullable',
                'téléphone' =>'nullable',
                
                

    
    
            ]);
            $user = User::find($id);
            
            $user->name=$request->input('name');
            $user->email=$request->input('email');
            $user->CIN=$request->input('CIN');
            $user->numéro_CNSS=$request->input('numéro_CNSS');
            $user->téléphone=$request->input('téléphone');
           
           
         
       
            $user->save();
            return redirect()->route('consultant.dashboard.index');
            
        }}
         public function updateProfile(Request $request, $id)
    { if(Auth::user()->id ==$id)
        {
            $request->validate([
                
                'nbr_enfant' =>'nullable',
                'situation_familiale' =>'nullable',
                'Adresse' =>'nullable',
                

    
    
            ]);
            $user = User::find($id);
            
            
            $user->nbr_enfant=$request->input('nbr_enfant');
            $user->situation_familiale=$request->input('situation_familiale');
            $user->Adresse=$request->input('Adresse');
           
         
       
            $user->save();
            return redirect()->route('consultant.dashboard.index');
            
        }
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function updateEntreprise(Request $request, $id)
    { if(Auth::user()->id ==$id)
        {
            $request->validate([
                
                'Materiel_Télé' =>'nullable',
                'Date_entrée' =>'nullable',
                'Materiel_Pc' =>'nullable',
                'Materiel_Voiture' =>'nullable',
                

    
    
            ]);
            $user = User::find($id);
            
            
            $user->Materiel_Télé=$request->input('Materiel_Télé');
            $user->Date_entrée=$request->input('Date_entrée');
            $user->Materiel_Voiture=$request->input('Materiel_Voiture');
            $user->Materiel_Pc=$request->input('Materiel_Pc');
           
         
       
            $user->save();
            return redirect()->route('consultant.dashboard.index');
            
        }
       
    }
    
 public function TimeSheet(Request $request)
 {
    $request->validate([
        
        'date' =>'required',
        'service' =>'required',
      'file' => 'required|mimes:png,jpg,jpeg|max:2048'
         

    ]);
    if($request->file()) {
        $mis=Missions::mission(Auth::user()->id);
        if($mis==null)
        {
            return back()
                ->with('Danger',"Vous n'avez aucune mission en cours.");
        }
        $mission =Missions::find($mis->id);
        $fileName = $request->file->getClientOriginalName();
        
        $file = $request->file('file');
        $img = Image::make($file)
        ->resize(100, 100)->save('storage/uploads/'.$fileName);
       
        
        $mission->logo = $request->file->getClientOriginalName();
       $mission->save();
      
        }



    $moi=new Date($request->input('date'));
    $service=$request->input('service');
    $period = CarbonPeriod::between($moi->format('Y').'-'.$moi->format('m').'-01',$moi->format('Y').'-'.$moi->format('m').'-31')->filter('isWeekday');
    foreach ($period as $date) {
      $days[] = $date->format('Y-m-d');
    }
  
    
     return view('consultant.users.Timesheet')->with('customer_data',Missions:: Missions(Auth::user()->id))
     ->with('date',$days )
     ->with('logo',$mission->logo )
     ->with('mois',ucfirst($moi->format('M-Y') ))
     ->with('service',$service)
     ->with(['mission'=>Missions:: Missions(Auth::user()->id)])->with(['interval'=>Missions:: Soustraire_Date(Auth::user()->id)])->with(['consommée'=>Missions:: Soustraire_Date_Today(Auth::user()->id)])
        ->with(['restante'=>Missions:: restante(Auth::user()->id)]);
 }



 

  
 public function CreateCRA(Request $request,$id)
    {
        //
        $request->validate([
            'Projet' =>'required',
            'Commentaire' =>'required',
            'Date' =>'required',
            'nbr_heures' =>'required',
            
         
            
         
         


        ]);
       $user =new Cra;
       $user->Projet=$request->input('Projet');
       $user->Commentaire=$request->input('Commentaire');
       $user->nbr_heures=$request->input('nbr_heures');
       $user->Date=$request->input('Date');
       $user->Ligne_de_Crédit=$request->input('Ligne_de_Crédit');
     
       $user->save();
       
       $user->Users()->sync($request->Users);
        
     
       return view('consultant.users.tableau')->with(['cra'=>CRA::CRA(Auth::user()->id)]);
    }
}
