<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OssCheckLog extends Model
{
    protected $fillable = ['user_id', 'nib', 'status', 'http_code', 'sumber', 'message', 'checked_by'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function checker(): BelongsTo
    {
        return $this->belongsTo(User::class, 'checked_by');
    }
}
