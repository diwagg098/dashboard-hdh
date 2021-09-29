<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BillingController extends Controller
{
    public function index()
    {
        $content = DB::table('billing')
            ->join('guest', 'guest.id', '=', 'billing.guest_id')
            ->select('billing.billing_id', 'guest.nama', 'billing.total', 'billing.created_at', 'billing.status')
            ->get();
        return view('billing.index', compact('content'));
    }
}
