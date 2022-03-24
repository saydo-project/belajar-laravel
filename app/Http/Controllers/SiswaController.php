<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SiswaController extends Controller
{
    /**
     * index
     * 
     * @return void
     */
    public function index()
    {
        // get siswas
        //$siswas = Siswa::latest()->paginate(5);
        //$siswas = Siswa::orderBy('created_at', 'desc')->paginate(5);

        //render view with siswas
        //return view('siswas.index', compact('siswas'));

        //return view('siswas.index', [
        //'siswas' => Siswa::latest()->paginate(5)
        //]);

        $siswas = Siswa::latest()->paginate(5);
        return view('siswas.index',compact('siswas'));
    }

    /**
     * 
     * @return void
     */
    public function create()
    {
        return view('siswas.create');
    }

    /**
     * create
     * 
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        //validate form
        $this->validate($request, [
            'image'             => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'nama_siswa'        => 'required|min:5',
            'tanggal_lahir'     => 'required'
         ]);

         if ($request) {
         //upload image
         $image = $request->file('image');
         $image->storeAs('public/siswas', $image->hashName());
 
         //create siswa
         siswa::create([
             'image'            => $image->hashName(),
             'nama_siswa'       => $request->nama_siswa,
             'tanggal_lahir'    => $request->tanggal_lahir
         ]);

        } else {
            //create siswa without image
            siswa::create([
            'nama_siswa'       => $request->nama_siswa,
            'tanggal_lahir'    => $request->tanggal_lahir
        ]);

        }

        //redirect to index
        return redirect()->route('siswas.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * edit
     * 
     * @param mixed $post
     * @return @void
     */
    public function edit(siswa $siswa){
        return view('siswas.edit', compact('siswa'));
    }

    /**
     * update
     * 
     * @param mixed $request
     * @param mixed $post
     */
    public function update(Request $request, siswa $siswa)
    {
        //validate form
        $this->validate($request, [
            'image'             => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'nama_siswa'        => 'required|min:5',
            'tanggal_lahir'     => 'required'
        ]);

        //check if image is uploaded
        if ($request->hasFile('image')) {

            //upload new image
            $image = $request->file('image');
            $image->storeAs('public/siswas', $image->hashName());

            //delete old image
            //Storage::delete('public/siswas/'.$siswa->image);
            Storage::disk('local')->delete('public/siswas/'.$siswa->image);

            //update siswa with new image
            $siswa->update([
                'image'             => $image->hashName(),
                'nama_siswa'        => $request->nama_siswa,
                'tanggal_lahir'     => $request->tanggal_lahir
            ]);

        } else {

            //update siswa without image
            $siswa->update([
                'nama_siswa'        => $request->nama_siswa,
                'tanggal_lahir'     => $request->tanggal_lahir
            ]);
        }

        //redirect to index
        return redirect()->route('siswas.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * destroy
     * 
     * @param mixed $post
     * @return void
     */
    public function destroy(siswa $siswa)
    {
        //delete image
        //Storage::delete('public/siswas/'.$siswa->image);
        Storage::disk('local')->delete('public/siswas/'.$siswa->image);

        //delete siswa
        $siswa->delete();

        //redirect to index
        return redirect()->route('siswas.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
