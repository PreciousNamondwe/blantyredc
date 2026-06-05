<?php

namespace App\Services;

use App\Models\PaymentTransactionModel;
use App\Models\ApplicationModel;

class PaymentService
{
    protected $paymentModel;
    protected $applicationModel;

    public function __construct()
    {
        $this->paymentModel = new PaymentTransactionModel();
        $this->applicationModel = new ApplicationModel();
    }

    /**
     * Process payment for application
     */
    public function processPayment($applicationId, $amount, $paymentMethod, $reference = null, $userId = null)
    {
        // Get application details
        $application = $this->applicationModel->find($applicationId);
        if (!$application) {
            throw new \Exception('Application not found');
        }

        // Check if payment already exists
        $existingPayment = $this->paymentModel
            ->where('application_id', $applicationId)
            ->where('status', 'completed')
            ->first();

        if ($existingPayment) {
            throw new \Exception('Payment already completed for this application');
        }

        // Create payment transaction
        $paymentData = [
            'application_id' => $applicationId,
            'user_id' => $userId ?: $application['user_id'],
            'amount' => $amount,
            'payment_method' => $paymentMethod,
            'reference_number' => $reference ?: $this->generateReferenceNumber(),
            'status' => 'pending',
            'transaction_date' => date('Y-m-d H:i:s'),
            'created_at' => date('Y-m-d H:i:s')
        ];

        $paymentId = $this->paymentModel->insert($paymentData);

        return $this->paymentModel->find($paymentId);
    }

    /**
     * Confirm payment
     */
    public function confirmPayment($paymentId, $transactionId = null)
    {
        $payment = $this->paymentModel->find($paymentId);
        if (!$payment) {
            throw new \Exception('Payment not found');
        }

        if ($payment['status'] === 'completed') {
            throw new \Exception('Payment already completed');
        }

        $updateData = [
            'status' => 'completed',
            'transaction_id' => $transactionId,
            'completed_at' => date('Y-m-d H:i:s')
        ];

        $this->paymentModel->update($paymentId, $updateData);

        // Update application payment status
        $this->applicationModel->update($payment['application_id'], [
            'payment_status' => 'paid',
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        return $this->paymentModel->find($paymentId);
    }

    /**
     * Get payment by application ID
     */
    public function getPaymentByApplication($applicationId)
    {
        return $this->paymentModel
            ->where('application_id', $applicationId)
            ->orderBy('created_at', 'DESC')
            ->first();
    }

    /**
     * Get payments by user
     */
    public function getPaymentsByUser($userId, $limit = 20, $offset = 0)
    {
        return $this->paymentModel
            ->where('user_id', $userId)
            ->orderBy('created_at', 'DESC')
            ->limit($limit, $offset)
            ->findAll();
    }

    /**
     * Calculate service fee based on service type
     */
    public function calculateServiceFee($serviceType)
    {
        $fees = [
            'birth_certificate' => 5000,
            'death_certificate' => 3000,
            'business_license' => 25000,
            'complaint_reporting' => 1000,
            'change_of_name' => 15000,
            'commissioner_of_oaths' => 2000,
            'certification_of_certificates' => 5000,
            'deceased_estates' => 10000,
            'affidavits' => 3000,
            'activity_features' => 5000
        ];

        return $fees[$serviceType] ?? 0;
    }

    /**
     * Generate unique reference number
     */
    private function generateReferenceNumber()
    {
        return 'PAY-' . date('Ymd') . '-' . strtoupper(substr(md5(uniqid()), 0, 8));
    }

    /**
     * Get payment statistics
     */
    public function getPaymentStats($startDate = null, $endDate = null)
    {
        $query = $this->paymentModel;

        if ($startDate) {
            $query->where('transaction_date >=', $startDate);
        }

        if ($endDate) {
            $query->where('transaction_date <=', $endDate);
        }

        $totalAmount = $query->selectSum('amount')->first()['amount'] ?? 0;
        $completedCount = $query->where('status', 'completed')->countAllResults();
        $pendingCount = $query->where('status', 'pending')->countAllResults();

        return [
            'total_amount' => $totalAmount,
            'completed_payments' => $completedCount,
            'pending_payments' => $pendingCount
        ];
    }

    /**
     * Refund payment
     */
    public function refundPayment($paymentId, $reason = null)
    {
        $payment = $this->paymentModel->find($paymentId);
        if (!$payment) {
            throw new \Exception('Payment not found');
        }

        if ($payment['status'] !== 'completed') {
            throw new \Exception('Only completed payments can be refunded');
        }

        $this->paymentModel->update($paymentId, [
            'status' => 'refunded',
            'refund_reason' => $reason,
            'refunded_at' => date('Y-m-d H:i:s')
        ]);

        // Update application payment status
        $this->applicationModel->update($payment['application_id'], [
            'payment_status' => 'refunded',
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        return $this->paymentModel->find($paymentId);
    }
}