<?php

namespace App\Http\Controllers\Salarié;
use DateTime;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\cra;
use App\missions;
use App\documents;
use App\type_users;
use Illuminate\support\Facades\Auth;
use Carbon\Carbon;
use Date;
class SalarieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     
        $date = new Date();

    return view('salarié.users.dashboard')->with('Doc_approved',documents:: Documents_Approuvés(Auth::user()->id))->with('Doc_No_approved',documents:: Documents_Non_Approuvés(Auth::user()->id))
    ->with(['mission'=>Missions:: Missions(Auth::user()->id)])
    ->with('No_Doc_approved',documents:: No_Documents_Approuvés(Auth::user()->id))
    ->with('No_Doc_No_approved',documents:: No_Documents_Non_Approuvés(Auth::user()->id))
    ->with('No_heure_mois',Cra::nbre_heures_mois(Auth::user()->id,"09"))
    ->with('No_jour_mois',Cra::nbre_jours_mois(Auth::user()->id,ucfirst(trans($date->format('F')))))
    ->with('No_jour_conjé_payé',Cra:: nbre_jours_congé_payé(Auth::user()->id,ucfirst(trans($date->format('F')))))
    ->with('No_jour_conjé_sans_solde',Cra::  nbre_jours_congé_sans_solde(Auth::user()->id,ucfirst(trans($date->format('F')))))
    ->with('No_jour_Jours_Fériés',Cra:: nbre_jours_fériés(Auth::user()->id,ucfirst(trans($date->format('F')))))
    ->with('No_jour_Frais_généraux',Cra:: nbre_jours_Frais_généraux(Auth::user()->id,ucfirst(trans($date->format('F')))))
    ->with('month', ucfirst(trans($date->format('F'))));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function document()
    {   
        return view('salarié.users.document')->with('type_users',type_users::all())->with(['documents'=>documents::Documents_salarié()]);
    }
    public function Select_Month($month)
    {    

        Date::setLocale('fr');
        
$dateObj   = Date::createFromFormat('!m', $month);
$monthName = $dateObj->format('F'); // March
        return view('salarié.users.dashboard')->with('Doc_approved',documents:: Documents_Approuvés(Auth::user()->id))->with('Doc_No_approved',documents:: Documents_Non_Approuvés(Auth::user()->id))
        ->with(['mission'=>Missions:: Missions(Auth::user()->id)])
        ->with('No_Doc_approved',documents:: No_Documents_Approuvés(Auth::user()->id))
        ->with('No_Doc_No_approved',documents:: No_Documents_Non_Approuvés(Auth::user()->id))
        ->with('No_heure_mois',Cra::nbre_heures_mois(Auth::user()->id,$month))
        ->with('No_jour_mois',Cra::nbre_jours_mois(Auth::user()->id,$month))
        ->with('No_jour_conjé_payé',Cra:: nbre_jours_congé_payé(Auth::user()->id,$month))
        ->with('No_jour_conjé_sans_solde',Cra::  nbre_jours_congé_sans_solde(Auth::user()->id,$month))
        ->with('No_jour_Jours_Fériés',Cra:: nbre_jours_fériés(Auth::user()->id,$month))
        
        ->with('No_jour_Frais_généraux',Cra::nbre_jours_Frais_généraux(Auth::user()->id,$month))
        ->with('month',ucfirst(trans($monthName)));

    }
    public function fiche()
    {   
        return view('salarié.users.fiche');
    }
    public function CRA()
    {   
        return view('salarié.users.CRA')->with(['cra'=>CRA::CRA(Auth::user()->id)]);
    }
    public function mission()
    {   
        return view('salarié.users.missions')->with(['mission'=>Missions:: Missions(Auth::user()->id)]);
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
        
     
       return view('salarié.users.cra')->with(['cra'=>CRA::CRA(Auth::user()->id)]);
    }
    public function setPasswordAttribute($value){
        $this->attributes['password'] = bcrypt($value);
    }
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
            return view('salarié.users.Profile')->with(['user'=>User::find($id)]);
            
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function Adresse_Famille_Edit($id)
    {
        if(Auth::user()->id ==$id)
        {
            return view('salarié.users.Adresse_Famille')->with(['user'=>User::find($id)]);
            
        }
        //
    }
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
            return redirect()->route('salarié.dashboard.index');
            
        }
       
    }

    public function update(Request $request, $id)
    {
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
            return redirect()->route('salarié.dashboard.index');
            
        }}
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
    

    public function Entreprise_Edit($id)
    {
        if(Auth::user()->id ==$id)
        {
            return view('salarié.users.Entreprise')->with(['user'=>User::find($id)]);
            
        }
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
            return redirect()->route('salarié.dashboard.index');
            
        }
       
    }
}
