<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Noticia;
use App\Http\Requests\NoticiaRequest;
use App\Services\UploadService;

class NoticiaController extends Controller
{
    public function index()
    {
        $noticias = Noticia::where('status', Noticia::STATUS_ATIVO)->get();

        return view('noticias.index', [
            'noticias' => Noticia::where('status', Noticia::STATUS_ATIVO)->paginate(3)
        ]);
    }


    public function create()
    {
        return view('noticias.form');
    }

    public function edit(Noticia $noticia)
    {

        return view('noticias.edit', [
            'noticia' => $noticia
        ]);
    }

    public function store(NoticiaRequest $request)
    {
        $dados = $request->all();
        $dados['data_publicacao'] = Carbon::createFromFormat("d/m/Y", $dados['data_publicacao'])->format("Y-m-d");
        $dados['image'] = UploadService::upload($dados['imagem']);
        // $request->imagem->storeAs('public', $request->imagem->getClientOriginalName());
        // $dados['imagem'] = '/storage/' . $request->imagem->getClientOriginalName();
        // dd($dados);
        Noticia::create($dados);
        return redirect()->back()->with('mensagem', 'Registro criado com sucesso!');
    }

    public function update(NoticiaRequest $request, Noticia $noticia)
    {
        $dados = $request->all();
        $dados['data_publicacao'] = Carbon::createFromFormat("d/m/Y", $dados['data_publicacao'])->format("Y-m-d");
        
        if ($request->imagem) {
            $dados['imagem'] = UploadService::upload($request->imagem);
            // $request->imagem->storeAs('public', $request->imagem->getClientOriginalName());
            // $dados['imagem'] = '/storage/' . $request->imagem->getClientOriginalName();
        }
        $noticia->update($dados);

        return redirect()->back()->with('mensagem', 'Registro atualizado com sucesso!');
    }

    public function delete(Noticia $noticia)
    {
        $noticia->delete();

        return redirect('/noticias')->with('mensagem', 'Registro excluído com sucesso!');
    }
}
