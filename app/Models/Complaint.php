<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'description',
        'photo',
        'location',
        'latitude',
        'longitude',
        'status',
        'finished_file',
    ];

    protected $casts = [
        'latitude'  => 'float',
        'longitude' => 'float',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(ComplaintCategory::class, 'category_id');
    }

    public function responses()
    {
        return $this->hasMany(Response::class);
    }

    public function getStatusBadgeAttribute(): string
    {
        return match ($this->status) {
            'Menunggu' => 'warning',
            'Diproses' => 'info',
            'Selesai'  => 'success',
            default    => 'secondary',
        };
    }
}
