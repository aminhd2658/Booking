<?php

namespace App\Services;

use App\Interfaces\ModelInterface;
use App\Models\Booking;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class PaymentService implements ModelInterface
{

    public function __construct(private Booking $booking)
    {
    }


    public function create(array $data = null)
    {
        $data = [
            //'gateway' =>,
            'ref_num' => mt_rand(1000000, 9999999),
            'price' => $this->calculatePrice(),
            'status' => Payment::COMPLETE,
            'date' => Carbon::now()
        ];

        return $this->booking->payments()->create($data);
    }


    public function update(Model $model, array $data)
    {
    }

    public function delete(Model $model)
    {
    }


    // Calculate customer payment price : days * final_price_per_night
    public function calculatePrice()
    {
        $diffDays = Carbon::parse($this->booking->start_at)->diffInDays(Carbon::parse($this->booking->end_at));
        return $diffDays * $this->booking->room->final_price_per_night;
    }
}
