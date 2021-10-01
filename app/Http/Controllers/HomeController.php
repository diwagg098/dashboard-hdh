<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $ceksesi = $request->session()->has('is_login');

        if (!$ceksesi) {
            Alert::info('', 'Silahkan login terlebih dahulu');
            return redirect('/login');
        }

        $date = date('Y-m-d');
        $tgl = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30];

        for ($i = 1; $i < 31; $i++) {
            $content = DB::table('billing')
                ->join('booking', 'booking.cart_id', '=', 'billing.id_cart')
                ->join('cartroom', 'cartroom.cartr_id', '=', 'booking.cart_id')
                ->whereDay('checkin', $i)
                ->count();

            $chart[] = intval($content);
        }

        for ($p = 1; $p < 31; $p++) {
            $peng = DB::table('pengunjung')->whereDay('date', $p)->count();
            $guest[] = intval($peng);
        }

        $reserv = DB::table('cartroom')->join('guest', 'guest.guest_id', '=', 'cartroom.id_guest')
            ->join('booking', 'booking.cart_id', '=', 'cartroom.cartr_id')
            ->join('billing', 'billing.id_cart', '=', 'cartroom.cartr_id')
            ->where('booking.status_booking', 0)->where('billing.status_code', '200')->select(['name'])->get();

        // dd($reserv);
        $reservCount = $reserv->count();
        $datap = DB::table('pengunjung')->where('date', $date)->count();
        $today = DB::table('billing')->where('checkin', date('Y-m-d'))
            ->join('booking', 'booking.cart_id', '=', 'billing.id_cart')
            ->join('cartroom', 'cartroom.cartr_id', '=', 'booking.cart_id')
            ->count();

        $data = [
            'datap' => $datap,
            'tgl' => $tgl,
            'chart' => $chart,
            'guest' => $guest,
            'reserv' => $reserv,
            'reservCount' => $reservCount,
            'today' => $today
        ];

        // dd($data);
        return view('layout.home', $data);
    }
}
