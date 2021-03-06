<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Finance extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'dividends'
    ];

    public function records()
    {
        return $this->hasMany(FinanceRecord::class);
    }
}
