<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bp;

class BpController extends Controller
{
    public function index(Request $request){

        if($request->has('search')){
            $datas = Bp::where('nama_barang','LIKE','%' .$request->search.'%')->paginate(5);
        }else{
            $datas = Bp::paginate(10);
        }
        return view('persediaan.index', compact('datas'));
    }

    public function tambahbp(){
        return view('persediaan.tambahbp');
    }

    public function insertbp(Request $request){
        $validating = $request->validate([
            'no' => 'required',
            'nama_barang' => 'required',
            'satuan' => 'required',
            'stok' => 'required'
        ], [
            'no.required' => 'Nomer Barang Harus Di Isi',
            'nama_barang.required' => 'Nama Barang Tidak Boleh Kosong',
            'satuan.required' => 'Satuan Harus Di Isi',
            'stok.required' => 'Cantumkan Stock Barang'
        ]);

        $isCreated = Bp::create($validating);

        return redirect ('persediaan/index')->with('success','Data Berhasil di Tambah');
    }

    public function tampilbp ($id){
        $data = Bp::find($id);
        return view('persediaan.tampilbp', compact('data'));
    }

    public function editbp(Request $request, $id){
        $validating = $request->validate([
            'nama_barang' => 'required',
            'satuan' => 'required',
            'stok' => 'required'
        ], [
            'nama_barang.required' => 'Nama Barang Tidak Boleh Kosong',
            'satuan.required' => 'Satuan Harus Di Isi',
            'stok.required' => 'Cantumkan Stock Barang'
        ]);

        $isUpdated = Bp::where('id', $id)->update($validating);
        return redirect ('persediaan/index')->with('success','Data Berhasil di Edit');
    }

    public function deletebp($id){
        $data = Bp::find($id);
        $data->delete();
        return redirect('persediaan/index')->with('success','Data Berhasil di Hapus');
    }

}

