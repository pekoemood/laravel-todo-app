<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;

class Todo extends Model
{
    use HasFactory;
    use Notifiable;

    protected $fillable = [
        'title', 'description', 'is_complete', 'due_date'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected function casts(): array
    {
        return ['is_complete' => 'boolean',
                'due_date' => 'date'
            ];

    }
}
