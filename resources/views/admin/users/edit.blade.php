
@extends('layouts.app')

@section('content')

    <!-- Left Side Of Navbar -->
 

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Mise à jour utilisateur: ') }} {{$user->name}}</div>
                <form action="{{route('admin.users.update',['user'=>$user->id])}}" method="POST">
                    @csrf
                    {{method_field('PUT')}}
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="exampleInputEmail1">Role:</label>
                    <select class="form-control" name="type_users">
                        @foreach(["admin" => "admin", "consultant" => "consultant","salarié" => "salarié"] AS $type_users => $contactLabel)    
                        <option value="{{ $type_users }}" {{ old("type_users", $user->type_users) == $type_users ? "selected" : "" }}>{{ $contactLabel }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                        <label for="exampleInputEmail1">Nom:</label>
                        <input type="text" class="form-control" name="name"  placeholder={{$user->name}} required autocomplete="name" autofocus>
                        
                     
                      </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                        <label for="exampleInputEmail1">Email:</label>
                        <input type="email" class="form-control" name="email" @error('email') is-invalid @enderror placeholder={{$user->email}} required autocomplete="email" autofocus>
                      
                        @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        Update
                    </button>
                </form>
                <div class="card-body">
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection