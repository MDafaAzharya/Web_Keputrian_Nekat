<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Galeri;
use Illuminate\Support\Facades\File;

class GaleriController extends Controller
{
    public function index()
    {
        $image = Galeri::all();
        return view ('dashboard/galeri', compact('image'));
    }

    public function store(Request $request)
    {
        //dd($request->all());
      if ($request->file('foto')) {
        // $foto = $this->upload($request->file('foto'), $this->path);
        $file = $request->file('foto');
        $fileName = $file->getClientOriginalName();
        $file->move('assets/dataimage', $fileName);
        // $validated['logo'] = $fileName;
      }
      $insert = Galeri::create([
        'nama_file' => $fileName,
      ]);
      session()->flash('success', 'Data Berhasil Ditambahkan');
      return back();
    }
    public function destroy(string $id)
    {
      $image = Galeri::findOrFail($id);
        
      if ($image->nama_file) {
        $imagePath = 'public/assets/dataimage' . $image->nama_file;
        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }
      }
      $image->delete();
      session()->flash('success', 'Data Berhasil Ditambahkan');
      return back();
    }
}
