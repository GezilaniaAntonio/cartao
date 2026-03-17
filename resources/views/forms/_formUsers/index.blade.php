@php
    $roles = [
        'admin' => 'Administrador',
        'user' => 'Utilizador'
    ];
@endphp


                        <div class="row g-3"> <!-- grid para espaçamento -->
                            <div class="col-12">
                                <input type="text" name="name" class="form-control" value="{{-- {{ old('name', $user->name ?? '')}} --}}" placeholder="Nome completo">
                            </div>

                            <div class="col-12">
                                <input type="email" name="email" class="form-control" value="{{-- {{ old('email', $user->email ?? '')}} --}}" placeholder="Email">
                            </div>

                            <div class="col-12">
                                <input type="password" name="password" class="form-control" placeholder="Senha">
                            </div>

                            <div class="col-12">
                                <input type="password" name="password_confirmation" class="form-control"
                                    placeholder="Confirmar senha">
                            </div>

                            <div class="col-12">
                                <select name="role" class="form-select">
                                    @foreach ($roles as $value => $label)
                                    <option value="{{ $value }}" {{ ($user->role ?? '') === $value ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                                </select>
                            </div>

                            <div class="col-12 text-center mt-4">
                                <button type="submit" class="btn btn-primary me-2">
                                    <i class="bi bi-save"></i> Cadastrar
                                </button>
                            </div>
                        </div>

