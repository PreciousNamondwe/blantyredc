/**
 * Form Validation Library
 * Provides client-side validation for government service forms
 */

class FormValidator {
    constructor(formElement) {
        this.form = formElement;
        this.errors = {};
    }

    /**
     * Validate required fields
     */
    validateRequired(fieldName, value, label) {
        if (!value || value.trim() === '') {
            this.errors[fieldName] = `${label} is required`;
            return false;
        }
        return true;
    }

    /**
     * Validate email format
     */
    validateEmail(fieldName, value) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (value && !emailRegex.test(value)) {
            this.errors[fieldName] = 'Please enter a valid email address';
            return false;
        }
        return true;
    }

    /**
     * Validate phone number (Malawi format)
     */
    validatePhone(fieldName, value) {
        const phoneRegex = /^(0|\+265)[0-9]{9}$/;
        if (value && !phoneRegex.test(value.replace(/\s/g, ''))) {
            this.errors[fieldName] = 'Please enter a valid Malawian phone number';
            return false;
        }
        return true;
    }

    /**
     * Validate ID number
     */
    validateIDNumber(fieldName, value) {
        if (value && value.length < 5) {
            this.errors[fieldName] = 'Please enter a valid ID number';
            return false;
        }
        return true;
    }

    /**
     * Validate file upload
     */
    validateFile(fieldName, file, maxSize = 5242880, allowedTypes = ['application/pdf', 'image/jpeg', 'image/png']) {
        if (!file) {
            this.errors[fieldName] = 'Please upload a file';
            return false;
        }

        if (file.size > maxSize) {
            this.errors[fieldName] = `File size must be less than ${maxSize / 1048576}MB`;
            return false;
        }

        if (!allowedTypes.includes(file.type)) {
            this.errors[fieldName] = 'Invalid file type. Allowed: PDF, JPG, PNG';
            return false;
        }

        return true;
    }

    /**
     * Validate minimum length
     */
    validateMinLength(fieldName, value, minLength, label) {
        if (value && value.length < minLength) {
            this.errors[fieldName] = `${label} must be at least ${minLength} characters`;
            return false;
        }
        return true;
    }

    /**
     * Validate date
     */
    validateDate(fieldName, value, label) {
        const date = new Date(value);
        if (isNaN(date.getTime())) {
            this.errors[fieldName] = `Please enter a valid ${label}`;
            return false;
        }
        return true;
    }

    /**
     * Validate date range
     */
    validateDateRange(fieldName, value, minDate, maxDate, label) {
        const date = new Date(value);
        const min = new Date(minDate);
        const max = new Date(maxDate);

        if (date < min || date > max) {
            this.errors[fieldName] = `${label} must be between ${minDate} and ${maxDate}`;
            return false;
        }
        return true;
    }

    /**
     * Display errors on form
     */
    displayErrors() {
        // Clear previous errors
        this.form.querySelectorAll('.form-error-message').forEach(el => el.remove());
        this.form.querySelectorAll('.error').forEach(el => el.classList.remove('error'));

        // Display new errors
        Object.keys(this.errors).forEach(fieldName => {
            const field = this.form.querySelector(`[name="${fieldName}"]`);
            if (field) {
                field.classList.add('error');

                const errorDiv = document.createElement('div');
                errorDiv.className = 'form-error-message';
                errorDiv.innerHTML = `<i class="fas fa-exclamation-circle"></i> ${this.errors[fieldName]}`;

                field.parentElement.appendChild(errorDiv);
            }
        });

        // Scroll to first error
        const firstError = this.form.querySelector('.error');
        if (firstError) {
            firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
            firstError.focus();
        }
    }

    /**
     * Clear all errors
     */
    clearErrors() {
        this.errors = {};
        this.form.querySelectorAll('.form-error-message').forEach(el => el.remove());
        this.form.querySelectorAll('.error').forEach(el => el.classList.remove('error'));
    }

    /**
     * Check if form is valid
     */
    isValid() {
        return Object.keys(this.errors).length === 0;
    }
}

/**
 * File Upload Handler
 */
class FileUploadHandler {
    constructor(uploadZone, fileInput, fileListContainer) {
        this.uploadZone = uploadZone;
        this.fileInput = fileInput;
        this.fileListContainer = fileListContainer;
        this.files = [];

        this.init();
    }

    init() {
        // Click to upload
        this.uploadZone.addEventListener('click', () => {
            this.fileInput.click();
        });

        // File input change
        this.fileInput.addEventListener('change', (e) => {
            this.handleFiles(e.target.files);
        });

        // Drag and drop
        this.uploadZone.addEventListener('dragover', (e) => {
            e.preventDefault();
            this.uploadZone.classList.add('dragover');
        });

        this.uploadZone.addEventListener('dragleave', () => {
            this.uploadZone.classList.remove('dragover');
        });

        this.uploadZone.addEventListener('drop', (e) => {
            e.preventDefault();
            this.uploadZone.classList.remove('dragover');
            this.handleFiles(e.dataTransfer.files);
        });
    }

    handleFiles(fileList) {
        Array.from(fileList).forEach(file => {
            this.files.push(file);
            this.displayFile(file);
        });
    }

    displayFile(file) {
        const fileItem = document.createElement('div');
        fileItem.className = 'uploaded-file-item';
        fileItem.innerHTML = `
            <div class="uploaded-file-info">
                <i class="fas fa-file-pdf uploaded-file-icon"></i>
                <div>
                    <div class="uploaded-file-name">${file.name}</div>
                    <div class="uploaded-file-size">${this.formatFileSize(file.size)}</div>
                </div>
            </div>
            <button type="button" class="uploaded-file-remove" data-filename="${file.name}">
                <i class="fas fa-times"></i>
            </button>
        `;

        fileItem.querySelector('.uploaded-file-remove').addEventListener('click', () => {
            this.removeFile(file.name);
            fileItem.remove();
        });

        this.fileListContainer.appendChild(fileItem);
    }

    removeFile(filename) {
        this.files = this.files.filter(f => f.name !== filename);
    }

    formatFileSize(bytes) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return Math.round(bytes / Math.pow(k, i) * 100) / 100 + ' ' + sizes[i];
    }

    getFiles() {
        return this.files;
    }
}

/**
 * Form Wizard Controller
 */
class FormWizard {
    constructor(wizardElement) {
        this.wizard = wizardElement;
        this.steps = Array.from(wizardElement.querySelectorAll('.wizard-step'));
        this.currentStep = 0;
        this.formData = {};

        this.init();
    }

    init() {
        this.showStep(0);
        this.updateProgress();
    }

    showStep(stepIndex) {
        this.steps.forEach((step, index) => {
            step.style.display = index === stepIndex ? 'block' : 'none';
        });
        this.currentStep = stepIndex;
        this.updateProgress();
    }

    nextStep() {
        if (this.currentStep < this.steps.length - 1) {
            this.showStep(this.currentStep + 1);
        }
    }

    previousStep() {
        if (this.currentStep > 0) {
            this.showStep(this.currentStep - 1);
        }
    }

    updateProgress() {
        const stepIndicators = this.wizard.querySelectorAll('.form-wizard-step');
        stepIndicators.forEach((indicator, index) => {
            indicator.classList.remove('active', 'completed');
            if (index < this.currentStep) {
                indicator.classList.add('completed');
            } else if (index === this.currentStep) {
                indicator.classList.add('active');
            }
        });
    }

    saveStepData(stepData) {
        this.formData = { ...this.formData, ...stepData };
    }

    getFormData() {
        return this.formData;
    }
}
