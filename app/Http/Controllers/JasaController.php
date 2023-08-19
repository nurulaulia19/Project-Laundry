<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\Jasa;
use App\Models\Cabang;
use App\Models\Kategori;
use App\Exports\JasaExport;
use App\Models\AksesCabang;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\View;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class JasaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $dataJasa = Jasa::with('kategori')->orderBy('id_jasa', 'DESC')->paginate(10);
        // $dataProduk = DataProduk::with('kategori')->get();
        return view('jasa.index', compact('dataJasa'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $dataKategori = Kategori::all();
        $dataJasa = Jasa::all();
        return view('jasa.create', compact('dataKategori','dataJasa'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'gambar' => 'required|file|mimes:jpeg,jpg,png',
            // Tambahkan aturan validasi lainnya sesuai kebutuhan
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar'); // phpcs:ignore ..DetectUploadFil.Found
            $extension = $file->getClientOriginalExtension();
            $fileName = Str::random(40) . '.' . $extension;
            // $fileName = $file->getClientOriginalName();
            $file->storeAs('public/photos', $fileName); 
        } else {
            $fileName = null;
        }

        $dataJasa = new Jasa;
        $dataJasa->id_jasa = $request->id_jasa;
        $dataJasa->id_kategori = $request->id_kategori;
        $dataJasa->jenis_layanan = $request->jenis_layanan;
        $dataJasa->harga_perkg = $request->harga_perkg;
        $dataJasa->gambar = $fileName;
        if ($request->has('diskon_jasa')) {
            $dataJasa->diskon_jasa = $request->diskon_jasa;
        } else {
            $dataJasa->diskon_jasa = 0;
        }
        $dataJasa->save();
    
        return redirect()->route('jasa.index')->with('success', 'Jasa inserted successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_jasa)
    {
        $dataKategori = Kategori::all();
        $dataJasa = Jasa::where('id_jasa', $id_jasa)->first();
        return view('jasa.update', compact('dataKategori','dataJasa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_jasa)
    {
        $validator = Validator::make($request->all(), [
            'gambar' => 'file|mimes:jpeg,jpg,png' // phpcs:ignore ..DetectWeakValidation.Found,..DetectWeakValidation.Found
            // Tambahkan aturan validasi lainnya sesuai kebutuhan
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $dataJasa = Jasa::find($id_jasa);
    
        if (!$dataJasa) {
            // Produk dengan 'id_jasa' yang dimaksud tidak ditemukan
            // Lakukan tindakan error handling atau tampilkan pesan kesalahan
            return redirect()->back()->with('error', 'Jasa tidak ditemukan.');
        }
    
        $dataJasa->id_kategori = $request->id_kategori;
        $dataJasa->jenis_layanan = $request->jenis_layanan;
        $dataJasa->harga_perkg = $request->harga_perkg;
        $dataJasa->diskon_jasa = $request->diskon_jasa;
    
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $extension = $file->getClientOriginalExtension();
            $fileName = Str::random(40) . '.' . $extension;
            $file->storeAs('public/photos', $fileName);
            $dataJasa->gambar = $fileName;
        }
    
        $dataJasa->save();
    
        return redirect()->route('jasa.index')->with('success', 'Jasa berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_jasa)
    {
        $dataJasa = Jasa::where('id_jasa', $id_jasa);
        $dataJasa->delete();
        return redirect()->route('jasa.index')->with('success', 'Terdelet');
    }


    
    // public function laporanJasa(Request $request) {
    //     $query = Jasa::with('kategori', 'transaksiDetail.transaksi')
    //         ->orderBy('id_jasa', 'DESC');
    
    //     $startDate = $request->input('start_date');
    //     $endDate = $request->input('end_date');
    //     $status = $request->input('status');
        
    
    //     // Simpan data tanggal dan status ke dalam session jika diberikan dalam request
    //     if ($startDate && $endDate) {
    //         session(['start_date' => $startDate]);
    //         session(['end_date' => $endDate]);
    //     } else {
    //         session()->forget('start_date');
    //         session()->forget('end_date');
    //     }
    
        
    //     // Cek apakah status ada dalam request sebelum menyimpan dalam session
    //     if ($request->has('status')) {
    //         session(['status' => $status]);
    //     } else {
    //         session()->forget('status');
    //     }

    //     $filteredStatus = session('status');

    //     // Terapkan filter jika ada data tanggal dalam session
    //     if (session()->has('start_date') && session()->has('end_date')) {
    //         $query->whereHas('transaksiDetail.transaksi', function ($query) use ($filteredStatus) {
    //             $query->whereBetween('tanggal_transaksi', [session('start_date'), session('end_date')]);

    //             if ($filteredStatus === null) {
    //                 $query->where(function ($query) {
    //                     $query->orWhere('status', 'proses')
    //                         ->orWhere('status', 'selesai');
    //                 });
    //             } else {
    //                 $query->where('status', session('status'));
    //             }
    //         });
    //     }
    
    //     $dataJasa = $query->paginate(10);
    
    //     return view('laporan.laporanJasa', compact('dataJasa'));
    // }
    public function laporanJasa(Request $request) {
        $query = Jasa::with('kategori', 'transaksiDetail.transaksi')
            ->orderBy('id_jasa', 'DESC');
    
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $status = $request->input('status');
        $cabangId = $request->input('cabang'); // Get cabang from request
    
        // Simpan data tanggal dan status ke dalam session jika diberikan dalam request
        if ($startDate && $endDate) {
            session(['start_date' => $startDate]);
            session(['end_date' => $endDate]);
        } else {
            session()->forget('start_date');
            session()->forget('end_date');
        }
    
        // Cek apakah status ada dalam request sebelum menyimpan dalam session
        if ($request->has('status')) {
            session(['status' => $status]);
        } else {
            session()->forget('status');
        }
    
        // Simpan data cabang ke dalam session jika diberikan dalam request
        if ($request->has('cabang')) {
            session(['cabang' => $cabangId]);
        } else {
            session()->forget('cabang');
        }
    
        $filteredStatus = session('status');
        $filteredCabangId = session('cabang'); // Get cabang from session
    
        // Terapkan filter jika ada data tanggal dalam session
        if (session()->has('start_date') && session()->has('end_date')) {
            $query->whereHas('transaksiDetail.transaksi', function ($query) use ($filteredStatus, $filteredCabangId) {
                $query->whereBetween('tanggal_transaksi', [session('start_date'), session('end_date')]);
    
                if ($filteredStatus === null) {
                    $query->where(function ($query) {
                        $query->orWhere('status', 'proses')
                            ->orWhere('status', 'selesai');
                    });
                } else {
                    $query->where('status', session('status'));
                }
    
                // Add cabang filter
                if ($filteredCabangId) {
                    $query->where('id_cabang', $filteredCabangId);
                }
            });
        }
    
        $dataJasa = $query->paginate(10);
        
        // $dataCabang = Cabang::all();
        $loggedInUser = auth()->user();
        $dataCabang = AksesCabang::where('user_id', $loggedInUser->user_id)
            ->with('cabang')
            ->get();

        // dd( $dataJasa);
    
        return view('laporan.laporanJasa', compact('dataJasa','dataCabang'));
    }
    

// public function exportToPDF(Request $request)
// {
//         $paperSize = $request->input('paper_size', 'A4');
    
//         $query = Jasa::query(); // Create a query builder to apply filters
    
//         $startDate = $request->input('start_date');
//         $endDate = $request->input('end_date');
//         $status = $request->input('status');

//         // Simpan data tanggal dan status ke dalam session jika diberikan dalam request
//         if ($startDate && $endDate) {
//             session(['start_date' => $startDate]);
//             session(['end_date' => $endDate]);
//         } else {
//             session()->forget('start_date');
//             session()->forget('end_date');
//         }


//         // Cek apakah status ada dalam request sebelum menyimpan dalam session
//         if ($request->has('status')) {
//             session(['status' => $status]);
//         } else {
//             session()->forget('status');
//         }

//         $filteredStatus = session('status');

//         // Terapkan filter jika ada data tanggal dalam session
//         if (session()->has('start_date') && session()->has('end_date')) {
//             $query->whereHas('transaksiDetail.transaksi', function ($query) use ($filteredStatus) {
//                 $query->whereBetween('tanggal_transaksi', [session('start_date'), session('end_date')]);

//                 if ($filteredStatus === null) {
//                     $query->where(function ($query) {
//                         $query->orWhere('status', 'proses')
//                             ->orWhere('status', 'selesai');
//                     });
//                 } else {
//                     $query->where('status', session('status'));
//                 }
//             });
//         }
        
//             $dataJasa = $query->get();
    
//             $grandTotalJumlahJasa = 0;
//             $dataJasa = $query->get();
            
//             foreach ($dataJasa as $item) {
//                 $totalJumlahJasa = 0; // Inisialisasi total jumlah Jasa untuk setiap Jasa
//                 foreach ($item->transaksiDetail as $transaksiDetail) {
//                     if ($transaksiDetail->transaksi->tanggal_transaksi >= $startDate && $transaksiDetail->transaksi->tanggal_transaksi <= $endDate) {
//                         if (!$status || ($status && $transaksiDetail->transaksi->status == $status)) {
//                             $totalJumlahJasa += $transaksiDetail->jumlah_jasa;
//                         }
//                     }
//                 }
            
//                 // Tambahkan total jumlah produk ke grand total
//                 $grandTotalJumlahJasa += $totalJumlahJasa;
//             }

            
            
//             $pdfOptions = new Options();
//             $pdfOptions->set('defaultFont', 'Arial');
//             // Set ukuran kertas sesuai dengan parameter yang diambil dari request
//             $pdfOptions->set('size', $paperSize);
            
//             $pdf = new Dompdf($pdfOptions);
            
//             // Render the view with data and get the HTML content
//             $htmlContent = View::make('laporan.eksportJasa', compact('dataJasa', 'grandTotalJumlahJasa'))->render();
            
//             $pdf->loadHtml($htmlContent);
            
//             $pdf->setPaper($paperSize, 'portrait'); // Atur ukuran kertas secara dinamis
            
//             $pdf->render();
            
            
//             return $pdf->stream('laporan-jasa.pdf');
// }

public function exportToPDF(Request $request)
{
    $paperSize = $request->input('paper_size', 'A4');

    $query = Jasa::query(); // Create a query builder to apply filters

    $startDate = $request->input('start_date');
    $endDate = $request->input('end_date');
    $status = $request->input('status');
    $cabangId = $request->input('cabang'); // Get the selected cabang from the request

    // Simpan data tanggal, status, dan cabang ke dalam session jika diberikan dalam request
    if ($startDate && $endDate) {
        session(['start_date' => $startDate]);
        session(['end_date' => $endDate]);
    } else {
        session()->forget('start_date');
        session()->forget('end_date');
    }

    if ($request->has('status')) {
        session(['status' => $status]);
    } else {
        session()->forget('status');
    }

    if ($request->has('cabang')) {
        session(['cabang' => $cabangId]);
    } else {
        session()->forget('cabang');
    }

    $filteredStatus = session('status');
    $filteredCabang = session('cabang'); // Use the filtered cabang from session

    // Terapkan filter jika ada data tanggal dalam session
    if (session()->has('start_date') && session()->has('end_date')) {
        $query->whereHas('transaksiDetail.transaksi', function ($query) use ($filteredStatus, $filteredCabang) {
            $query->whereBetween('tanggal_transaksi', [session('start_date'), session('end_date')]);

            if ($filteredStatus === null) {
                $query->whereIn('status', ['proses', 'selesai']);
            } else {
                $query->where('status', session('status'));
            }

            if ($filteredCabang !== null) {
                $query->where('id_cabang', $filteredCabang);
            }
        });
    }

    // Get the filtered Jasa data
    $dataCabang = Cabang::all();
    $dataJasa = $query->get();

    // Calculate the grand total of jumlah_jasa
    $grandTotalJumlahJasa = $dataJasa->sum(function ($item) use ($startDate, $endDate, $status) {
        return $item->transaksiDetail->sum(function ($transaksiDetail) use ($startDate, $endDate, $status) {
            if (
                $transaksiDetail->transaksi &&
                $transaksiDetail->transaksi->tanggal_transaksi >= $startDate &&
                $transaksiDetail->transaksi->tanggal_transaksi <= $endDate &&
                (!$status || ($status && $transaksiDetail->transaksi->status == $status))
            ) {
                return $transaksiDetail->jumlah_jasa;
            }
            return 0;
        });
    });
    
      $pdfOptions = new Options();
            $pdfOptions->set('defaultFont', 'Arial');
            // Set ukuran kertas sesuai dengan parameter yang diambil dari request
            $pdfOptions->set('size', $paperSize);
            
            $pdf = new Dompdf($pdfOptions);
            
            // Render the view with data and get the HTML content
            $htmlContent = View::make('laporan.eksportJasa', compact('dataJasa', 'grandTotalJumlahJasa', 'dataCabang'))->render();
            
            $pdf->loadHtml($htmlContent);
            
            $pdf->setPaper($paperSize, 'portrait'); // Atur ukuran kertas secara dinamis
            
            $pdf->render();
            
            
            return $pdf->stream('laporan-jasa.pdf');
}
    


// public function exportToExcel(Request $request)
// {
    
//     $query = Jasa::with('kategori', 'transaksiDetail.transaksi')
//     ->orderBy('id_jasa', 'DESC');

//         $startDate = $request->input('start_date');
//         $endDate = $request->input('end_date');
//         $status = $request->input('status');

//         // Simpan data tanggal dan status ke dalam session jika diberikan dalam request
//         if ($startDate && $endDate) {
//             session(['start_date' => $startDate]);
//             session(['end_date' => $endDate]);
//         } else {
//             session()->forget('start_date');
//             session()->forget('end_date');
//         }


//         // Cek apakah status ada dalam request sebelum menyimpan dalam session
//         if ($request->has('status')) {
//             session(['status' => $status]);
//         } else {
//             session()->forget('status');
//         }

//         $filteredStatus = session('status');

//         // Terapkan filter jika ada data tanggal dalam session
//         if (session()->has('start_date') && session()->has('end_date')) {
//             $query->whereHas('transaksiDetail.transaksi', function ($query) use ($filteredStatus) {
//                 $query->whereBetween('tanggal_transaksi', [session('start_date'), session('end_date')]);

//                 if ($filteredStatus === null) {
//                     $query->where(function ($query) {
//                         $query->orWhere('status', 'proses')
//                             ->orWhere('status', 'selesai');
//                     });
//                 } else {
//                     $query->where('status', session('status'));
//                 }
//             });
//         }


//             $dataJasa = $query->get();

//     // Modify the data to exclude the 'id_transaksi' column and add the sequential number
//     $dataWithNumber = [];
//     $counter = 1;
//     $grandTotalJumlahJasa = 0;

//     foreach ($dataJasa as $item) {
//         $totalJumlahJasa = 0; // Inisialisasi total jumlah Jasa untuk setiap Jasa
//         foreach ($item->transaksiDetail as $transaksiDetail) {
//             if ($transaksiDetail->transaksi->tanggal_transaksi >= $startDate && $transaksiDetail->transaksi->tanggal_transaksi <= $endDate) {
//                 if (!$status || ($status && $transaksiDetail->transaksi->status == $status)) {
//                     $totalJumlahJasa += $transaksiDetail->jumlah_jasa;
//                 }
//             }
//         }

//         $rowData = [
//             $counter++, // Increment the counter and add the number as the first column
//             $item->kategori->nama_kategori,
//             $item->nama_jasa,
//             $totalJumlahJasa, // Total jumlah produk
            
//         ];

//         $dataWithNumber[] = $rowData;
//         $grandTotalJumlahJasa += $totalJumlahJasa;
//     }

//     $dataWithNumber[] = [
//         'Grand Total', // Empty cell for the number column
//         '', // Label for the total row
//         '', 
//         $grandTotalJumlahJasa,
//     ];

//     // Convert the array data to a Laravel Collection
//     $dataCollection = new Collection($dataWithNumber);

//     // Export data to Excel using the ProdukExport class
//     // return Excel::download(new ProdukExport($dataCollection), 'laporan-produk.xlsx');
//     return Excel::download(new JasaExport($dataJasa), 'laporan-jasa.xlsx');
//     // return Excel::download(new TransaksiExport($dataTransaksi, $totalBayar, $totalKembalian), 'laporan-transaksi.xlsx');

// }

public function exportToExcel(Request $request)
{
    
    $query = Jasa::with('kategori', 'transaksiDetail.transaksi')
        ->orderBy('id_jasa', 'DESC');

    $startDate = $request->input('start_date');
    $endDate = $request->input('end_date');
    $status = $request->input('status');
    $cabangId = $request->input('cabang'); // Get the selected cabang from the request

    // Simpan data tanggal, status, dan cabang ke dalam session jika diberikan dalam request
    if ($startDate && $endDate) {
        session(['start_date' => $startDate]);
        session(['end_date' => $endDate]);
    } else {
        session()->forget('start_date');
        session()->forget('end_date');
    }

    if ($request->has('status')) {
        session(['status' => $status]);
    } else {
        session()->forget('status');
    }

    if ($request->has('cabang')) {
        session(['cabang' => $cabangId]);
    } else {
        session()->forget('cabang');
    }

    $filteredStatus = session('status');
    $filteredCabang = session('cabang'); // Use the filtered cabang from session

    // Terapkan filter jika ada data tanggal dalam session
    if (session()->has('start_date') && session()->has('end_date')) {
        $query->whereHas('transaksiDetail.transaksi', function ($query) use ($filteredStatus, $filteredCabang) {
            $query->whereBetween('tanggal_transaksi', [session('start_date'), session('end_date')]);

            if ($filteredStatus === null) {
                $query->whereIn('status', ['proses', 'selesai']);
            } else {
                $query->where('status', session('status'));
            }

            if ($filteredCabang !== null) {
                $query->where('id_cabang', $filteredCabang);
            }
        });
    }


    $dataCabang = Cabang::all();
    $dataJasa = $query->get();

    // Modify the data to exclude the 'id_transaksi' column and add the sequential number
    $dataWithNumber = [];
    $counter = 1;
    $grandTotalJumlahJasa = 0;

    foreach ($dataJasa as $item) {
        $totalJumlahJasa = 0;
    
        foreach ($item->transaksiDetail as $transaksiDetail) {
            $transaksi = $transaksiDetail->transaksi;
    
            if ($transaksi && $transaksi->tanggal_transaksi >= $startDate && $transaksi->tanggal_transaksi <= $endDate) {
                if (!$status || ($status && $transaksi->status == $status)) {
                    $totalJumlahJasa += $transaksiDetail->jumlah_jasa;
                }
            }
        }
    
        $rowData = [
            // Existing columns...
            $item->kategori->nama_kategori,
            $item->nama_jasa,
            $totalJumlahJasa,
            $item->transaksiDetail->first()->transaksi->cabang->nama_cabang ?? 'Unknown',
        ];
    
        $dataWithNumber[] = $rowData;
        $grandTotalJumlahJasa += $totalJumlahJasa;
    }

    $dataWithNumber[] = [
        'Grand Total', // Empty cell for the number column
        '', // Label for the total row
        '', 
        $grandTotalJumlahJasa,
    ];

    // Convert the array data to a Laravel Collection
    $dataCollection = new Collection($dataWithNumber);

    // Export data to Excel using the ProdukExport class
    // return Excel::download(new ProdukExport($dataCollection), 'laporan-produk.xlsx');
    return Excel::download(new JasaExport($dataJasa, $dataCabang), 'laporan-jasa.xlsx');
    // return Excel::download(new TransaksiExport($dataTransaksi, $totalBayar, $totalKembalian), 'laporan-transaksi.xlsx');

}

}
