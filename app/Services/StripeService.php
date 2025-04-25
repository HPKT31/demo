<?php
namespace App\Services;

use App\Services\PaymentGatewayInterface;

class StripeService implements PaymentGatewayInterface
{
    public function processPayment(array $orderData): array
    {
        $card = $orderData['credit_card'] ?? '';

        if (!preg_match('/^[0-9]{16}$/', $card)) {
            return ['status' => 2, 'message' => 'Invalid card format'];
        }

        if ($card === '4242424242424242') {
            return ['status' => 1, 'message' => 'Payment success by Stripe'];
        }

        if ($card === '4000000000001018') {
            return ['status' => 0, 'message' => 'Payment failed by Stripe'];
        }

        return ['status' => 2, 'message' => 'Unsupported card'];
    }
    
}
