<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = Invoice::latest()->when(request()->q, function ($invoices) {
            $invoices = $invoices->where('invoices', 'like', '%' . request()->q . '%');
        })->paginate(10);

        return view('admin.order.index', compact('invoices'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        return view('admin.order.show', compact('invoice'));
    }
}
