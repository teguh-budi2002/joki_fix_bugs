<?php

namespace App\Http\Controllers;

use App\Models\fps;
use App\Models\Kfs;
use App\Models\Bp;
use Illuminate\Http\Request;

class FpsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $dataFps = fps::with(['bp', 'kf'])->paginate(5);
        return view('fp/fpindex',compact('dataFps'));
    }


    public function tambahfp(){
        return view('fp.tambahfp');
    }

    public function tambahfungsi(){
        $datafungsi = Kfs::get();
        $databarang = Bp::get();
        return view('fp.tambahfp', compact('datafungsi','databarang'));
    }

    public function insertfp(Request $request){
        $validation = $request->validate([
            'no_surat' => 'required',
            'kf_id' => 'required',
            'tanggal' => 'required',
            'bps_id' => 'required',
            'jumlah' => 'required'
        ], [
            'no_surat.required' => 'No Surat Harus Di Isi',
            'tanggal.required' => 'Tanggal Permintaan Tidak Boleh Kosong',
            'jumlah.required' => 'Isikan Jumlah Yang Di Inginkan'
        ]);

        $validation['bps_id'] = $request->bps_id;
        $validation['kf_id'] = $request->kf_id;

        $isCreated = fps::create($validation);

        return redirect ('fp/fpindex')->with('success','Data Berhasil di Input');
    }

    public function tampilfp($id){

        $data = fps::where('id', $id)->first();
        $dataFungsi = Kfs::get();
        $dataBarang = Bp::get();

        return view('fp.tampilfp', compact('data', 'dataFungsi', 'dataBarang'));
    }

    public function editfp(Request $request, $id){
        $validation = $request->validate([
            'no_surat' => 'required',
            'kf_id' => 'required',
            'tanggal' => 'required',
            'bps_id' => 'required',
            'jumlah' => 'required'
        ], [
            'no_surat.required' => 'No Surat Harus Di Isi',
            'tanggal.required' => 'Tanggal Permintaan Tidak Boleh Kosong',
            'jumlah.required' => 'Isikan Jumlah Yang Di Inginkan'
        ]);

        $validation['bps_id'] = $request->bps_id;
        $validation['kf_id'] = $request->kf_id;

        $isUpadated = fps::where('id', $id)->update($validation);

        return redirect ('fp/fpindex')->with('success','Data Berhasil di Edit');
    }


    public function deletefp($id){
        $datas=fps::find($id);
        $datas->delete();
        return redirect ('fp/fpindex')->with('success','Data Berhasil di Hapus');
    }
}
