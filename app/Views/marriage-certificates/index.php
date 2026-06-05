<?= $this->extend('templates/layout.php')?>

<?= $this->section('content')?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<!-- Add clean inline theme updates directly to keep styles uniform -->
<style>
    /* Global Base Page/Container Overrides */
    .bg-whitish-blue-canvas {
        background-color: #f3f8fc !important;
        padding-top: 5rem;
        padding-bottom: 5rem;
        position: relative;
    }
    .overlap-container {
        margin-top: -50px;
        position: relative;
        z-index: 10;
    }
    
    /* Professional Card Framework */
    .form-wizard {
        background: #ffffff !important;
        border: 1px solid #e2e8f0 !important;
        border-radius: 16px !important;
        padding: 2.5rem !important;
        box-shadow: 0 10px 25px -5px rgba(10, 37, 64, 0.05), 0 8px 10px -6px rgba(10, 37, 64, 0.05) !important;
    }

    /* Elegant Wizard Progress Stepper */
    .form-wizard-steps {
        display: flex;
        justify-content: space-between;
        margin-bottom: 3rem;
        border-bottom: 2px solid #e2e8f0;
        padding-bottom: 1.5rem;
    }
    .form-wizard-step {
        text-align: center;
        flex: 1;
        position: relative;
        opacity: 0.5;
        transition: all 0.3s ease;
    }
    .form-wizard-step.active {
        opacity: 1;
    }
    .form-wizard-step-number {
        width: 36px;
        height: 36px;
        line-height: 34px;
        border-radius: 50%;
        background: #e2e8f0;
        color: #475569;
        font-weight: 600;
        margin: 0 auto 0.5rem auto;
        border: 2px solid transparent;
        transition: all 0.3s ease;
    }
    .form-wizard-step.active .form-wizard-step-number {
        background: #0a2540;
        color: #ffffff;
        border-color: #0a2540;
    }
    .form-wizard-step-label {
        font-size: 0.875rem;
        font-weight: 500;
        color: #475569;
    }
    .form-wizard-step.active .form-wizard-step-label {
        color: #0a2540;
        font-weight: 600;
    }

    /* Premium Typography & Form Groupings */
    .section-title-dark {
        color: #0a2540 !important;
        font-weight: 700;
        letter-spacing: -0.02em;
    }
    .form-group-modern {
        margin-bottom: 1.5rem;
    }
    .form-group-modern label {
        display: block;
        color: #475569;
        font-weight: 500;
        font-size: 0.875rem;
        margin-bottom: 0.5rem;
    }
    .form-group-modern label .required {
        color: #ef4444;
    }
    
    /* Input Elements */
    .form-input-modern {
        width: 100%;
        padding: 0.75rem 1rem;
        background-color: #f8fafc !important;
        border: 1px solid #cbd5e1 !important;
        color: #1e293b !important;
        border-radius: 8px !important;
        font-size: 0.95rem;
        transition: all 0.2s ease-in-out;
    }
    .form-input-modern:focus {
        background-color: #ffffff !important;
        border-color: #0a2540 !important;
        box-shadow: 0 0 0 3px rgba(10, 37, 64, 0.1) !important;
        outline: none;
    }
    .form-input-modern::placeholder {
        color: #94a3b8 !important;
    }

    /* Enterprise File Drop Zones */
    .file-upload-zone {
        border: 2px dashed #cbd5e1;
        background: #f8fafc;
        border-radius: 10px;
        padding: 2rem;
        text-align: center;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    .file-upload-zone:hover {
        border-color: #0a2540;
        background: #f1f5f9;
    }
    .file-upload-icon {
        font-size: 2rem;
        color: #64748b;
        margin-bottom: 0.5rem;
    }
    .file-upload-text {
        color: #334155;
        font-weight: 500;
    }
    .file-upload-hint {
        color: #64748b;
        font-size: 0.8rem;
        margin-top: 0.25rem;
    }

    /* Elegant Corporate Summary/Payment Details Box */
    .glass-card-modern {
        background: #f0f7ff !important;
        border: 1px solid #bae6fd !important;
        border-radius: 12px;
        padding: 1.5rem;
    }
    .glass-card-modern h5 {
        color: #0369a1 !important;
        font-weight: 600;
    }
    .glass-card-modern p {
        color: #0284c7 !important;
    }
    .glass-card-modern h2 {
        color: #0c4a6e !important;
        font-weight: 700;
    }

    /* Button Kits */
    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 1rem;
        margin-top: 2.5rem;
        border-top: 1px solid #e2e8f0;
        padding-top: 1.5rem;
    }
    .btn-form-primary {
        background: #0a2540 !important;
        color: #ffffff !important;
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.2s ease;
    }
    .btn-form-primary:hover {
        background: #0f355c !important;
        transform: translateY(-1px);
    }
    .btn-form-secondary {
        background: #ffffff !important;
        color: #475569 !important;
        border: 1px solid #cbd5e1 !important;
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.2s ease;
    }
    .btn-form-secondary:hover {
        background: #f8fafc !important;
        color: #1e293b !important;
    }

    /* Success Card Structure */
    .form-success-card {
        text-align: center;
        padding: 2rem 1rem;
    }
    .form-success-icon {
        font-size: 2rem;
        color: #ffffff;
        margin-bottom: 1.5rem;
    }
    .form-success-title {
        color: #0a2540 !important;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }
    .form-success-message {
        color: #475569;
        margin-bottom: 1.5rem;
    }
    .form-success-reference {
        background: #f1f5f9;
        color: #0a2540;
        font-weight: 700;
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        display: inline-block;
        letter-spacing: 0.05em;
        margin-bottom: 1.5rem;
        border: 1px solid #e2e8f0;
    }

    /* Tailored Component Dropdowns */
    .custom-dropdown-toggle {
        width: 100%;
        padding: 0.75rem 1rem;
        background: #f8fafc;
        border: 1px solid #cbd5e1;
        color: #1e293b;
        text-align: left;
        border-radius: 8px;
        position: relative;
    }
    .custom-dropdown-toggle::after {
        content: '\f107';
        font-family: 'Font Awesome 5 Free';
        font-weight: 900;
        position: absolute;
        right: 15px;
    }
    .custom-dropdown-menu {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        box-shadow: 0 10px 15px -3px rgba(0,0,0,0.05);
        border-radius: 8px;
    }
    .custom-dropdown-item {
        color: #334155;
        padding: 10px 15px;
    }
    .custom-dropdown-item:hover {
        background: #f0f7ff;
        color: #0a2540;
    }
</style>

<!-- Main Content Section: Changed to Whitish Blue Canvas with refined overlapping container -->
<section class="bg-whitish-blue-canvas ">
    <div class="container py-3">
         <h1 class="text-center section-title-dark mb-0">Marriage Certificate Application</h1>
    </div>
</section>
<section class="bg-whitish-blue-canvas overlap-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                
                <!-- Form Wizard -->
                <div class="form-wizard" id="marriageForm">
                    
                    <!-- Progress Steps -->
                    <div class="form-wizard-steps">
                        <div class="form-wizard-step active" data-step="1">
                            <div class="form-wizard-step-number">1</div>
                            <div class="form-wizard-step-label">Personal Info</div>
                        </div>
                        <div class="form-wizard-step" data-step="2">
                            <div class="form-wizard-step-number">2</div>
                            <div class="form-wizard-step-label">Marriage Details</div>
                        </div>
                        <div class="form-wizard-step" data-step="3">
                            <div class="form-wizard-step-number">3</div>
                            <div class="form-wizard-step-label">Documents</div>
                        </div>
                        <div class="form-wizard-step" data-step="4">
                            <div class="form-wizard-step-number">4</div>
                            <div class="form-wizard-step-label">Confirm</div>
                        </div>
                    </div>

                    <form id="marriageCertificateForm" method="POST">
                        
                        <!-- Step 1: Personal Information -->
                        <div class="wizard-step" data-step="1">
                            <h3 class="section-title-dark mb-4">Applicant Information</h3>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group-modern">
                                        <label>Full Name <span class="required">*</span></label>
                                        <input type="text" name="applicant_name" class="form-input-modern" placeholder="Enter your full name" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group-modern">
                                        <label>National ID Number <span class="required">*</span></label>
                                        <input type="text" name="applicant_id_number" class="form-input-modern" placeholder="Enter your ID number" required>
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

                            <div class="form-group-modern">
                                <label>Residential Address <span class="required">*</span></label>
                                <textarea name="applicant_address" class="form-input-modern" rows="3" placeholder="Enter your full residential address" required></textarea>
                            </div>
                        </div>

                        <!-- Step 2: Marriage Details -->
                        <div class="wizard-step" data-step="2" style="display: none;">
                            <h3 class="section-title-dark mb-4">Marriage Information</h3>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group-modern">
                                        <label>Spouse Full Name <span class="required">*</span></label>
                                        <input type="text" name="spouse_name" class="form-input-modern" placeholder="Enter spouse's full name" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group-modern">
                                        <label>Marriage Date <span class="required">*</span></label>
                                        <input type="date" name="marriage_date" class="form-input-modern" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group-modern">
                                <label>Marriage Location <span class="required">*</span></label>
                                <input type="text" name="marriage_location" class="form-input-modern" placeholder="Church/Registry/Venue name and location" required>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group-modern">
                                        <label>Witness 1 Name <span class="required">*</span></label>
                                        <input type="text" name="witness1_name" class="form-input-modern" placeholder="First witness full name" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group-modern">
                                        <label>Witness 2 Name <span class="required">*</span></label>
                                        <input type="text" name="witness2_name" class="form-input-modern" placeholder="Second witness full name" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group-modern">
                                <label>Marriage Officer Name</label>
                                <input type="text" name="officer_name" class="form-input-modern" placeholder="Name of person who officiated">
                            </div>
                        </div>

                        <!-- Step 3: Document Upload -->
                        <div class="wizard-step" data-step="3" style="display: none;">
                            <h3 class="section-title-dark mb-4">Required Documents</h3>
                            
                            <div class="form-group-modern">
                                <label>Applicant National ID <span class="required">*</span></label>
                                <div class="file-upload-zone" id="uploadZone1">
                                    <i class="fas fa-cloud-upload-alt file-upload-icon"></i>
                                    <div class="file-upload-text">Click to upload or drag and drop</div>
                                    <div class="file-upload-hint">PDF, JPG or PNG (Max 5MB)</div>
                                </div>
                                <input type="file" id="fileInput1" name="applicant_id_doc" accept=".pdf,.jpg,.jpeg,.png" style="display: none;">
                                <div class="uploaded-files-list" id="fileList1"></div>
                            </div>

                            <div class="form-group-modern">
                                <label>Spouse National ID <span class="required">*</span></label>
                                <div class="file-upload-zone" id="uploadZone2">
                                    <i class="fas fa-cloud-upload-alt file-upload-icon"></i>
                                    <div class="file-upload-text">Click to upload or drag and drop</div>
                                    <div class="file-upload-hint">PDF, JPG or PNG (Max 5MB)</div>
                                </div>
                                <input type="file" id="fileInput2" name="spouse_id_doc" accept=".pdf,.jpg,.jpeg,.png" style="display: none;">
                                <div class="uploaded-files-list" id="fileList2"></div>
                            </div>

                            <div class="form-group-modern">
                                <label>Chief's Letter <span class="required">*</span></label>
                                <div class="file-upload-zone" id="uploadZone3">
                                    <i class="fas fa-cloud-upload-alt file-upload-icon"></i>
                                    <div class="file-upload-text">Click to upload or drag and drop</div>
                                    <div class="file-upload-hint">PDF, JPG or PNG (Max 5MB)</div>
                                </div>
                                <input type="file" id="fileInput3" name="chiefs_letter" accept=".pdf,.jpg,.jpeg,.png" style="display: none;">
                                <div class="uploaded-files-list" id="fileList3"></div>
                            </div>
                        </div>

                        <!-- Step 4: Review & Confirm -->
                        <div class="wizard-step" data-step="4" style="display: none;">
                            <h3 class="section-title-dark mb-4">Review & Confirm Your Details</h3>

                            <div class="data-section mb-4">
                                <h5>Applicant Information</h5>
                                <div class="data-grid">
                                    <div class="data-item">
                                        <div class="data-label">Full Name</div>
                                        <div class="data-value" id="reviewApplicantName"></div>
                                    </div>
                                    <div class="data-item">
                                        <div class="data-label">National ID Number</div>
                                        <div class="data-value" id="reviewApplicantIdNumber"></div>
                                    </div>
                                    <div class="data-item">
                                        <div class="data-label">Email Address</div>
                                        <div class="data-value" id="reviewApplicantEmail"></div>
                                    </div>
                                    <div class="data-item">
                                        <div class="data-label">Phone Number</div>
                                        <div class="data-value" id="reviewApplicantPhone"></div>
                                    </div>
                                    <div class="data-item" style="grid-column: span 2;">
                                        <div class="data-label">Residential Address</div>
                                        <div class="data-value" id="reviewApplicantAddress"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="data-section mb-4">
                                <h5>Marriage Information</h5>
                                <div class="data-grid">
                                    <div class="data-item">
                                        <div class="data-label">Spouse Full Name</div>
                                        <div class="data-value" id="reviewSpouseName"></div>
                                    </div>
                                    <div class="data-item">
                                        <div class="data-label">Marriage Date</div>
                                        <div class="data-value" id="reviewMarriageDate"></div>
                                    </div>
                                    <div class="data-item">
                                        <div class="data-label">Marriage Location</div>
                                        <div class="data-value" id="reviewMarriageLocation"></div>
                                    </div>
                                    <div class="data-item">
                                        <div class="data-label">Witness 1</div>
                                        <div class="data-value" id="reviewWitness1"></div>
                                    </div>
                                    <div class="data-item">
                                        <div class="data-label">Witness 2</div>
                                        <div class="data-value" id="reviewWitness2"></div>
                                    </div>
                                    <div class="data-item" style="grid-column: span 2;">
                                        <div class="data-label">Marriage Officer Name</div>
                                        <div class="data-value" id="reviewOfficerName"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group-modern">
                                <label class="d-flex align-items-center gap-2">
                                    <input type="checkbox" name="confirm_details" style="accent-color: #0a2540;">
                                    <span class="text-secondary small">I confirm that all the details provided are correct and may be submitted to the council for review.</span>
                                </label>
                            </div>
                        </div>


                        <!-- Success Message (Hidden Initially) -->
                        <div id="successStep" style="display: none;">
                            <div class="form-success-card" style="text-align: center;">
                                <div class="mx-auto rounded-circle d-flex align-items-center justify-content-center mb-4" style="width: 72px; height: 72px; background-color: #0a2540; color: #ffffff;">
                                    <i class="fas fa-check fs-2"></i>
                                </div>
                                <h2 class="form-success-title">Application Submitted Successfully</h2>
                                <p class="form-success-message">Thank you for submitting your marriage certificate application. Blantyre District Council will contact you with guidance on the next steps.</p>
                                <a href="<?= base_url('/'); ?>" class="btn-form-primary mt-4 d-inline-block text-decoration-none">
                                    <i class="fas fa-sign-out-alt"></i> Exit
                                </a>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="form-actions" id="formActions">
                            <button type="button" class="btn-form-secondary" id="prevBtn" style="display: none;">
                                <i class="fas fa-arrow-left"></i> Previous
                            </button>
                            <button type="button" class="btn-form-primary" id="nextBtn">
                                Next <i class="fas fa-arrow-right"></i>
                            </button>
                            <button type="submit" class="btn-form-primary" id="submitBtn" style="display: none;">
                                <i class="fas fa-paper-plane"></i> Submit Application
                            </button>
                        </div>

                    </form>

                </div>

            </div>
        </div>
    </div>
</section>

<!-- [The unchanged javascript script segment continues exactly as configured previously below] -->
<script src="<?= base_url('js/form-validator.js'); ?>"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('marriageCertificateForm');
    const wizard = new FormWizard(document.getElementById('marriageForm'));
    const validator = new FormValidator(form);
    
    const fileHandler1 = new FileUploadHandler(
        document.getElementById('uploadZone1'),
        document.getElementById('fileInput1'),
        document.getElementById('fileList1')
    );
    
    const fileHandler2 = new FileUploadHandler(
        document.getElementById('uploadZone2'),
        document.getElementById('fileInput2'),
        document.getElementById('fileList2')
    );
    
    const fileHandler3 = new FileUploadHandler(
        document.getElementById('uploadZone3'),
        document.getElementById('fileInput3'),
        document.getElementById('fileList3')
    );

    const nextBtn = document.getElementById('nextBtn');
    const prevBtn = document.getElementById('prevBtn');
    const submitBtn = document.getElementById('submitBtn');

    nextBtn.addEventListener('click', function() {
        if (validateCurrentStep()) {
            wizard.nextStep();
            populateReviewSummary();
            updateButtons();
        }
    });

    prevBtn.addEventListener('click', function() {
        wizard.previousStep();
        updateButtons();
    });

    form.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        if (!validateCurrentStep()) {
            return;
        }

        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span class="form-loading"></span> Processing...';

        try {
            const formData = new FormData(form);
            formData.append('service_type', 'marriage_certificate');
            
            const jsonData = {};
            formData.forEach((value, key) => {
                jsonData[key] = value;
            });
            
            const payload = {
                service_type: 'marriage_certificate',
                applicant_name: formData.get('applicant_name'),
                applicant_email: formData.get('applicant_email'),
                applicant_phone: formData.get('applicant_phone'),
                applicant_id_number: formData.get('applicant_id_number'),
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
                await uploadDocuments(applicationId);

                document.getElementById('referenceNumber').textContent = result.data.reference_number;
                document.querySelectorAll('.wizard-step').forEach(step => step.style.display = 'none');
                document.getElementById('successStep').style.display = 'block';
                document.getElementById('formActions').style.display = 'none';
            } else {
                alert('Error: ' + result.message);
                submitBtn.disabled = false;
                submitBtn.innerHTML = '<i class="fas fa-paper-plane"></i> Submit Application';
            }
        } catch (error) {
            console.error('Error:', error);
            alert('An error occurred. Please try again.');
            submitBtn.disabled = false;
            submitBtn.innerHTML = '<i class="fas fa-paper-plane"></i> Submit Application';
        }
    });

    async function uploadDocuments(applicationId) {
        const files = [
            { handler: fileHandler1, type: 'applicant_id' },
            { handler: fileHandler2, type: 'spouse_id' },
            { handler: fileHandler3, type: 'chiefs_letter' }
        ];

        for (const fileInfo of files) {
            const fileList = fileInfo.handler.getFiles();
            for (const file of fileList) {
                const formData = new FormData();
                formData.append('document', file);
                formData.append('document_type', fileInfo.type);

                await fetch(`<?= base_url('api/applications/'); ?>${applicationId}/documents`, {
                    method: 'POST',
                    body: formData
                });
            }
        }
    }

    function validateCurrentStep() {
        validator.clearErrors();
        const currentStep = wizard.currentStep + 1;
        let isValid = true;

        if (currentStep === 1) {
            const name = form.querySelector('[name="applicant_name"]').value;
            const email = form.querySelector('[name="applicant_email"]').value;
            const phone = form.querySelector('[name="applicant_phone"]').value;
            const idNumber = form.querySelector('[name="applicant_id_number"]').value;

            isValid = validator.validateRequired('applicant_name', name, 'Full Name') && isValid;
            isValid = validator.validateRequired('applicant_email', email, 'Email') && isValid;
            isValid = validator.validateEmail('applicant_email', email) && isValid;
            isValid = validator.validateRequired('applicant_phone', phone, 'Phone') && isValid;
            isValid = validator.validatePhone('applicant_phone', phone) && isValid;
            isValid = validator.validateRequired('applicant_id_number', idNumber, 'ID Number') && isValid;
        } else if (currentStep === 2) {
            const spouseName = form.querySelector('[name="spouse_name"]').value;
            const marriageDate = form.querySelector('[name="marriage_date"]').value;
            const location = form.querySelector('[name="marriage_location"]').value;

            isValid = validator.validateRequired('spouse_name', spouseName, 'Spouse Name') && isValid;
            isValid = validator.validateRequired('marriage_date', marriageDate, 'Marriage Date') && isValid;
            isValid = validator.validateRequired('marriage_location', location, 'Marriage Location') && isValid;
        } else if (currentStep === 3) {
            const files1 = fileHandler1.getFiles();
            const files2 = fileHandler2.getFiles();
            const files3 = fileHandler3.getFiles();

            if (files1.length === 0) {
                validator.errors['applicant_id_doc'] = 'Please upload your National ID';
                isValid = false;
            }
            if (files2.length === 0) {
                validator.errors['spouse_id_doc'] = 'Please upload spouse National ID';
                isValid = false;
            }
            if (files3.length === 0) {
                validator.errors['chiefs_letter'] = 'Please upload Chief\'s Letter';
                isValid = false;
            }
        } else if (currentStep === 4) {
            const confirmDetails = form.querySelector('[name="confirm_details"]');
            if (!confirmDetails || !confirmDetails.checked) {
                validator.errors['confirm_details'] = 'Please confirm that all details are correct before submitting';
                isValid = false;
            }
        }

        if (!isValid) {
            validator.displayErrors();
        }

        return isValid;
    }

    function updateButtons() {
        const currentStep = wizard.currentStep;
        const lastStepIndex = wizard.steps.length - 1;
        
        prevBtn.style.display = currentStep > 0 ? 'block' : 'none';
        nextBtn.style.display = currentStep < lastStepIndex ? 'block' : 'none';
        submitBtn.style.display = currentStep === lastStepIndex ? 'block' : 'none';
    }

    function populateReviewSummary() {
        const summaryFields = {
            reviewApplicantName: form.querySelector('[name="applicant_name"]').value,
            reviewApplicantIdNumber: form.querySelector('[name="applicant_id_number"]').value,
            reviewApplicantEmail: form.querySelector('[name="applicant_email"]').value,
            reviewApplicantPhone: form.querySelector('[name="applicant_phone"]').value,
            reviewApplicantAddress: form.querySelector('[name="applicant_address"]').value,
            reviewSpouseName: form.querySelector('[name="spouse_name"]').value,
            reviewMarriageDate: form.querySelector('[name="marriage_date"]').value,
            reviewMarriageLocation: form.querySelector('[name="marriage_location"]').value,
            reviewWitness1: form.querySelector('[name="witness1_name"]').value,
            reviewWitness2: form.querySelector('[name="witness2_name"]').value,
            reviewOfficerName: form.querySelector('[name="officer_name"]').value
        };

        Object.keys(summaryFields).forEach(id => {
            const element = document.getElementById(id);
            if (element) {
                element.textContent = summaryFields[id] || 'Not provided';
            }
        });
    }
});

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