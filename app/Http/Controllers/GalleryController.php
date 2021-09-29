<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;

class GalleryController extends Controller
{
    public function index()
    {
        $content = DB::table('gallery')->get();
        return view('gallery.index', compact('content'));
    }

    public function create()
    {
        return view('gallery.create');
    }

    public function store(Request $request)
    {

        $request->validate(
            [
                'foto' => 'mimes:png,jpg,PNG,JPG,JPEG,jpeg|max:4000',
            ],
            [
                'foto.mimes' => 'Format tidak sesuai',
                'foto.max' => 'Maksimal foto 4mb'
            ]
        );

        $file = $request->file('foto');

        if (!$file) {
            Alert::error('Error', 'Belum ada foto yang di upload');
            return redirect('/gallery/create');
        } else {
            $fileExt = $file->getClientOriginalExtension();
            $fileName = 'Gallery-' . date('YmdHis') . '.' . $fileExt;
            $file->move(public_path() . '/images/gallery', $fileName);
        }

        $data = [
            'upload_path' => $fileName,
            'created_at' => date('Y-m-d')
        ];

        $save = DB::table('gallery')->insert($data);
        if ($save) {
            Alert::success('Success', 'Foto telah ditambahkan ke Gallery');
            return redirect('/gallery');
        } else {
            Alert::error('Error', 'Oops terjadi kesalahan');
            return redirect('/gallery/create');
        }
    }

    public function delete($upload_path)
    {
        $content = DB::table('gallery')->where('upload_path', $upload_path)->delete();
        if ($content) {
            Alert::success('Success', 'Foto berhasil dihapus dari gallery');
            return redirect('/gallery');
        } else {
            Alert::error('Error', 'Oops tejadi kesalahan dalam menghapus foto gallery');
            return redirect('/gallery');
        }
    }
}
