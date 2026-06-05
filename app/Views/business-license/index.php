<?= $this->extend('templates/layout.php')?>

<?= $this->section('content')?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<section class="bg-whitish-blue-canvas ">
    <div class="container py-5">
         <h1 class="text-center section-title-dark mb-0">Business Licence Application</h1>
    </div>
</section>

<section class="w-100 py-3" style="background-color: #f0f4f8;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">

                <div id="businessWizardProgress" class="d-flex justify-content-between align-items-center mb-5 position-relative wizard-progress-bar" style="max-width: 600px; mx: auto; margin: 0 auto 3rem auto;">
                    <div class="form-wizard-step text-center position-relative flex-grow-1 active" data-step="1">
                        <div class="step-icon mx-auto rounded-circle d-flex align-items-center justify-content-center fw-bold border mb-2" style="width: 40px; height: 40px; transition: all 0.3s ease;">1</div>
                        <div class="small fw-semibold text-dark text-uppercase tracking-wider fs-7">Personal Info</div>
                    </div>
                    <div class="form-wizard-step text-center position-relative flex-grow-1" data-step="2">
                        <div class="step-icon mx-auto rounded-circle d-flex align-items-center justify-content-center fw-bold border mb-2" style="width: 40px; height: 40px; transition: all 0.3s ease;">2</div>
                        <div class="small fw-semibold text-muted text-uppercase tracking-wider fs-7">Business Details</div>
                    </div>
                    <div class="form-wizard-step text-center position-relative flex-grow-1" data-step="3">
                        <div class="step-icon mx-auto rounded-circle d-flex align-items-center justify-content-center fw-bold border mb-2" style="width: 40px; height: 40px; transition: all 0.3s ease;">3</div>
                        <div class="small fw-semibold text-muted text-uppercase tracking-wider fs-7">Documents</div>
                    </div>
                </div>

                <div class="card bg-white text-dark border-0 shadow-sm p-4 p-md-5 rounded-3">
                    <form id="businessLicenseApplicationForm" enctype="multipart/form-data" novalidate>

                        <div class="wizard-step" data-step="1">
                            <div class="border-bottom pb-2 mb-4">
                                <h3 class="h4 text-dark fw-bold m-0">Applicant Information</h3>
                            </div>

                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label text-dark fw-semibold small text-uppercase mb-2">First Name <span class="text-danger">*</span></label>
                                        <input type="text" name="firstname" class="form-control border-light-dark p-3 bg-light" placeholder="Enter your first name" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label text-dark fw-semibold small text-uppercase mb-2">Last Name <span class="text-danger">*</span></label>
                                        <input type="text" name="lastname" class="form-control border-light-dark p-3 bg-light" placeholder="Enter your last name" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label text-dark fw-semibold small text-uppercase mb-2">ID Type <span class="text-danger">*</span></label>
                                        <select name="id_type" class="form-select border-light-dark p-3 bg-light" required>
                                            <option value="">Select ID type</option>
                                            <option value="National ID">National ID</option>
                                            <option value="Passport">Passport</option>
                                            <option value="Driving License">Driving License</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label text-dark fw-semibold small text-uppercase mb-2">ID Number <span class="text-danger">*</span></label>
                                        <input type="text" name="id_number" class="form-control border-light-dark p-3 bg-light" placeholder="Enter your ID number" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label text-dark fw-semibold small text-uppercase mb-2">Phone Number <span class="text-danger">*</span></label>
                                        <input type="tel" name="contact" class="form-control border-light-dark p-3 bg-light" placeholder="+265 XXX XXX XXX" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label text-dark fw-semibold small text-uppercase mb-2">Email Address <span class="text-danger">*</span></label>
                                        <input type="email" name="email" class="form-control border-light-dark p-3 bg-light" placeholder="your.email@example.com" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label text-dark fw-semibold small text-uppercase mb-2">Date of Birth <span class="text-danger">*</span></label>
                                        <input type="date" name="dob" class="form-control border-light-dark p-3 bg-light" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label text-dark fw-semibold small text-uppercase mb-2">Gender <span class="text-danger">*</span></label>
                                        <select name="gender" class="form-select border-light-dark p-3 bg-light" required>
                                            <option value="">Select gender</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="wizard-step" data-step="2" style="display:none;">
                            <div class="border-bottom pb-2 mb-4">
                                <h3 class="h4 text-dark fw-bold m-0">Business Details</h3>
                            </div>

                            <div class="form-group mb-4">
                                <label class="form-label text-dark fw-semibold small text-uppercase mb-2">Business Name <span class="text-danger">*</span></label>
                                <input type="text" name="business_name" class="form-control border-light-dark p-3 bg-light" placeholder="Enter registered business name" required>
                            </div>

                            <div class="form-group mb-4">
                                <label class="form-label text-dark fw-semibold small text-uppercase mb-2">Business Type <span class="text-danger">*</span></label>
                                <select name="business_type" class="form-select border-light-dark p-3 bg-light select-scollable" required>
                                    <option value="">Select business type</option>
                                    <?php if (!empty($businessTypes)): ?>
                                        <?php foreach ($businessTypes as $type): ?>
                                            <option value="<?= esc($type['name']) ?>"><?= esc($type['name']) ?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                    <optgroup label="Agriculture & Food Services">
                                        <option>Butcher Licence (Cattle) (Rural)</option>
                                        <option>Butcher Licence (Cattle) (Peri-Urban)</option>
                                        <option>Butcher Licence (Goat, Pig) (Rural)</option>
                                        <option>Butcher Licence (Goat, Pig) (Peri-Urban)</option>
                                        <option>Fish Den Licence (Rural)</option>
                                        <option>Fish Den Licence (Peri-Urban)</option>
                                        <option>Groceries Licence (Rural)</option>
                                        <option>Groceries Licence (Peri-Urban)</option>
                                        <option>Restaurant Licence (Rural)</option>
                                        <option>Restaurant Licence (Peri-Urban)</option>
                                        <option>Tea Room Licence (Rural)</option>
                                        <option>Tea Room Licence (Peri-Urban)</option>
                                    </optgroup>
                                    <optgroup label="Education & Health Development">
                                        <option>Private Primary School Licence (Rural)</option>
                                        <option>Private Primary School Licence (Peri-Urban)</option>
                                        <option>Private Secondary School Licence (Rural)</option>
                                        <option>Private Secondary School Licence (Peri-Urban)</option>
                                        <option>Private Hospital Licence (Rural)</option>
                                        <option>Private Hospital Licence (Peri-Urban)</option>
                                        <option>Pharmacy Licence (Rural)</option>
                                        <option>Pharmacy Licence (Peri-Urban)</option>
                                        <option>Drug Shop Licence (Rural)</option>
                                        <option>Drug Shop Licence (Peri-Urban)</option>
                                    </optgroup>
                                    <optgroup label="Manufacturing & Industry">
                                        <option>Cement Blocks Manufacturing Licence (Rural)</option>
                                        <option>Cement Blocks Manufacturing Licence (Peri-Urban)</option>
                                        <option>Coffin Workshop Licence (Rural)</option>
                                        <option>Coffin Workshop Licence (Peri-Urban)</option>
                                        <option>Clothing Factory Licence (Rural)</option>
                                        <option>Clothing Factory Licence (Peri-Urban)</option>
                                        <option>Welding Shop Licence (Rural)</option>
                                        <option>Welding Shop Licence (Peri-Urban)</option>
                                        <option>Carpentry Licence (Rural)</option>
                                        <option>Carpentry Licence (Peri-Urban)</option>
                                        <option>Tin Smith Licence (Rural)</option>
                                        <option>Tin Smith Licence (Peri-Urban)</option>
                                    </optgroup>
                                    <optgroup label="Retail & Domestic Commerce">
                                        <option>Retail Licence (Local) (Rural)</option>
                                        <option>Retail Licence (Local) (Peri-Urban)</option>
                                        <option>Retail Licence (Foreign Owned) (Rural)</option>
                                        <option>Retail Licence (Foreign Owned) (Peri-Urban)</option>
                                        <option>Wholesaler Licence (Rural)</option>
                                        <option>Wholesaler Licence (Peri-Urban)</option>
                                        <option>Supermarket / Superette Licence (Rural)</option>
                                        <option>Supermarket / Superette Licence (Peri-Urban)</option>
                                        <option>Boutique Licence (Rural)</option>
                                        <option>Boutique Licence (Peri-Urban)</option>
                                        <option>Stationery Shop Licence (Rural)</option>
                                        <option>Stationery Shop Licence (Peri-Urban)</option>
                                        <option>Hardware Licence (Small) (Rural)</option>
                                        <option>Hardware Licence (Small) (Peri-Urban)</option>
                                        <option>Hardware Licence (Big) (Rural)</option>
                                        <option>Hardware Licence (Big) (Peri-Urban)</option>
                                        <option>Shop @ Filling Station Licence (Rural)</option>
                                        <option>Shop @ Filling Station Licence (Peri-Urban)</option>
                                    </optgroup>
                                    <optgroup label="Logistics & Mobility Systems">
                                        <option>Kabaza Motorcycle Licence (Rural)</option>
                                        <option>Kabaza Motorcycle Licence (Peri-Urban)</option>
                                        <option>Kabaza Bicycle Licence (Rural)</option>
                                        <option>Kabaza Bicycle Licence (Peri-Urban)</option>
                                        <option>Mobile Retailing Licence / Van (Rural)</option>
                                        <option>Mobile Retailing Licence / Van (Peri-Urban)</option>
                                        <option>Transport & Logistics Company Licence (Rural)</option>
                                        <option>Transport & Logistics Company Licence (Peri-Urban)</option>
                                    </optgroup>
                                    <optgroup label="Financial Systems & Digital Technology">
                                        <option>Mobile Money Licence (Rural)</option>
                                        <option>Mobile Money Licence (Peri-Urban)</option>
                                        <option>Local Mobile Money Transfer Licence (Rural)</option>
                                        <option>Local Mobile Money Transfer Licence (Peri-Urban)</option>
                                        <option>International Mobile Money Transfer Licence (Rural)</option>
                                        <option>International Mobile Money Transfer Licence (Peri-Urban)</option>
                                        <option>Computer Cafe Licence (Rural)</option>
                                        <option>Computer Cafe Licence (Peri-Urban)</option>
                                        <option>Phone Repair Licence (Rural)</option>
                                        <option>Phone Repair Licence (Peri-Urban)</option>
                                        <option>Telephone Bureau Licence (Rural)</option>
                                        <option>Telephone Bureau Licence (Peri-Urban)</option>
                                    </optgroup>
                                    <optgroup label="Utilities & Local Clean Energy">
                                        <option>LPG Exchange Point Licence (Rural)</option>
                                        <option>LPG Exchange Point Licence (Peri-Urban)</option>
                                        <option>LPG Refilling Point Licence (Rural)</option>
                                        <option>LPG Refilling Point Licence (Peri-Urban)</option>
                                        <option>Battery Charging Licence (Rural)</option>
                                        <option>Battery Charging Licence (Peri-Urban)</option>
                                    </optgroup>
                                    <optgroup label="Recreational & Hospitality Infrastructure">
                                        <option>Lodge Licence (Rural)</option>
                                        <option>Lodge Licence (Peri-Urban)</option>
                                        <option>Rest House Licence (Rural)</option>
                                        <option>Rest House Licence (Peri-Urban)</option>
                                        <option>Liquor Licence (Rural)</option>
                                        <option>Liquor Licence (Peri-Urban)</option>
                                        <option>Liquor Licence (Lodge) (Rural)</option>
                                        <option>Liquor Licence (Lodge) (Peri-Urban)</option>
                                        <option>Gaming Licence (Rural)</option>
                                        <option>Gaming Licence (Peri-Urban)</option>
                                        <option>Pool Table Licence (Rural)</option>
                                        <option>Pool Table Licence (Peri-Urban)</option>
                                        <option>Recreational Services Licence (Rural)</option>
                                        <option>Recreational Services Licence (Peri-Urban)</option>
                                    </optgroup>
                                    <optgroup label="Civic Services & Domestic Infrastructure">
                                        <option>Maize Mill (Per Mortar) Licence (Rural)</option>
                                        <option>Maize Mill (Per Mortar) Licence (Peri-Urban)</option>
                                        <option>Burning Centre Licence (Rural)</option>
                                        <option>Burning Centre Licence (Peri-Urban)</option>
                                        <option>Tyre Fitter Licence (Rural)</option>
                                        <option>Tyre Fitter Licence (Peri-Urban)</option>
                                        <option>Watch Repair Licence (Rural)</option>
                                        <option>Watch Repair Licence (Peri-Urban)</option>
                                        <option>Bicycle Repair Licence (Rural)</option>
                                        <option>Bicycle Repair Licence (Peri-Urban)</option>
                                        <option>Tailoring Shop Licence (Rural)</option>
                                        <option>Tailoring Shop Licence (Peri-Urban)</option>
                                        <option>Barbershop Licence (Rural)</option>
                                        <option>Barbershop Licence (Peri-Urban)</option>
                                    </optgroup>
                                    <optgroup label="Natural Resources & Extraction">
                                        <option>Mining Licence (Minor) (Rural)</option>
                                        <option>Mining Licence (Minor) (Peri-Urban)</option>
                                        <option>Mining Licence (Major) (Rural)</option>
                                        <option>Mining Licence (Major) (Peri-Urban)</option>
                                    </optgroup>
                                    <optgroup label="General Classifications">
                                        <option>Herbalist Licence (Rural)</option>
                                        <option>Herbalist Licence (Peri-Urban)</option>
                                        <option>Cooperatives / VSL Licence (Rural)</option>
                                        <option>Cooperatives / VSL Licence (Peri-Urban)</option>
                                        <option>Studio Licence (Rural)</option>
                                        <option>Studio Licence (Peri-Urban)</option>
                                        <option>Seasonal Trading Licence (Rural)</option>
                                        <option>Seasonal Trading Licence (Peri-Urban)</option>
                                        <option>Banks Licence (Rural)</option>
                                        <option>Banks Licence (Peri-Urban)</option>
                                        <option>Warehousing Licence (Rural)</option>
                                        <option>Warehousing Licence (Peri-Urban)</option>
                                        <option>Local Cold Storage Licence (Rural)</option>
                                        <option>Local Cold Storage Licence (Peri-Urban)</option>
                                        <option>Cobra Licence (Rural)</option>
                                        <option>Cobra Licence (Peri-Urban)</option>
                                        <option>Other</option>
                                    </optgroup>
                                </select>
                            </div>

                            <div class="form-group mb-4">
                                <label class="form-label text-dark fw-semibold small text-uppercase mb-2">Operational Market Zone <span class="text-danger">*</span></label>
                                <select name="market" class="form-select border-light-dark p-3 bg-light" required>
                                    <option value="">Select market zone location</option>
                                    <option value="Lunzu">Lunzu</option>
                                    <option value="Machinjiri">Machinjiri</option>
                                    <option value="Chadzunda">Chadzunda</option>
                                    <option value="Chikuli">Chikuli</option>
                                    <option value="Mdeka">Mdeka</option>
                                    <option value="Chilobwe">Chilobwe</option>
                                </select>
                            </div>

                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label text-dark fw-semibold small text-uppercase mb-2">Tracking File Code</label>
                                        <input type="text" id="codeField" name="code" class="form-control border-light-dark p-3 bg-light fw-bold text-muted" readonly style="letter-spacing: 0.5px;">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label text-dark fw-semibold small text-uppercase mb-2">Registering Date <span class="text-danger">*</span></label>
                                        <input type="date" name="registering_date" class="form-control border-light-dark p-3 bg-light" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="wizard-step" data-step="3" style="display:none;">
                            <div class="border-bottom pb-2 mb-4">
                                <h3 class="h4 text-dark fw-bold m-0">Required Documents</h3>
                            </div>

                            <div class="form-group mb-4">
                                <label class="form-label text-dark fw-semibold small text-uppercase mb-2">Applicant Valid Identification <span class="text-danger">*</span></label>
                                <div class="file-upload-zone p-4 rounded-3 text-center border border-2 border-dashed bg-light cursor-pointer" data-file-zone="owner_id" style="border-color: #cbd5e1 !important; transition: all 0.2s ease;">
                                    <i class="fas fa-cloud-upload-alt text-muted mb-2 fs-3"></i>
                                    <div class="fw-bold text-dark mb-1">Click to upload or drag and drop file</div>
                                    <div class="text-muted small">PDF, JPG or PNG (Max 5MB)</div>
                                </div>
                                <input type="file" id="ownerIdInput" name="owner_id" accept=".pdf,.jpg,.jpeg,.png" required style="display:none;">
                                <div class="uploaded-files-list mt-2" id="ownerIdList"></div>
                            </div>

                            <div class="form-group mb-4">
                                <label class="form-label text-dark fw-semibold small text-uppercase mb-2">Official Business Registration Certificate <span class="text-danger">*</span></label>
                                <div class="file-upload-zone p-4 rounded-3 text-center border border-2 border-dashed bg-light cursor-pointer" data-file-zone="registration_cert" style="border-color: #cbd5e1 !important; transition: all 0.2s ease;">
                                    <i class="fas fa-cloud-upload-alt text-muted mb-2 fs-3"></i>
                                    <div class="fw-bold text-dark mb-1">Click to upload or drag and drop file</div>
                                    <div class="text-muted small">PDF, JPG or PNG (Max 5MB)</div>
                                </div>
                                <input type="file" id="registrationCertInput" name="registration_cert" accept=".pdf,.jpg,.jpeg,.png" required style="display:none;">
                                <div class="uploaded-files-list mt-2" id="registrationCertList"></div>
                            </div>

                            <div class="form-check p-0 mt-4 d-flex align-items-start gap-2">
                                <input type="checkbox" class="form-check-input ms-0 mt-1" name="confirm_details" value="1" id="confirmCheck" required>
                                <label class="form-check-label text-muted small" for="confirmCheck" style="line-height: 1.4;">
                                    I hereby confirm that all information provided throughout this multiphase submission layout is completely accurate and legally consistent with municipal business standards.
                                </label>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-5 pt-3 border-top" id="formActions">
                            <div>
                                <button type="button" class="btn btn-outline-dark px-4 py-2-5 fw-bold rounded-3" id="prevBtn" style="display:none;">
                                    <i class="fas fa-arrow-left me-2"></i> Previous
                                </button>
                            </div>
                            <div>
                                <button type="button" class="btn text-white px-5 py-2-5 fw-bold rounded-3 shadow-sm" id="nextBtn" style="background-color: #0a2540; border: none;">
                                    Next Step <i class="fas fa-arrow-right ms-2"></i>
                                </button>
                                <button type="submit" class="btn text-white px-5 py-2-5 fw-bold rounded-3 shadow-sm" id="submitBtn" style="background-color: #0a2540; border: none; display:none;">
                                    <i class="fas fa-paper-plane me-2"></i> Submit Application
                                </button>
                            </div>
                        </div>

                    </form>

                    <div id="businessApplicationSuccessCard" class="d-none text-center py-4">
                        <div class="mx-auto rounded-circle d-flex align-items-center justify-content-center mb-4" style="width: 72px; height: 72px; background-color: #0a2540; color: #ffffff;">
                            <i class="fas fa-check fs-2"></i>
                        </div>
                        <div class="border-bottom pb-3 mb-4">
                            <h3 class="h4 text-dark fw-bold mb-2">Application Submitted Successfully</h3>
                            <p class="text-muted mb-0">
                                Thank you for submitting your business licence application. Blantyre District Council will contact you with guidance on the next steps.
                            </p>
                        </div>
                        <a href="<?= base_url('/') ?>" class="btn text-white px-5 py-2-5 fw-bold rounded-3 shadow-sm" style="background-color: #0a2540; border: none;">
                            <i class="fas fa-sign-out-alt me-2"></i>Exit
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // ===== AUTO CODE =====
    function generateCode(){
        const field = document.getElementById("codeField");
        if(field) field.value = "BL-" + Math.floor(100000 + Math.random()*900000);
    }
    generateCode();

    // ===== MULTI-STEP WIZARD ENGINE =====
    let currentStepIndex = 0;
    const steps = document.querySelectorAll(".wizard-step");
    const stepIndicators = document.querySelectorAll(".form-wizard-step");
    const prevBtn = document.getElementById("prevBtn");
    const nextBtn = document.getElementById("nextBtn");
    const submitBtn = document.getElementById("submitBtn");

    function renderActiveStep(targetIndex){
        steps.forEach((el, idx) => el.style.display = idx === targetIndex ? "block" : "none");
        
        stepIndicators.forEach((el, idx) => {
            if(idx === targetIndex) {
                el.classList.add("active");
                el.classList.remove("completed");
                el.querySelector('.step-icon').style.backgroundColor = '#0a2540';
                el.querySelector('.step-icon').style.color = '#ffffff';
                el.querySelector('.step-icon').style.borderColor = '#0a2540';
            } else if(idx < targetIndex) {
                el.classList.add("completed");
                el.classList.remove("active");
                el.querySelector('.step-icon').style.backgroundColor = '#198754';
                el.querySelector('.step-icon').style.color = '#ffffff';
                el.querySelector('.step-icon').style.borderColor = '#198754';
            } else {
                el.classList.remove("active", "completed");
                el.querySelector('.step-icon').style.backgroundColor = '#f8fafc';
                el.querySelector('.step-icon').style.color = '#64748b';
                el.querySelector('.step-icon').style.borderColor = '#cbd5e1';
            }
        });

        prevBtn.style.display = targetIndex === 0 ? "none" : "block";
        nextBtn.style.display = targetIndex === (steps.length - 1) ? "none" : "block";
        submitBtn.style.display = targetIndex === (steps.length - 1) ? "block" : "none";
    }
    
    renderActiveStep(currentStepIndex);

    nextBtn.onclick = () => {
        const requiredFields = steps[currentStepIndex].querySelectorAll("input[required], select[required]");
        let isStepValid = true;
        
        requiredFields.forEach(field => {
            if (!field.value.trim() || (field.type === 'checkbox' && !field.checked)) {
                field.classList.add("is-invalid");
                isStepValid = false;
            } else {
                field.classList.remove("is-invalid");
            }
        });

        if (isStepValid) {
            currentStepIndex++;
            renderActiveStep(currentStepIndex);
            window.scrollTo({ top: 150, behavior: 'smooth' });
        } else {
            alert("Please fill out all mandatory operational inputs inside this section phase.");
        }
    }

    prevBtn.onclick = () => { 
        currentStepIndex--; 
        renderActiveStep(currentStepIndex); 
        window.scrollTo({ top: 150, behavior: 'smooth' });
    }

    // ===== SERVER DATA SUBMISSION HANDLING =====
    document.getElementById("businessLicenseApplicationForm").addEventListener("submit", async function(e){
        e.preventDefault();

        const formElement = this;
        const confirmBox = document.getElementById("confirmCheck");
        if(confirmBox && !confirmBox.checked) {
            confirmBox.classList.add("is-invalid");
            alert("Verification authorization agreement checkbox must be certified checked.");
            return;
        }

        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status"></span> Processing Payload...';

        const dataPayload = new FormData(formElement);
        dataPayload.append('service_type', 'business_license');
        dataPayload.append('applicant_name', dataPayload.get('firstname') + ' ' + dataPayload.get('lastname'));
        dataPayload.append('applicant_email', dataPayload.get('email'));
        dataPayload.append('applicant_phone', dataPayload.get('contact'));

        try {
            const res = await fetch("<?= base_url('api/applications/submit')?>", {
                method: "POST",
                body: dataPayload
            });

            const textResponse = await res.text();
            let structuredJson;
            try {
                structuredJson = JSON.parse(textResponse);
            } catch (err) {
                console.error("Server API returned broken non-JSON formatting string response lines:", textResponse);
                alert("Interface Communications Fault: Internal endpoint systems responded abnormally.");
                resetSubmitState();
                return;
            }

            if (structuredJson.status === 'success' || structuredJson.success === true) {
                // Hide the form and show the success card
                document.getElementById("businessLicenseApplicationForm").classList.add("d-none");
                const successCard = document.getElementById("businessApplicationSuccessCard");
                successCard.classList.remove("d-none");
                
                window.scrollTo({ top: 0, behavior: 'smooth' });
            } else {
                let diagnosticMessage = 'Submission verification checks dropped.';
                if(structuredJson.messages) diagnosticMessage = Object.values(structuredJson.messages).join("\n");
                else if(structuredJson.message) diagnosticMessage = structuredJson.message;
                
                alert("Validation System Error: \n" + diagnosticMessage);
                resetSubmitState();
            }
        } catch (error) {
            console.error("Critical communications transport pipeline breakdown error:", error);
            alert("Communications Protocol Failure: Could not finalize endpoint handshake data transfers.");
            resetSubmitState();
        }
    });

    function resetSubmitState() {
        submitBtn.disabled = false;
        submitBtn.innerHTML = '<i class="fas fa-paper-plane me-2"></i> Submit Application';
    }

    // ===== FILE ATTACHMENT ZONE BOUND DRIVER LOGIC =====
    function bindFileZone(zoneSelector, inputSelector, listSelector) {
        const targetZone = document.querySelector(zoneSelector);
        const nestedInput = document.querySelector(inputSelector);
        const dataListContainer = document.querySelector(listSelector);

        if (!targetZone || !nestedInput || !dataListContainer) return;

        targetZone.addEventListener('click', () => nestedInput.click());
        
        targetZone.addEventListener('dragover', (e) => {
            e.preventDefault();
            targetZone.style.backgroundColor = '#e2e8f0';
        });
        
        targetZone.addEventListener('dragleave', () => {
            targetZone.style.backgroundColor = '#f8fafc';
        });
        
        targetZone.addEventListener('drop', (e) => {
            e.preventDefault();
            targetZone.style.backgroundColor = '#f8fafc';
            if (e.dataTransfer.files.length) {
                nestedInput.files = e.dataTransfer.files;
                renderFileNameOutput(nestedInput, dataListContainer);
            }
        });
        
        nestedInput.addEventListener('change', () => renderFileNameOutput(nestedInput, dataListContainer));
    }

    function renderFileNameOutput(input, outputListElement) {
        const binaryFile = input.files[0];
        outputListElement.innerHTML = binaryFile ? 
            `<div class="d-flex align-items-center gap-2 mt-2 p-2 rounded-2 bg-light text-dark small border border-light-dark">
                <i class="fas fa-file-alt text-primary"></i>
                <span class="fw-medium">${binaryFile.name}</span> 
                <span class="text-muted text-uppercase ms-auto fs-8">(${Math.round(binaryFile.size/1024)} KB)</span>
             </div>` : '';
    }

    bindFileZone('[data-file-zone="owner_id"]', '#ownerIdInput', '#ownerIdList');
    bindFileZone('[data-file-zone="registration_cert"]', '#registrationCertInput', '#registrationCertList');
});
</script>

<style>
/* Clean form overrides keeping external logic clean */
.border-light-dark { border-color: #cbd5e1 !important; }
.cursor-pointer { cursor: pointer; }
.fs-7 { font-size: 0.85rem !important; }
.fs-8 { font-size: 0.72rem !important; }
.py-2-5 { padding-top: 0.65rem !important; padding-bottom: 0.65rem !important; }
.form-wizard-step .step-icon { border-color: #cbd5e1; background-color: #f8fafc; color: #64748b; }
.is-invalid { border-color: #dc3545 !important; background-image: none !important; }
.select-scollable { max-height: 200px; }

/* Interactive wizard connectors layout lines */
.wizard-progress-bar::after {
    content: "";
    position: absolute;
    top: 20px;
    left: 10%;
    width: 80%;
    height: 2px;
    background-color: #cbd5e1;
    z-index: 1;
}
.form-wizard-step { z-index: 2; }
</style>
<?= $this->endSection()?>
