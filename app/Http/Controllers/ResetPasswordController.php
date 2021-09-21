<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    public function forgotPassword(Request $req) {
        $rules = [
            'email' => 'required|email'
        ];
    
        $customMessages = [
            'email.required' => 'E-mail não informado.'
        ];

        $this->validate($req, $rules, $customMessages);

        $user = User::where('email','=', $req->email)->first();

        if(!$user) {
            return back()->with('fail','Nenhuma conta encontrada com este e-mail.');
        }

        $token = Str::random(40);
        $host = $_SERVER['HTTP_HOST'];   
        
        $link = "http://$host/reset-password/$token";

        require 'PHPMailer/vendor/autoload.php';
        $mail = new PHPMailer(true);
        $mail->CharSet = "UTF-8";
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host = 'smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Username = 'edc07a70fc261b';
        $mail->Password = 'c0ca5d2ec37d27';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 2525;
        $mail->setFrom('binaryshop@info.com','BinaryShop');
        $mail->addAddress($req->email);
        $mail->isHTML(true);
        $mail->Subject = 'BinaryShop - Recuperação de Senha';
        $mail->Body = '<h1 style="margin: 15px auto; text-align: center;">BinaryShop</h1>' 
        . '<p style="margin: 15px auto; text-align: center;">Olá ' . $user->name 
        . ', um reset de senha foi requisitado! <br><br>Clique no link para ser redirecionado:</p><a style="' 
        . 'display: flex; justify-content: center; align-items: center; margin: 0 auto;' 
        . 'text-align: center;" href="' . $link . '">Resetar senha</a>';
        $dt = $mail->send();

        if(!$dt) {
            return back()->with('fail','Algo deu errado.');
        }

        if (DB::table('password_resets')->where('email', $req->email)->exists()) {
            $query = DB::table('password_resets')->
            where('email', $req->email)->update([
                'token'=>$token
            ]);
        } else {
            $query = DB::table('password_resets')->insert([
                'email'=>$req->email,
                'token'=>$token,
                "created_at" => date('Y-m-d H:i:s')
            ]);
        }

        return redirect('login')->with('success','Código de recuperação enviado para seu e-mail.');
    }

    public function resetView(Request $req, $token) {
        $tokenData = DB::table('password_resets')->where('token','=', $token)->first();

        if(!$tokenData) {
            return  back()->with('fail','Um erro de conexão ocorreu. Tente novamente.');
        }

        $email = DB::table('password_resets')->where('token','=', $token)->value('email');

        return view('auth/resetPassword', compact('email','token'));
    }

    public function resetPassword(Request $req) {
        $tokenData = DB::table('password_resets')->where('token','=', $req->token)->first();

        if(!$tokenData) {
            return  back()->with('fail','Sessão expirada.');
        }

        $rules = [
            'password'=>'required|min:5|max:12',
            'repeatpw'=>'required'
        ];
    
        $customMessages = [
            'password.required' => 'O campo senha não foi preenchido.',
            'repeatpw.required' => 'Confirme sua senha.',
            'password.min' => 'É necessário no mínimo 5 caracteres na senha.',
            'password.max' => 'É necessário no máximo 12 caracteres na senha.'
        ];

        $this->validate($req, $rules, $customMessages);

        $encryptedPassword = Hash::make($req->password);

        if(!Hash::check($req->repeatpw, $encryptedPassword)) {
            return back()->withInput()->with('fail','As senhas não estão de acordo!');
        }

        $query = DB::table('users')->
        where('email', $req->email)->update([
            'password'=>$encryptedPassword,
        ]);

        if(!$query) {
            return redirect('forgot-password')->with('fail','Algo deu errado!');   
        }

        $query = DB::table('password_resets')->where('token','=', $req->token)->delete();

        if(!$query) {
            return redirect('forgot-password')->with('fail','Algo deu errado!');   
        }

        return redirect('login')->with('success','Senha alterada com sucesso!');
    }

    public function redirect() {
        return back()->with('fail','Algo deu errado.');
    }
}