<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $ceksesi = $request->session()->has('is_login');

        if (!$ceksesi) {
            Alert::info('', 'Silahkan login terlebih dahulu');
            return redirect('/login');
        }


        $day = date('Y-m-d');
        $reserv = DB::table('billing')
            ->join('booking', 'booking.cart_id', '=', 'billing.id_cart')
            ->join('cartroom', 'cartroom.cartr_id', '=', 'booking.cart_id')
            ->where('status_booking', 0)
            ->get();

        $checkin =
            DB::table('billing')
            ->join('booking', 'booking.cart_id', '=', 'billing.id_cart')
            ->join('cartroom', 'cartroom.cartr_id', '=', 'booking.cart_id')
            ->where('status_booking', 1)
            ->get();

        $today = DB::table('billing')->where('checkin', $day)
            ->join('booking', 'booking.cart_id', '=', 'billing.id_cart')
            ->join('cartroom', 'cartroom.cartr_id', '=', 'booking.cart_id')
            ->get();
        $tgl = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30];

        for ($i = 1; $i < 31; $i++) {
            $content = DB::table('billing')
                ->join('booking', 'booking.cart_id', '=', 'billing.id_cart')
                ->join('cartroom', 'cartroom.cartr_id', '=', 'booking.cart_id')
                ->whereDAy('checkin', $i)
                ->count();

            $chart[] = intval($content);
        }

        $data = [
            'reserv' => $reserv,
            'today' => $today,
            'chart' => $chart,
            'tgl' => $tgl,
            'checkin' => $checkin
        ];

        // dd($data);

        return view('report.index', $data);
    }

    public function checkin(Request $request, $id_booking)
    {
        $ceksesi = $request->session()->has('is_login');

        if (!$ceksesi) {
            Alert::info('', 'Silahkan login terlebih dahulu');
            return redirect('/login');
        }

        if (!$id_booking) {
            return redirect()->back();
        }

        $data = [
            'status_booking' => 1
        ];
        $content = DB::table('booking')->where('id_booking', $id_booking)->update($data);

        if ($content) {
            Alert::success('Success', 'Checkin berhasil');
            return redirect('/report');
        } else {
            Alert::info('Oops', 'Terjadi kesalahan');
            return redirect('/report');
        }

        // dd($content);
    }
}
