<?php

namespace App\Http\Controllers;

use App\Models\PenerbitSupplier;
use Illuminate\Http\Request;

class PenerbitSupplierController extends Controller
{
    public function index()
    {
        $data = PenerbitSupplier::orderBy('id')->get();
        return view('penerbit.index', compact('data'));
    }

    public function create()
    {
        return view('penerbit.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_penerbit' => 'required',
            'nama_supplier' => 'required',
            'kontak_sales'  => 'required|numeric',
            'alamat'        => 'required',
        ]);

        PenerbitSupplier::create([
            'nama_penerbit' => $request->nama_penerbit,
            'nama_supplier' => $request->nama_supplier,
            'kontak_sales'  => $request->kontak_sales,
            'alamat'        => $request->alamat,
            'status'        => 'Diproses',
        ]);

        return redirect()->route('penerbit.index');
    }

    public function edit(PenerbitSupplier $penerbit)
    {
        return view('penerbit.edit', compact('penerbit'));
    }

    public function update(Request $request, PenerbitSupplier $penerbit)
    {
        $request->validate([
            'nama_penerbit' => 'required',
            'nama_supplier' => 'required',
            'kontak_sales'  => 'required|numeric',
            'alamat'        => 'required',
        ]);

        $penerbit->update($request->only('nama_penerbit', 'nama_supplier', 'kontak_sales', 'alamat'));

        return redirect()->route('penerbit.index');
    }

    public function destroy(PenerbitSupplier $penerbit)
    {
        $penerbit->delete();
        return redirect()->route('penerbit.index');
    }

    public function updateStatus(Request $request, PenerbitSupplier $penerbit)
    {
        $penerbit->update(['status' => $request->status]);
        return redirect()->route('penerbit.index');
    }
}