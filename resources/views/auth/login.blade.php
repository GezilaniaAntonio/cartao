@extends('layouts.app')

@section('content')
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth">
                <div class="row flex-grow">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left p-5">

                            <div class="brand-logo text-center">
                                <img src="{{ asset('admin/assets/img/ga.png') }}" alt="logo">
                            </div>

                          {{--   <h4>Hello! let's get started</h4> --}}
                            <h6 class="font-weight-light">Faça login para continuar.</h6>

                            <form method="POST" action="{{-- {{ route('login') }} --}}" class="pt-3">
                                @csrf

                                {{-- EMAIL --}}
                                <div class="form-group">
                                    <input type="email" name="email" value="{{-- {{ old('email') }} --}}"
                                        class="form-control form-control-lg @error('email') is-invalid @enderror"
                                        placeholder="Email" required autofocus>

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

                                {{-- LOGIN BUTTON --}}
                                <div class="mt-3 d-grid gap-2">
                                    <button type="submit"
                                        class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">
                                        Entrar
                                    </button>
                                </div>

                                <div class="my-2 d-flex justify-content-between align-items-center">
                                    <div class="form-check">
                                        <label class="form-check-label" style="color: #0f2a44; font-weight: 500;">
                                            <input type="checkbox" name="remember" class="form-check-input"
                                               {{--  {{ old('remember') ? 'checked' : '' }}  --}}style="accent-color: #0f2a44;">
                                            Lembrar-me
                                        </label>
                                    </div>

                                </div>

                                 {{--    @if (Route::has('password.request'))
                                        <a href="{{ route('password.request') }}" class="auth-link"
                                            style="color: #0f2a44; font-weight: 500;">
                                            Esqueceu a palavra-passe?
                                        </a>
                                    @endif --}}




                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
