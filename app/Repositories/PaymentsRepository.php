<?php
namespace App\Repositories;

use App\Models\OrderDetails;
use App\Models\Payments;
use Exception;
use Illuminate\Support\Facades\DB;

class PaymentsRepository
{
    
    public function createPayment($params){
        $data = [
            'amount' => $params['vnp_Amount'] / 100,
            'trade_code' => $params['vnp_TransactionNo'],
            'trade_date' => date('Y/m/d H:i:s', strtotime($params['vnp_PayDate'])),
            'bank_code' => $params['vnp_BankCode'],
            'bank_pay_code' => $params['vnp_BankTranNo'],
            'user_id' => Auth()->user()->id,
            'order_id' => $params['vnp_TxnRef'],
            'type' => $params['vnp_CardType'],
            'status' => 1
        ];
        return Payments::create($data);
    }

}
