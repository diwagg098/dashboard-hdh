<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        $content = DB::table('products')->get();
        return view('product.index', compact('content'));
    }

    public function create()
    {
        return view('product.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_product' => 'required',
            'harga' => 'required|numeric',
            'status' => 'required',
            'deskripsi' => 'required',
            'foto' => 'mimes:png,jpg,PNG,JPG,jpeg,JPEG|required|max:4000'
        ], [
            'nama_product.required' => 'Nama Product harus diisi',
            'harga.required' => 'Harga product harus diisi',
            'harga.numeric' => 'Harga harus berupa angka',
            'status' => 'Anda belum memilih status',
            'deskripsi' => 'Deskripsi harus diisi',
            'foto.mimes' => 'Format foto tidak sesuai',
            'foto.required' => 'Anda belum upload foto',
            'foto.max' => 'Ukuran gambar terlalu besar, maksimal 4 MB'
        ]);

        $file = $request->file('foto');

        if (!$file) {
            Alert::warning('Warning', 'Tidak ada foto yang diupload');
            return redirect('/products/create');
        } else {
            $fileExt = $file->getClientOriginalExtension();
            $fileName = 'Product-' . date('YmdHis') . '.' . $fileExt;
            $file->move(public_path() . '/images/product', $fileName);
        }

        $data = [
            'nama_product' => $request->nama_product,
            'product_id' => Uuid::uuid4()->getHex(),
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi,
            'rate' => 0,
            'foto' => $fileName,
            'status' => $request->status
        ];
        $save = DB::table('products')->insert($data);
        if ($save) {
            Alert::success('Success', 'Data product berhasil ditambahkan');
            return redirect('/products');
        } else {
            Alert::error('Error', 'Oops terjadi kesalahan dalam menambahkan data product');
            return redirect('/products/create');
        }
    }

    public function edit($product_id)
    {
        $content = DB::table('products')->where('product_id', $product_id)->first();
        return view('product.edit', compact('content'));
    }

    public function update(Request $request, $product_id)
    {
        $content = DB::table('products')->where('product_id', $product_id)->first();
        $request->validate(
            [
                'nama_product' => 'required',
                'harga' => 'required|numeric',
                'deskripsi' => 'required',
                'status' => 'required',
            ],
            [
                'nama_product.required' => 'Nama product harus diisi',
                'harga.required' => 'Harga harus diisi',
                'harga.numeric' => 'Harga harus angka',
                'deskripsi.required' => 'Deskripsi harus diisi',
            ]
        );

        $file = $request->file('foto');

        if (!$file) {
            $fileName = $content->foto;
        } else {
            $fileExt = $file->getClientOriginalExtension();
            $fileName = 'Product-' . date('YmdHis') . '.' . $fileExt;
            $file->move(public_path() . '/images/product', $fileName);
        }

        $data = [
            'nama_product' => $request->nama_product,
            'harga' => $request->harga,
            'status' => $request->status,
            'foto' => $fileName,
            'deskripsi' => $request->deskripsi,
        ];

        $update = DB::table('products')->where('product_id', $product_id)->update($data);
        if ($update) {
            Alert::success('Success', 'Data berhasil diupdate');
            return redirect('/products');
        } else {
            Alert::error('Error', 'Oops terjadi kesalahan dalam update data');
            return redirect('/products/edit/' . $content->product_id);
        }
    }

    public function delete($product_id)
    {
        $content = DB::table('products')->where('product_id', $product_id)->delete();
        if ($content) {
            Alert::success('Success', 'Data product berhasil dihapus');
            return redirect('/products');
        } else {
            Alert::warning('Warning', 'Oops terjadi kesalhan dalam menghapus data');
            return redirect('/products');
        }
    }
}
