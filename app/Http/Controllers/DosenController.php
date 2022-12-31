<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use Illuminate\Http\Request;
use App\Models\Religion;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class DosenController extends Controller
{
    public function index3(Request $request){
        
        if($request->has('search')){
            $data3 = Dosen::where('nama','LIKE','%' .$request->search.'%')->paginate(5);
            Session::put('halaman_url', request()->fullUrl());
        }else{
            $data3 = Dosen::paginate(5);
           
            Session::put('halaman_url', request()->fullUrl());
        }

        
        return view('datadosen',compact('data3'));
    }
    public function tambahdosen(){
        $dataagama = Religion::all();
        return view('tambahdata3',compact('dataagama'));
    }

    public function insertdata3(Request $request){
        //dd($request->all());
        $this->validate($request,[
            'nama' => 'required|min:5|max:25',
            'notelpon' => 'required|min:11|max:12',
            'agama' => 'required|min:1|max:10',
     ]);

        $data3 = Dosen::create($request->all());
        if($request->hasFile('foto')){
            $request->file('foto')->move('fotodosen/', $request->file('foto')->getClientOriginalName());
            $data3->foto = $request->file('foto')->getClientOriginalName();
            $data3->save();
        }
        return redirect()->route('dosen')->with('success',' Data Berhasil Di Tambahkan');
    }

    public function tampilkandata3($id){

        $data3 = Dosen::find($id);
        return view('tampildata3', compact('data3'));
    }

    public function updatedata(Request $request, $id){
        $data3 = Dosen::find($id);
        $data3->update($request->all());
        if(session('halaman_url')){
            return Redirect(session('halaman_url'))->with('success',' Data Berhasil Di Update');
        }

        return redirect()->route('dosen')->with('success',' Data Berhasil Di Update');

    }

    public function delete($id){
        $data3 = Dosen::find($id);
        $data3->delete();
        return redirect()->route('dosen')->with('success',' Data Berhasil Di Hapus');
    }

}