<?php

namespace App\Http\Controllers;

use App\Models\Lista;
use App\Models\Tarefas;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TarefasController extends Controller
{
    public function mtIndex(){
        $listas = Lista::where("user_id", Auth::id())->get();

        return view("minhastarefas", compact('listas'));
    }

    public function index(){
        return view("crialista");
    }

    public function tarefaIndex($listaId){
        $lista = Lista::find($listaId);

        $tarefas = Tarefas::where("lista_id", $listaId)->get();

        try{
            $dataFormat = $this->exibirData($lista->data);
        }catch(\Exception $e){
            return redirect()->route('mt')->with('sucess', 'A lista foi excluída.');
        }

        if($lista == null){
            redirect()->intended(route('mt'))->with('error', 'A lista foi excluída ou não existe.');;
        }

        $idUser = Auth::id();
        if($idUser == $lista->user_id){
            return view("tarefa", compact('tarefas', 'lista', 'dataFormat'));
        }

        return redirect()->intended(route('mt'))->with('error', 'Não tem permissão para ver essa lista.');
    }

    public function tarefasPost(Request $request, $listaId){
        $request->validate([
            "nome" => 'required',
            "tempo"=> 'nullable'
        ]);

        $tarefas = [];

        $banco['nome'] = $request->nome;
        $banco['tempo'] = $request->tempo;
        $banco['status'] = 0;
        $banco['lista_id'] = $listaId; 

        if(Tarefas::where('lista_id', $listaId)->count() <= 9){
            $tarefas = Tarefas::create($banco);
        }

        if(Tarefas::where('lista_id', $listaId)->count() > 9){
            return redirect()->intended(route('tarefas', ['id' => $listaId]))->with('error', 'A lista já possui 10 tarefas. Não é possível criar mais.');
        }

        if($tarefas){
            return redirect()->intended(route('tarefas', ['id' => $listaId]))->with('sucess', 'A tarefa foi criada com sucesso.');
        }

        return redirect()->intended(route('tarefas', ['id' => $listaId]))->with('error', 'Ocorreu um erro na criação da tarefa. Tente novamente.');
    }

    public function listaPost(Request $request){

        if($request->titulo == ''){
            return redirect()->intended(route('criaLista'))->with('error', 'Ocorreu um erro na criação da lista. Tente novamente.');
        }

        $request->validate([
            "titulo" => 'required',
            "data"=>  'nullable'
        ]);

        $banco['titulo'] = $request->titulo;
        $banco['user_id'] = Auth::id();
        if($request->data >= date("Y-m-d")){
            $banco['data'] = $request->data;
        }
        else{
            return redirect()->intended(route('criaLista'))->with('error', 'A data inválida. Escolha uma data maior ou igual que a atual.');
        }

        $lista = Lista::create($banco);
        
        if($lista){
            return redirect()->intended(route('tarefas', ['id' => $lista->id]))->with('sucess', 'A lista foi criada com sucesso.');
        }

        if(Auth::check()){
            return redirect()->intended(route('criaLista'))->with('error', 'Ocorreu um erro na criação da lista. Tente novamente.');
        }
        else{
            return redirect()->intended(route('login'))->with('error', "Sessão expirada. Faça login novamente");
        }
    }

    public function listaAlter(Request $request, $listaId){

        $banco = [];
        $lista = [];

        if($request->titulo){
            $banco['titulo'] = $request->titulo;
        } 
        
        if($request->data){
            $banco['data'] = $request->data;
        }

        if($banco){
            $lista = Lista::where('id', $listaId)->update($banco);
        }

        if($lista){
          return redirect()->intended(route('tarefas', ['id' => $listaId]))->with('sucess', 'A lista foi alterada com sucesso.');
        }

        return redirect()->intended(route('tarefas', ['id' => $listaId]))->with('error', 'Ocorreu um erro na alteração da lista. Tente novamente.');
    }

    public function exibirData($data){
        $dataFormatada = Carbon::parse($data)->format('d-m-Y');
        return $dataFormatada;
    }

    public function listaEx($listaId){
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        $tarefa = Tarefas::where('lista_id', $listaId)->delete();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
        $lista = Lista::where('id', $listaId)->delete();

        if(!$lista){
            if(!$tarefa){
                return redirect()->intended(route('mt'))->with('sucess', 'A lista foi deletada com sucesso.');
            }
        }

        return redirect()->intended(route('tarefas', ['id' => $listaId]))->with('error', 'Ocorreu um erro ao deletar a lista. Tente novamente.');
    }

    public function tarefaEx($listaId, $tarefaId){

        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        $tarefa = Tarefas::where('id', $tarefaId)->delete();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        if($tarefa){
            return redirect()->intended(route('tarefas', ['id' => $listaId]))->with('sucess','A tarefa foi excluída com sucesso.');
        }

        return redirect()->intended(route('home'))->with('error','Ocorreu um erro ao excluir a tarefa. Tente novamente.');
    }

    public function tarefaAlter(Request $request, $listaId, $tarefaId){

        $banco = [];
        $tarefa = [];

        if($request->nome){
            $banco['nome'] = $request->nome;
        } 
        
        if($request->tempo){
            $banco['tempo'] = $request->tempo;
        }

        if($request->status == 1){
            $banco['status'] = $request->status;
        } 
        else{
            if ($request->status == null){
                $banco['status'] = 0;
            }
        }
        

        if($banco){
            $tarefa = Tarefas::where('id', $tarefaId)->update($banco);
        }

        if($tarefa){
          return redirect()->intended(route('tarefas', ['id' => $listaId]))->with('sucess', 'A tarefa foi alterada com sucesso.');
        }

        return redirect()->intended(route('home'))->with('error', 'Ocorreu um erro ao deletar a lista. Tente novamente.');
    }
}
