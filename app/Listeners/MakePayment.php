<?php

namespace App\Listeners;

use App\Events\BookingCreated;
use App\Services\BookingService;
use App\Services\PaymentService;

class MakePayment
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(BookingCreated $event): void
    {
        $payment = (new PaymentService($event->booking))->create();
        (new BookingService($event->booking->room))->update($event->booking, [
            'payment_id' => $payment->id
        ]);

    }
}
