<div class="card">
    <div class="card-body">
        <h5 class="card-title">Cadastro da Pessoa</h5>

        <form class="row g-3" method="POST" action="{{ route('card.store')}}">
            @csrf

            <div class="col-md-6">
                <label>Nome Completo</label>
                <input type="text" name="name" class="form-control"
                    value="{{ old('name', $card->name ?? '') }}">
            </div>

            <div class="col-md-6">
                <label>Fotografia</label>
                <input type="file" name="image" class="form-control">
            </div>

            <div class="col-md-6">
                <label>Nome do Pai</label>
                <input type="text" name="father_name" class="form-control"
                    value="{{ old('father_name', $card->father_name ?? '') }}">
            </div>

            <div class="col-md-6">
                <label>Nome da Mãe</label>
                <input type="text" name="mother_name" class="form-control"
                    value="{{ old('mother_name', $card->mother_name ?? '') }}">
            </div>

            <div class="col-md-6">
                <label>Data de Nascimento</label>
                <input type="date" name="date_of_birth" class="form-control"
                    value="{{ old('date_of_birth', $card->date_of_birth ?? '') }}">
            </div>

            <div class="col-md-6">
                <label>Local de Nascimento</label>
                <input type="text" name="birth_place" class="form-control"
                    value="{{ old('birth_place', $card->birth_place ?? '') }}">
            </div>

            <div class="col-md-6">
                <label>Estado Civil</label>
                <input type="text" name="marital_status" class="form-control"
                    value="{{ old('marital_status', $card->marital_status ?? '') }}">
            </div>

            <div class="col-md-6">
                <label>Profissão</label>
                <input type="text" name="profession" class="form-control"
                    value="{{ old('profession', $card->profession ?? '') }}">
            </div>

            <div class="col-md-6">
                <label>Endereço</label>
                <input type="text" name="address" class="form-control"
                    value="{{ old('address', $card->address ?? '') }}">
            </div>

            <div class="col-md-6">
                <label>Data de Entrada na China</label>
                <input type="date" name="entry_date" class="form-control"
                    value="{{ old('entry_date', $card->entry_date ?? '') }}">
            </div>

            <div class="col-md-6">
                <label>Documento Apresentado</label>
                <input type="text" name="document_number" class="form-control"
                    value="{{ old('document_number', $card->document_number ?? '') }}">
            </div>

            <div class="col-md-6">
                <label>Local de Emissão</label>
                <input type="text" name="place_of_issue" class="form-control"
                    value="{{ old('place_of_issue', $card->place_of_issue ?? '') }}">
            </div>

            <div class="col-md-6">
                <label>Data de Emissão</label>
                <input type="date" name="date_of_issue" class="form-control"
                    value="{{ old('date_of_issue', $card->date_of_issue ?? '') }}">
            </div>

            <div class="col-md-6">
                <label>Data de Expiração</label>
                <input type="date" name="expiry_date" class="form-control"
                    value="{{ old('expiry_date', $card->expiry_date ?? '') }}">
            </div>

            <div class="col-12 text-center">
                <button type="submit" class="btn btn-primary">
                    Cadastrar
                </button>
            </div>

        </form>
    </div>
</div>