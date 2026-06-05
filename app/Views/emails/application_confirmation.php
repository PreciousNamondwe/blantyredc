<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Confirmation - Blantyre District Council</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background: #0f172a;
            color: white;
            padding: 20px;
            text-align: center;
        }
        .content {
            background: #f8f9fa;
            padding: 30px;
            border: 1px solid #dee2e6;
        }
        .reference {
            background: #ef4444;
            color: white;
            padding: 15px;
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            letter-spacing: 2px;
            margin: 20px 0;
        }
        .info-box {
            background: white;
            border-left: 4px solid #ef4444;
            padding: 15px;
            margin: 15px 0;
        }
        .footer {
            text-align: center;
            padding: 20px;
            color: #6c757d;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Blantyre District Council</h1>
        <p>Application Confirmation</p>
    </div>
    
    <div class="content">
        <h2>Dear <?= $application['applicant_name']; ?>,</h2>
        
        <p>Thank you for submitting your application for <strong><?= ucwords(str_replace('_', ' ', $application['service_type'])); ?></strong>.</p>
        
        <div class="reference">
            <?= $application['reference_number']; ?>
        </div>
        
        <p>Please save this reference number for tracking your application status.</p>
        
        <div class="info-box">
            <h3>Application Details:</h3>
            <ul>
                <li><strong>Service:</strong> <?= ucwords(str_replace('_', ' ', $application['service_type'])); ?></li>
                <li><strong>Reference Number:</strong> <?= $application['reference_number']; ?></li>
                <li><strong>Submitted:</strong> <?= date('F j, Y g:i A', strtotime($application['created_at'])); ?></li>
                <li><strong>Status:</strong> <?= ucfirst($application['status']); ?></li>
                <?php if ($application['payment_amount']): ?>
                <li><strong>Fee:</strong> MK <?= number_format($application['payment_amount'], 2); ?></li>
                <?php endif; ?>
            </ul>
        </div>
        
        <div class="info-box">
            <h3>Next Steps:</h3>
            <ol>
                <li>Complete payment if not already done</li>
                <li>Our team will review your application within 5 business days</li>
                <li>You will receive an email notification when your application is processed</li>
                <li>Track your application status online using your reference number</li>
            </ol>
        </div>
        
        <p>If you have any questions, please contact us at:</p>
        <ul>
            <li>Email: info@blantyredc.gov.mw</li>
            <li>Phone: +265 1 822 277</li>
        </ul>
    </div>
    
    <div class="footer">
        <p>&copy; <?= date('Y'); ?> Blantyre District Council. All rights reserved.</p>
        <p>This is an automated message. Please do not reply to this email.</p>
    </div>
</body>
</html>
