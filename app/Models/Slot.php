<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Slot extends Model
{
    use HasFactory;

    protected $table = "slots";

    const DOOR_DELIVERY = 'Door Delivery';
    const FAST_DELIVERY = 'Fast Delivery';
    const MORNING = 'Morning';
    const EVENING = 'Evening';

    protected $fillable = [
        'delivery_type',
        'day_type',
        'start_time',
        'end_time',
    ];

    public function getDayType()
    {
        return $this->day_type == 'M' ? Self::MORNING : Self::EVENING;
    }

    public function getDeliveryType()
    {
        return $this->delivery_type == 'D' ? Self::DOOR_DELIVERY : Self::FAST_DELIVERY;
    }

    public function setStartTimeAttribute($value)
    {
        $this->attributes['start_time'] = Carbon::parse($value);
    }
}
