#!/bin/bash

# Database Setup Script for Digital Forms System
# Blantyre District Council

echo "========================================="
echo "Digital Forms Database Setup"
echo "========================================="
echo ""

# Database credentials
DB_NAME="blantyredc"
DB_USER="root"

echo "This script will create the necessary database tables for the digital forms system."
echo ""
read -p "Enter MySQL password for root user: " -s DB_PASS
echo ""
echo ""

# Run the migration
echo "Creating database tables..."
mysql -u $DB_USER -p$DB_PASS $DB_NAME < app/Database/migrations/001_create_applications_schema.sql

if [ $? -eq 0 ]; then
    echo "✓ Database tables created successfully!"
    echo ""
    echo "The following tables have been created:"
    echo "  - applications"
    echo "  - application_documents"
    echo "  - application_status_log"
    echo "  - payment_transactions"
    echo "  - service_config"
    echo ""
    
    # Insert default service configurations
    echo "Inserting default service configurations..."
    mysql -u $DB_USER -p$DB_PASS $DB_NAME << EOF
INSERT INTO service_config (service_type, service_name, description, fee_amount, processing_days, is_active) VALUES
('marriage_certificate', 'Marriage Certificate', 'Official marriage certificate application', 22000.00, 5, TRUE),
('business_license', 'Business License', 'New business license application', 50000.00, 7, TRUE),
('firearm_license', 'Firearm License', 'Firearm license application', 75000.00, 14, TRUE),
('birth_certificate', 'Birth Certificate', 'Birth certificate request', 15000.00, 3, TRUE),
('death_certificate', 'Death Certificate', 'Death certificate request', 15000.00, 3, TRUE);
EOF
    
    if [ $? -eq 0 ]; then
        echo "✓ Service configurations inserted successfully!"
    else
        echo "✗ Failed to insert service configurations"
    fi
    
    echo ""
    echo "========================================="
    echo "Setup Complete!"
    echo "========================================="
    echo ""
    echo "You can now access the digital forms at:"
    echo "  - Marriage Certificate: /marriage-certificates"
    echo ""
    echo "API Endpoints available:"
    echo "  - POST /api/applications/submit"
    echo "  - GET  /api/applications/{id}/status"
    echo "  - POST /api/applications/{id}/documents"
    echo ""
else
    echo "✗ Failed to create database tables"
    echo "Please check your database credentials and try again."
    exit 1
fi
