<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Upload;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;


class CardController extends Controller
{
    /* public function index()
    {
        $cards = Card::with('uploads')->get();
        return view('admin.dash.index', compact('cards'));
    } */
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

        return redirect()->route('dash')->with('success', 'Cartão criado com sucesso!');
    }

    public function destroy(Card $card)
    {
        $card->delete();
        return redirect()->route('dash')->with('success', 'Cartão eliminado com sucesso!');
    }


    public function cardgenerate($id)
    {
        $card = Card::findOrFail($id);

        $uploads = Upload::where('card_id', $card->id)->get();

        $pdf = PDF::loadView('pdf.card.index', compact('card', 'uploads'))
            ->setPaper('a6', 'landscape');

        return $pdf->stream('RelatorioTodosEstagiarios.pdf');
    }
}
