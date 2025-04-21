<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderInfo extends Model
{
    use HasFactory;

    protected $table = 'order_infos';
    public $timestamps = false;

    protected $fillable = [
        'order_id',
        'phone',
        'email',
        'customer_name',
        'country',
        'city',
        'payment_method'
    ];

    protected $guarded = ['id'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Helper method to format phone number for display
    public function getFormattedPhone()
    {
        return $this->phone ? $this->phone : 'N/A';
    }
} 