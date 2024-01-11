<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ActivityModel; 
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class ActivityController extends Controller
{
    public function insertActivity(Request $request)
{
    // Validasi input
    //dd($request->all());
    $request->validate([
        'date' => 'required|date',
        'activity' => 'required|string',
        'place' => 'required|string',
        'ket' => 'required|string',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif', // Maksimum 2 MB
    ]);

   
        if ($request->file('image')) {
            // $image = $this->upload($request->file('image'), $this->path);
            $file = $request->file('image');
            $fileName = $file->getClientOriginalName();
            $file->move('assets/dataimage', $fileName);
            // $validated['logo'] = $fileName;
        }
        // Simpan data ke dalam tabel activity_report
        ActivityModel::create([
            'date' => $request->input('date'),
            'jenis_kegiatan' => $request->input('activity'),
            'lokasi' => $request->input('place'),
            'keterangan' => $request->input('ket'),
            'image' => $fileName,
        ]);

        // Tampilkan notifikasi SweetAlert berhasil
        return redirect()->back()->with('success', 'Data berhasil disimpan.');
   
}

    public function showdata()
    {
        $activitymodel = ActivityModel::all();
        return view('dashboard/report', compact('activitymodel'));
    }

    public function edit($id)
    {
        $activitymodel = ActivityModel::all($id);
        return view('dashboard/report', compact('activity'));
    }

    public function editdata(Request $request){
        // Validasi input
        $request->validate([
            'date' => 'required|date',
            'activity' => 'required|string',
            'place' => 'required|string',
            'ket' => 'required|string',
            'images' => 'nullable|image|mimes:jpeg,png,jpg,gif', 
        ]);
        try {
            $user = ActivityModel::findorfail($request->report_id);
            $user->date = $request->date;
            $user->jenis_kegiatan = $request->activity;
            $user->lokasi = $request->place;
            $user->keterangan = $request->ket;
            
            if ($request->hasFile('image')) {
                $originalFileName = $request->file('image')->getClientOriginalName();
                $imagePath = public_path('assets/dataimage/' . $user->image);
                
                if (File::exists($imagePath)) {
                    File::delete($imagePath);
                }
        
                // Menyimpan gambar baru ke storage
                $image = $request->file('image')->move('assets/dataimage', $originalFileName);
        
                // Mengupdate nama file gambar
                $user->image = $originalFileName;
            }
            
            $user->update();
            // Tampilkan notifikasi SweetAlert berhasil
            return redirect()->back()->with('success', 'Data berhasil disimpan.');
        } catch (\Exception $e) {
            // Tampilkan notifikasi SweetAlert gagal
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        $report = ActivityModel::find($id);
        $imagePath = public_path('assets/dataimage/' . $report->image);
                
        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }
        
        // Hapus laporan dari database
        $report->delete();
        
        // Redirect dengan pesan sukses jika diperlukan
        return redirect()->route('report')->with('success', 'Laporan berhasil dihapus.');
    }
    public function profile()
    {
        return view('dashboard/profile');
    }

    public function print(Request $request)
    {
    $startDate = $request->input('start_date');
    $endDate = $request->input('end_date');

    if ($startDate && $endDate) {
        $reports = ActivityModel::whereBetween('date', [$startDate, $endDate])->get();
    } else {
        $reports = ActivityModel::all();
    }

    return view('dashboard/print', compact('reports'));
    }    
}