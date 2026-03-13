<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <style>
        @page {
            margin: 0;
        }

        body {
            margin: 0;
            padding: 0;
        }

        .page {
            page-break-after: always;
            position: relative;
            width: 100%;
            height: 100vh;
        }

        .page:last-child {
            page-break-after: auto;
        }

        .bg-centralizado {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-position: center center;
            background-repeat: no-repeat;
            background-size: cover;
            z-index: -1;
        }

        .content {
            position: relative;
            z-index: 1;
            padding: 40px;
            color: white;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.8);
        }
    </style>
</head>

<body>
    {{-- Página 1 --}}
    <div class="page">
        <div class="bg-centralizado" style="background-image: url('{{ public_path('templates/frente.png') }}');"></div>
        <div class="content">
            <table style="color:black;">
                <tr>
                    <td>Nome:</td>
                    <td>{{ $card->name }}</td>
                </tr>
                <tr>
                    <td>Nome do Pai:</td>
                    <td>{{ $card->father_name }}</td>
                </tr>
                <tr>
                    <td>Nome da Mãe:</td>
                    <td>{{ $card->mother_name }}</td>
                </tr>
                <tr>
                    <td>Data Nasc.:</td>
                    <td>{{ date('d/m/Y', strtotime($card->date_of_birth)) }}</td>
                </tr>
                <tr>
                    <td>Naturalidade:</td>
                    <td>{{ $card->birth_place }}</td>
                </tr>
                <tr>
                    <td>Estado Civil:</td>
                    <td>{{ $card->marital_status }}</td>
                </tr>
                <tr>
                    <td>Profissão:</td>
                    <td>{{ $card->profession }}</td>
                </tr>
                <tr>
                    <td>Endereço:</td>
                    <td>{{ $card->address }}</td>
                </tr>
                <tr>
                    <td>Data Entrada:</td>
                    <td>{{ date('d/m/Y', strtotime($card->entry_date)) }}</td>
                </tr>
                <tr>
                    <td>Nº Documento:</td>
                    <td>{{ $card->document_number }}</td>
                </tr>
                <tr>
                    <td>Local Emissão:</td>
                    <td>{{ $card->place_of_issue }}</td>
                </tr>
                <tr>
                    <td>Data Emissão:</td>
                    <td>{{ date('d/m/Y', strtotime($card->date_of_issue)) }}</td>
                </tr>
                <tr>
                    <td>Validade:</td>
                    <td>{{ date('d/m/Y', strtotime($card->expiry_date)) }}</td>
                </tr>
            </table>
        </div>
    </div>

    {{-- Página 2 --}}
    <div class="page" >
        <div class="bg-centralizado" style="background-image: url('{{ public_path('templates/verso.png') }}');"></div>
        <div class="content" style="color:black;">
            <h1 style="text-align: center;">Página 2</h1>
        </div>
    </div>
</body>

</html>
