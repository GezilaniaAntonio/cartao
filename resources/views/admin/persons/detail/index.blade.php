@extends('layouts.merge.dash')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Validar Participante</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.participants.list') }}">Inscrições</a></li>
                    <li class="breadcrumb-item active">Detalhes do QR Code</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row justify-content-center">
                <div class="col-lg-8">

                    <div class="card shadow-sm border-0">
                        <div class="card-body pt-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title">Dados da Inscrição</h5>
                                {{-- Status do Check-in com Badge --}}
                                @if ($participant->checked_in)
                                    <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i> Check-in
                                        Realizado</span>
                                @else
                                    <span class="badge bg-warning text-dark"><i class="bi bi-clock me-1"></i> Aguardando
                                        Entrada</span>
                                @endif
                            </div>

                            <ul class="list-group list-group-flush mt-3">
                                <li class="list-group-item d-flex justify-content-between">
                                    <strong>Nome Completo:</strong> <span>{{ $participant->name }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <strong>Evento:</strong> <span>{{ $participant->event->name ?? 'N/A' }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <strong>E-mail:</strong> <span>{{ $participant->email }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <strong>Telefone:</strong> <span>{{ $participant->phone ?? 'Não informado' }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <strong>Data da Inscrição:</strong>
                                    <span>{{ $participant->created_at ? $participant->created_at->format('d/m/Y H:i') : 'Data não disponível' }}
                                    </span>
                                </li>

                                {{-- Proteção contra erro format() on null --}}
                                <li class="list-group-item d-flex justify-content-between bg-light">
                                    <strong>Entrada no Evento:</strong>
                                    <span class="text-primary fw-bold">
                                        {{ $participant->checked_in_at ? $participant->checked_in_at->format('d/m/Y H:i') : 'Ainda não entrou' }}
                                    </span>
                                </li>
                            </ul>

                            <div class="mt-4 d-flex justify-content-between">
                                <a href="{{ route('admin.participants.list') }}" class="btn btn-secondary px-4">
                                    <i class="bi bi-arrow-left"></i> Voltar à Lista
                                </a>

                                {{-- Botão para forçar check-in manual se necessário --}}
                                @if (!$participant->checked_in)
                                    {{-- Onde estiver o formulário ou link de check-in --}}
                                    <form action="{{ route('site.participants.checkin', $participant->id) }}" method="GET"
                                        style="display:inline;">
                                        <button type="submit" class="btn btn-primary px-4">
                                            <i class="bi bi-qr-code-scan"></i> Validar Entrada Manual
                                        </button>
                                    </form>
                                @endif
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </section>
    </main>
@endsection
