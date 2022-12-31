<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\Religion;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class EmployeeController extends Controller
{
    public function index(Request $request){

        if($request->has('search')){
            $data = Employee::where('nama','LIKE','%' .$request->search.'%')->paginate(5);
            Session::put('halaman_url', request()->fullUrl());
        }else{
            $data = Employee::paginate(5);
           
            Session::put('halaman_url', request()->fullUrl());
        }

        
        return view('datapegawai',compact('data'));
    }

    public function tambahpegawai(){
        $dataagama = Religion::all();
        return view('tambahdata',compact('dataagama'));
    }

    public function insertdata(Request $request){
        //dd($request->all());
        $this->validate($request,[
                'nama' => 'required|min:5|max:25',
                'notelpon' => 'required|min:11|max:12',
                'agama' => 'required|min:1|max:10',
         ]);

        $data = Employee::create($request->all());
        if($request->hasFile('foto')){
            $request->file('foto')->move('fotopegawai/', $request->file('foto')->getClientOriginalName());
            $data->foto = $request->file('foto')->getClientOriginalName();
            $data->save();
        }
        return redirect()->route('pegawai')->with('success',' Data Berhasil Di Tambahkan');
    }

    public function tampilkandata($id){
        
        $data = Employee::find($id);
        //dd($data);
        return view('tampildata', compact('data'));
    }

    public function updatedata1(Request $request, $id){
        $data = Employee::find($id);
        $data->update($request->all());
        if(session('halaman_url')){
            return Redirect(session('halaman_url'))->with('success',' Data Berhasil Di Update');
        }

        return redirect()->route('pegawai')->with('success',' Data Berhasil Di Update');

    }

    public function delete($id){
        $data = Employee::find($id);
        $data->delete();
        return redirect()->route('pegawai')->with('success',' Data Berhasil Di Hapus');
    }
}
