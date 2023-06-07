<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeSheet extends Model
{
    use HasFactory;

    protected $fillable = [
        'work_day',
        'difficult',
        'plan',
        'created_by',
        'manager_id',
        'status'
    ];

    public const STATUS = [
        'Chưa duyệt', 'Đã duyệt', 'Từ chối'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id', 'id');
    }

    public function timeSheetDetails()
    {
        return $this->hasMany(TimeSheetDetail::class, 'time_sheet_id', 'id');
    }
}
