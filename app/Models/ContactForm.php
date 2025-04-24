<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactForm extends Model
{
    /** @use HasFactory<\Database\Factories\ContactFormFactory> */
    use HasFactory;

    protected $fillable = ['name', 'email', 'phone', 'subject', 'message', 'ip_address', 'user_agent'];
}
