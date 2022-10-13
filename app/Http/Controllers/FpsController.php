<?php

namespace App\Http\Controllers;

use App\Models\fps;
use App\Models\Kfs;
use App\Models\Bp;
use Illuminate\Http\Request;

class FpsController extends Controller
{
    private $validation;

    public function __construct()
    {
        $this->validation = [
            'no_surat' => 'required',
            'tanggal' => 'required',
            'jumlah' => 'required|numeric|gt:0'
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $dataFps = fps::with(['bp', 'kf'])->paginate(5);
        return view('fp/fpindex', compact('dataFps'));
    }


    public function tambahfp()
    {
        return view('fp.tambahfp');
    }

    public function tambahfungsi()
    {
        $datafungsi = Kfs::get();
        $databarang = Bp::get();
        return view('fp.tambahfp', compact('datafungsi', 'databarang'));
    }

    public function insertfp(Request $request)
    {
        $validated = $request->validate($this->validation, [
            'no_surat.required' => 'No Surat Harus Di Isi',
            'tanggal.required' => 'Tanggal Permintaan Tidak Boleh Kosong',
            'jumlah.required' => 'Isikan Jumlah Yang Di Inginkan',
            'jumlah.numeric' => 'Jumlah Barang Harus Berupa Angka',
            'jumlah.gt' => 'Jumlah Barang Harus Lebih Dari 0'
        ]);
        $validated['bps_id'] = $request->bps_id;
        $validated['kf_id'] = $request->kf_id;
        $barang = bp::where('id', $request->bps_id)->first();

        if ((int)$request->jumlah > $barang->stok) {
            return redirect()->back()->with('empty', 'Stock Barang Yang Anda Pilih Telah Habis Atau Anda Memasukkan Jumlah Quantity Melebihi Batas Jumlah Barang');
        } elseif ($barang->stok > 0) {
            $barang->decrement('stok', (int)$request->jumlah);
        }

        $isCreated = fps::create($validated);
        return redirect('fp/fpindex')->with('success', 'Data Berhasil di Input');
    }

    public function tampilfp($id)
    {

        $data = fps::where('id', $id)->first();
        $dataFungsi = Kfs::get();
        $dataBarang = Bp::get();

        return view('fp.tampilfp', compact('data', 'dataFungsi', 'dataBarang'));
    }

    public function editfp(Request $request, $id)
    {
        // dd($request);
        $validated = $request->validate($this->validation, [
            'no_surat.required' => 'No Surat Harus Di Isi',
            'tanggal.required' => 'Tanggal Permintaan Tidak Boleh Kosong',
            'jumlah.required' => 'Isikan Jumlah Yang Di Inginkan',
            'jumlah.numeric' => 'Jumlah Barang Harus Berupa Angka',
            'jumlah.gt' => 'Jumlah Barang Harus Lebih Dari 0'
        ]);
        $validated['bps_id'] = $request->bps_id;
        $validated['kf_id'] = $request->kf_id;
        $fps = fps::where('id', $id)->first();
        $barang = bp::where('id', $request->bps_id)->first();

        // INI BOLEH DI IMPLEMENTASIKAN JIKA MEMANG USER TIDAK BOLEH MENGEMBALIKAN BARANG DAN HANYA BOLEH MENAMBAH BARANG SAJA!
        // if ((int)$request->jumlah > $barang->stok) {
        //     return redirect()->back()->with('empty', 'Gagal Mengedit!, Karena Stock Barang Yang Anda Pilih Telah Habis Atau Anda Memasukkan Jumlah Quantity Melebihi Batas Jumlah Barang');
        // }

        if ((int)$request->jumlah < $fps->jumlah) {
            $barangDikembalikan = $fps->jumlah - (int)$request->jumlah;
            $barang->increment('stok', $barangDikembalikan);
        } else {
            $barangDitambah = (int)$request->jumlah - $fps->jumlah;
            $barang->decrement('stok', $barangDitambah);
        }

        $isUpadated = $fps->update($validated);

        return redirect('fp/fpindex')->with('success', 'Data Berhasil di Edit');
    }


    public function deletefp($id)
    {
        $datas = fps::find($id);
        $datas->delete();
        return redirect('fp/fpindex')->with('success', 'Data Berhasil di Hapus');
    }
}
