<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransactionDetail extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'transaction_details';

    protected $fillable = [
        'transaction_id',
        'food_id',
        'quantity',
        'amount',
    ];

    protected $hidden = [];

    public function transactionItems()
    {
        return $this->belongsTo(TransactionMaster::class, 'id', 'transaction_id');
    }
}
