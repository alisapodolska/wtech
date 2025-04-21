<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'date',
        'status',
        'total_price',
        'total_amount',
        'created_at'
    ];

    protected $casts = [
        'date' => 'datetime:Y-m-d H:i:s',
        'created_at' => 'datetime:Y-m-d H:i:s',
        'total_price' => 'decimal:2',
        'total_amount' => 'decimal:2'
    ];

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderInfo()
    {
        return $this->hasOne(OrderInfo::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Helper method to format date
    public function getFormattedDate()
    {
        return $this->date ? Carbon::parse($this->date)->format('Y-m-d H:i:s') : '';
    }
} 