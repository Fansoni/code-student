<?php

namespace App\Http\Controllers;

use App\Models\Encarregado;
use App\Models\Endereco;
use App\Models\Estudante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class EstudanteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $estudantes = Estudante::with(['encarregado'])->paginate(5);
        return Inertia::render('Dashboard', [
            'estudantes' => $estudantes
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Estudante/Create');
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
            'nome' => ['required'],
            'data_nascimento' => ['required', 'date'],
            'serie_ingresso' => ['required', 'numeric'],
            'cep' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (!preg_match("/^[0-9]{5}-[0-9]{3}/", trim($value))) {
                        $fail('CEP inválido');
                    }
                },
            ],
            'rua' => ['required'],
            'numero' => ['required', 'numeric'],
            'complemento' => ['required'],
            'bairro' => ['required'],
            'cidade' => ['required'],
            'estado' => ['required'],
            'nome_mae' => ['required'],
            'cpf_mae' => ['required', 'formato_cpf', 'cpf'],
            'data_preferencial_mae' => ['required', 'date'],
        ], [
            'data_preferencial_mae.required' => "A data de pagamento é obrigatória.",
            'cpf_mae.required' => "CPF obrigatório.",
        ]);

        DB::beginTransaction();
        try {
            $endereco = Endereco::create([
                'cep' => $request->cep,
                'rua' => $request->rua,
                'numero' => $request->numero,
                'complemento' => $request->complemento,
                'bairro' => $request->bairro,
                'cidade' => $request->cidade,
                'estado' => $request->estado,
            ]);

            $encarregado = Encarregado::create([
                'nome' => $request->nome_mae,
                'cpf' => $request->cpf_mae,
                'data_pagamento' => $request->data_preferencial_mae,
            ]);

            $estudante = Estudante::create([
                'nome' => $request->nome,
                'data_nascimento' => $request->data_nascimento,
                'serie_ingresso' => $request->serie_ingresso,
                'endereco_id' => $endereco->id,
                'encarregado_id' => $encarregado->id
            ]);
            DB::commit();
            return back();
        } catch (\Throwable $th) {
            DB::rollback();
        }
        return back(500);
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
        $estudante = Estudante::with(['endereco', 'encarregado'])->find($id);
        return Inertia::render('Estudante/Edit', ['estudante' => $estudante]);
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
        $request->validate([
            'nome' => ['required'],
            'data_nascimento' => ['required', 'date'],
            'serie_ingresso' => ['required', 'numeric'],
            'cep' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (!preg_match("/^[0-9]{5}-[0-9]{3}/", trim($value))) {
                        $fail('CEP inválido');
                    }
                },
            ],
            'rua' => ['required'],
            'numero' => ['required', 'numeric'],
            'complemento' => ['required'],
            'bairro' => ['required'],
            'cidade' => ['required'],
            'estado' => ['required'],
            'nome_mae' => ['required'],
            'cpf_mae' => ['required', 'formato_cpf', 'cpf'],
            'data_preferencial_mae' => ['required', 'date'],
        ], [
            'data_preferencial_mae.required' => "A data de pagamento é obrigatória.",
            'cpf_mae.required' => "CPF obrigatório.",
        ]);

        DB::beginTransaction();
        try {
            $estudante = Estudante::find($id);
            $estudante->endereco->update([
                'cep' => $request->cep,
                'rua' => $request->rua,
                'numero' => $request->numero,
                'complemento' => $request->complemento,
                'bairro' => $request->bairro,
                'cidade' => $request->cidade,
                'estado' => $request->estado,
            ]);

            $estudante->encarregado->update([
                'nome' => $request->nome_mae,
                'cpf' => $request->cpf_mae,
                'data_pagamento' => $request->data_preferencial_mae,
            ]);

            $estudante->update([
                'nome' => $request->nome,
                'data_nascimento' => $request->data_nascimento,
                'serie_ingresso' => $request->serie_ingresso,
            ]);
            DB::commit();
            return back();
        } catch (\Throwable $th) {
            DB::rollback();
        }
        return back(500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $estudante = Estudante::find($id);
        $estudante->delete();

        return back()->with('message', 'success');
    }
}
