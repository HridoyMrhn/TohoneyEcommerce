<?php

namespace App\Http\Controllers\Backend;

use App\Models\Order;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\OrderDetail;
use App\Models\Product;

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


    public function cancel($id){
        $order_deatil = OrderDetail::where('order_id', $id)->get();
        foreach($order_deatil as $data){
            Product::find($data->product_id)->increment('quantity', $data->product_quantity);
        };
        Order::findOrFail($id)->update([
            'status' => 'cancel'
        ]);
        session()->flash('b_status', 'Order has been Canceled!');
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
