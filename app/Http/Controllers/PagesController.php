<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
class PagesController extends Controller
{
    public function index()
    {    if (Auth::check())
        {
          
        switch (Auth::user()->type_users) {
            case 'admin':
                return redirect('admin/users');
                break;

            case 'salarié':
                return redirect('salarié/dashboard');
                break;

            case 'consultant':
                return redirect('consultant/dashboard');
                break;
            
            default;
             abort(403);
                break;
    }
}
if (Auth::guest()){
    return view('auth.login');

} 
else abort(403);
}
    public function About()
    {
        return view('pages.about');
    }
    public function services()
    {
        return view('pages.services');
    }
}
