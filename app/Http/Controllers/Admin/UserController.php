<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\type_users;
use App\missions;
use App\documents;
use \Illuminate\Notifications\Notifiable;
use App\Notifications\AuthorPostApproved;
use App\Notifications\NewPostNotify;
use Illuminate\Support\Facades\Notification;
use Illuminate\support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;
use DB;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        return view('admin.users.index')->with('users',User::all());
    }
    public function mission()
    {   
        return view('admin.users.Affecter_Mission')->with('users',User:: Consultant_Salarié());
    }
    public function document()
    {   
        return view('admin.users.document')->with('type_users',type_users::all())->with('documents',documents::all());
    }
    public function pending()
    {   
        return view('admin.users.pending')->with('type_users',type_users::all())->with('documents',documents::all());
    }
    public function Affecter_Mission($id)
    {   $user=User::find($id);
        if( $user->type_users=="consultant")
        {
        return view('admin.users.Missions_Consultant')->with('user',$user);
        }
        else 
        if( $user->type_users=="salarié")
        {
        return view('admin.users.Mission_salarié')->with('user',$user);
        }
    }
   
   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' =>'required',
            'email' =>'required|unique:users_rh',
            'password' =>'required',
            'type_users' =>'required',

        ]);
       $user =new User;
       $user->type_users=$request->input('type_users');
       $user->name=$request->input('name');
       $user->email=$request->input('email');
   
       $user->password = bcrypt($request->input('password'));
  
       $user->save();
        return redirect()->route('admin.users.index');
    }
    public function CreateMission_Salarié(Request $request,$id)
    {
        //
        $request->validate([
            'Client' =>'required',
            'Responsable' =>'required',
            'Intitulé_Mission' =>'required',
           


        ]);
       $user =new Missions;
       $user->Client=$request->input('Client');
       $user->Responsable=$request->input('Responsable');
       
       $user->Intitulé_Mission=$request->input('Intitulé_Mission');
        
       $user->save();
       $user->Users()->sync($request->Users);
      
       $users = User::find($id);
      
      
       $users->is_affected=true;
       $users->save();
        return redirect()->route('admin.users.index');
    }
    public function CreateMission_Consultant(Request $request,$id)
    {
        //
        $request->validate([
            'Client' =>'required',
            'Responsable' =>'required',
            'Intitulé_Mission' =>'required',
            'Date_Debut' =>'required',
            'numéro_Bncmd_encours' =>'required',
            'Date_Fin' =>'required',
         


        ]);
       $user =new Missions;
       $user->Client=$request->input('Client');
       $user->Responsable=$request->input('Responsable');
       $user->Date_Debut=$request->input('Date_Debut');
       $user->Intitulé_Mission=$request->input('Intitulé_Mission');
       $user->numéro_Bncmd_encours=$request->input('numéro_Bncmd_encours');
       $user->Date_Fin=$request->input('Date_Fin');
       $user->save();
       $user->Users()->sync($request->Users);
      
       $users = User::find($id);
      
       $users->is_affected=true;
       $users->save();
        
     
        return redirect()->route('admin.users.index');
    }
    public function setPasswordAttribute($value){
        $this->attributes['password'] = bcrypt($value);
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
            return redirect()->route('admin.users.index');
            
        }
        return view('admin.users.edit')->with(['user'=>User::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(Auth::user()->id ==$id)
        {
            return redirect()->route('admin.users.index');
            
        }
        $request->validate([
            'name' =>'required',
            'type_users' =>'required',
            'email' =>'required',


        ]);
        $user = User::find($id);
        $user->type_users=$request->input('type_users');
        $user->name=$request->input('name');
        $user->email=$request->input('email');
   
        $user->save();
        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
      
    
        $doc= DB::table('documents_rh')
        ->join('documents_user_rh','documents_user_rh.documents_id','=','documents_rh.id')
        ->where('user_id',$id)
        ->delete();
        
       $user->documents()->detach();
       $user->delete();
        return redirect()->route('admin.users.index');
    }
    public function destroyDocument($id)
    {
        $document = documents::find($id);
        $document->delete();
        return redirect()->back();
    }
    public function destroyMission($id)
    {
        $mission = Missions::find($id);
        $user=User::find($mission->users()->first()->id);
       $user->is_affected=false;
       $user->save();
        $mission->users()->detach();
       
        $mission->delete();

        return redirect()->back();
    }
    public function approval($id)
    {
        $post = Documents::find($id);
        if ($post->is_approved == false)
        {
            $post->is_approved = true;
            $post->save();
            /** 
            $post->users->first()->notify(new AuthorPostApproved($post));
            $subscribers = User::all();
            foreach ($subscribers as $subscriber)
            {
                Notification::route('mail',$subscriber->email)
                    ->notify(new NewPostNotify($post));
            }
            **/

            Toastr::success('Post Successfully Approved :)','Success');
        } else {
            Toastr::info('This Post is already approved','Info');
        }
        return redirect()->back();
    }
 
}
