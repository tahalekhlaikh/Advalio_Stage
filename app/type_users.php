<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\documents;
class type_users extends Model
{ 
    
    
       /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'type_users_rh';
    
    /**
    * The table associated with the model.
    *
    * @var string
    */

    public function documents(){
        return $this->belongsToMany('App\documents','documents_rh');  
    }

    //
}
