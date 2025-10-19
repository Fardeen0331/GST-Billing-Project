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
      return view('party.index');
    }

  // Function to create/store party
  public function createParty(Request $request){

    //Validation
    $request->validate([
      'party_type' => 'required',
      'full_name' => 'required',

  ]);

      $param = $request->all();

      // Remove token from post data before inserting
      unset($param['_token']);
      Party::create($param);

      // Redirect to add party back
      return redirect()->route('add-party')->withStatus("Party created successfully");
      
    }
}
