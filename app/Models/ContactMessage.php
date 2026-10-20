<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContactMessage extends Model
{
    protected $fillable = [
        'handled_by',
        'name',
        'email',
        'phone',
        'company_name',
        'service_type',
        'budget_range',
        'subject',
        'message',
        'status',
        'crm_status',
        'admin_note',
    ];

    public function handler(): BelongsTo
    {
        return $this->belongsTo(User::class, 'handled_by');
    }

    public function scopeUnread(Builder $query): Builder
    {
        return $query->where('status', 'unread');
    }

    public function getCrmStatusLabelAttribute(): string
    {
        return match ($this->crm_status) {
            'contacted' => 'Dihubungi',
            'in_discussion' => 'Dalam Diskusi',
            'proposal_sent' => 'Proposal Terkirim',
            'won' => 'Deal / Menang',
            'lost' => 'Batal / Lost',
            default => 'Inquiry Baru',
        };
    }
}
