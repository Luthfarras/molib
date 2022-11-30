<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function home()
    {
        //
        $data = Buku::where('status', 'tampil')->get();
        $kategori = Kategori::all();
        return view('home', compact('data', 'kategori'));
    }

    public function index()
    {
        //
        $data = Buku::all();
        $kategori = Kategori::all();
        return view('buku', compact('data', 'kategori'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data = $request->all();
        $file = $request->file('cover')->store('img');
        $data['cover'] = $file;
        Buku::create($data);
        return redirect('buku');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function show(Buku $buku)
    {
        //
        return view('detail', compact('buku'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function edit(Buku $buku)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Buku $buku)
    {
        //
        $data = $request->all();
        if ($request->file('cover')) {
            $file = $request->file('cover')->store('img');
            Storage::delete($buku->cover);
            $data['cover'] = $file;
            $buku->update($data);
        }else {
            $data['cover'] = $buku->cover;
            $buku->update($data);
        }
        return redirect('buku');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function destroy(Buku $buku)
    {
        //
        $buku->delete();
        return redirect('buku');
    }

    public function akses(Buku $buku)
    {
        //
        if ($buku->status == 'tampil') {
            $buku->update([
                'status' => 'sembunyi',
            ]);
        }else {
            $buku->update([
                'status' => 'tampil',
            ]);
        }
        return redirect('buku');
    }
}
