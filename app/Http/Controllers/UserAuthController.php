<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserAuthController extends Controller
{
    public function userRegister(Request $req){
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password'=>'required|min:5|max:12',
            'repeatpw'=>'required'
        ];
    
        $customMessages = [
            'name.required' => 'O campo nome não foi preenchido.',
            'email.required' => 'O campo e-mail não foi preenchido.',
            'password.required' => 'O campo senha não foi preenchido.',
            'repeatpw.required' => 'Confirme sua senha.',
            'email' => 'E-mail inválido.',
            'email.unique' => 'Este e-mail já está em uso.',
            'password.min' => 'É necessário no mínimo 5 caracteres na senha.',
            'password.max' => 'É necessário no máximo 12 caracteres na senha.'
        ];

        $this->validate($req, $rules, $customMessages);

        $encryptedPassword = Hash::make($req->password);

        if(!Hash::check($req->repeatpw, $encryptedPassword)) {
            return back()->withInput()->with('fail','As senhas não estão de acordo!');
        }

        $query = DB::table('users')->insert([
            'name'=>$req->name,
            'email'=>$req->email,
            'password'=>$encryptedPassword,
            'is_admin'=>$req->is_admin,
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ]);

        if(!$query) {
            return back()->withInput()->with('fail','Algo deu errado!');   
        }

        return redirect('login')->with('success','Conta criada com sucesso!');
    }

    public function userLogin(Request $req) {
        $rules = [
            'email' => 'required|email',
            'password'=>'required|min:5|max:12',
        ];
    
        $customMessages = [
            'email.required' => 'O campo e-mail não foi preenchido.',
            'password.required' => 'O campo senha não foi preenchido.',
            'password.min' => 'É necessário no mínimo 5 caracteres na senha.',
            'password.max' => 'É necessário no máximo 12 caracteres na senha.'
        ];
    
        $this->validate($req, $rules, $customMessages);

        $user = User::where('email','=', $req->email)->first();

        if(!$user) {
            return back()->withInput()->with('fail','Nenhuma conta encontrada com este e-mail.');
        }

        if(!Hash::check($req->password, $user->password)){
            return back()->withInput()->with('fail','Senha inválida!');
        } else {
            $req->session()->put('LoggedUser', $user->id);
            return redirect('/');
        }
    }

    public function logout() {
        if(session()->has('LoggedUser')) {
            session()->pull('LoggedUser');
            return redirect('login');   
        }
    }
}