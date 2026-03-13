@extends('layouts.app')

@section('content')


<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth" style="min-height: 100vh;">
            <div class="row flex-grow">
                <div class="col-lg-4 mx-auto">
                    <div class="auth-form-light text-left p-5">

                        <div class="brand-logo text-center">
                            <img src="{{ asset('admin/assets/img/ga.png') }}" alt="logo">
                        </div>

                        <h6 class="font-weight-light">Crie sua conta para continuar.</h6>

                        <form method="POST" action="{{ route('register') }}" class="pt-3">
                            @csrf

                            {{-- NAME --}}
                            <div class="form-group">
                                <input type="text" name="name" value="{{ old('name') }}"
                                    class="form-control form-control-lg @error('name') is-invalid @enderror"
                                    placeholder="Nome" required autofocus>
                                @error('name')
                                    <span class="invalid-feedback d-block">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            {{-- EMAIL --}}
                            <div class="form-group">
                                <input type="email" name="email" value="{{ old('email') }}"
                                    class="form-control form-control-lg @error('email') is-invalid @enderror"
                                    placeholder="Email" required>
                                @error('email')
                                    <span class="invalid-feedback d-block">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            {{-- PASSWORD --}}
                            <div class="form-group">
                                <input type="password" name="password"
                                    class="form-control form-control-lg @error('password') is-invalid @enderror"
                                    placeholder="Password" required>
                                @error('password')
                                    <span class="invalid-feedback d-block">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            {{-- PASSWORD CONFIRM --}}
                            <div class="form-group">
                                <input type="password" name="password_confirmation"
                                    class="form-control form-control-lg"
                                    placeholder="Confirmar Password" required>
                            </div>

                            {{-- REGISTER BUTTON --}}
                            <div class="mt-3 d-grid gap-2">
                                <button type="submit"
                                    class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn"
                                    >
                                    Registrar
                                </button>
                            </div>





                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
