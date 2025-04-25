<?php
namespace App\Services;



class MomoService implements PaymentGatewayInterface
{
    public function processPayment(array $orderData): array
    {
        $phone = $orderData['phone'] ?? '';

        if( $phone==='089111111'){
            return[
                'status' => 0,
                'message'=>'Something went wrong',
            ];
        }
        elseif( $phone==='089999999'){
            return[
                'status' => 1,
                'message'=>'Payment processed by Momo',
            ];
        }else{
            return[
                'status' => 2,
                'message'=>'entern phone',
            ];
        }
    }
}