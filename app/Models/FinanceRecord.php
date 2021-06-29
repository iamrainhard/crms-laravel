<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinanceRecord extends Model
{
    use HasFactory;
    protected $fillable = [
        'finance_id',
        'amount',
        'description',
        'church_id'
    ];

    public function finance()
    {
        return $this->belongsTo(Finance::class);
    }

    public function church()
    {
        return $this->belongsTo(Church::class);
    }
}
