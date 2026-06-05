<?= $this->extend('templates/layout.php')?>

<?= $this->section('content')?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<!-- Main Wrapper Section (Matches Custom Soft Bluish-Slate Civic Layout) -->
<section class="w-100 py-5" style="background-color: #f0f4f8;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                
                <!-- Pure White Form Layout Container Card -->
                <div class="card bg-white text-dark border-0 shadow-sm p-4 p-md-5 rounded-3">
                    
                    <form id="complaintReportingForm" method="POST" novalidate>
                        
                        <!-- Section 1: Core Details -->
                        <div class="border-bottom pb-2 mb-4">
                            <h3 class="h4 text-dark fw-bold m-0">Complaint Details</h3>
                        </div>
                        
                        <div class="form-group mb-4">
                            <label class="form-label text-dark fw-semibold small text-uppercase mb-2">Complaint Category <span class="text-danger">*</span></label>
                            <select name="complaint_category" class="form-select border-light-dark p-3 bg-light" data-custom-dropdown required>
                                <option value="">Select category</option>
                                <option value="corruption">Corruption</option>
                                <option value="roads">Roads & Infrastructure</option>
                                <option value="waste">Waste Management</option>
                                <option value="water">Water & Drainage</option>
                                <option value="street_lights">Street Lighting</option>
                                <option value="public_health">Public Health</option>
                                <option value="noise">Noise Pollution</option>
                                <option value="illegal_construction">Illegal Construction</option>
                                <option value="staff_conduct">Staff Conduct</option>
                                <option value="service_delivery">Service Delivery</option>
                                <option value="other">Other</option>
                            </select>
                        </div>

                        <div class="form-group mb-4">
                            <label class="form-label text-dark fw-semibold small text-uppercase mb-2">Subject/Title <span class="text-danger">*</span></label>
                            <input type="text" name="complaint_subject" class="form-control border-light-dark p-3 bg-light" placeholder="Brief description of the issue" required>
                        </div>

                        <div class="form-group mb-4">
                            <label class="form-label text-dark fw-semibold small text-uppercase mb-2">Detailed Description <span class="text-danger">*</span></label>
                            <textarea name="complaint_description" class="form-control border-light-dark p-3 bg-light" rows="5" placeholder="Please provide as much detail as possible about the issue" style="line-height: 1.6;" required></textarea>
                        </div>

                        <div class="form-group mb-4">
                            <label class="form-label text-dark fw-semibold small text-uppercase mb-2">Location/Address <span class="text-danger">*</span></label>
                            <textarea name="complaint_location" class="form-control border-light-dark p-3 bg-light" rows="2" placeholder="Exact location where the issue is occurring" required></textarea>
                        </div>

                        <div class="form-group mb-4">
                            <label class="form-label text-dark fw-semibold small text-uppercase mb-2">Priority Level <span class="text-danger">*</span></label>
                            <select name="priority_level" class="form-select border-light-dark p-3 bg-light" data-custom-dropdown required>
                                <option value="">Select priority</option>
                                <option value="low">Low - Can wait for regular schedule</option>
                                <option value="medium">Medium - Needs attention soon</option>
                                <option value="high">High - Urgent issue</option>
                                <option value="emergency">Emergency - Immediate danger</option>
                            </select>
                        </div>

                        <!-- Section 2: Supporting Evidence -->
                        <div class="border-bottom pb-2 mt-5 mb-4">
                            <h3 class="h4 text-dark fw-bold m-0">Supporting Evidence <span class="text-muted fs-6 fw-normal">(Optional)</span></h3>
                        </div>

                        <div class="form-group mb-4">
                            <label class="form-label text-dark fw-semibold small text-uppercase mb-2">Upload Photos</label>
                            <div class="file-upload-zone p-5 rounded-3 text-center border border-2 border-dashed bg-light cursor-pointer" id="uploadZone1" style="border-color: #cbd5e1 !important; transition: all 0.2s ease;">
                                <i class="fas fa-camera text-muted mb-3" style="font-size: 2rem;"></i>
                                <div class="fw-bold text-dark mb-1">Click to upload photos or drag and drop</div>
                                <div class="text-muted small">JPG or PNG (Max 5MB each, up to 5 photos)</div>
                            </div>
                            <input type="file" id="fileInput1" name="photos" accept=".jpg,.jpeg,.png" multiple style="display: none;">
                            <div class="uploaded-files-list mt-3 row g-2" id="fileList1"></div>
                        </div>

                        <!-- Section 3: Identity & Contact -->
                        <div class="border-bottom pb-2 mt-5 mb-4">
                            <h3 class="h4 text-dark fw-bold m-0">Contact Information</h3>
                        </div>

                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="form-group mb-4">
                                    <label class="form-label text-dark fw-semibold small text-uppercase mb-2">Full Name <span class="text-danger">*</span></label>
                                    <input type="text" name="applicant_name" class="form-control border-light-dark p-3 bg-light" placeholder="Your full name" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-4">
                                    <label class="form-label text-dark fw-semibold small text-uppercase mb-2">Phone Number <span class="text-danger">*</span></label>
                                    <input type="tel" name="applicant_phone" class="form-control border-light-dark p-3 bg-light" placeholder="+265 999 123 456" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <label class="form-label text-dark fw-semibold small text-uppercase mb-2">Email Address <span class="text-danger">*</span></label>
                            <input type="email" name="applicant_email" class="form-control border-light-dark p-3 bg-light" placeholder="your.email@example.com" required>
                        </div>

                        <div class="form-check p-0 mt-4 d-flex align-items-start gap-2">
                            <input type="checkbox" class="form-check-input ms-0 mt-1" name="anonymous" value="1" id="anonymousCheck">
                            <label class="form-check-label text-muted small" for="anonymousCheck" style="line-height: 1.4;">
                                Submit anonymously (your contact details will be kept confidential within Council governance networks)
                            </label>
                        </div>

                        <!-- Form Action Submission Row -->
                        <div class="d-flex justify-content-end align-items-center mt-5 pt-3 border-top" id="formActions">
                            <button type="submit" class="btn text-white px-5 py-3 fw-bold rounded-3 shadow-sm transition-all" id="submitBtn" style="background-color: #0a2540; border: none;">
                                <i class="fas fa-paper-plane me-2"></i> Submit Complaint
                            </button>
                        </div>
                    </form>

                    <!-- Success Message Layout Module (Hidden Initially) -->
                    <div id="successMessage" style="display: none;">
                        <div class="text-center py-4">
                            <i class="fas fa-check-circle text-success mb-3" style="font-size: 4.5rem;"></i>
                            <h2 class="text-dark fw-extrabold mb-2">Complaint Submitted!</h2>
                            <p class="text-muted px-lg-5">Thank you for reporting this issue. We take all localized community disruptions and civil oversight issues seriously.</p>
                            
                            <div class="d-inline-block bg-light px-4 py-2 my-3 rounded-pill border fw-mono font-weight-bold text-dark tracking-wider" id="referenceNumber">
                                REF-XXXXXX
                            </div>
                            
                            <p class="small text-muted mb-4">
                                Your complaint has been systematically logged. Updates will route systematically via email or SMS networks.
                            </p>
                            
                            <div class="text-start p-4 rounded-3 mb-4 mx-auto" style="background-color: #f8fafc; border: 1px solid #e2e8f0; max-width: 550px;">
                                <h6 class="text-dark fw-bold mb-3 d-flex align-items-center"><i class="fas fa-info-circle me-2 text-primary"></i> Next Processing Milestones:</h6>
                                <ol class="text-muted small mb-0 ps-3" style="line-height: 1.8;">
                                    <li>Intake triage evaluation complete within 24 hours.</li>
                                    <li>Assignment allocation to specialized municipal department teams.</li>
                                    <li>Action strategy execution and physical verification parameters.</li>
                                    <li>Direct diagnostic resolution disclosure updates generated.</li>
                                </ol>
                            </div>
                            
                            <a href="<?= base_url('/'); ?>" class="btn btn-outline-dark rounded-pill px-4 py-2 mt-2">
                                <i class="fas fa-home me-2"></i> Return to Homepage
                            </a>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</section>

<script src="<?= base_url('js/form-validator.js'); ?>"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('complaintReportingForm');
    const validator = new FormValidator(form);
    const submitBtn = document.getElementById('submitBtn');
    
    const fileHandler = new FileUploadHandler(
        document.getElementById('uploadZone1'),
        document.getElementById('fileInput1'),
        document.getElementById('fileList1')
    );

    form.addEventListener('submit', async function(e) {
        e.preventDefault();
        validator.clearErrors();
        
        const name = form.querySelector('[name="applicant_name"]').value;
        const email = form.querySelector('[name="applicant_email"]').value;
        const phone = form.querySelector('[name="applicant_phone"]').value;
        const subject = form.querySelector('[name="complaint_subject"]').value;
        const description = form.querySelector('[name="complaint_description"]').value;
        
        let isValid = true;
        isValid = validator.validateRequired('applicant_name', name, 'Full Name') && isValid;
        isValid = validator.validateRequired('applicant_email', email, 'Email') && isValid;
        isValid = validator.validateEmail('applicant_email', email) && isValid;
        isValid = validator.validateRequired('applicant_phone', phone, 'Phone') && isValid;
        isValid = validator.validatePhone('applicant_phone', phone) && isValid;
        isValid = validator.validateRequired('complaint_subject', subject, 'Subject') && isValid;
        isValid = validator.validateRequired('complaint_description', description, 'Description') && isValid;
        isValid = validator.validateMinLength('complaint_description', description, 20, 'Description') && isValid;
        
        if (!isValid) {
            validator.displayErrors();
            return;
        }

        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Submitting...';

        try {
            const formData = new FormData(form);
            const jsonData = {};
            formData.forEach((value, key) => {
                jsonData[key] = value;
            });
            
            const payload = {
                service_type: 'complaint_reporting',
                applicant_name: formData.get('applicant_name'),
                applicant_email: formData.get('applicant_email'),
                applicant_phone: formData.get('applicant_phone'),
                applicant_id_number: '',
                payment_amount: 0,
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
                const applicationId = result.data.application_id;
                const files = fileHandler.getFiles();
                
                for (const file of files) {
                    const photoFormData = new FormData();
                    photoFormData.append('document', file);
                    photoFormData.append('document_type', 'complaint_photo');

                    await fetch(`<?= base_url('api/applications/'); ?>${applicationId}/documents`, {
                        method: 'POST',
                        body: photoFormData
                    });
                }

                document.getElementById('referenceNumber').textContent = result.data.reference_number;
                form.style.display = 'none';
                document.getElementById('formActions').style.display = 'none';
                document.getElementById('successMessage').style.display = 'block';
                window.scrollTo({ top: 0, behavior: 'smooth' });
            } else {
                alert('Error: ' + result.message);
                resetSubmitBtn();
            }
        } catch (error) {
            console.error('Error:', error);
            alert('An error occurred. Please try again.');
            resetSubmitBtn();
        }
    });

    function resetSubmitBtn() {
        submitBtn.disabled = false;
        submitBtn.innerHTML = '<i class="fas fa-paper-plane me-2"></i> Submit Complaint';
    }
});

// Dropdown Custom Transformation Driver
(function() {
    function convertSelectToCustom(select) {
        if (select.dataset.converted === 'true') return;
        
        const wrapper = document.createElement('div');
        wrapper.className = 'custom-dropdown position-relative w-100';
        
        const toggle = document.createElement('button');
        toggle.className = 'custom-dropdown-toggle btn btn-light border-light-dark text-start w-100 p-3 d-flex justify-content-between align-items-center';
        toggle.type = 'button';
        toggle.style.backgroundColor = '#f8fafc';
        toggle.textContent = select.options[select.selectedIndex]?.text || 'Select an option';
        
        const menu = document.createElement('div');
        menu.className = 'custom-dropdown-menu dropdown-menu w-100 shadow-sm border border-light-dark position-absolute start-0 mt-1';
        menu.style.maxHeight = '250px';
        menu.style.overflowY = 'auto';
        menu.style.zIndex = '1050';
        
        Array.from(select.options).forEach(option => {
            const item = document.createElement('div');
            item.className = 'custom-dropdown-item dropdown-item px-3 py-2 cursor-pointer';
            item.textContent = option.text;
            item.dataset.value = option.value;
            
            if (option.value === select.value) item.classList.add('active');

            item.addEventListener('click', function() {
                select.value = option.value;
                toggle.textContent = option.text;
                menu.classList.remove('show');
                menu.querySelectorAll('.custom-dropdown-item').forEach(i => i.classList.remove('active'));
                item.classList.add('active');
                select.dispatchEvent(new Event('change'));
            });
            menu.appendChild(item);
        });
        
        toggle.addEventListener('click', function(e) {
            e.preventDefault(); e.stopPropagation();
            const isOpen = menu.classList.contains('show');
            document.querySelectorAll('.custom-dropdown-menu').forEach(m => m.classList.remove('show'));
            if (!isOpen) menu.classList.add('show');
        });
        
        document.addEventListener('click', function(e) {
            if (!wrapper.contains(e.target)) menu.classList.remove('show');
        });
        
        wrapper.appendChild(toggle);
        wrapper.appendChild(menu);
        
        select.style.display = 'none';
        select.dataset.converted = 'true';
        select.parentNode.insertBefore(wrapper, select);
    }
    
    function initCustomDropdowns() {
        setTimeout(function() {
            document.querySelectorAll('select[data-custom-dropdown]').forEach(convertSelectToCustom);
        }, 100);
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initCustomDropdowns);
    } else {
        initCustomDropdowns();
    }
})();
</script>

<?= $this->endSection()?>