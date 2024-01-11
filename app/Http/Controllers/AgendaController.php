<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agenda;

class AgendaController extends Controller
{
    public function index()
    {
            return view('dashboard.agenda');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'judul' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'warna' => 'required',
          ]);
          $data = $request->all();
          $data['judul'] = $request->input('judul');
          $data['start_date'] = $request->input('start_date');
          $data['end_date'] = $request->input('end_date');
          $data['warna'] = $request->input('warna');
          $insert = Agenda::create($data);

          return back()->with('success', 'Berhasil menambahkan Data');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $start = date('Y-m-d', strtotime($request->start));
        $end = date('Y-m-d', strtotime($request->end));

        $events = Agenda::where('start_date', '>=', $start)
        ->where('end_date', '<=' , $end)->get()
        ->map( fn ($item) => [
            'id' => $item->id,
            'title' => $item->judul,
            'start' => $item->start_date,
            'end' => date('Y-m-d',strtotime($item->end_date. '+1 days')),
            'color' => $item->warna,
            'className' => ['bg-'. $item->warna]
        ]);

        return response()->json($events);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
       $data =  Agenda::find($id);
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'judul' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'warna' => 'required',
          ]);
        $data = Agenda::find($request->id);      

        $data->judul = $request->judul;
        $data->start_date = $request->start_date;
        $data->end_date = $request->end_date;
        $data->warna = $request->warna;
        $data->save();
        return back()->with('success', 'Berhasil mengubah data');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $Agenda = Agenda::findOrFail($id);
        $Agenda->delete();
        return back()->with('success', 'Berhasil menghapus data');
    }
}
