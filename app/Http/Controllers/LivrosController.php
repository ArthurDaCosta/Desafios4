<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Livro;
use PDOException;


class LivrosController extends Controller
{
    public function index()
    {
      try{
        $livros = Livro::all();
      } catch (PDOException $e) {
        return view('livros.index')
          ->with('error', 'Erro ao buscar livros: ' . $e->getMessage());
      }

      if ($livros->isEmpty()) {
        return view('livros.index')
          ->with('error', 'Nenhum livro encontrado.');
      }

      return view('livros.index', compact('livros'));
    }

    public function indexID(string $id)
    {
      try{
        $livros = Livro::find($id);
      } catch (PDOException $e) { 
        return view('livros.index')
          ->with('error', 'Erro ao buscar livro: ' . $e->getMessage());
      }

      if (is_null($livros)) {
        return view('livros.index')
          ->with('error', "Livro de ID = $id não encontrado.");
      }

      return view('livros.index', compact('livros'));
    }

    public function showFilter(Request $request)
    {
      $request->validate([
        'título' => 'string|max:255',
        'autor' => 'string|max:255',
        'gênero' => 'string|max:255',
        'data_inicial' => 'date',
        'data_final' => 'date'
      ]);
      
      try{
        $livros = Livro::query();

        if ($request->has(['data_inicial'])) {
          $livros->where('data_publicação', '>=', $request->data_inicial);
        }
        
        if ($request->has(['data_final'])) {
          $livros->where('data_publicação', '<=', $request->data_final);
        }

        $livros->where($request->only(['título', 'autor', 'gênero']));
        $livros = $livros->get();
      } catch (PDOException $e) {
        return view('livros.index')
          ->with('error', 'Erro ao filtrar livros: ' . $e->getMessage());
      }

      if ($livros->isEmpty()) {
        return view('livros.index')
          ->with('error', 'Nenhum livro encontrado.');
      }

      return view('livros.index', compact('livros'))
        ->with('success', 'Livros filtrados com sucesso.');
    }

    public function store(Request $request)
    {
      $request->validate([
          'título' => 'required|string|max:255',
          'autor' => 'required|string|max:255',
          'data_publicação' => 'required|date|before:tomorrow',
          'gênero' => 'required|string|max:255|in:Romance,Clássico,Ficção,Mistério,Ação,Drama',
          'páginas' => 'required|integer|min:1'
      ]);

      try{
        Livro::create($request->all());
      } catch (PDOException $e) {
        return view('livros.index')
          ->with('error', 'Erro ao inserir livro: ' . $e->getMessage());
      }

      return redirect()->route('livros.indexAll');
    }

    public function update(Request $request, string $id)
    {
      try{
        $livros = Livro::find($id);
      } catch (PDOException $e) {
        return view('livros.index')
          ->with('error', 'Erro ao atualizar livro: ' . $e->getMessage());
      }

      if (is_null($livros)) {
        return view('livros.index', compact('livros'))
          ->with('error', "Livro de ID = $id não encontrado.");
      }

      $request->validate([
        'título' => 'string|max:255',
        'autor' => 'string|max:255',
        'data_publicação' => 'date|before:tomorrow',
        'gênero' => 'string|max:255|in:Romance,Clássico,Ficção,Mistério,Ação,Drama',
        'páginas' => 'integer|min:1'
      ]);  

      try{
        $livros->update($request->all());
      } catch (PDOException $e) {
        return view('livros.index')
          ->with('error', 'Erro ao atualizar livro: ' . $e->getMessage());
      }

      return view('livros.index', compact('livros'))
        ->with('success', "Livro de ID = $id atualizado com sucesso.");
    }

    public function destroy(string $id)
    {
        try{
          $livros= Livro::find($id);
        } catch (PDOException $e) {
          return view('livros.index')
            ->with('error', 'Erro ao deletar livro: ' . $e->getMessage());
        }

        if (is_null($livros)) {
          return view('livros.index')
            ->with('error', "Livro de ID = $id não encontrado.");
        }

        try {
          $livros->delete();
        } catch (PDOException $e) {
          return view('livros.index')
            ->with('error', 'Erro ao deletar livro: ' . $e->getMessage());
        }

        return view('livros.index', compact('livros'))
          ->with('success', "Livro de ID = $id deletado com sucesso.");
    }
}
