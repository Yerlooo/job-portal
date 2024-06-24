<?php

namespace App\Http\Controllers;

use App\Models\KontakPerusahaan;
use Illuminate\Http\Request;
use App\Models\Perusahaan;
use Illuminate\Support\Facades\Hash;

class PerusahaanController extends Controller
{
    public function getShowDetailPerusahaan()
    {
        return view('Perusahaan.DetailPerusahaan');
    }
    public function getshowLihatPerusahaan()
    {
        return view('Perusahaan.LihatPerusahaan');
    }
    public function getShowLihatPerusahaan2()
    {
        return view('Perusahaan.LihatPerusahaan2'); 
    }
    public function getShowProfillPerusahaan()
    {
        return view('Perusahaan.ProfillPerusahaan');
    }
    public function getShowHomePagePerusahaan()
    {
        return view('Perusahaan.HomePagePerusahaan');
    }
    public function getShowKontakPerusahaan()
    {
        return view('Perusahaan.Kontak-Perusahaan');
    }
    public function postKontak(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'no_hp' => 'required|string|max:255',
            'pesan' => 'required|string|max:255'
        ]);

        KontakPerusahaan::create($validatedData);

        return redirect()->back()->with('success', 'Pesan berhasil dikirim!');
    }
}
