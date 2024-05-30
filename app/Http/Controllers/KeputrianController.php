<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Keputrian;
use Illuminate\Support\Facades\File;
class KeputrianController extends Controller
{
    public function index()
    {
        $keputrian = Keputrian::all();
        return view('dashboard.keputrian', compact('keputrian'));
    }
    public function update(Request $request)
    {
       //dd($request->all());
        $request->validate([
            'judul' => 'required',
            'text' => 'required',
            'gambar' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $data = Keputrian::find($request->id);
    
        // Cek apakah ada file gambar baru diunggah
        if ($request->hasFile('gambar')) {
            $originalFileName = $request->file('gambar')->getClientOriginalName();
    
            // Menghapus gambar sebelumnya jika ada
            if ($data->gambar) {
                File::delete('public/assets/dataimage/' . $data->gambar);
            }
    
            // Menyimpan gambar baru ke storage
            $image = $request->file('gambar')->move('assets/dataimage', $originalFileName);
    
            // Mengupdate nama file gambar
            $data->gambar = $originalFileName;
        }
    
        $data->judul = $request->judul;
        $data->text = $request->text;
        $data->save();
        return back()->with('success', 'Berhasil mengubah Data');
    }
}
