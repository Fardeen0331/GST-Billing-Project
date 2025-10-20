<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Party;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use function Opis\Closure\unserialize; 


class PartyController extends Controller
{
  // Function to load add party view
  public function addParty(){

    return view('party.add');
  }
  
  // Function to load parties
    public function index(){
      // Get all part
      $parties = Party::select('id', 'party_type', 'full_name','phone_no','address','account_holder_name','account_no',
      'bank_name','swift_code','branch_address')->get();

    return view('party.index')->with('parties', $parties);
    }

  // Function to create/store party
  public function createParty(Request $request){

    //Validation
    $request->validate([
      'party_type' => 'required',
      'full_name' => 'required|string|min:2|max:20',
      'phone_no' => 'required|numeric|min:10|',
      'address' => 'required|max:225',

      'account_holder_name' => 'required|string|min:2|max:20',
      'account_no' => 'required|numeric|min:11|',
      'bank_name' => 'required|max:225',
      'swift_code' => 'required|max:50',
      'branch_address' => 'required|max:225',

    ]);

      $param = $request->all();

      // Remove token from post data before inserting
      unset($param['_token']);
      Party::create($param);

      // Redirect to add party back
      return redirect()->route('add-party')->withStatus("Party created successfully");
      
    }


    // Function to load edit party view
    public function editParty($party_id){

      $data['party'] = Party::find($party_id);

    return view('party.edit', $data);
  }


  // Function to update party
  public function updateParty($id,  Request $request){

     //Validation
    $request->validate([
      'party_type' => 'required',
      'full_name' => 'required|string|min:2|max:20',
      'phone_no' => 'required|numeric|min:10|',
      'address' => 'required|max:225',

      'account_holder_name' => 'required|string|min:2|max:20',
      'account_no' => 'required|numeric|min:11|',
      'bank_name' => 'required|max:225',
      'swift_code' => 'required|max:50',
      'branch_address' => 'required|max:225',

    ]);
    $param = $request->all();
    unset($param['_token']);
    unset($param['_method']);
    Party::where('id', $id)->update($param);
    return redirect()->route('manage-parties')->withStatus("Party updated successfully");
  }

  // Function to delete party
  public function deleteParty(Party $party){
    $party->delete();
    return redirect()->route('manage-parties')->withStatus("Party deleted successfully");
  }
}


