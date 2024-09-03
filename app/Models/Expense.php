<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model  
{
    use HasFactory;

    /**
     * 
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 
        'image', 
        'slug'
    ];

    /**
     *
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}