<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VendorInvoice extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $invoices = DB::table('vendor_invoices as vi')
            ->select('vi.*', 'p.full_name', 'p.phone_no')
            ->join('parties as p', 'vi.party_id', '=', 'p.id')
            ->orderBy('vi.id', 'desc')
            ->get()->toArray();
        return view('vendor-invoice.index', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($party_id = null)
    {
        $data = [];
        $decoded_party_id = null;

        //Get the party details
        $party_id = base64_decode($party_id);
        $data['party'] = DB::table('parties')
            ->where(['party_type' => 'vendor', 'id' => $party_id])
            ->first();

        $data['party'] = null;

        $invoice = DB::table('vendor_invoices')
            ->where(['party_id' => $party_id])
            ->orderBy('id', 'desc')
            ->first();
        if (empty($invoice))
            $data['invoice_no'] = 1;
        else
            $data['invoice_no'] = $invoice->invoice_no + 1;

              return view('vendor-invoice.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Check for existing client (vendor)
        $party = DB::table('parties')
            ->where('party_type', 'vendor')
            ->where(['full_name' => $request->full_name, 'phone_no' => $request->phone_no])
            ->first();
            
        $party_id= null;

        if (!empty($party)) {
            $party_id = $party->id;
        } else {
            # Create new party
            $param = array(
                'party_type' => 'vendor',
                'full_name' => $request->full_name,
                'phone_no' => $request->phone_no,
                'address' => $request->address,
                'account_holder_name' => $request->account_holder_name,
                'account_no' => $request->account_no,
                'bank_name' => $request->bank_name,
                'swift_code' => $request->swift_code,
                'branch_address' => $request->branch_address,
            );
            $party_id = DB::table('parties')->insertGetId($param);
        }

         # Create vendor invoice
        $param = array(
            'party_id' => $party_id,
            'invoice_no' => $request->invoice_no,
            'invoice_date' => $request->invoice_date,
            'account_holder_name' => $request->account_holder_name,
            'account_no' => $request->account_no,
            'bank_name' => $request->bank_name,
            'swift_code' => $request->swift_code,
            'branch_address' => $request->branch_address,
            'item_description' => $request->item_description,
            'total_amount' => $request->total_amount,
            'declaration' => $request->declaration,
            'created_at' => date("Y-m-d H:i:s")
        );
        $invoice_id = DB::table('vendor_invoices')->insertGetId($param);
        if ($invoice_id) {
            return redirect()->route('vendor-invoice.show', [base64_encode($invoice_id)]);
        } else {
            return redirect()->back()->withError("Something went wrong, please try again");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
         $invoice_id = base64_decode($id);
        // $company = DB::table('company_details')->where('id', 1)->first();
        $invoice = DB::table('vendor_invoices as vi')
            ->join('parties as p', 'vi.party_id', '=', 'p.id')
            ->where('vi.id', $invoice_id)->first();
        return view('vendor-invoice.print', compact('invoice'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        //
    }
}
