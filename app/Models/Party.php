<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Party extends Model
{
    // table
    protected $table = "parties";
    

   protected $fillable = [
        "party_type", 
        "full_name", 
        "phone_no", 
        "email", 
        "address",
        "account_holder_name",
        "account_no",
        "bank_name",
        "swift_code",
        "branch_address"
    ];
}
