<?php

namespace App;
use App\type_users;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
Use DB;
use App\Auth;
class missions extends Model
{
    protected $table = 'missions_rh';
    public function Users(){
        return $this->belongsToMany('App\User','missions_user_rh');   }
        public static function Missions($id){
      
            $mission_id= DB::table('missions_user_rh')->where( 'user_id', $id)->value('missions_id');
            $mission= DB::table('missions_rh')->where( 'id',  $mission_id)->get();

              
            return $mission;
        }
        public static function mission($id){
      
            $data= DB::table('missions_rh')
            ->join('missions_user_rh','missions_user_rh.missions_id','=','missions_rh.id')
            ->where('user_id',$id)
            ->first();
   
            return  $data;
}
        
        public static function Soustraire_Date($id){
          
           $mission= Missions:: Missions($id)->first();
           if($mission !=null){
            $interval=Carbon::parse($mission->Date_Debut)->diff(Carbon::parse($mission->Date_Fin));
             


              
            return $interval->format('%a ');;}
        }
        public static function Soustraire_Date_Today($id){
      
            $mission= Missions:: Missions($id)->first();
            if($mission !=null){
             $interval=Carbon::parse($mission->Date_Debut)->diff(Carbon::parse(Carbon::now()));
 
 
 
               
             return $interval->format('%a');;}
         }
         public static function Restante($id){
      
            $mission= Missions:: Missions($id)->first();
            if($mission !=null){
            $interval=Carbon::parse(Carbon::now())->diff(Carbon::parse($mission->Date_Fin));
 
 
               
             return $interval->format('%a ');;}
         }

        
       
}
