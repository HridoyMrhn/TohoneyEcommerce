<?php

namespace App\Http\Controllers\Backend;

use App\Models\Order;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index(){
        return view('backend.layouts.order.list', [
            'orders' => Order::latest()->paginate(10)
        ]);
    }


    public function accept($id){
        Order::findOrFail($id)->update([
            'status' => 'accept'
        ]);
        session()->flash('s_status', 'Order has been Accepted');
        return back();
    }


    public function reject($id){
        Order::findOrFail($id)->delete();
        session()->flash('b_status', 'Order has been Deleted');
        return back();
    }


    public function orderAccept(){
        return view('backend.layouts.order.list', [
            'orders' => Order::where('status', 'accept')->latest()->paginate(10)
        ]);
    }


    public function orderPending(){
        return view('backend.layouts.order.list', [
            'orders' => Order::where('status', 'pending')->latest()->paginate(10)
        ]);
    }


    public function invoice($id){
        return view('backend.layouts.order.show', [
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
