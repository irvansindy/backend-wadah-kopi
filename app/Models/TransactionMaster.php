<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransactionMaster extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'transaction_masters';

    protected $fillable = [
        'user_id',
        'grand_total',
        'tax',
        'service_fee',
        'service_fee',
    ];

    protected $hidden = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function transactionDetails()
    {
        return $this->hasMany(TransactionDetail::class, 'transaction_id', 'id');
    }
}
