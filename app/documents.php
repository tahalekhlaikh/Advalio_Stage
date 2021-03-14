<?php

namespace App;
use App\type_users;
use App\User;
use Illuminate\Database\Eloquent\Model;
Use DB;
class documents extends Model
{protected $fillable = [
        'name',
        'file_path',
        'file_size'

    ];
    protected $table = 'documents_rh';
    public function type_users(){
        return $this->belongsToMany('App\type_users','documents_type_users_rh');   }
        public function hasAnytype_users($type_users){
            return null !==$this->type_users()->whereIn('name',$type_users)->first();
        
        }
        public function Users(){
            return $this->belongsToMany('App\User','documents_user_rh');   }
           
        public static function Documents_Salarié(){
            $documents_id = DB::table('documents_type_users_rh')->where('type_users_id', 2)->pluck('documents_id');
            $documents= DB::table('documents_rh')->whereIn( 'id',  $documents_id)->where( 'is_approved',  1)->get();
              
            return $documents;
        }
        public static function Documents_Consultant(){
            $documents_id = DB::table('documents_type_users_rh')->where('type_users_id', 1)->pluck('documents_id');
            $documents= DB::table('documents_rh')->whereIn( 'id',  $documents_id)->where( 'is_approved',  1)->get();
            
            return $documents;
        
        }
        public static function No_Documents_Approuvés($id){
            $data= DB::table('documents_rh')
            ->select('name')
            ->join('documents_user_rh','documents_user_rh.documents_id','=','documents_rh.id')
            ->where('user_id',$id)
            ->where( 'is_approved',  1)
            ->count();
            return  $data;
          
        }
        public static function Documents_Approuvés($id){
            $data= DB::table('documents_rh')
            ->select('name')
            ->join('documents_user_rh','documents_user_rh.documents_id','=','documents_rh.id')
            ->where('user_id',$id)
            ->where( 'is_approved',  1)
            ->get();
            return  $data;
          
        }
        public static function Documents_Non_Approuvés($id){
            
            $data= DB::table('documents_rh')
            ->select('name')
            ->join('documents_user_rh','documents_user_rh.documents_id','=','documents_rh.id')
            ->where('user_id',$id)
            ->where( 'is_approved',  0)
            ->get();
            return  $data;
        }
        public static function No_Documents_Non_Approuvés($id){
            
            $data= DB::table('documents_rh')
            ->select('name')
            ->join('documents_user_rh','documents_user_rh.documents_id','=','documents_rh.id')
            ->where('user_id',$id)
            ->where( 'is_approved',  0)
            ->count();
            return  $data;
        }
        public function hasAnytype_user($type_users){
            return null !==$this->type_users()->where('name',$type_users)->first();
        
        }
    //
}
