<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GstBillController extends Controller
{
   // Function to load gst bills
  public function index(){
    return view('gst-bill.index');
  }
  
  // Function to load add gst bill view
    public function addGstBill(){
      return view('gst-bill.add');
    }

     // Function to load print gst bill view
    public function print(){
      return view('gst-bill.print');
    }
}
