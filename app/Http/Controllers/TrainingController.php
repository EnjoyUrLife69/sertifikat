<?php

namespace App\Http\Controllers;

use App\Models\Training;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

// indonesia
Carbon::setLocale('id');

class TrainingController extends Controller
{
    // Fungsi untuk nge format tanggal dengan ordinal
    private function formatWithOrdinal($date)
    {
        $day = $date->day;

        // Tentukan suffix
        if ($day % 100 >= 11 && $day % 100 <= 13) {
            $suffix = 'th'; // pengecualian untuk hari ke 11, 12, dan 13
        } elseif ($day % 10 == 1) {
            $suffix = 'st';
        } elseif ($day % 10 == 2) {
            $suffix = 'nd';
        } elseif ($day % 10 == 3) {
            $suffix = 'rd';
        } else {
            $suffix = 'th';
        }

        return $date->format('j') . $suffix;
    }

    public function index()
    {
        // Retrieve all trainings ordered by the created date
        $training = Training::withCount('sertifikat')
            ->orderBy('created_at', 'desc')
            ->get();

        // Add formatted date range to each training
        foreach ($training as $data) {
            $startDate = Carbon::parse($data->tanggal_mulai);
            $endDate = Carbon::parse($data->tanggal_selesai);

            // Format dates with ordinal suffix
            $formattedStartDate = $this->formatWithOrdinal($startDate);
            $formattedEndDate = $this->formatWithOrdinal($endDate);

            if ($startDate->format('F Y') === $endDate->format('F Y')) {
                $formattedMonth = $startDate->translatedFormat('F'); // Menggunakan translatedFormat untuk bahasa
                $formattedYear = $startDate->translatedFormat('Y');

                // Mengubah format tanggal menjadi bahasa Indonesia
                $data->formatted_tanggal = "{$formattedMonth} {$formattedStartDate} - {$formattedEndDate}, {$formattedYear}";
            } else {
                // Bulan yang berbeda
                $formattedStartDate = $startDate->translatedFormat('F j'); // Menggunakan translatedFormat untuk bahasa
                $formattedEndDate = $endDate->translatedFormat('F j, Y');

                $data->formatted_tanggal = "{$formattedStartDate} - {$formattedEndDate}";
            }
        }

        return view('training.index', compact('training'));
    }

    public function create()
    {
        return view('training.create');

    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_training' => 'required|string|max:255|unique:trainings,nama_training',
            'kode' => 'required|string|max:50|unique:trainings,kode',
        ]);

        $training = new Training;
        $training->nama_training = $request->nama_training;
        $training->tanggal_mulai = $request->tanggal_mulai;
        $training->tanggal_selesai = $request->tanggal_selesai;
        $training->kode = $request->kode;

        if ($request->hasFile('cover')) {
            $img = $request->file('cover');
            $name = rand(1000, 9999) . $img->getClientOriginalName();
            $img->move('images/training', $name);
            $training->cover = $name;
        }

        $training->konten = $request->konten;

        $training->save();

        toast('Data has been Created!', 'success')->position('top-end');
        return redirect()->route('training.index');
    }

    public function show($id)
    {
        $training = Training::FindOrFail($id);
        return view('training.show', compact('training'));

    }

    public function edit($id)
    {
        $training = Training::FindOrFail($id);
        return view('training.edit', compact('training'));

    }
    public function update(Request $request, $id)
    {

        $training = Training::FindOrFail($id);

        $training->nama_training = $request->nama_training;
        $training->tanggal_mulai = $request->tanggal_mulai;
        $training->tanggal_selesai = $request->tanggal_selesai;
        $training->kode = $request->kode;

        if ($request->hasFile('cover')) {
            $img = $request->file('cover');
            $name = rand(1000, 9999) . $img->getClientOriginalName();
            $img->move('images/training', $name);
            $training->cover = $name;
        }

        $training->konten = $request->konten;

        $training->save();

        toast('Data has been Updated!', 'success')->position('top-end');
        return redirect()->route('training.index');

    }

    public function destroy($id)
    {
        $training = Training::FindOrFail($id);
        $training->delete();

        toast('Data has been Deleted!', 'success')->position('top-end');
        return redirect()->route('training.index');

    }

}
