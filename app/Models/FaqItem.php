<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FaqItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'question',
        'answer',
        'category'
    ];

    public function contact()
    {
        return $this->hasOne(Contact::class, 'category', 'faq_id');
    }
}
