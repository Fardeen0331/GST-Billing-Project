<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Party extends Model
{
    // table
    protected $table = "parties";

    protected $fillable = array("full_name", "phne_no", "email", "address");
}
