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
        // 'image' => 'required|image|mimes:jpeg,png,jpg,gif', // Maksimum 2 MB
    ]);

        $imagePaths = [];
        foreach ($request->file('image') as $image) {
            // $image = $this->upload($request->file('image'), $this->path);
            $fileName = $image->getClientOriginalName();
            $image->move('assets/dataimage', $fileName);
            $imagePaths[] = $fileName;
            // $validated['logo'] = $fileName;
        }
        // Simpan data ke dalam tabel activity_report
        ActivityModel::create([
            'date' => $request->input('date'),
            'jenis_kegiatan' => $request->input('activity'),
            'lokasi' => $request->input('place'),
            'keterangan' => $request->input('ket'),
            'image' => json_encode($imagePaths),
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

    public function editdata(Request $request)
    {
        // Validasi input
        $request->validate([
            'date' => 'required|date',
            'activity' => 'required|string',
            'place' => 'required|string',
            'ket' => 'required|string',
        ]);
    
        try {
            $activity = ActivityModel::findOrFail($request->report_id);
            $activity->date = $request->date;
            $activity->jenis_kegiatan = $request->activity;
            $activity->lokasi = $request->place;
            $activity->keterangan = $request->ket;
    
            if ($request->hasFile('image')) {
                // Hapus gambar lama jika ada
                $oldImages = json_decode($activity->image);
                foreach ($oldImages as $oldImage) {
                    $oldImagePath = public_path('assets/dataimage/' . $oldImage);
                    if (File::exists($oldImagePath)) {
                        File::delete($oldImagePath);
                    }
                }
    
                // Simpan gambar baru ke storage
                $uploadedImages = [];
                foreach ($request->file('image') as $image) {
                    $originalFileName = $image->getClientOriginalName();
                    $image->move('assets/dataimage', $originalFileName);
                    $uploadedImages[] = $originalFileName;
                }
    
                // Simpan nama file gambar sebagai JSON
                $activity->image = json_encode($uploadedImages);
            }
    
            $activity->update();
    
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

    return view('dashboard.print', compact('reports'));
    }    
}