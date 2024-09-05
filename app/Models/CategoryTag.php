<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryTag extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug'];

    /**
     * The expenses that belong to the category tag.
     */
    public function expenses()
    {
        return $this->belongsToMany(Expense::class, 'expense_category_tag');
    }
}
