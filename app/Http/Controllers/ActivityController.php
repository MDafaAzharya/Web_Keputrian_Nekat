<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ActivityModel; 
use Illuminate\Support\Facades\Storage;
class ActivityController extends Controller
{
    public function insertActivity(Request $request)
    {
        // Validasi input
        $request->validate([
            'date' => 'required|date',
            'activity' => 'required|string',
            'place' => 'required|string',
            'ket' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Sesuaikan dengan kebutuhan Anda
        ]);
    
        try {
            // Upload gambar jika ada
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('images', 'public');
            } else {
                $imagePath = null;
            }
    
            // Simpan data ke dalam tabel activity_report
            ActivityModel::create([
                'date' => $request->input('date'),
                'jenis_kegiatan' => $request->input('activity'),
                'lokasi' => $request->input('place'),
                'keterangan' => $request->input('ket'),
                'image' => $imagePath, // Simpan path gambar
            ]);
    
            // Tampilkan notifikasi SweetAlert berhasil
            return redirect()->back()->with('success', 'Data berhasil disimpan.');
    
        } catch (\Exception $e) {
            // Tampilkan notifikasi SweetAlert gagal
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
            
   

    public function showdata()
    {
        $activitymodel = ActivityModel::all();
        return view('report', compact('activitymodel'));
    }


    public function edit($id)
    {
        $activitymodel = ActivityModel::all($id);
        return view('report', compact('activity'));
    }


    public function editdata(Request $request)
    {
        // Validasi data yang diterima dari form edit
    $validatedData = $request->validate([
        'date' => 'required|date',
        'activity' => 'required|string',
        'place' => 'required|string',
        'ket' => 'required|string',
        'image' => 'nullable|image|max:2048', // Contoh validasi untuk gambar (opsional)
    ]);

    // Mengambil ID laporan dari input hidden
    $reportId = $request->input('report_id');

    // Mengambil laporan berdasarkan ID
    $report = ActivityModel::find($reportId);

    if (!$report) {
        // Laporan tidak ditemukan, handle kesalahan di sini
        return redirect()->back()->with('error', 'Laporan tidak ditemukan.');
    }

    // Update data laporan berdasarkan data yang diterima dari form
    $report->date = $validatedData['date'];
    $report->jenis_kegiatan = $validatedData['activity'];
    $report->lokasi = $validatedData['place'];
    $report->keterangan = $validatedData['ket'];

    // Jika ada file gambar yang diunggah, simpan dan perbarui path gambar
    if ($request->hasFile('image')) {
        // Hapus gambar lama jika ada
        if ($report->image) {
            Storage::disk('public')->delete($report->image);
        }

        // Simpan gambar baru
        $imagePath = $request->file('image')->store('images', 'public');
        $report->image = $imagePath;
    }

    $report->save();

    // Redirect dengan pesan sukses jika diperlukan
    return redirect()->route('report')->with('success', 'Laporan berhasil diperbarui.');
    return redirect()->route('report')->with('error', 'Laporan Gagal diperbarui.');
    }

    public function delete($id)
    {
        // Temukan laporan berdasarkan ID
        $report = ActivityModel::find($id);

        if (!$report) {
            // Laporan tidak ditemukan, handle kesalahan di sini
            return redirect()->back()->with('error', 'Laporan tidak ditemukan.');
        }

        // Hapus gambar terkait jika ada
        if ($report->image) {
            Storage::disk('public')->delete($report->image); // Menggunakan 'public' disk untuk menghapus gambar
        }

        // Hapus laporan dari database
        $report->delete();

        // Redirect dengan pesan sukses jika diperlukan
        return redirect()->route('report')->with('success', 'Laporan berhasil dihapus.');
    }

    public function profile()
    {
        return view('profile');
    }

    public function print(Request $request)
    {
    $startDate = $request->input('start_date');
    $endDate = $request->input('end_date');

    if ($startDate && $endDate) {
        $reports = ActivityMOdel::whereBetween('date', [$startDate, $endDate])->get();
    } else {
        $reports = ActivityMOdel::all();
    }

    return view('print', compact('reports'));
    }    
}


