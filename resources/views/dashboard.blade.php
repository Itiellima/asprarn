<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar Tailwind</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex">
    <!-- Sidebar -->
    <aside class="w-64 min-h-screen bg-gray-800 text-white p-4">
        <h2 class="text-xl font-bold mb-6">Menu</h2>
        <nav class="flex flex-col space-y-4">
            <a href="/" class="d-inline-flex align-items-center text-decoration-none">
                <img src="/img/Aspra.png" alt="Logo" width="110" height="70" class="me-2">
                <span class="fs-5 fw-bold"></span>
            </a>
            <a href="#" class="hover:bg-gray-700 p-2 rounded">🏠 Home</a>
            <a href="#" class="hover:bg-gray-700 p-2 rounded">📂 Projetos</a>
            <a href="#" class="hover:bg-gray-700 p-2 rounded">⚙️ Configurações</a>
        </nav>
    </aside>

    <!-- Conteúdo -->
    <main class="flex-1 p-6">
        <h1 class="text-2xl font-bold">Conteúdo principal</h1>
        <p class="mt-4">Texto de exemplo dentro da área principal.</p>
    </main>
</body>

</html>
