<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cuti extends Model
{
    protected $table = 'cutis';
    
    protected $fillable = [
        'pegawai_id',
        'tanggal_mulai',
        'tanggal_akhir',
        'jumlah_hari',
        'alasan',
        'status',
        'approved_by',
        'catatan',
    ];

    const STATUS_PENDING = 'pending';
    const STATUS_APPROVED = 'approved';
    const STATUS_REJECTED = 'rejected';
    const STATUS_CANCELED = 'canceled';

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }

    public function approvedBy()
    {
        return $this->belongsTo(Pegawai::class, 'approved_by');
    }
    
    /**
     * Check if the leave request is in a pending state
     */
    public function isPending()
    {
        return $this->status === self::STATUS_PENDING;
    }
    
    /**
     * Check if the leave request has been approved
     */
    public function isApproved()
    {
        return $this->status === self::STATUS_APPROVED;
    }
    
    /**
     * Check if the leave request has been rejected
     */
    public function isRejected()
    {
        return $this->status === self::STATUS_REJECTED;
    }
    
    /**
     * Check if the leave request has been canceled
     */
    public function isCanceled()
    {
        return $this->status === self::STATUS_CANCELED;
    }
    
    /**
     * Scope a query to only include active leave requests (pending or approved)
     */
    public function scopeActive($query)
    {
        return $query->whereIn('status', [self::STATUS_PENDING, self::STATUS_APPROVED]);
    }
}
