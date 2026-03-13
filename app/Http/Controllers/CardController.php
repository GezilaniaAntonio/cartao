<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Upload;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;


class CardController extends Controller
{
    public function index()
    {
        $cards = Card::with('uploads')->get();
        return view('admin.dash.index', compact('cards'));
    }
public function store(Request $request)
{
    // Validação
    $request->validate([
        'name' => 'required|string',
        'father_name' => 'required|string',
        'mother_name' => 'required|string',
        'date_of_birth' => 'required|date',
        'birth_place' => 'required|string',
        'marital_status' => 'required|in:SOLTEIRO,CASADO,DIVORCIADO,VIUVO',
        'profession' => 'required|string',
        'address' => 'required|string',
        'entry_date' => 'required|date',
        'document_number' => 'required|string',
        'place_of_issue' => 'required|string',
        'date_of_issue' => 'required|date',
        'expiry_date' => 'required|date',
        'image' => 'required|image|mimes:jpeg,png,jpg',
        'signature' => 'image|mimes:jpeg,png,jpg',
        'fingerprint' => 'image|mimes:jpeg,png,jpg',
    ]);

    // Preparar os dados
    $data = $request->except(['_token', 'image', 'signature', 'fingerprint']);

    // Processar e salvar a imagem principal
    if ($request->hasFile('image') && $request->file('image')->isValid()) {
        $image = $request->file('image');
        $extension = $image->extension();
        $imageName = md5($image->getClientOriginalName() . strtotime('now')) . '.' . $extension;
        $image->move(public_path('img/cards'), $imageName);
        $data['image'] = $imageName; // Adiciona o nome da imagem aos dados
    }

    // CRIAR O CARD UMA ÚNICA VEZ (com a imagem incluída)
    $card = Card::create($data);

    // Upload da assinatura (usando o relacionamento)
    if ($request->hasFile('signature')) {
        $path = $request->file('signature')->store('uploads/signatures', 'public');
        $card->uploads()->create(['type' => 'signature', 'path' => $path]);
    }

    // Upload da impressão digital (usando o relacionamento)
    if ($request->hasFile('fingerprint')) {
        $path = $request->file('fingerprint')->store('uploads/fingerprints', 'public');
        $card->uploads()->create(['type' => 'fingerprint', 'path' => $path]);
    }

    return redirect()->route('admin.dash.index')->with('success', 'Cartão criado com sucesso!');
}

    public function destroy(Card $card)
    {
        $card->delete();
        return redirect()->route('admin.dash.index')->with('success', 'Cartão eliminado com sucesso!');
    }

    public function generateCard($id)
    {
        $card = Card::findOrFail($id);
        $uploads = Upload::where('card_id', $card->id)->get();

        // 1. FONTES
        $fontPath = public_path('fonts/arial.ttf');
        $fontBoldPath = public_path('fonts/arialbd.ttf');
        $fontChinesePath = public_path('fonts/msyh.ttf');

        // Fallbacks
        if (!file_exists($fontPath)) { $fontPath = 'C:/Windows/Fonts/arial.ttf'; }
        if (!file_exists($fontBoldPath)) { $fontBoldPath = 'C:/Windows/Fonts/arialbd.ttf'; }
        if (!file_exists($fontChinesePath)) { $fontChinesePath = 'C:/Windows/Fonts/msyh.ttf'; }
        if (!file_exists($fontChinesePath)) {
            $fontChinesePath = 'C:/Windows/Fonts/simsun.ttc';
        }
        if (!file_exists($fontChinesePath)) {
            $fontChinesePath = $fontPath;
        }

        $card = Card::findOrFail($id);
    $uploads = Upload::where('card_id', $card->id)->get();

    // CORRIGIDO: Pega a imagem do campo 'image' do card, não da tabela uploads
    $imagePath = $card->image ? 'img/cards/' . $card->image : null;
    $signPath  = $uploads->where('type', 'signature')->first()->path ?? null;
    $fingerPath = $uploads->where('type', 'fingerprint')->first()->path ?? null;

        // ==================== FRENTE DO CARTÃO ====================
        $front = Image::make(public_path('templates/frente.png'))->resize(1013, 638);



        // --- LADO DIREITO (Foto) ---
        if ($imagePath && file_exists(public_path($imagePath))) {
            $photo = Image::make(public_path($imagePath))->fit(200, 260);
            $front->insert($photo, 'top-left', 770, 220);
        }

        // --- LADO ESQUERDO (Dados) ---
        $leftMargin = 70;
        $dataColumn = 230;
        $y = 250;
        $lineSpace = 42;



        // NOME
        $front->text("Nome /", $leftMargin, $y, function($f) use ($fontBoldPath) {
            $f->file($fontBoldPath); $f->size(15); $f->color('#000');
        });

        $front->text(" 名称:", $leftMargin + 50, $y, function($f) use ($fontChinesePath) {
            $f->file($fontChinesePath); $f->size(15); $f->color('#000');
        });

        $front->text(strtoupper($card->name), $dataColumn, $y, function($f) use ($fontPath) {
            $f->file($fontPath); $f->size(15); $f->color('#000');
        });

        // Filiação (Pai)
        $y += $lineSpace;
        $front->text("Filiação /", $leftMargin, $y, function($f) use ($fontBoldPath) {
            $f->file($fontBoldPath); $f->size(14); $f->color('#000');
        });

        $front->text(" 之子:", $leftMargin + 60, $y, function($f) use ($fontChinesePath) {
            $f->file($fontChinesePath); $f->size(15); $f->color('#000');
        });

        $front->text(strtoupper($card->father_name), $dataColumn, $y, function($f) use ($fontPath) {
            $f->file($fontPath); $f->size(14); $f->color('#000');
        });

        // Filiação (Mãe)
        $y += $lineSpace ;
        $front->text("E /", $leftMargin, $y, function($f) use ($fontBoldPath) {
            $f->file($fontBoldPath); $f->size(15); $f->color('#000');
        });

        $front->text(" 和:", $leftMargin + 15, $y, function($f) use ($fontChinesePath) {
            $f->file($fontChinesePath); $f->size(15); $f->color('#000');
        });

        $front->text(strtoupper($card->mother_name), $dataColumn, $y, function($f) use ($fontPath) {
            $f->file($fontPath); $f->size(14); $f->color('#000');
        });

        // Data de Nascimento e Local
        $y += $lineSpace;

        $front->text("Data de nascimento", $leftMargin, $y, function($f) use ($fontBoldPath) {
            $f->file($fontBoldPath); $f->size(14); $f->color('#000');
        });
        $y += 20;

        $front->text("e local /", $leftMargin, $y, function($f) use ($fontBoldPath) {
            $f->file($fontBoldPath); $f->size(14); $f->color('#000');
        });

        $front->text(" 出生日期和地点:", $leftMargin + 45, $y, function($f) use ($fontChinesePath) {
            $f->file($fontChinesePath); $f->size(14); $f->color('#000');
        });

        $nascInfo = date('d/m/Y', strtotime($card->date_of_birth)) . " em " . $card->birth_place;
        $front->text($nascInfo, $dataColumn, $y, function($f) use ($fontPath) {
            $f->file($fontPath); $f->size(14); $f->color('#000');
        });

        // Estado Civil
        $y += $lineSpace;
        $front->text("Estado civil /", $leftMargin, $y, function($f) use ($fontBoldPath) {
            $f->file($fontBoldPath); $f->size(15); $f->color('#000');
        });

        $front->text(" 婚姻状况:", $leftMargin + 85, $y, function($f) use ($fontChinesePath) {
            $f->file($fontChinesePath); $f->size(15); $f->color('#000');
        });

        $front->text($card->marital_status, $dataColumn, $y, function($f) use ($fontPath) {
            $f->file($fontPath); $f->size(14); $f->color('#000');
        });

        // Profissão
        $y += $lineSpace;
        $front->text("Profissão /", $leftMargin, $y, function($f) use ($fontBoldPath) {
            $f->file($fontBoldPath); $f->size(15); $f->color('#000');
        });

        $front->text(" 职业:", $leftMargin + 90, $y, function($f) use ($fontChinesePath) {
            $f->file($fontChinesePath); $f->size(15); $f->color('#000');
        });

        $front->text(strtoupper($card->profession), $dataColumn, $y, function($f) use ($fontPath) {
            $f->file($fontPath); $f->size(14); $f->color('#000');
        });

        // Endereço
        $y += $lineSpace;
        $front->text("Endereço /", $leftMargin, $y, function($f) use ($fontBoldPath) {
            $f->file($fontBoldPath); $f->size(14); $f->color('#000');
        });

        $front->text(" 地址:", $leftMargin + 80, $y, function($f) use ($fontChinesePath) {
            $f->file($fontChinesePath); $f->size(14); $f->color('#000');
        });

        $shortAddress = mb_strimwidth($card->address, 0, 45, "...");
        $front->text($shortAddress, $dataColumn, $y, function($f) use ($fontPath) {
            $f->file($fontPath); $f->size(14); $f->color('#000');
        });

        // --- ASSINATURA DO TITULAR ---
        if ($signPath && file_exists(public_path($signPath))) {
            $signature = Image::make(public_path($signPath))->resize(220, 70);
            $front->insert($signature, 'top-left', 730, 470);
        }

        $front->text("ASSINATURA /", 760, 560, function($f) use ($fontPath) {
            $f->file($fontPath); $f->size(14); $f->color('#000'); $f->align('left');
        });

        $front->text(" 持有人签名", 860, 560, function($f) use ($fontChinesePath) {
            $f->file($fontChinesePath); $f->size(14); $f->color('#000'); $f->align('left');
        });

        // ==================== VERSO DO CARTÃO ====================
        $back = Image::make(public_path('templates/verso.png'))->resize(1013, 638);

        $leftMargin = 50;
        $rightMargin = 750;
        $y = 120;

        // 1. Data de entrada na China
        $back->text("Data de entrada na CHINA /", $leftMargin, $y, function($f) use ($fontBoldPath) {
            $f->file($fontBoldPath); $f->size(14); $f->color('#000');
        });
        $back->text("进入中国的日期:", $leftMargin + 185, $y, function($f) use ($fontChinesePath) {
            $f->file($fontChinesePath); $f->size(14); $f->color('#000');
        });
        $back->text(date('d/m/Y', strtotime($card->entry_date)), 360, $y, function($f) use ($fontPath) {
            $f->file($fontPath); $f->size(14); $f->color('#000');
        });

     // 2. Documento apresentado - MÁXIMA PROXIMIDADE
$y += 45;
$back->text("Documento apresentado /", $leftMargin, $y, function($f) use ($fontBoldPath) {
    $f->file($fontBoldPath); $f->size(14); $f->color('#000');
});
$back->text("提交的文件:", $leftMargin + 180, $y, function($f) use ($fontChinesePath) { // REDUZIDO de 170 para 150
    $f->file($fontChinesePath); $f->size(14); $f->color('#000');
});
$back->text("Passaporte Nº " . $card->document_number, 320, $y, function($f) use ($fontPath) { // REDUZIDO de 430 para 280
    $f->file($fontPath); $f->size(14); $f->color('#000');
});

// 3. Local e data de emissão - MÁXIMA PROXIMIDADE
$y += 45;
$placeOfIssueChinese = $card->place_of_issue_chinese ?? $card->place_of_issue;
$back->text($card->place_of_issue . " aos " . date('Y.m.d', strtotime($card->date_of_issue)), $leftMargin, $y, function($f) use ($fontPath) {
    $f->file($fontPath); $f->size(14); $f->color('#000');
});
$back->text("/ " . $placeOfIssueChinese . ",", 210, $y, function($f) use ($fontChinesePath) { // REDUZIDO de 330 para 230
    $f->file($fontChinesePath); $f->size(14); $f->color('#000');
});
$back->text(date('Y年m月d', strtotime($card->date_of_issue)), 290, $y, function($f) use ($fontChinesePath) { // REDUZIDO de 400 para 290
    $f->file($fontChinesePath); $f->size(14); $f->color('#000');
});

        // 4. Validade
        $y += 45;
        $back->text("Válido até /", $leftMargin, $y, function($f) use ($fontBoldPath) {
            $f->file($fontBoldPath); $f->size(14); $f->color('#000');
        });
        $back->text("本文件有效期至:", $leftMargin + 95, $y, function($f) use ($fontChinesePath) {
            $f->file($fontChinesePath); $f->size(14); $f->color('#000');
        });
        $back->text(date('Y/m/d', strtotime($card->expiry_date)), 260, $y, function($f) use ($fontPath) {
            $f->file($fontPath); $f->size(14); $f->color('#000');
        });

        // 5. ASSINATURA DO EMBAIXADOR
       // 5. ASSINATURA DO EMBAIXADOR - CENTRALIZADO E MAIS JUNTO
// 5. ASSINATURA DO EMBAIXADOR - MAIS PARA BAIXO
 // AUMENTADO de 80 para 120



// 5. ASSINATURA DO EMBAIXADOR - CORRIGIDO (assinatura em cima, título por baixo)
// 5. ASSINATURA DO EMBAIXADOR - CORRIGIDO (sem quadrados)
$y += 130;

// Primeiro a ASSINATURA (imagem) em cima
if (file_exists(public_path('templates/ga.png'))) {
    $ga = Image::make(public_path('templates/ga.png'))->resize(200, 60);
    $back->insert($ga, 'top-left', 400, $y);
}

// Depois o TÍTULO por baixo da assinatura - SEPARADO POR IDIOMA
// Parte em português com fonte Arial Bold
$back->text("O EMBAIXADOR /", 400, $y + 70, function($f) use ($fontBoldPath) {
    $f->file($fontBoldPath); $f->size(16); $f->color('#000');
});

// Parte em chinês com fonte chinesa (para não aparecer quadrado)
$back->text("签字", 530, $y + 70, function($f) use ($fontChinesePath) {
    $f->file($fontChinesePath); $f->size(16); $f->color('#000');
});

// 6. Texto das autoridades - MAIS PARA BAIXO E CENTRALIZADO
// 6. Texto das autoridades - MAIS PARA BAIXO E MAIS PARA A DIREITA
$y += 150;

$back->text("ÀS AUTORIDADES A QUEM ESTE DOCUMENTO É APRESENTADO, SOLICITAMOS", 480, $y, function($f) use ($fontPath) {
    $f->file($fontPath); $f->size(11); $f->color('#000');
    $f->align('center');
});

$y += 22;
$back->text("GENTILMENTE QUE SEJA PRESTADA A ASSISTÊNCIA NECESSÁRIA AO SEU TITULAR", 480, $y, function($f) use ($fontPath) {
    $f->file($fontPath); $f->size(11); $f->color('#000');
    $f->align('center');
});

$y += 22;
$back->text("向接收此文件的当局请求, 请为持有人提供必要的协助", 480, $y, function($f) use ($fontChinesePath) {
    $f->file($fontChinesePath); $f->size(11); $f->color('#000');
    $f->align('center');
});

// 7. Telefone - MAIS PARA BAIXO E MAIS PARA A DIREITA
$y += 25;
$back->text("Telf: (+86 10) 65326968 – 65326839 – 65326970", 480, $y, function($f) use ($fontPath) {
    $f->file($fontPath); $f->size(11); $f->color('#000');
    $f->align('center');
});

        // 8. DIGITAL
        $back->text("DIGITAL /", $rightMargin, 120, function($f) use ($fontBoldPath) {
            $f->file($fontBoldPath); $f->size(18); $f->color('#000');
        });
        $back->text("指纹", $rightMargin + 100, 120, function($f) use ($fontChinesePath) {
            $f->file($fontChinesePath); $f->size(18); $f->color('#000');
        });

        if ($fingerPath && file_exists(public_path($fingerPath))) {
            $fingerprint = Image::make(public_path($fingerPath))->resize(150, 190);
            $back->insert($fingerprint, 'top-left', $rightMargin, 160);
        }

        // ==================== MONTAGEM FINAL - TAMANHO REAL PARA IMPRESSÃO ====================


$canvas = Image::canvas(2046, 638, '#ffffff');
$canvas->insert($front, 'left', 0, 0);
$canvas->insert($back, 'left', 1033, 0);

return $canvas->response('png')
    ->header('Content-Type', 'image/png')
    ->header('Content-Disposition', 'inline; filename="cartao_' . $card->document_number . '.png"')
    ->header('X-Resolution', '300')
    ->header('Y-Resolution', '300');

        return $canvas->response('png');
    }
}
