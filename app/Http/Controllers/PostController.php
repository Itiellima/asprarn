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

        return view('posts.create');
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

        $path = $request->file('img')->store('posts', 'public');

        $user->posts()->create([
            'titulo' => $request->titulo,
            'assunto' => $request->assunto,
            'img' => $path,
            'data' => $request->data,
            'texto' => $request->texto,
        ]);


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
            'img' => 'required|file|mimes:jpg,jpeg,png|max:2048',
            'texto' => 'required|string|max:5000',
            'data' => 'required|data',
        ]);

        if ($request->hasFile('img')) {
            if ($post->img && Storage::Disk('public')->exists($post->img)) {
                Storage::disk('public')->delete($post->img);
            }

            $post->img = $request->file('img')->store('posts', 'public');
        }

        $post->update([
            'titulo' => $request->titulo,
            'assunto' => $request->assunto,
            'texto' => $request->texto,
            'data' => $request->data,
        ]);


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
}
