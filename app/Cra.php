<?php

namespace App;
use App\type_users;
use App\User;
use Illuminate\Database\Eloquent\Model;
Use DB;

class cra extends Model
{
        
       /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'Cras_rh';
    
    public function Users(){
        return $this->belongsToMany('App\User','cra_user_rh');   }
       
        public static function Cra($id){
      
           $data= DB::table('cras_rh')
            ->select('Projet','Commentaire','nbr_heures','Date','Ligne_de_Crédit')
            ->join('cra_user_rh','cra_user_rh.Cra_id','=','cras_rh.id')
            ->where('user_id',$id)
            ->get();
            return  $data;
       
        
}
public static function nbre_heures_mois($id,$month){
      
  $data= DB::table('cras_rh')
            ->select('nbr_heures')
            ->join('cra_user_rh','cra_user_rh.Cra_id','=','cras_rh.id')
            ->where('user_id',$id)
            ->whereRaw('extract(month from Date) = ?', [$month])
     
            ->sum('nbr_heures');
            return  $data;
            
}
public static function nbre_jours_mois($id,$month){
      
  $data= DB::table('cras_rh')
            ->select('Date')
            ->join('cra_user_rh','cra_user_rh.Cra_id','=','cras_rh.id')
            ->where('user_id',$id)
            ->distinct('Date')
            ->whereRaw('extract(month from Date) = ?', [$month])
            ->count();
   
            return  $data;
}
public static function nbre_jours_congé_payé($id,$month){
      
  $data= DB::table('cras_rh')
            ->select('Ligne_de_Crédit')
            ->join('cra_user_rh','cra_user_rh.Cra_id','=','cras_rh.id')
            ->where('user_id',$id)
            ->where('Ligne_de_Crédit','Congé payé')
            ->distinct('Date')
            ->whereRaw('extract(month from Date) = ?', [$month])
            ->count();
   
            return  $data;
}
public static function nbre_jours_fériés($id,$month){
      
  $data= DB::table('cras_rh')
            ->select('Ligne_de_Crédit')
            ->join('cra_user_rh','cra_user_rh.Cra_id','=','cras_rh.id')
            ->where('user_id',$id)
            ->where('Ligne_de_Crédit','Jours Fériés')
            ->whereRaw('extract(month from Date) = ?', [$month])
            ->distinct('Date')
            ->count();
   
            return  $data;
}
public static function nbre_jours_congé_sans_solde($id,$month){
      
  $data= DB::table('cras_rh')
            ->select('Ligne_de_Crédit')
            ->join('cra_user_rh','cra_user_rh.Cra_id','=','cras_rh.id')
            ->where('user_id',$id)
            ->where('Ligne_de_Crédit','Congé sans solde')
            ->whereRaw('extract(month from Date) = ?', [$month])
            ->distinct('Date')
            ->count();
   
            return  $data;
}
public static function nbre_jours_congé($id,$month){
      
  $data= DB::table('cras_rh')
            ->select('Ligne_de_Crédit')
            ->join('cra_user_rh','cra_user_rh.Cra_id','=','cras_rh.id')
            ->where('user_id',$id)
            ->where('Ligne_de_Crédit','Congé')
            ->whereRaw('extract(month from Date) = ?', [$month])
            ->distinct('Date')
            ->count();
   
            return  $data;
}
public static function nbre_jours_travaillé($id,$month){
      
  $data= DB::table('cras_rh')
            ->select('Ligne_de_Crédit')
            ->join('cra_user_rh','cra_user_rh.Cra_id','=','cras_rh.id')
            ->where('user_id',$id)
            ->where('Ligne_de_Crédit','Jour Travaillé')
            ->whereRaw('extract(month from Date) = ?', [$month])
            ->distinct('Date')
            ->count();
   
            return  $data;
}
public static function nbre_jours_Maladie($id,$month){
      
  $data= DB::table('cras_rh')
            ->select('Ligne_de_Crédit')
            ->join('cra_user_rh','cra_user_rh.Cra_id','=','cras_rh.id')
            ->where('user_id',$id)
            ->where('Ligne_de_Crédit','Maladie')
            ->whereRaw('extract(month from Date) = ?', [$month])
            ->distinct('Date')
            ->count();
   
            return  $data;
}
public static function nbre_jours_autre($id,$month){
      
  $data= DB::table('cras_rh')
            ->select('Ligne_de_Crédit')
            ->join('cra_user_rh','cra_user_rh.Cra_id','=','cras_rh.id')
            ->where('user_id',$id)
            ->where('Ligne_de_Crédit','autre')
            ->whereRaw('extract(month from Date) = ?', [$month])
            ->distinct('Date')
            ->count();
   
            return  $data;
}
public static function nbre_jours_Frais_généraux($id,$month){
      
  $data= DB::table('cras_rh')
            ->select('Ligne_de_Crédit')
            ->join('cra_user_rh','cra_user_rh.Cra_id','=','cras_rh.id')
            ->where('user_id',$id)
            ->where('Ligne_de_Crédit','Frais généraux')
            ->whereRaw('extract(month from Date) = ?', [$month])
            ->distinct('Date')
            ->count();
   
            return  $data;
}
public static function jour($id,$date,$ligne){
  $data= DB::table('cras_rh')
            ->join('cra_user_rh','cra_user_rh.Cra_id','=','cras_rh.id')
            ->where('user_id',$id)
            ->where('Date',$date)
            ->value('Ligne_de_Crédit');
   if($data==$ligne)
    return 1;
     else   return 0;
}
public static function commentaire($id,$date){
  $data= DB::table('cras_rh')
            ->join('cra_user_rh','cra_user_rh.Cra_id','=','cras_rh.id')
            ->where('user_id',$id)
            ->where('Date',$date)
            ->value('Commentaire');
   return $data;
}

}
