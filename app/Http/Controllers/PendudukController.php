<?php

namespace App\Http\Controllers;

use App\Models\Penduduk;
use App\Http\Requests\StorePendudukRequest;
use App\Http\Requests\UpdatePendudukRequest;
use Exception;
use Illuminate\Database\QueryException;
use PDOException;

class PendudukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data['tb_penduduk'] = Penduduk::orderBy('created_at', 'DESC')->get();

            return view('penduduk.index')->with($data);
        } catch (QueryException | Exception | PDOException $error) {
            $this->failResponses($error->getMessage(), $error->getCode());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePendudukRequest $request)
    {
        $request->validate([
            'foto' => 'required|image|mimes:png,jpg,jpeg,svg|max:2048',
        ]);
        $fotoName = time() . '.' . $request->foto->extension();
        $request->foto->move(public_path('images'), $fotoName);
        $data = $request->all();
        $data['foto'] = $fotoName;
        Penduduk::create($data);
        return redirect()->route('penduduk.index')->with('success', 'Data Penduduk berhasil ditambahkan!');
    }


    /**
     * Display the specified resource.
     */
    public function show(Penduduk $penduduk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Penduduk $penduduk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePendudukRequest $request, string $id)
    {
        // Temukan data penduduk berdasarkan ID
        $penduduk = Penduduk::find($id);

        // Validasi input, gambar hanya diperlukan jika diunggah
        $request->validate([
            'foto' => 'nullable|image|mimes:png,jpg,jpeg,svg|max:2048',
        ]);

        // Ambil semua data dari request
        $data = $request->except('foto'); // Kecualikan 'foto' dari data yang akan di-update

        // Cek apakah ada file gambar yang diunggah
        if ($request->hasFile('foto')) {
            // Tentukan nama file gambar baru
            $fotoName = time() . '.' . $request->foto->extension();
            // Pindahkan file gambar ke direktori 'public/images'
            $request->foto->move(public_path('images'), $fotoName);
            // Tambahkan nama file gambar baru ke array data
            $data['foto'] = $fotoName;
        }

        // Perbarui data penduduk dengan data yang telah dimodifikasi
        $penduduk->update($data);

        // Redirect dengan pesan sukses
        return redirect()->route('penduduk.index')->with('success', 'Update data berhasil');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Penduduk::find($id)->delete();
        return redirect('penduduk')->with('success', 'Data Penduduk berhasil dihapus!');
    }
}
