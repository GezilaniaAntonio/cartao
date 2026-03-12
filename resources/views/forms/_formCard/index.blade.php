<div class="card">
    <div class="card-body">
        <h5 class="card-title">Cadastro de Emissão de Cartão</h5>
        
      @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

        <form class="row g-3" method="POST" action="{{ route('admin.dash.store') }}" enctype="multipart/form-data">
            @csrf

            <!-- DADOS PESSOAIS -->
            <div class="col-md-6">
                <label class="form-label">Nome Completo</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
            </div>

            <div class="col-md-3">
                <label class="form-label">Nome do Pai</label>
                <input type="text" name="father_name" class="form-control" value="{{ old('father_name') }}" required>
            </div>

            <div class="col-md-3">
                <label class="form-label">Nome da Mãe</label>
                <input type="text" name="mother_name" class="form-control" value="{{ old('mother_name') }}" required>
            </div>

            <div class="col-md-3">
                <label class="form-label">Data de Nascimento</label>
                <input type="date" name="date_of_birth" class="form-control" value="{{ old('date_of_birth') }}" required>
            </div>

            <div class="col-md-3">
                <label class="form-label">Local de Nascimento</label>
                <input type="text" name="birth_place" class="form-control" value="{{ old('birth_place') }}" required>
            </div>

            <div class="col-md-3">
                <label class="form-label">Estado Civil</label>
                <select name="marital_status" class="form-select" required>
                    <option value="">Selecione...</option>
                    <option value="SOLTEIRO" {{ old('marital_status') == 'SOLTEIRO' ? 'selected' : '' }}>SOLTEIRO</option>
                    <option value="CASADO" {{ old('marital_status') == 'CASADO' ? 'selected' : '' }}>CASADO</option>
                    <option value="DIVORCIADO" {{ old('marital_status') == 'DIVORCIADO' ? 'selected' : '' }}>DIVORCIADO</option>
                    <option value="VIUVO" {{ old('marital_status') == 'VIUVO' ? 'selected' : '' }}>VIUVO</option>
                </select>
            </div>

            <div class="col-md-3">
                <label class="form-label">Profissão</label>
                <input type="text" name="profession" class="form-control" value="{{ old('profession') }}" required>
            </div>

            <!-- DADOS DE RESIDÊNCIA E DOCUMENTO -->
            <div class="col-md-8">
                <label class="form-label">Endereço Completo</label>
                <input type="text" name="address" class="form-control" value="{{ old('address') }}" required>
            </div>

            <div class="col-md-4">
                <label class="form-label">Número do Documento (ID)</label>
                <input type="text" name="document_number" class="form-control" value="{{ old('document_number') }}" required>
            </div>

            <div class="col-md-3">
                <label class="form-label">Data de Entrada</label>
                <input type="date" name="entry_date" class="form-control" value="{{ old('entry_date') }}" required>
            </div>

            <div class="col-md-3">
                <label class="form-label">Local de Emissão</label>
                <input type="text" name="place_of_issue" class="form-control" value="{{ old('place_of_issue') }}" required>
            </div>

            <div class="col-md-3">
                <label class="form-label">Data de Emissão</label>
                <input type="date" name="date_of_issue" class="form-control" value="{{ old('date_of_issue') }}" required>
            </div>

            <div class="col-md-3">
                <label class="form-label">Data de Expiração</label>
                <input type="date" name="expiry_date" class="form-control" value="{{ old('expiry_date') }}" required>
            </div>

            <!-- CAPTURA BIOMÉTRICA E MULTIMÉDIA -->
            <hr class="my-4">
            <h6 class="text-primary">Anexos e Biometria</h6>

             <div class="col-md-4">
                    <div class="form-group">
                        <label for="image">Imagem</label>
                        <input type="file" class="form-control" id="image" name="image">
                        @if (isset($card->image))
                            <img src="{{ asset('storage/cards/' . $card->image) }}" alt="card Image"
                                class="img-thumbnail mt-2" style="max-width: 200px;">
                        @endif
                    </div>
                </div>

            <div class="col-md-4">
                <label class="form-label font-weight-bold text-danger">Assinatura Digitalizada *</label>
                <input type="file" name="signature" class="form-control" accept="image/*" >
                <small class="text-muted">Use o dispositivo de assinatura</small>
            </div>

            <div class="col-md-4">
                <label class="form-label font-weight-bold text-danger">Impressão Digital *</label>
                <input type="file" name="fingerprint" class="form-control" accept="image/*" >
                <small class="text-muted">Use o scanner biométrico</small>
            </div>

            <div class="col-12 text-center mt-4">
                <button type="submit" class="btn btn-success btn-lg px-5">CADASTRAR E EMITIR</button>
            </div>
        </form>
        
    </div>
</div>
