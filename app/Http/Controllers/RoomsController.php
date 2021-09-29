<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Nette\Utils\Json;
use RealRashid\SweetAlert\Facades\Alert;

class RoomsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $ceksesi = $request->session()->has('is_login');

        if (!$ceksesi) {
            Alert::info('', 'Silahkan login terlebih dahulu');
            return redirect('/login');
        }
        $content = DB::table('rooms')->get();
        return view('rooms.index', compact('content'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $ceksesi = $request->session()->has('is_login');

        if (!$ceksesi) {
            Alert::info('', 'Silahkan login terlebih dahulu');
            return redirect('/login');
        }
        return view('rooms.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'nama_kamar' => 'required',
            'harga' => 'required',
            'foto' => 'required|mimes:png,jpg,JPG,JPEG,PNG|max:3000'
        ], [
            'nama_kamar.required' => 'Nama Kamar Harus isi',
            'harga.required' => 'Harga harus diisi',
            'foto.required' => 'Anda belum mengupload foto',
            'foto.mimes' => 'format file tidak sesuai',
            'foto.max' => 'Ukuran file max: 3mb'
        ]);

        $file = $request->file('foto');

        if ($file) {
            $fileExt = $file->getClientOriginalExtension();
            $fileName = 'Rooms' . date('Ymd') . '.' . $fileExt;
            $file->move(public_path() . '/images/rooms', $fileName);
        } else {
            Alert::warning('Warning', 'Anda belum mengupload foto');
            return redirect()->back();
        }

        $room = 'R' . rand(0, 999);
        $datafitur = $request->fitur;
        if (!empty($request->input('fitur'))) {
            $input = join(',', $request->input('fitur'));
        }

        // dd($encode, json_decode($encode));
        $rooms = new Room();
        $rooms->id_kamar = $room;
        $rooms->nama_kamar = $request->nama_kamar;
        $rooms->price = $request->harga;
        $rooms->fitur = $input;
        $rooms->foto = $fileName;

        $rooms->save();


        if ($rooms->save()) {
            Alert::success('Success', 'Data kamar sudah ditambahkan');
            return redirect('/rooms');
        } else {
            Alert::warning('Oops', 'Tejadi kesalahan dalam input data');
            return redirect('/rooms/create');
        }


        // $data = [
        //     'id_kamar' => $room,
        //     'nama_kamar' => $request->nama_kamar,
        //     'price' => $request->harga,
        //     'fitur' => serialize($will_insert),
        //     'foto' => $fileName
        // ];
        // dd($data);
        // $save = DB::table('rooms')->insert($data);
        // if ($save) {
        //     Alert::success('Success', 'Kamar baru berhasil ditambahkan');
        //     return redirect('/rooms');
        // } else {
        //     Alert::error('Error', 'Ooops terjadi kesalhan dalam menambah data kamar');
        //     return redirect()->back();
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function show(Room $room)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $content = DB::table('rooms')->where('id_kamar', $id)->first();
        return view('rooms.edit', compact('content'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_kamar)
    {
        $content = DB::table('rooms')->where('id_kamar', $id_kamar)->first();

        $request->validate([
            'nama_kamar' => 'required',
            'harga' => 'required|numeric',
            'description' => 'required',
            'foto' => 'mimes:png,jpg,jpeg,JPEG,PNG,JPG|max:3000'
        ], [
            'nama_kamar.required' => 'Nama Kamar Harus isi',
            'harga.required' => 'Harga harus diisi',
            'price.numeric' => 'Harga harus berupa angka',
            'description.required' => 'Deskripsi harus diisi',
        ]);

        $file = $request->file('foto');

        if (!$file) {
            $fileName = $content->foto;
        } else {
            $fileExt = $file->getClientOriginalExtension();
            $fileName = 'R' . date('Ymd') . '.' . $fileExt;
            $file->move(public_path() . '/images/rooms/', $fileName);
        }

        $data = [
            'nama_kamar' => $request->nama_kamar,
            'price' => $request->harga,
            'description' => $request->description,
            'foto' => $fileName,
        ];
        // dd($data);
        $update = DB::table('rooms')->where('id_kamar', $id_kamar)->update($data);
        if ($update) {
            Alert::success('Success', 'Data kamar berhasil diupdate');
            return redirect('/rooms');
        } else {
            Alert::error('Success', 'Ooops terjadi kesalahan dalam update data');
            return redirect('/rooms');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('rooms')->where('id_kamar', $id)->delete();
        Alert::success('Success', 'Data kamar berhasil dihapus');
        return redirect('/rooms');
    }
}
