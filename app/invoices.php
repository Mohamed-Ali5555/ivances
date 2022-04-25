<?php

namespace App;
use App\sections;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class invoices extends Model
{

    use SoftDeletes;

    protected $fillable =[
        'invoice_number',
        'invoice_Date',
        'Due_date',
        'product',
        'section_id',
        'Amount_collection',
        'Amount_Commission',
        'Discount',
        'Rate_VAT',
        'Value_VAT',
        'Total',
        'note',
        'status',
        'value_status',
    ];
    // protected $guarded =[]; 

    public function section(){
        return $this->belongsTo(sections::Class);
    }
}
