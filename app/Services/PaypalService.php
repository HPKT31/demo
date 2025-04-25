<?php 
namespace App\Services;



class PaypalService implements PaymentGatewayInterface
{
    public function processPayment(array $orderData): array
    {
        $email = $orderData['email'] ?? '';

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return ['status' => 2, 'message' => 'Invalid email format'];
        }

        if ($email === 'success@ttrpay.net') {
            return ['status' => 1, 'message' => 'Payment success by PayPal'];
        }

        if ($email === 'failed@ttrpay.net') {
            return ['status' => 0, 'message' => 'Payment failed by PayPal'];
        }

        return ['status' => 2, 'message' => 'Unsupported email'];
    }
}