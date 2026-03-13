<!DOCTYPE html>
<html>

<head>
    <title>Debug Completo do Cartão</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background: #f5f5f5;
        }

        .container {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        .card-container {
            position: relative;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-front,
        .card-back {
            position: relative;
            width: 1013px;
            height: 638px;
            border: 2px solid #333;
            margin-bottom: 20px;
            background-size: cover;
        }

        .card-front {
            background: url('/templates/frente.png') no-repeat;
            background-size: cover;
        }

        .card-back {
            background: url('/templates/verso.png') no-repeat;
            background-size: cover;
        }

        /* Grid lines for positioning */
        .grid-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image:
                linear-gradient(to right, rgba(255, 0, 0, 0.1) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(255, 0, 0, 0.1) 1px, transparent 1px);
            background-size: 50px 50px;
            pointer-events: none;
        }

        .marker {
            position: absolute;
            width: 12px;
            height: 12px;
            background: red;
            border: 2px solid white;
            border-radius: 50%;
            transform: translate(-50%, -50%);
            z-index: 10;
            box-shadow: 0 0 5px black;
        }

        .label {
            position: absolute;
            background: rgba(0, 0, 0, 0.8);
            color: white;
            padding: 4px 8px;
            font-size: 12px;
            border-radius: 4px;
            white-space: nowrap;
            transform: translateX(10px);
            z-index: 20;
            pointer-events: none;
            border: 1px solid yellow;
        }

        .marker:hover+.label,
        .label:hover {
            background: blue;
            font-weight: bold;
        }

        .info-panel {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        .info-panel h3 {
            margin-top: 0;
            color: #333;
            border-bottom: 2px solid #007bff;
            padding-bottom: 10px;
        }

        .info-panel table {
            width: 100%;
            border-collapse: collapse;
        }

        .info-panel td {
            padding: 8px 0;
            border-bottom: 1px solid #eee;
        }

        .info-panel td:first-child {
            font-weight: bold;
            color: #555;
            width: 40%;
        }

        .coordinate-control {
            background: #e9ecef;
            padding: 15px;
            border-radius: 6px;
            margin-top: 20px;
        }

        .coordinate-control input {
            width: 60px;
            padding: 5px;
            margin: 0 5px;
        }

        .btn-update {
            background: #007bff;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
        }

        .preview-image {
            max-width: 100px;
            max-height: 100px;
            border: 1px solid #ddd;
            margin: 5px;
        }
    </style>
</head>

<body>
    <h1>🔍 Debug Completo do Cartão - ID: {{ $card->id }}</h1>

    <div class="container">
        <!-- Informações do Cartão -->
        <div class="info-panel">
            <h3>📋 Dados do Cartão</h3>
            <table>
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

            <div class="coordinate-control">
                <h4>🎯 Coordenadas Sugeridas</h4>
                <p><strong>Frente:</strong></p>
                <ul>
                    <li>Nome: (300, 160)</li>
                    <li>Nome do Pai: (300, 210)</li>
                    <li>Nome da Mãe: (300, 250)</li>
                    <li>Nascimento: (300, 290)</li>
                    <li>Naturalidade: (500, 290)</li>
                    <li>Estado Civil: (300, 330)</li>
                    <li>Profissão: (300, 370)</li>
                    <li>Endereço: (300, 410)</li>
                </ul>
                <p><strong>Verso:</strong></p>
                <ul>
                    <li>Data Entrada: (80, 350)</li>
                    <li>Nº Documento: (80, 380)</li>
                    <li>Local Emissão: (80, 410)</li>
                    <li>Data Emissão: (80, 440)</li>
                    <li>Validade: (80, 470)</li>
                    <li>Autoridades: (80, 500)</li>
                </ul>
            </div>
        </div>

        <!-- Cards com marcadores -->
        <div>
            <h2>🎴 Frente do Cartão</h2>
            <div class="card-container">
                <div class="card-front">
                    <div class="grid-overlay"></div>

                    <!-- Foto -->
                    @if ($imagePath)
                        <div class="marker" style="left: 70px; top: 150px; background: blue;" title="Foto"></div>
                        <div class="label" style="left: 80px; top: 150px;">📸 Foto</div>
                    @endif

                    <!-- Nome -->
                    <div class="marker" style="left: 300px; top: 160px;" title="Nome"></div>
                    <div class="label" style="left: 310px; top: 160px;">📝 Nome: {{ $card->name }}</div>

                    <!-- Assinatura -->
                    @if ($signPath)
                        <div class="marker" style="left: 300px; top: 440px; background: green;" title="Assinatura">
                        </div>
                        <div class="label" style="left: 310px; top: 440px;">✍️ Assinatura</div>
                    @endif

                    <!-- Nome do Pai -->
                    <div class="marker" style="left: 300px; top: 210px;"></div>
                    <div class="label" style="left: 310px; top: 210px;">👨 PAI: {{ $card->father_name }}</div>

                    <!-- Nome da Mãe -->
                    <div class="marker" style="left: 300px; top: 250px;"></div>
                    <div class="label" style="left: 310px; top: 250px;">👩 MÃE: {{ $card->mother_name }}</div>

                    <!-- Data Nascimento -->
                    <div class="marker" style="left: 300px; top: 290px;"></div>
                    <div class="label" style="left: 310px; top: 290px;">🎂 NASC:
                        {{ date('d/m/Y', strtotime($card->date_of_birth)) }}</div>

                    <!-- Naturalidade -->
                    <div class="marker" style="left: 300px; top: 330px;"></div>
                    <div class="label" style="left: 310px; top: 330px;">🌍 NAT: {{ $card->birth_place }}</div>

                    <!-- Estado Civil -->
                    <div class="marker" style="left: 300px; top: 370px;"></div>
                    <div class="label" style="left: 310px; top: 370px;">💍 EST: {{ $card->marital_status }}</div>

                    <!-- Profissão -->
                    <div class="marker" style="left: 300px; top: 410px;"></div>
                    <div class="label" style="left: 310px; top: 410px;">💼 PROF: {{ $card->profession }}</div>

                    <!-- Endereço -->
                    <div class="marker" style="left: 300px; top: 450px;"></div>
                    <div class="label" style="left: 310px; top: 450px;">🏠 END: {{ $card->address }}</div>
                </div>
            </div>

            <h2 style="margin-top: 30px;">🎴 Verso do Cartão</h2>
            <div class="card-container">
                <div class="card-back">
                    <div class="grid-overlay"></div>

                    <!-- Impressão Digital -->
                    @if ($fingerPath)
                        <div class="marker" style="left: 850px; top: 250px; background: purple;" title="Digital"></div>
                        <div class="label" style="left: 860px; top: 250px;">👆 Digital</div>
                    @endif

                    <!-- Assinatura do Embaixador -->
                    <div class="marker" style="left: 506px; top: 300px; background: gold;" title="Embaixador"></div>
                    <div class="label" style="left: 516px; top: 300px;">👤 Embaixador</div>

                    <!-- Data de Entrada -->
                    <div class="marker" style="left: 80px; top: 350px;"></div>
                    <div class="label" style="left: 90px; top: 350px;">📅 Entrada:
                        {{ date('d/m/Y', strtotime($card->entry_date)) }}</div>

                    <!-- Número do Documento -->
                    <div class="marker" style="left: 80px; top: 380px;"></div>
                    <div class="label" style="left: 90px; top: 380px;">🆔 Doc: {{ $card->document_number }}</div>

                    <!-- Local de Emissão -->
                    <div class="marker" style="left: 80px; top: 410px;"></div>
                    <div class="label" style="left: 90px; top: 410px;">📍 Emissão: {{ $card->place_of_issue }}</div>

                    <!-- Data de Emissão -->
                    <div class="marker" style="left: 80px; top: 440px;"></div>
                    <div class="label" style="left: 90px; top: 440px;">📆 Emitido:
                        {{ date('d/m/Y', strtotime($card->date_of_issue)) }}</div>

                    <!-- Data de Validade -->
                    <div class="marker" style="left: 80px; top: 470px;"></div>
                    <div class="label" style="left: 90px; top: 470px;">⏰ Válido:
                        {{ date('d/m/Y', strtotime($card->expiry_date)) }}</div>

                    <!-- Autoridades -->
                    <div class="marker" style="left: 80px; top: 500px;"></div>
                    <div class="label" style="left: 90px; top: 500px;">🏛️ Autoridades</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Uploads Preview -->
    <div style="margin-top: 30px; background: white; padding: 20px; border-radius: 8px;">
        <h3>📎 Uploads</h3>
        <div style="display: flex; gap: 20px;">
            @if ($imagePath)
                <div>
                    <strong>Foto:</strong><br>
                    <img src="{{ asset($imagePath) }}" class="preview-image">
                </div>
            @endif
            @if ($signPath)
                <div>
                    <strong>Assinatura:</strong><br>
                    <img src="{{ asset($signPath) }}" class="preview-image">
                </div>
            @endif
            @if ($fingerPath)
                <div>
                    <strong>Digital:</strong><br>
                    <img src="{{ asset($fingerPath) }}" class="preview-image">
                </div>
            @endif
        </div>
    </div>

    <!-- Código Gerado Sugerido -->
    <div style="margin-top: 30px; background: #2d2d2d; color: #fff; padding: 20px; border-radius: 8px;">
        <h3 style="color: #fff;">📝 Código PHP Sugerido</h3>
        <pre style="background: #1e1e1e; color: #d4d4d4; padding: 15px; border-radius: 5px; overflow-x: auto;">
// Frente do Cartão
$front->text(strtoupper($card->name), 300, 160, function($f) use ($fontPath, $color) {
    $f->file($fontPath); $f->size(24); $f->color($color);
});

$front->text("PAI: " . strtoupper($card->father_name), 300, 210, function($f) use ($fontPath, $color) {
    $f->file($fontPath); $f->size(18); $f->color($color);
});

$front->text("MÃE: " . strtoupper($card->mother_name), 300, 250, function($f) use ($fontPath, $color) {
    $f->file($fontPath); $f->size(18); $f->color($color);
});

$front->text("NASC: " . date('d/m/Y', strtotime($card->date_of_birth)), 300, 290, function($f) use ($fontPath, $color) {
    $f->file($fontPath); $f->size(18); $f->color($color);
});

$front->text("NAT: " . $card->birth_place, 300, 330, function($f) use ($fontPath, $color) {
    $f->file($fontPath); $f->size(18); $f->color($color);
});

$front->text("ESTADO: " . $card->marital_status, 300, 370, function($f) use ($fontPath, $color) {
    $f->file($fontPath); $f->size(18); $f->color($color);
});

$front->text("PROF: " . $card->profession, 300, 410, function($f) use ($fontPath, $color) {
    $f->file($fontPath); $f->size(18); $f->color($color);
});

$front->text("END: " . $card->address, 300, 450, function($f) use ($fontPath, $color) {
    $f->file($fontPath); $f->size(16); $f->color($color);
});

// Verso do Cartão
$back->text("ENTRADA: " . date('d/m/Y', strtotime($card->entry_date)), 80, 350, function($f) use ($fontPath, $color) {
    $f->file($fontPath); $f->size(16); $f->color($color);
});

$back->text("DOC: " . $card->document_number, 80, 380, function($f) use ($fontPath, $color) {
    $f->file($fontPath); $f->size(16); $f->color($color);
});

$back->text("EMISSÃO: " . $card->place_of_issue, 80, 410, function($f) use ($fontPath, $color) {
    $f->file($fontPath); $f->size(16); $f->color($color);
});

$back->text("DATA EMISSÃO: " . date('d/m/Y', strtotime($card->date_of_issue)), 80, 440, function($f) use ($fontPath, $color) {
    $f->file($fontPath); $f->size(16); $f->color($color);
});

$back->text("VÁLIDO ATÉ: " . date('d/m/Y', strtotime($card->expiry_date)), 80, 470, function($f) use ($fontPath, $color) {
    $f->file($fontPath); $f->size(16); $f->color($color);
});
        </pre>
    </div>

    <script>
        function updateCoordinates(element, x, y) {
            document.querySelectorAll('.marker, .label').forEach(el => {
                if (el.classList.contains('marker')) {
                    el.style.left = x + 'px';
                    el.style.top = y + 'px';
                }
            });
        }
    </script>
</body>

</html>
