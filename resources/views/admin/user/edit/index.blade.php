@extends('layouts.merge.dash')
@section('title', 'Sistema Emissão de Cartões')
@section('content')

<div class="pagetitle">
        <h1>Emissão de Cartões</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Cartões</a></li>
                <li class="breadcrumb-item active">Emissão</li>
            </ol>
        </nav>
    </div>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Utilizadores do Sistema</h5>
                        <!-- Tabs Simplificadas -->
                        <ul class="nav nav-tabs d-flex" id="participantsTab" role="tablist">
                            <li class="nav-item flex-fill">
                                <button class="nav-link w-100 active" data-bs-toggle="tab" data-bs-target="#all">Todos os
                                    Registros</button>
                            </li>
                        </ul>
                        <div class="tab-content pt-3">
                            
                            <!-- 2. Aba: novo registro -->
                            <div class="tab-pane fade" id="checked">
                                <form action="{{ route('admin.users.edit', $user->id) }}" method="post">
                                    @csrf 
                                    @method('POST')
                                    @include('forms._formUsers.index')
                                </form>
                            </div>
                        </div><!-- End tab content -->
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection