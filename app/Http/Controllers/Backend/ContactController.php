<?php

namespace App\Http\Controllers\Backend;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ContactController extends Controller
{
    public function index(){
        return view('backend.layouts.contact.list', [
            'contacts' => Contact::orderBy('id', 'desc')->paginate(10)
        ]);
    }


    public function seen($id){
        Contact::findOrFail($id)->update([
            'status' => 'seen'
        ]);
        return back()->with('s_status', 'Contact has been Seen!');
    }


    public function unseen($id){
        Contact::findOrFail($id)->update([
            'status' => 'unseen'
        ]);
        return back()->with('b_status', 'Contact has been Uneen!');
    }


    public function destroy(Request $request, $id){
        $contact = Contact::findOrFail($id);
        $file_name = $contact->files;
        if(file_exists(public_path('uploads/contact/'.$file_name))){
            @unlink(public_path('uploads/contact/'.$file_name));
        }
        $contact->delete();
        session()->flash('b_status', 'contact has been Deleted!');
        return back();
    }


    public function download($id){
        $path = public_path('uploads/contact/'.Contact::findOrFail($id)->files);
        return response()->download($path);

        // echo $id;
    }
}
