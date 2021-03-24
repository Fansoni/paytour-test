<?php

namespace App\Http\Controllers;

use App\Mail\EmailCandidato;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class PaytourController extends Controller
{
    public function index()
    {
        $escolaridades = DB::table('escolaridades')->get(); //get all escolaridades
        return view('welcome', ['escolaridades' => $escolaridades]);
    }

    public function createCandidato(Request $request)
    {
        //Validadar todas as entradas
        $validator = Validator::make($request->all(), [
            'nome' => ['required'],
            'email' => ['required', 'email'],
            'telefone' => ['required', 'numeric'],
            'cargo' => ['required'],
            'escolaridade' => ['required'],
            'arquivo' => ['required', 'file', 'mimes:doc,docx,pdf', 'max:1024'],
        ], [
            'nome.required' => 'O campo :attribute é obrigatório',
            'email.required' => 'O campo :attribute é obrigatório',
            'email.email' => 'Insira um e-mail válido',
            'telefone.required' => 'O campo :attribute é obrigatório',
            'cargo.required' => 'O campo :attribute é obrigatório',
            'escolaridade.required' => 'O campo :attribute é obrigatório',
            'arquivo.required' => 'O campo :attribute é obrigatório',
            'arquivo.max' => 'O arquivo deve ter no máximo 1MB de tamanho',
            'arquivo.mimes' => 'Arquivo não suportado, insira um do tipo .doc, .docx, ou .pdf',
            'arquivo.*' => 'Houve uma falha ao submeter o arquivo',
        ]);

        if($validator->fails()){
            return back()->withErrors($validator->errors()->messages());
        }

       DB::beginTransaction();
        try {
            //Upload de ficheiros
            $fileName = null;
            if(isset($request->arquivo)){
                $fileName = time().'.'.$request->arquivo->extension();
                $request->arquivo->move(public_path('uploads/candidatos'), $fileName);
            }

            //Inserir candidato
            DB::table('candidatos')->insert([
                'nome' => $request->nome,
                'email' => $request->email,
                'telefone' => $request->telefone,
                'cargo' => $request->cargo,
                'escolaridade_id' => $request->escolaridade,
                'observacao' => $request->observacao,
                'arquivo' => $fileName,
                'ip' => $request->ip(),
                'created_at'    =>  new \DateTime(),
                'updated_at'    =>  new \DateTime()
            ]);
            DB::commit();
            $escolaridade = DB::table('escolaridades')->find($request->escolaridade);
            //Envio de email
            Mail::to('fansonidealmeida@gmail.com')->send(new EmailCandidato([
                'nome' => $request->nome,
                'email' => $request->email,
                'telefone' => $request->telefone,
                'cargo' => $request->cargo,
                'escolaridade' => $escolaridade->nome,
                'observacao' => $request->observacao,
                'arquivo' => $fileName,
                'data_envio'    =>  new \DateTime(),
            ]));
            return back()->with('successMessage', 'Cadastro feito com sucesso');
        } catch (\Throwable $th) {
            DB::rollback();
        }
        return back()->withErrors(['errors', 'Ocorreu um erro durante o cadastro, verifique os seus dados']);
    }
}
