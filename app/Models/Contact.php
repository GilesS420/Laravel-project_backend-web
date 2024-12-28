<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'subject',
        'message',
        'admin_response',
        'is_answered',
        'is_converted_to_faq',
        'faq_id'
    ];

    protected $casts = [
        'is_answered' => 'boolean',
        'is_converted_to_faq' => 'boolean'
    ];

    public function faqItem()
    {
        return $this->belongsTo(FaqItem::class, 'faq_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
