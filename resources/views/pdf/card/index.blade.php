<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <style>
        /* Existing CSS (mantido intacto) */
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
.chinese, .chinese * {
    font-family: 'DejaVu Sans', 'SimSun', 'Times New Roman', Times, serif !important;
}

        .page .content {
            padding: 0;
            color: #000;
            text-shadow: none;
        }


        .frente-tabela {
            position: absolute;
            left: 70px;
            top: 220px;
            width: 600px;
            border-collapse: collapse;
            font-size: 12px;
            color: #000;
        }

               .verso-tabela {
            position: absolute;
            left: 50px;
            top: 100px;
            width: 900px;
            border-collapse: collapse;
            font-size: 12px;
            color: #000;
        }


        table td {
            padding: 2px 0;
            vertical-align: top;
        }

        table td:first-child {
            font-weight: bold;
            white-space: nowrap;
        }

        .frente-tabela td:first-child {
            width: 150px;
        }

        .verso-tabela td:first-child {
            width: 220px;
        }


        .imagem-assinatura {
            position: absolute;
            left: 730px;
            top: 470px;
            width: 220px;
            height: 70px;
        }

        .imagem-digital {
            position: absolute;
            left: 750px;
            top: 160px;
            width: 150px;
            height: 190px;
        }

        .content {
            position: relative;
            z-index: 1;
            padding: 40px;
            color: white;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.8);


}

        .imagem-ga {
            position: absolute;
            left: 400px;
            top: 350px;
            width: 200px;
            height: 60px;
        }


        .texto-assinatura {
            position: absolute;
            left: 760px;
            top: 560px;
            font-size: 12px;
            color: #000;
        }

        .texto-assinatura-chinese {
            left: 860px;
            top: 560px;
            font-size: 12px;
        }
    </style>
</head>

<body>
    {{-- Página 1 - Frente --}}
    <div class="page">
        <div class="bg-centralizado" style="background-image: url('{{ public_path('templates/frente.png') }}');"></div>
        <div class="content">
            <table class="frente-tabela">
                <tr>
                    <td>Nome / <span class="chinese">名称:</span></td>
                    <td>{{ strtoupper($card->name) }}</td>
                </tr>
                <tr>
                    <td>Filiação / <span class="chinese">之子:</span></td>
                    <td>{{ strtoupper($card->father_name) }}</td>
                </tr>
                <tr>
                    <td>E / <span class="chinese">和:</span></td>
                    <td>{{ strtoupper($card->mother_name) }}</td>
                </tr>
                <tr>
                    <td>Data de nascimento e local / <span class="chinese">出生日期和地点:</span></td>
                    <td>{{ date('d/m/Y', strtotime($card->date_of_birth)) }} em {{ $card->birth_place }}</td>
                </tr>
                <tr>
                    <td>Estado civil / <span class="chinese">婚姻状况:</span></td>
                    <td>{{ $card->marital_status }}</td>
                </tr>
                <tr>
                    <td>Profissão / <span class="chinese">职业:</span></td>
                    <td>{{ strtoupper($card->profession) }}</td>
                </tr>
                <tr>
                    <td>Endereço / <span class="chinese">地址:</span></td>
                    <td>{{ $card->address }}</td>
                </tr>
            </table>

            {{-- Assinatura do titular --}}
            @php $sign = isset($uploads) ? $uploads->where('type', 'signature')->first() : null; @endphp
            @if ($sign && file_exists(public_path($sign->path)))
                <div class="imagem-assinatura">
                    <img src="{{ public_path($sign->path) }}" width="220" height="70" alt="Assinatura">
                </div>
            @endif
            <div class="texto-assinatura">ASSINATURA /</div>
            <div class="texto-assinatura-chinese chinese">持有人签名</div>
        </div>
    </div>

    {{-- Página 2 - Verso --}}
    <div class="page">
        <div class="bg-centralizado" style="background-image: url('{{ public_path('templates/verso.png') }}');"></div>
        <div class="content">
            <table class="verso-tabela">
                <tr>
                    <td>Data de entrada na CHINA / <span class="chinese">进入中国的日期:</span></td>
                    <td>{{ date('d/m/Y', strtotime($card->entry_date)) }}</td>
                </tr>
                <tr>
                    <td>Documento apresentado / <span class="chinese">提交的文件:</span></td>
                    <td>Passaporte Nº {{ $card->document_number }}</td>
                </tr>
                <tr>
                    <td>Local e data de emissão / <span class="chinese">签发地点和日期:</span></td>
                    <td>
                        {{ $card->place_of_issue }} aos {{ date('Y.m.d', strtotime($card->date_of_issue)) }}
                        / <span class="chinese">{{ $card->place_of_issue_chinese ?? $card->place_of_issue }}</span>,
                        <span class="chinese">{{ date('Y年m月d', strtotime($card->date_of_issue)) }}</span>
                    </td>
                </tr>
                <tr>
                    <td>Válido até / <span class="chinese">本文件有效期至:</span></td>
                    <td>{{ date('Y/m/d', strtotime($card->expiry_date)) }}</td>
                </tr>
                <tr>
                    <td>Assinatura do Embaixador / <span class="chinese">大使签字:</span></td>
                    <td>
                        @if (file_exists(public_path('templates/ga.png')))
                            <img src="{{ public_path('templates/ga.png') }}" width="200" height="60"
                                style="vertical-align: middle; margin-right: 10px;">
                        @endif
                        <span>O EMBAIXADOR / </span><span class="chinese">签字</span>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="padding-top: 10px; padding-bottom: 5px;">
                        ÀS AUTORIDADES A QUEM ESTE DOCUMENTO É APRESENTADO, SOLICITAMOS GENTILMENTE QUE SEJA PRESTADA A
                        ASSISTÊNCIA NECESSÁRIA AO SEU TITULAR
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="padding-bottom: 5px;" class="chinese">
                        向接收此文件的当局请求, 请为持有人提供必要的协助
                    </td>
                </tr>
                <tr>
                    <td>Telefone / <span class="chinese">电话:</span></td>
                    <td>(+86 10) 65326968 – 65326839 – 65326970</td>
                </tr>
                <tr>
                    <td>DIGITAL / <span class="chinese">指纹:</span></td>
                    <td>
                        @php $finger = isset($uploads) ? $uploads->where('type', 'fingerprint')->first() : null; @endphp
                        @if ($finger && file_exists(public_path($finger->path)))
                            <img src="{{ public_path($finger->path) }}" width="150" height="190" alt="Digital">
                        @endif
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>

</html>
