<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $invoices = Invoice::where('customer_id', auth()->guard('api')->user()->id)->latest()->get();

        return response()->json([
            'success'   => true,
            'message'   => 'List Invoice: ' . auth()->guard('api')->user()->name,
            'data'      => $invoices
        ], 200);
    }

    public function show($snap_token)
    {
        $invoices = Invoice::where('customer_id', auth()->guard('api')->user()->id)->where('snap_token', $snap_token)->latest()->get();

        return response()->json([
            'success'   => true,
            'message'   => 'Detail Invoice: ' . auth()->guard('api')->user()->name,
            'data'      => $invoices,
            'product'   => $invoices->orders
        ], 200);
    }
}
