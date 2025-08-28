<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (!$user || !$user->hasAnyRole(['admin', 'moderador'])) {
            return redirect()->back()->with('error', 'Acesso negado. Você não tem permissão para acessar esta página.');
        }

        $posts = Post::with('user')->latest()->paginate(10);

        return view('posts.index', compact('posts'));
    }

    public function create()
    {

        $user = Auth::user();

        if (!$user || !$user->hasAnyRole(['admin', 'moderador'])) {
            return redirect()->back()->with('error', 'Acesso negado. Você não tem permissão para acessar esta página.');
        }

        $post = new Post();

        return view('posts.create', compact('post'));
    }

    public function show($id)
    {
        $user = Auth::user();

        if (!$user || !$user->hasAnyRole(['admin', 'moderador'])) {
            return redirect()->back()->with('error', 'Acesso negado. Você não tem permissão para acessar esta página.');
        }

        $post = Post::findOrFail($id);

        return view('posts.show', compact('post'));
    }

    public function store(Request $request)
    {

        $user = Auth::user();
        if (!$user || !$user->hasAnyRole(['admin', 'moderador'])) {
            return redirect()->back()->with('error', 'Acesso negado. Você não tem permissão para acessar esta página.');
        }

        $request->validate([
            'titulo' => 'required|string|max:255',
            'assunto' => 'required|string|max:500',
            'img' => 'required|file|mimes:jpg,jpeg,png|max:2048',
            'texto' => 'required|string|max:5000',
            'data' => 'required|date',
        ]);


        $arquivos = $request->file('img');

        // Se for apenas um arquivo, transforma em array
        if (!is_array($arquivos)) {
            $arquivos = [$arquivos];
        }

        foreach ($arquivos as $arquivo) {
            $path = $arquivo->store('img', 'public');

            $user->files()->create([
                'tipo_documento' => $request->tipo_documento,
                'path' => $path,
                'status' => 'pendente',
                'observacao' => $request->observacao,
            ]);
        }


        return redirect()->route('posts.index')->with('success', 'Post criado com sucesso!');
    }

    public function update(Request $request, $id)
    {
        $user = Auth::user();
        if (!$user || !$user->hasAnyRole(['admin', 'moderador'])) {
            return redirect()->back()->with('error', 'Acesso negado. Você não tem permissão para acessar esta página.');
        }

        $post = Post::findOrFail($id);

        $request->validate([
            'titulo' => 'required|string|max:225',
            'assunto' => 'required|string|max:500',
            'img' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
            'texto' => 'required|string|max:5000',
            'data' => 'required|date',
        ]);

        $data = [
            'titulo' => $request->titulo,
            'assunto' => $request->assunto,
            'texto' => $request->texto,
            'data' => $request->data,
        ];

        if ($request->hasFile('img')) {
            if ($post->img && Storage::disk('public')->exists($post->img)) {
                Storage::disk('public')->delete($post->img);
            }
            $data['img'] = $request->file('img')->store('posts', 'public');
        }

        $post->update($data);

        return redirect()->route('posts.index')->with('success', 'Publicação atualizada com sucesso!');
    }



    public function destroy($id)
    {

        $user = Auth::user();
        if (!$user || !$user->hasAnyRole(['admin', 'moderador'])) {
            return redirect()->back()->with('error', 'Acesso negado. Você não tem permissão para acessar esta página.');
        }

        $post = Post::findOrFail($id);
        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Publicação excluida com sucesso!');
    }

    public function edit($id)
    {
        $user = Auth::user();
        if (!$user || !$user->hasAnyRole(['admin', 'moderador'])) {
            return redirect()->back()->with('error', 'Acesso negado. Você não tem permissão para acessar esta página.');
        }

        $post = Post::findOrFail($id);

        return view('posts.create', compact('post'));
    }
}
