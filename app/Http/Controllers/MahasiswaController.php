<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Models\Religion;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class MahasiswaController extends Controller
{
    public function index2(Request $request){
        
        if($request->has('search')){
            $data2 = Mahasiswa::where('nama','LIKE','%' .$request->search.'%')->paginate(5);
            Session::put('halaman_url', request()->fullUrl());
        }else{
            $data2 = Mahasiswa::paginate(5);
           
            Session::put('halaman_url', request()->fullUrl());
        }

        
        return view('datamahasiswa',compact('data2'));
    }
    public function tambahmahasiswa(){
        $dataagama = Religion::all();
        return view('tambahdata2',compact('dataagama'));
    }

    public function insertdata2(Request $request){
        //dd($request->all());
        $this->validate($request,[
            'nama' => 'required|min:5|max:25',
            'notelpon' => 'required|min:11|max:12',
            'agama' => 'required|min:1|max:10',
     ]);

        $data = Mahasiswa::create($request->all());
        if($request->hasFile('foto')){
            $request->file('foto')->move('fotomahasiswa/', $request->file('foto')->getClientOriginalName());
            $data->foto = $request->file('foto')->getClientOriginalName();
            $data->save();
        }
        return redirect()->route('mahasiswa')->with('success',' Data Berhasil Di Tambahkan');
    }

    public function tampilkandata2($id){
        
        $data2 = Mahasiswa::find($id);
        //dd($data);
        return view('tampildata2', compact('data2'));
    }

    public function updatedata2(Request $request, $id){
        $data2 = Mahasiswa::find($id);
        $data2->update($request->all());
        if(session('halaman_url')){
            return Redirect(session('halaman_url'))->with('success',' Data Berhasil Di Update');
        }

        return redirect()->route('mahasiswa')->with('success',' Data Berhasil Di Update');

    }

    public function delete($id){
        $data2 = Mahasiswa::find($id);
        $data2->delete();
        return redirect()->route('mahasiswa')->with('success',' Data Berhasil Di Hapus');
    }

}