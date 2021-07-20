<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Order;
use Barryvdh\DomPDF\Facade as PDF;
use App\Http\Controllers\Controller;

class InvoiceController extends Controller
{
    public function invoice($id){
        return view('frontend.layouts.pages.invoice', [
            'order_details' => Order::findOrFail($id)
        ]);
    }


    public function invoiceDownload($id){
        $invoice_details = Order::findOrFail($id);
        $pdf = PDF::loadView('pdf.invoice', compact('invoice_details'));
        return $pdf->download('invoice.pdf');
    }

    // public function invoiceDownload($id){
    //     $invoice_details = Order::findOrFail($id);
    //     return view ('backend.layouts.pdf.invoice', compact('invoice_details'));
    // }
}
