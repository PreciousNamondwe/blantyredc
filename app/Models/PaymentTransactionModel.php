<?php

namespace App\Models;

use CodeIgniter\Model;

class PaymentTransactionModel extends Model
{
    protected $table = 'payment_transactions';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'application_id',
        'amount',
        'currency',
        'payment_method',
        'transaction_reference',
        'status',
        'paid_at'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // Validation
    protected $validationRules = [
        'application_id' => 'required|integer',
        'amount' => 'required|decimal',
        'currency' => 'required|max_length[3]',
        'payment_method' => 'required|in_list[cash,bank_transfer,mobile_money,card]',
        'transaction_reference' => 'required|max_length[100]|is_unique[payment_transactions.transaction_reference,id,{id}]',
        'status' => 'required|in_list[pending,completed,failed,refunded]'
    ];

    /**
     * Create payment transaction
     */
    public function createTransaction($applicationId, $amount, $paymentMethod = 'cash', $currency = 'MWK')
    {
        $reference = 'PAY-' . date('YmdHis') . '-' . str_pad(mt_rand(0, 9999), 4, '0', STR_PAD_LEFT);

        return $this->insert([
            'application_id' => $applicationId,
            'amount' => $amount,
            'currency' => $currency,
            'payment_method' => $paymentMethod,
            'transaction_reference' => $reference,
            'status' => 'pending'
        ]);
    }

    /**
     * Mark payment as completed
     */
    public function completePayment($transactionId)
    {
        return $this->update($transactionId, [
            'status' => 'completed',
            'paid_at' => date('Y-m-d H:i:s')
        ]);
    }

    /**
     * Get payments for application
     */
    public function getApplicationPayments($applicationId)
    {
        return $this->where('application_id', $applicationId)
                    ->orderBy('created_at', 'DESC')
                    ->findAll();
    }

    /**
     * Get payment statistics
     */
    public function getPaymentStats($days = 30)
    {
        $startDate = date('Y-m-d H:i:s', strtotime("-{$days} days"));

        $stats = [];

        // Total payments
        $stats['total_payments'] = $this->where('created_at >=', $startDate)->countAllResults();

        // Completed payments
        $stats['completed_payments'] = $this->where('status', 'completed')
            ->where('created_at >=', $startDate)
            ->countAllResults();

        // Total amount collected
        $result = $this->selectSum('amount')
            ->where('status', 'completed')
            ->where('created_at >=', $startDate)
            ->first();
        $stats['total_amount'] = $result['amount'] ?? 0;

        // By payment method
        $methodStats = $this->select('payment_method, COUNT(*) as count, SUM(amount) as total')
            ->where('status', 'completed')
            ->where('created_at >=', $startDate)
            ->groupBy('payment_method')
            ->findAll();

        $stats['by_method'] = $methodStats;

        return $stats;
    }

    /**
     * Check if application has completed payment
     */
    public function hasCompletedPayment($applicationId)
    {
        return $this->where('application_id', $applicationId)
                    ->where('status', 'completed')
                    ->countAllResults() > 0;
    }
}