@extends('layouts.merge.dash')

@section('content')
    <main id="main" class="main">
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
                                    <button class="nav-link w-100 active" data-bs-toggle="tab" data-bs-target="#all">Todos</button>
                                </li>
                                <li class="nav-item flex-fill">
                                    <button class="nav-link w-100 text-success" data-bs-toggle="tab" data-bs-target="#checked">Formulário</button>
                                </li>
                                <li class="nav-item flex-fill">
                                    <button class="nav-link w-100 text-warning" data-bs-toggle="tab" data-bs-target="#pending">Emitidos</button>
                                </li>
                            </ul>

                            <div class="tab-content pt-3">

                                <!-- 1. Aba: Todos -->
                                <div class="tab-pane fade show active" id="all">
                                    <table class="table datatable">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Evento</th>
                                                <th>Nome</th>
                                                <th>Email</th>
                                                <th>Check-in</th>
                                                <th>Ações</th>
                                            </tr>
                                        </thead>
                                       {{--  <tbody>
                                            @foreach ($participants as $p)
                                                <tr>
                                                    <td>{{ $p->id }}</td>
                                                    <td>{{ $p->event->name ?? '-' }}</td>
                                                    <td>{{ $p->name }}</td>
                                                    <td>{{ $p->email }}</td>
                                                    <td>
                                                        <span class="badge {{ $p->checked_in ? 'bg-success' : 'bg-warning text-dark' }}">
                                                            {{ $p->checked_in ? 'Sim' : 'Não' }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('admin.participants.show', $p->id) }}" class="btn btn-sm btn-info text-white">
                                                            <i class="bi bi-eye"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody> --}}
                                    </table>
                                </div>

                                <!-- 2. Aba: Com Check-in -->
                                <div class="tab-pane fade" id="checked">
                                    <table class="table datatable">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nome</th>
                                                <th>Evento</th>
                                                <th>Data Check-in</th>
                                                <th>Ações</th>
                                            </tr>
                                        </thead>
                                       <tbody>

                                        </tbody>
                                    </table>
                                </div>

                                <!-- 3. Aba: Pendente (Apenas os que NÃO fizeram check-in) -->
                                <div class="tab-pane fade" id="pending">
                                    <table class="table datatable">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nome</th>
                                                <th>Evento</th>
                                                <th>Status</th>
                                                <th>Ações</th>
                                            </tr>
                                        </thead>
                                      {{--   <tbody>
                                            @foreach ($participants->where('checked_in', false) as $p)
                                                <tr>
                                                    <td>{{ $p->id }}</td>
                                                    <td>{{ $p->name }}</td>
                                                    <td>{{ $p->event->name ?? '-' }}</td>
                                                    <td><span class="badge bg-warning text-dark">Aguardando</span></td>
                                                    <td>
                                                        <a href="{{ route('admin.participants.show', $p->id) }}" class="btn btn-sm btn-info text-white">
                                                            <i class="bi bi-eye"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody> --}}
                                    </table>
                                </div>

                            </div><!-- End tab content -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
