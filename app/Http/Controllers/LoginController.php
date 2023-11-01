<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function index(){
        return view("login");
    }

    public function homeIndex(){
       return view("home");
    }

    public function registroindex(){
        return view("registro");
    }

    public function login(Request $request){
        $request->validate([
            "email" => 'required | email',
            "senha" => 'required'
        ]);

        $user = User::where("email", $request->email)->first();

        if(!$user){
            return redirect()->intended("login")->with("error", "E-mail inválido.");
        }

        if(password_verify($request->senha, $user->senha)){
            Auth::login($user, true);
            return redirect()->intended(route("home"));
        }

        return redirect()->intended(route("login"))->with("error", "Erro no login. Verifique os dados inseridos.");
    }

    public function registro(Request $request){
        $request->validate([
            'usuario' => 'required',
            'email' => 'required | email',
            'senha' => 'required'
        ]);

        $data['usuario'] = $request->usuario;
        if(User::where('email', $request->email)->first()){
            return redirect()->intended(route('registro'))->with('error', 'Email já cadastrado. Tente novamente.');
        }
        $data['email'] = $request->email;
        $Scripto = Hash::make($request->senha);
        $data['senha'] = $Scripto;

        $user = User::create($data);


        if($user){
            return redirect()->intended(route('login'))->with('sucess', 'O usuário foi registrado com sucesso.');
        }

        return redirect()->intended(route('registro'))->with('error', 'Ocorreu um erro no registro do usuário. Tente novamente.');
    }

    public function Desconectar(){
        Session::flush();
        Auth::logout();
        return redirect()->intended(route('home'));
    }
}
