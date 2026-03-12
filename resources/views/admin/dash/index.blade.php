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
                        <h5 class="card-title">Emissão de Cartões</h5>

                        <!-- Tabs Simplificadas -->
                        <ul class="nav nav-tabs d-flex" id="participantsTab" role="tablist">
                            <li class="nav-item flex-fill">
                                <button class="nav-link w-100 active" data-bs-toggle="tab" data-bs-target="#all">Todos os
                                    Registros</button>
                            </li>
                            <li class="nav-item flex-fill">
                                <button class="nav-link w-100 " data-bs-toggle="tab" data-bs-target="#checked">Novo
                                    Registro</button>
                            </li>
                
                        </ul>

                        <div class="tab-content pt-3">

                            <!-- 1. Aba: Todos -->
                            <div class="tab-pane fade show active" id="all">
                                <table class="table datatable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Foto</th>
                                            <th>Nome</th>
                                            <th>Filhação</th>
                                            <th>Data e local de Nascimento</th>
                                            <th>Est.Civil</th>
                                            <th>Profissão</th>
                                            <th>Endereço</th>
                                            <th>Data de entrada na China</th>
                                            <th>Doc.Apresentado</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cards as $c)
                                            <tr>
                                                <td>{{ $c->id }}</td>

                                                <td>
                                                    @if ($c->image)
                                                        <img src="{{ asset('img/cards/' . $c->image) }}" width="50"
                                                            height="50" style="object-fit: cover; border-radius: 5px;"
                                                            alt="{{ $c->name }}">
                                                    @else
                                                        <span class="text-muted">Sem imagem</span>
                                                    @endif
                                                </td>
                                                <td>{{ $c->name }}</td>
                                                <td>{{ $c->father_name }}</td>
                                                <td>{{ $c->mother_name }}</td>
                                                <td>{{ $c->date_of_birth }}</td>
                                                <td>{{ $c->birth_place }}</td>
                                                <td>{{ $c->marital_status }}</td>
                                                <td>{{ $c->profession }}</td>
                                                <td>{{ $c->document_number }}</td>
                                                <td>
                                                    <a href="{{ route('admin.cards.show', $c->id) }}"
                                                        class="btn btn-sm btn-info text-white">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.cards.edit', $c->id) }}"
                                                        class="btn btn-sm btn-warning">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>    
                                                </td>
                                                <td>
                                                    <form action="{{ route('admin.cards.destroy', $c->id) }}" method="POST"
                                                        onsubmit="return confirm('Tem certeza que deseja excluir este registro?');"
                                                        style="display: inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- 2. Aba: novo registro -->
                            <div class="tab-pane fade" id="checked">
                                @include('forms._formCard.index')
                            </div>

                           

                        </div><!-- End tab content -->
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
