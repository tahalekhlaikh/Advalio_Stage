<?php

namespace App;
use Auth;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\ResetPassword as ResetPasswordNotification;
use Illuminate\Database\Eloquent\Model;
use App\documents;
use App\missions;
Use DB;
class User extends Authenticatable 
{
    use Notifiable;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users_rh';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','type_users','CIN','numéro_CNSS','Adresse','téléphone','situation_familiale','Date_entrée','nbr_enfant','Materiel_Pc','Materiel_Voiture','Materiel_Télé'
    ];
       

   
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

 
public function isRole(){
    return $this->type_users;
}
public function sendPasswordResetNotification($token)
    {
        // Your your own implementation.
        $this->notify(new ResetPasswordNotification($token));
    }
    public function documents(){
        return $this->belongsToMany('App\documents','documents_user_rh');  
    }
    public function missions(){
        return $this->belongsToMany('App\missions','missions_user_rh');  
    }
    public function Cra(){
        return $this->belongsToMany('App\Cra');  
    }
    public static function Consultant_Salarié(){
      
        $documents= DB::table('users_rh')->whereIn( 'type_users',  ['salarié','consultant'])->get();
          
        return $documents;
    }
    public static function Mission_id($id)
    {
        $data= DB::table('missions_user_rh')
            ->where('user_id',$id)
            ->value('missions_id');
        
         if ($data==null){return 1;}
         else
            return  $data;
       
    }
    public static function Mission($id)
    {
        $data= DB::table('missions_rh')
        ->join('missions_user_rh','missions_user_rh.missions_id','=','missions_rh.id')
        ->where('user_id',$id)
        ->first();
       
    return $data;
       
    }


}
