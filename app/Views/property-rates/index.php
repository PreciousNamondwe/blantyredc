<?= $this->extend('templates/layout.php')?>

<?= $this->section('content')?>

<!-- Internal Hero -->
<section class="internal-hero">
    <img src="<?= base_url('image/new_hero.jpg'); ?>" class="internal-hero-bg" alt="Property Rates Payment">
    <div class="internal-hero-content">
        <div class="modern-breadcrumb mb-3">
            <a href="<?= base_url('/'); ?>">Overview</a>
            <span class="separator">//</span>
            <span>Services</span>
            <span class="separator">//</span>
            <span>Property Rates</span>
        </div>
        <h1 class="internal-hero-title">Property Rates Payment</h1>
    </div>
</section>

<!-- Main Content Section -->
<section class="bg-slate-dark overlap-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                
                <!-- Form Wizard -->
                <div class="form-wizard" id="propertyRatesForm">
                    
                    <form id="propertyRatesPaymentForm" method="POST">
                        
                        <h3 class="text-white mb-4">Property Information</h3>
                        
                        <div class="form-group-modern">
                            <label>Property Number / Plot Number <span class="required">*</span></label>
                            <input type="text" name="property_number" class="form-input-modern" placeholder="Enter your property/plot number" required>
                        </div>

                        <div class="form-group-modern">
                            <label>Property Address <span class="required">*</span></label>
                            <textarea name="property_address" class="form-input-modern" rows="3" placeholder="Full property address" required></textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group-modern">
                                    <label>Property Type <span class="required">*</span></label>
                                    <select name="property_type" class="form-input-modern" data-custom-dropdown required>
                                        <option value="">Select property type</option>
                                        <option value="residential">Residential</option>
                                        <option value="commercial">Commercial</option>
                                        <option value="industrial">Industrial</option>
                                        <option value="agricultural">Agricultural</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group-modern">
                                    <label>Payment Period <span class="required">*</span></label>
                                    <select name="payment_period" class="form-input-modern" data-custom-dropdown required>
                                        <option value="">Select period</option>
                                        <option value="2026_h1">2026 - First Half (Jan-Jun)</option>
                                        <option value="2026_h2">2026 - Second Half (Jul-Dec)</option>
                                        <option value="2025_h2">2025 - Second Half (Jul-Dec)</option>
                                        <option value="arrears">Arrears Payment</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <h3 class="text-white mb-4 mt-5">Owner Information</h3>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group-modern">
                                    <label>Full Name <span class="required">*</span></label>
                                    <input type="text" name="applicant_name" class="form-input-modern" placeholder="Property owner name" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group-modern">
                                    <label>National ID Number</label>
                                    <input type="text" name="applicant_id_number" class="form-input-modern" placeholder="ID number">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group-modern">
                                    <label>Email Address <span class="required">*</span></label>
                                    <input type="email" name="applicant_email" class="form-input-modern" placeholder="your.email@example.com" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group-modern">
                                    <label>Phone Number <span class="required">*</span></label>
                                    <input type="tel" name="applicant_phone" class="form-input-modern" placeholder="+265 999 123 456" required>
                                </div>
                            </div>
                        </div>

                        <h3 class="text-white mb-4 mt-5">Payment Details</h3>

                        <div class="form-group-modern">
                            <label>Amount to Pay (MK) <span class="required">*</span></label>
                            <input type="number" name="payment_amount" class="form-input-modern" placeholder="Enter amount" min="1000" step="100" required>
                            <small class="text-white-50 d-block mt-2">
                                <i class="fas fa-info-circle"></i> Check your rates bill or contact us if unsure of the amount
                            </small>
                        </div>

                        <div class="form-group-modern">
                            <label>Payment Method <span class="required">*</span></label>
                            <select name="payment_method" class="form-input-modern" data-custom-dropdown required>
                                <option value="">Select payment method</option>
                                <option value="airtel_money">Airtel Money</option>
                                <option value="tnm_mpamba">TNM Mpamba</option>
                                <option value="national_bank">National Bank</option>
                                <option value="standard_bank">Standard Bank</option>
                                <option value="fdh_bank">FDH Bank</option>
                            </select>
                        </div>

                        <div class="form-group-modern">
                            <label>Additional Notes</label>
                            <textarea name="notes" class="form-input-modern" rows="3" placeholder="Any additional information or special requests"></textarea>
                        </div>

                        <!-- Success Message (Hidden Initially) -->
                        <div id="successMessage" style="display: none;">
                            <div class="form-success-card">
                                <i class="fas fa-check-circle form-success-icon"></i>
                                <h2 class="form-success-title">Payment Initiated!</h2>
                                <p class="form-success-message">Your property rates payment has been recorded.</p>
                                <div class="form-success-reference" id="referenceNumber">REF-XXXXXX</div>
                                <p class="text-white-50">
                                    Please complete the payment using your selected method. 
                                    A confirmation will be sent to your email once payment is verified.
                                </p>
                                <a href="<?= base_url('/'); ?>" class="btn-form-primary mt-4">
                                    <i class="fas fa-home"></i> Return to Homepage
                                </a>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="form-actions" id="formActions">
                            <div></div>
                            <button type="submit" class="btn-form-primary" id="submitBtn">
                                <i class="fas fa-credit-card"></i> Proceed to Payment
                            </button>
                        </div>

                    </form>

                </div>

            </div>
        </div>
    </div>
</section>

<script src="<?= base_url('js/form-validator.js'); ?>"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('propertyRatesPaymentForm');
    const validator = new FormValidator(form);
    const submitBtn = document.getElementById('submitBtn');

    form.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        validator.clearErrors();
        
        // Validate
        const propertyNumber = form.querySelector('[name="property_number"]').value;
        const email = form.querySelector('[name="applicant_email"]').value;
        const phone = form.querySelector('[name="applicant_phone"]').value;
        const amount = form.querySelector('[name="payment_amount"]').value;
        
        let isValid = true;
        isValid = validator.validateRequired('property_number', propertyNumber, 'Property Number') && isValid;
        isValid = validator.validateRequired('applicant_email', email, 'Email') && isValid;
        isValid = validator.validateEmail('applicant_email', email) && isValid;
        isValid = validator.validateRequired('applicant_phone', phone, 'Phone') && isValid;
        isValid = validator.validatePhone('applicant_phone', phone) && isValid;
        isValid = validator.validateRequired('payment_amount', amount, 'Payment Amount') && isValid;
        
        if (!isValid) {
            validator.displayErrors();
            return;
        }

        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span class="form-loading"></span> Processing...';

        try {
            const formData = new FormData(form);
            
            const jsonData = {};
            formData.forEach((value, key) => {
                jsonData[key] = value;
            });
            
            const payload = {
                service_type: 'property_rates',
                applicant_name: formData.get('applicant_name'),
                applicant_email: formData.get('applicant_email'),
                applicant_phone: formData.get('applicant_phone'),
                applicant_id_number: formData.get('applicant_id_number') || '',
                payment_amount: parseFloat(formData.get('payment_amount')),
                form_data: JSON.stringify(jsonData)
            };

            const response = await fetch('<?= base_url('api/applications/submit'); ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(payload)
            });

            const result = await response.json();

            if (result.success) {
                document.getElementById('referenceNumber').textContent = result.data.reference_number;
                form.style.display = 'none';
                document.getElementById('formActions').style.display = 'none';
                document.getElementById('successMessage').style.display = 'block';
            } else {
                alert('Error: ' + result.message);
                submitBtn.disabled = false;
                submitBtn.innerHTML = '<i class="fas fa-credit-card"></i> Proceed to Payment';
            }
        } catch (error) {
            console.error('Error:', error);
            alert('An error occurred. Please try again.');
            submitBtn.disabled = false;
            submitBtn.innerHTML = '<i class="fas fa-credit-card"></i> Proceed to Payment';
        }
    });
});

// Standalone Custom Dropdown Conversion
(function() {
    function convertSelectToCustom(select) {
        if (select.dataset.converted === 'true') return;
        
        const wrapper = document.createElement('div');
        wrapper.className = 'custom-dropdown';
        
        const toggle = document.createElement('button');
        toggle.className = 'custom-dropdown-toggle';
        toggle.type = 'button';
        toggle.textContent = select.options[0]?.text || 'Select an option';
        
        const menu = document.createElement('div');
        menu.className = 'custom-dropdown-menu';
        
        Array.from(select.options).forEach(option => {
            const item = document.createElement('div');
            item.className = 'custom-dropdown-item';
            item.textContent = option.text;
            item.dataset.value = option.value;
            item.addEventListener('click', function() {
                select.value = option.value;
                toggle.textContent = option.text;
                menu.classList.remove('show');
                toggle.classList.remove('active');
                menu.querySelectorAll('.custom-dropdown-item').forEach(i => i.classList.remove('selected'));
                item.classList.add('selected');
                select.dispatchEvent(new Event('change'));
            });
            menu.appendChild(item);
        });
        
        toggle.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            const isOpen = menu.classList.contains('show');
            if (isOpen) {
                menu.classList.remove('show');
                toggle.classList.remove('active');
            } else {
                menu.classList.add('show');
                toggle.classList.add('active');
            }
        });
        
        document.addEventListener('click', function(e) {
            if (!wrapper.contains(e.target)) {
                menu.classList.remove('show');
                toggle.classList.remove('active');
            }
        });
        
        wrapper.appendChild(toggle);
        wrapper.appendChild(menu);
        
        select.style.display = 'none';
        select.dataset.converted = 'true';
        select.parentNode.insertBefore(wrapper, select);
        
        select.addEventListener('change', function() {
            const selected = Array.from(select.options).find(o => o.value === select.value);
            if (selected) toggle.textContent = selected.text;
        });
    }
    
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initCustomDropdowns);
    } else {
        initCustomDropdowns();
    }
    
    function initCustomDropdowns() {
        setTimeout(function() {
            document.querySelectorAll('select[data-custom-dropdown]').forEach(convertSelectToCustom);
        }, 100);
    }
})();
</script>

<?= $this->endSection()?>
