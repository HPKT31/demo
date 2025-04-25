<?php 
namespace App\Controllers;

use App\Models\Orders;
use App\Services\MomoService;
use App\Services\StripeService;
use App\Services\PaypalService;
use CodeIgniter\RESTful\ResourceController;

class PaymentController extends ResourceController
{
    protected $modelName = 'APP\Models\Orders';
    protected $format ='json';

    public function createOrder()
    {     
        
        $data = $this->request->getJSON(true);
        log_message('debug', 'Payment data: ' . json_encode($data));
   

        if (!isset($data['payment_type']) || !isset($data['customer_info'])) {
            return $this->failValidationErrors('Missing required fields');
        }
       

        $service = match ($data['payment_type']) {
            'momo'   => new MomoService(),
            'stripe' => new StripeService(),
            'paypal' => new PaypalService(),
            default  => null,
        };

        if (!$service) {
            return $this->fail('Unsupported payment type');
        }

        $result = $service->processPayment($data);

        if ($result['status'] === 2) {
            return $this->fail($result['message']);
        }

        $order = new Orders();

        $insertData = [
            'payment_type'   => $data['payment_type'],
            'phone'          => $data['phone'] ?? null,
            'email'          => $data['email'] ?? null,
            'credit_card'    => $data['credit_card'] ?? null,
            'amount'         => $data['amount'],
            'payment_status' => $result['status'],
            'message'        => $result['message'],
        ];

        $order->insert($insertData);

        return $this->respondCreated($insertData);
    }
}