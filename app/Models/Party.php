<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Party extends Model
{
    // table
    protected $table = "parties";

    // Primary key
    protected $primaryKey = "id";
    
    // fillable columns
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

    public function gstBills()
    {
        return $this->hasMany(GstBill::class);
    }
}
