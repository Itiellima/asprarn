<div class="container">
    <aside class="w-64 min-h-screen bg-gray-800 p-4">
        <h2 class="text-xl font-bold mb-6">Dashboard: {{ auth()->user()->name }}</h2>
        <nav class="flex flex-col space-y-4">
            <a href="/dashboard" class="hover:bg-gray-700 p-2 rounded">🏠 Home</a>
            <a href="/usuarios" class="hover:bg-gray-700 p-2 rounded">👮​ Usuarios</a>
            <a href="#" class="hover:bg-gray-700 p-2 rounded">​📂 Projetos</a>
            <a href="" class="hover:bg-gray-700 p-2 rounded">⚙️ Configurações</a>
        </nav>
    </aside>



    @role('admin')
            <a href="/usuarios" class="nav-link px-2 border-bottom">Gerenciar Usuários</a>

            <div class="dropdown-center">
                <li class="nav-link dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Associado
                </li>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="/associado">Listar</a></li>
                </ul>
            </div>
        @endrole
</div>
