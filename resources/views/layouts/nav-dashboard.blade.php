<div class="container">
    <aside class="w-64 min-h-screen bg-gray-800 p-4">

        <h2 class="text-xl font-bold mb-6">Dashboard: {{ auth()->user()->name }}</h2>

        <nav>
            <a href="/dashboard" class="hover:bg-gray-700 p-2 rounded">🏠 Home</a>

            @auth
                @hasanyrole('admin|moderador')
                    <a href="/usuarios" class="hover:bg-gray-700 p-2 rounded">👮 Gerenciar Usuarios</a>
                    <a href="/associado" class="hover:bg-gray-700 p-2 rounded">👮 Listar Associados</a>
                @endhasanyrole
            @endauth

            <a href="#" class="hover:bg-gray-700 p-2 rounded">/​📂 Publicações</a>
            <a href="#" class="hover:bg-gray-700 p-2 rounded">⚙️ Configurações</a>


            @role('admin')
            @endrole
        </nav>

    </aside>


</div>
