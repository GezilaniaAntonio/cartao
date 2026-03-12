<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Card;

class CardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $response['cards'] = Card::OrderBy('id')->get();
            return view('admin.cards.list.index', $response);
        }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.cards.create.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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
            'document_number' => 'required|string|unique:cards',
            'place_of_issue' => 'required|string',
            'date_of_issue' => 'required|date',
            'expiry_date' => 'required|date|after:today'
        ]);

        $data = $request->except('_token');

        $imageName = null;

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $image = $request->file('image');
            $extension = $image->extension();
            $imageName = md5($image->getClientOriginalName() . strtotime('now')) . '.' . $extension;
            $image->move(public_path('img/cards'), $imageName);
            $data['image'] = $imageName;
        }

        Card::create($data);

        return redirect()->route('admin.cards.list')
            ->with('success', 'Cartão cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Card $card)
    {
        //

        return view('admin.cards.detail.index', ['card' => $card]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Card $card)
    {
        //

        return view('admin.cards.edit.index', ['card' => $card]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Card $card)
    {
        //
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
            'document_number' => 'required|string|unique:cards',
            'place_of_issue' => 'required|string',
            'date_of_issue' => 'required|date',
            'expiry_date' => 'required|date|after:today'
        ]);

        $data = $request->except('_token');

        $imageName = null;

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $image = $request->file('image');
            $extension = $image->extension();
            $imageName = md5($image->getClientOriginalName() . strtotime('now')) . '.' . $extension;
            $image->move(public_path('img/cards'), $imageName);
            $data['image'] = $imageName;
        }

        $card->update($data);


        return redirect()->route('admin.cards.list')
            ->with('success', 'Cartão atualizado com sucesso!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Card $card)
    {
        //
        $card->delete();
        return redirect()->route('admin.cards.list')
            ->with('success', 'Cartão excluído com sucesso!');
    }
}
