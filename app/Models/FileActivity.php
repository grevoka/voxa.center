<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FileActivity extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'file_id',
        'user_id',
        'action',
    ];

    public function file(): BelongsTo
    {
        return $this->belongsTo(File::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
