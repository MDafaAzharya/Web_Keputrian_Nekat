<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Galeri;
use App\Models\Keputrian;
use App\Models\ActivityModel;
use App\Models\Agenda;

class HomeController extends Controller
{
    public function index()
    {
        $foto = Galeri::take(3)->get();
        $cardfoto = ActivityModel::all();
        $keputrian = Keputrian::all();
        return view('home', compact('foto','cardfoto','keputrian'));
    }

    public function galeri(Request $request)
    {
        $query = $request->input('query');

        $cardfoto = ActivityModel::when($query, function ($query, $search) {
            return $query->where('jenis_kegiatan', 'like', '%' . $search . '%')
                        ->orWhere('lokasi', 'like', '%' . $search . '%')
                        ->orWhere('keterangan', 'like', '%' . $search . '%')
                        ->orWhere('date', 'like', '%' . $search . '%');
        })
        ->get();
        return view('galeri', compact('cardfoto'));
    }

    public function detail($id)
    {
        $galeri =  ActivityModel::find($id);
        return view("galeri-detail", compact('galeri'));
    }

    public function agenda(){
        return view("agenda");
    }
    public function showagenda(Request $request){
        //dd($request->all());
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
}
