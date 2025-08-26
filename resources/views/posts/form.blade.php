<form action="{{ $post->exists ? route('posts.update', $post->id) : route('posts.store') }}" method="POST"
    enctype="multipart/form-data">
    @csrf

    @if ($post->exists)
        @method('PUT')
    @endif



    <div class="container row mb-3">
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Titulo da publicação</label>
            <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Titulo"
                value="{{ old('titulo', $post->titulo ?? '') }}">
            @error('titulo')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Assunto</label>
            <input type="text" class="form-control" id="assunto" name="assunto" placeholder="Assunto da publicação"
                value="{{ old('assunto', $post->assunto ?? '') }}">
            @error('assunto')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="formFile" class="form-label">Insira as fotos</label>
            <input class="form-control" type="file" id="img" name="img"
                {{ $post->exists ? '' : 'required' }}>
            @if ($post->exists && $post->img)
                <div class="mt-2">
                    <img id="preview-img" src="{{ asset('storage/' . $post->img) }}" width="120">
                </div>
            @else
                <img id="preview-img" style="display:none;" width="120">
            @endif
        </div>

        <div class="mb-3 col-3">
            <label for="exampleFormControlInput1" class="form-label">Data de referencia</label>
            <input type="date" class="form-control" id="data" name="data" placeholder="Data de inicio"
                value="{{ old('data', $post->data ? $post->data->format('Y-m-d') : '') }}">
            @error('data')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Texto do Post</label>
            <textarea class="form-control" id="texto" name="texto" rows="3" placeholder="Insira o texto do post aqui">{{ old('texto', $post->texto ?? '') }}</textarea>
            @error('texto')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">
            {{ $post->exists ? 'Salvar Alterações' : 'Criar Publicação' }}
        </button>

    </div>
</form>


<script>
    document.getElementById('img').addEventListener('change', function(event) {
        const preview = document.getElementById('preview-img');
        const file = event.target.files[0];
        if (file) {
            preview.src = URL.createObjectURL(file);
            preview.style.display = 'block';
        } else {
            preview.style.display = 'none';
        }
    });
</script>
