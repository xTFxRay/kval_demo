<?php
namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $order;

    public function __construct($order)
    {
        $this->order = $order;
    }
    
    public function build()
    {
        return $this->view('emails.order_confirmation')
                    ->with([
                        'name' => $this->order->name,
                        'orderId' => $this->order->id,
                        'totalAmount' => $this->order->total_amount,
                    ]);
    }
}