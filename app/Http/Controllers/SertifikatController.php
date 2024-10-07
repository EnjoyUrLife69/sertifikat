<?php
namespace App\Http\Controllers;

use App\Exports\SertifikatExport;
use App\Models\Sertifikat;
use App\Models\Training;
use Carbon\Carbon;
use Dompdf\Dompdf;
use Dompdf\Options;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Maatwebsite\Excel\Facades\Excel;
use setasign\Fpdi\Fpdi;

class SertifikatController extends Controller
{
    public function index(Request $request)
    {
        $training = Training::all();

        // Ambil ID kategori dari request
        $id_training = $request->get('id_training');

        // Jika kategori_id ada dan tidak kosong, filter artikel berdasarkan kategori tersebut
        if ($id_training) {
            $sertifikat = Sertifikat::where('id_training', $id_training)->get();
        } else {
            // Jika tidak, ambil semua artikel
            $sertifikat = Sertifikat::orderBy('created_at', 'desc')->get();

        }

        // Add formatted date range to each serti$sertifikat
        foreach ($sertifikat as $data) {
            $startDate = Carbon::parse($data->tanggal_mulai);
            $endDate = Carbon::parse($data->tanggal_selesai);

            // Check if the start and end dates are in the same month
            if ($startDate->format('F Y') === $endDate->format('F Y')) {
                $formattedStartDate = $startDate->format('j');
                $formattedEndDate = $endDate->format('j');
                $formattedMonth = $startDate->translatedFormat('F');
                $formattedYear = $startDate->translatedFormat('Y');

                $data->formatted_tanggal = "{$formattedMonth} {$formattedStartDate} - {$formattedEndDate} , {$formattedYear}";
            } else {
                // Different months
                $formattedStartDate = $startDate->format('F j');
                $formattedEndDate = $endDate->format('F j ,Y');

                $data->formatted_tanggal = "{$formattedStartDate} - {$formattedEndDate}";
            }
        }

        return view('sertifikat.index', compact('sertifikat', 'training', 'id_training'));
    }

    public function create()
    {
        $sertifikat = Sertifikat::all();
        $training = Training::all();
        return view('sertifikat.create', compact('sertifikat', 'training'));

    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_penerima' => 'required|string|max:255',
            'id_training' => 'required',
            'email' => 'required|email',
        ]);

        $sertifikat = new Sertifikat;
        $sertifikat->nama_penerima = $request->nama_penerima;
        $sertifikat->id_training = $request->id_training;
        $sertifikat->email = $request->email;

        $sertifikat->save();

        toast('Data has been submited!', 'success')->position('top-end');
        return redirect()->route('sertifikat.index');

    }

    public function show($id)
    {
        $sertifikat = Sertifikat::FindOrFail($id);
        $training = training::all();
        return view('sertifikat.show', compact('sertifikat', 'training'));

    }

    public function edit($id)
    {
        $sertifikat = Sertifikat::findOrFail($id);
        $training = Training::all();

        return view('sertifikat.edit', compact('sertifikat', 'training'));

    }

    public function update(Request $request, $id)
    {
        $sertifikat = Sertifikat::findOrFail($id);
        $sertifikat->nama_penerima = $request->nama_penerima;
        $sertifikat->id_training = $request->id_training;
        $sertifikat->email = $request->email;
        $sertifikat->status = $request->status;

        $sertifikat->save();

        toast('Data has been Updated!', 'success')->position('top-end');
        return redirect()->route('sertifikat.index', ['id_training' => $request->id_training])
            ->with('success', 'Data berhasil diupdate');

    }

    public function destroy($id)
    {
        $sertifikat = Sertifikat::FindOrFail($id);
        $sertifikat->delete();

        toast('Data has been Deleted!', 'success')->position('top-end');
        return redirect()->route('sertifikat.index');

    }

    // Fungsi untuk nge format tanggal dengan ordinal
    private function formatWithOrdinal($date)
    {
        $day = $date->day;

        // Tentukan suffix
        if ($day % 10 == 1 && $day != 11) {
            $suffix = 'st';
        } elseif ($day % 10 == 2 && $day != 12) {
            $suffix = 'nd';
        } elseif ($day % 10 == 3 && $day != 13) {
            $suffix = 'rd';
        } else {
            $suffix = 'th';
        }

        return $date->format('j') . $suffix;
    }

    // Metode untuk mencetak sertifikat berdasarkan ID
    public function printCertificate($id)
    {
        // Ambil data sertifikat dari database berdasarkan ID, termasuk data relasi dengan 'training'
        $sertifikat = Sertifikat::with('training')->findOrFail($id);

        // Ambil data training terkait
        $training = $sertifikat->training;

        if (!$training) {
            return abort(404, 'Training data not found');
        }

        // Format tanggal dari data training
        $startDate = Carbon::parse($training->tanggal_mulai);
        $endDate = Carbon::parse($training->tanggal_selesai);

        // Format tanggal dengan suffix ordinal
        $formattedStartDate = $this->formatWithOrdinal($startDate);
        $formattedEndDate = $this->formatWithOrdinal($endDate);

        if ($startDate->format('F Y') === $endDate->format('F Y')) {
            $formattedMonth = $startDate->translatedFormat('F');
            $formattedYear = $startDate->translatedFormat('Y');

            $formattedTanggal = "{$formattedMonth} {$formattedStartDate} - {$formattedEndDate}, {$formattedYear}";
        } else {
            $formattedStartDate = $startDate->format('F j');
            $formattedEndDate = $endDate->format('F j, Y');

            $formattedTanggal = "{$formattedStartDate} - {$formattedEndDate}";
        }

        // Mengubah bulan ke format Romawi
        $bulanRomawi = [
            1 => 'I', 2 => 'II', 3 => 'III', 4 => 'IV', 5 => 'V', 6 => 'VI',
            7 => 'VII', 8 => 'VIII', 9 => 'IX', 10 => 'X', 11 => 'XI', 12 => 'XII',
        ];
        $bulanRomaji = $bulanRomawi[$startDate->format('n')]; // 'n' menghasilkan angka bulan tanpa leading zero

        $nomorSertifikat = sprintf(
            'NO. %03d/%s/%s/%d',
            $sertifikat->id, // ID Nama Penerima
            $training->kode, // Kode dari tabel training
            $bulanRomaji, // Bulan dalam format Romawi
            $startDate->year// Tahun
        );

        // Membuat QR Code dengan URL untuk pengecekan sertifikat
        $qrCode = new QrCode(url('/check-certificate?nomor_sertifikat=' . urlencode($nomorSertifikat)));
        $qrCode->setSize(300); // Set ukuran QR Code
        $writer = new PngWriter();
        $qrCodePath = public_path("assets/qr_codes/{$sertifikat->id}.png");

        // Menyimpan QR Code ke file
        $writer->write($qrCode)->saveToFile($qrCodePath);

        // Path ke template PDF
        $templatePath = public_path('assets/img/sertifikat/template.pdf');

        if (!file_exists($templatePath)) {
            return abort(404, 'Template PDF not found');
        }

        // Inisialisasi FPDF
        $pdf = new Fpdi();

        // Inisialisasi FPDI dan FPDF
        define('FPDF_FONTPATH', public_path('fonts/'));

        // Daftarkan font
        $pdf->AddFont('AlexBrush-Regular', '', 'AlexBrush-Regular.php');

        // Menambahkan halaman dengan orientasi horizontal (landscape)
        $pdf->AddPage('L');

        // Set sumber file
        $pdf->setSourceFile($templatePath);

        // Import halaman pertama dari template PDF
        $tplIdx = $pdf->importPage(1);
        $pdf->useTemplate($tplIdx);

        $pdf->Image($qrCodePath, 30, 140, 50, 50); // Menyesuaikan posisi dan ukuran QR Code

        // Nama Penerima
        $pdf->SetFont('AlexBrush-Regular', '', 45);
        $pdf->SetTextColor(0, 0, 0); // Set warna teks ke hitam
        $pdf->SetXY(5, 90);
        $pdf->Cell(0, 10, $sertifikat->nama_penerima, 0, 1, 'C'); // 'C' untuk center alignment

        // Nomor Sertifikat
        $pdf->SetFont('Helvetica', 'B', 15);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->SetXY(113, 66);
        $pdf->Write(0, $nomorSertifikat);

        // Nama Pelatihan
        $pdf->SetFont('Helvetica', '', 17);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetXY(4, 115);
        $pdf->Cell(0, 10, 'for ' . $sertifikat->training->nama_training, 0, 1, 'C');

        // Tanggal
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetXY(4, 132.5);
        $pdf->Cell(0, 10, 'on ' . $formattedTanggal, 0, 1, 'C');

        // Nama file sesuai dengan nama penerima
        $fileName = "{$sertifikat->nama_penerima}_Sertifikat.pdf";

        // Output PDF
        return response($pdf->Output('S'), 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', "inline; filename=\"{$fileName}\"");
    }

    public function exportExcel()
    {
        // Mengambil id_training dari request
        $idTraining = request()->get('id_training');

        // Mengambil data sertifikat dengan filter jika id_training diberikan
        if ($idTraining) {
            $data = Sertifikat::with('training')->where('id_training', $idTraining)->orderBy('nama_penerima', 'asc')->get();
        } else {
            $data = Sertifikat::with('training')->get();
        }

        return Excel::download(new SertifikatExport($data), 'sertifikat.xlsx');
    }

    public function exportPDF(Request $request)
    {
        // Ambil parameter id_training dari request
        $idTraining = $request->get('id_training');

        // Ambil data sertifikat berdasarkan id_training yang difilter
        $sertifikat = Sertifikat::with('training')
            ->when($idTraining, function ($query) use ($idTraining) {
                return $query->where('id_training', $idTraining);
            })
            ->orderBy('nama_penerima', 'asc')
            ->get();

        // Cek apakah ada sertifikat yang ditemukan
        if ($sertifikat->isEmpty()) {
            return redirect()->back()->with('error', 'Data sertifikat tidak ditemukan.');
        }

        // Ambil nama training dari sertifikat pertama yang difilter
        $namaTraining = $sertifikat->first()->training ? $sertifikat->first()->training->nama_training : 'training_tidak_ditemukan';

        // Siapkan data untuk dikirim ke view
        $data = [
            'sertifikat' => $sertifikat,
        ];

        // Load view untuk PDF
        $pdfView = View::make('pdf.certificate', $data)->render();

        // Inisialisasi DOMPDF
        $options = new Options();
        $options->set('defaultFont', 'Arial');
        $dompdf = new Dompdf($options);

        // Load HTML dari view ke DOMPDF
        $dompdf->loadHtml($pdfView);

        // (Optional) Set ukuran kertas dan orientasi
        $dompdf->setPaper('A4', 'portrait');

        // Render PDF
        $dompdf->render();

        // Ganti spasi pada nama training dengan underscore agar sesuai dengan format file
        $namaFile = str_replace(' ', '_', $namaTraining) . '_peserta.pdf';

        // Kirim PDF ke browser untuk didownload dengan nama file sesuai nama training
        return $dompdf->stream($namaFile);
    }
}
