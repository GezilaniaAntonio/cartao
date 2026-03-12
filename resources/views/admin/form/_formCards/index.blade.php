
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Cadastro do projeto</h5>

            <form class="row g-3" method="POST" action="{{ route('admin.projects.store') }}">

                @csrf

                <div class="col-md-12 mb-3">
                    <input type="text" name="name" class="form-control" placeholder="Nome"
                        value="{{ old('name', $project->name ?? '') }}">
                </div>

                <div class="col-md-12 mb-3">
                    <textarea name="description" class="form-control" rows="5" placeholder="Descrição">{{ old('description', $project->description ?? '') }}</textarea>
                </div>
                 <div class="col-md-12 mb-3">
                    <label for="image_path" class="form-label">Imagem do Projeto</label>
                    <input type="file" id="image_path" name="image_path"
                        class="form-control @error('image_path') is-invalid @enderror" accept="image/*">

                    {{-- Corrigido de 'photo' para 'image' --}}
                    @error('image_path')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">
                        Cadastrar
                    </button>
                </div>

            </form>

        </div>
    </div>

