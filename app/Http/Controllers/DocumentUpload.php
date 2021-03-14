<?php

namespace App\Http\Controllers;
use App\documents;
use App\User;
use Illuminate\support\Facades\Auth;
use Illuminate\Http\Request;
use App\Notifications\NewAuthorPost;
use Illuminate\Support\Facades\Notification;

class DocumentUpload extends Controller
{
    public function createForm(){
        return view('admin.users.index');
      }
    
      public function fileUpload(Request $req){
            $req->validate([
            'file' => 'required|mimes:csv,txt,xlx,xls,pdf,xlsx,doc,docx,zip|max:2048'
            ]);
    
            $fileModel = new documents;
    
            if($req->file()) {
                $fileName = $req->file->getClientOriginalName();
                $filePath = $req->file('file')->storeAs('uploads', $fileName, 'public');
                $filesize = $req->file('file')->getSize();
                $fileModel->name = $req->file->getClientOriginalName();
                $fileModel->file_path = '/storage/' . $filePath;
                $fileModel->file_size =(int) ($filesize/1000);
                if(Auth::user()->type_users=='admin')
                {
                    $fileModel->is_approved=true;
                    
                }
                $fileModel->save();
                $fileModel->type_users()->sync($req->type_users);
                $fileModel->Users()->sync($req->Users);
                $users = User::where('type_users','admin')->get();
                 Notification::send($users, new NewAuthorPost( $fileModel));
                 if(Auth::user()->type_users=='admin')
                {
                    return back()
                ->with('success','Vous  Fichier a été téléchargé.')
                ->with('file', $fileName);
                    
                }
                return back()
                ->with('warning','Votre Fichier est en attente d’approbation')
                ->with('file', $fileName);
            }
       }
       public function pending(){
           $document= Documents::where('is_approved',false)->get();
           return view('admin.users.pending',compact('posts'));
       }
      
}
