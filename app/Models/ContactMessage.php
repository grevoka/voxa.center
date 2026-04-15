<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Crypt;

class ContactMessage extends Model
{
    protected $fillable = [
        'contact_id',
        'sender_type',
        'sender_id',
        'message',
    ];

    public function contact(): BelongsTo
    {
        return $this->belongsTo(Contact::class);
    }

    public function setMessageAttribute(string $value): void
    {
        $this->attributes['message'] = Crypt::encryptString($value);
    }

    public function getMessageAttribute(?string $value): ?string
    {
        if ($value === null) {
            return null;
        }

        try {
            return Crypt::decryptString($value);
        } catch (\Throwable) {
            return $value;
        }
    }
}
