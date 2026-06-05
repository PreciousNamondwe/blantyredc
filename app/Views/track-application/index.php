<?= $this->extend('templates/layout.php')?>

<?= $this->section('content')?>

<!-- Internal Hero -->
<section class="internal-hero">
    <img src="<?= base_url('image/new_hero.jpg'); ?>" class="internal-hero-bg" alt="Track Application">
    <div class="internal-hero-content">
        <div class="modern-breadcrumb mb-3">
            <a href="<?= base_url('/'); ?>">Overview</a>
            <span class="separator">//</span>
            <span>Services</span>
            <span class="separator">//</span>
            <span>Track Application</span>
        </div>
        <h1 class="internal-hero-title">Track Your Application</h1>
    </div>
</section>

<!-- Main Content Section -->
<section class="bg-slate-dark overlap-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                
                <!-- Search Form -->
                <div class="form-wizard" id="trackingForm">
                    <h3 class="text-white mb-4 text-center">Enter Your Reference Number</h3>
                    <p class="text-white-50 text-center mb-5">Track the status of your application in real-time</p>
                    
                    <form id="trackApplicationForm">
                        <div class="form-group-modern">
                            <label>Reference Number <span class="required">*</span></label>
                            <input type="text" name="reference_number" id="referenceInput" class="form-input-modern" placeholder="e.g., MAR-260211-A1B2C3" required style="text-align: center; font-size: 1.2rem; letter-spacing: 2px;">
                        </div>

                        <div class="form-actions">
                            <div></div>
                            <button type="submit" class="btn-form-primary" id="trackBtn">
                                <i class="fas fa-search"></i> Track Application
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Results Section (Hidden Initially) -->
                <div id="trackingResults" style="display: none;">
                    <div class="form-wizard mt-4">
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h4 class="text-white mb-3">Application Details</h4>
                                <div class="p-3 rounded-3" style="background: rgba(255,255,255,0.05);">
                                    <div class="mb-2">
                                        <small class="text-white-50">Reference Number</small>
                                        <div class="text-white fw-bold" id="refNumber">-</div>
                                    </div>
                                    <div class="mb-2">
                                        <small class="text-white-50">Service Type</small>
                                        <div class="text-white" id="serviceType">-</div>
                                    </div>
                                    <div class="mb-2">
                                        <small class="text-white-50">Applicant</small>
                                        <div class="text-white" id="applicantName">-</div>
                                    </div>
                                    <div class="mb-2">
                                        <small class="text-white-50">Submitted</small>
                                        <div class="text-white" id="submittedDate">-</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h4 class="text-white mb-3">Current Status</h4>
                                <div class="p-4 rounded-3 text-center" id="statusCard" style="background: rgba(239, 68, 68, 0.1); border: 2px solid #ef4444;">
                                    <div class="mb-2">
                                        <i class="fas fa-clock" style="font-size: 3rem; color: #ef4444;"></i>
                                    </div>
                                    <h5 class="text-white mb-2" id="currentStatus">Processing</h5>
                                    <small class="text-white-50" id="statusDescription">Your application is being reviewed</small>
                                </div>
                            </div>
                        </div>

                        <h4 class="text-white mb-3">Application Timeline</h4>
                        <div id="statusTimeline">
                            <!-- Timeline will be populated here -->
                        </div>

                        <div class="form-actions mt-4">
                            <button type="button" class="btn-form-secondary" onclick="location.reload()">
                                <i class="fas fa-search"></i> Track Another
                            </button>
                            <a href="<?= base_url('/'); ?>" class="btn-form-primary">
                                <i class="fas fa-home"></i> Return Home
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Error Message (Hidden Initially) -->
                <div id="errorMessage" style="display: none;">
                    <div class="form-wizard mt-4">
                        <div class="text-center p-5">
                            <i class="fas fa-exclamation-circle" style="font-size: 4rem; color: #ef4444; margin-bottom: 1.5rem;"></i>
                            <h4 class="text-white mb-3">Application Not Found</h4>
                            <p class="text-white-50">
                                We couldn't find an application with that reference number. 
                                Please check the number and try again.
                            </p>
                            <button type="button" class="btn-form-primary mt-3" onclick="location.reload()">
                                <i class="fas fa-redo"></i> Try Again
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('trackApplicationForm');
    const trackBtn = document.getElementById('trackBtn');

    form.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const referenceNumber = document.getElementById('referenceInput').value.trim();
        
        if (!referenceNumber) {
            alert('Please enter a reference number');
            return;
        }

        trackBtn.disabled = true;
        trackBtn.innerHTML = '<span class="form-loading"></span> Searching...';

        try {
            const response = await fetch('<?= base_url('api/applications/track'); ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ reference_number: referenceNumber })
            });
            const result = await response.json();

            if (result.success && result.data.application) {
                displayResults(result.data);
            } else {
                showError();
            }
        } catch (error) {
            console.error('Error:', error);
            showError();
        } finally {
            trackBtn.disabled = false;
            trackBtn.innerHTML = '<i class="fas fa-search"></i> Track Application';
        }
    });

    function displayResults(data) {
        const app = data.application;
        const applicantInfo = app.application_data?.applicant_info || {};
        
        // Hide form, show results
        document.getElementById('trackingForm').style.display = 'none';
        document.getElementById('trackingResults').style.display = 'block';
        
        // Populate details
        document.getElementById('refNumber').textContent = app.reference_number;
        document.getElementById('serviceType').textContent = app.service?.service_name || formatServiceType(app.service_key);
        document.getElementById('applicantName').textContent = applicantInfo.name || 'Unknown applicant';
        document.getElementById('submittedDate').textContent = formatDate(app.created_at);
        
        // Update status
        updateStatusCard(app.status);
        
        // Build timeline
        buildTimeline(app.status_history || []);
    }

    function updateStatusCard(status) {
        const statusCard = document.getElementById('statusCard');
        const statusIcon = statusCard.querySelector('i');
        const statusText = document.getElementById('currentStatus');
        const statusDesc = document.getElementById('statusDescription');
        
        const statusConfig = {
            'draft': { icon: 'fa-edit', color: '#6b7280', text: 'Draft', desc: 'Application saved as draft' },
            'submitted': { icon: 'fa-paper-plane', color: '#3b82f6', text: 'Submitted', desc: 'Application received and queued' },
            'under_review': { icon: 'fa-search', color: '#f59e0b', text: 'Under Review', desc: 'Being reviewed by our team' },
            'approved': { icon: 'fa-check-circle', color: '#22c55e', text: 'Approved', desc: 'Application has been approved' },
            'rejected': { icon: 'fa-times-circle', color: '#ef4444', text: 'Rejected', desc: 'Application was not approved' },
            'completed': { icon: 'fa-flag-checkered', color: '#22c55e', text: 'Completed', desc: 'Ready for collection' }
        };
        
        const config = statusConfig[status] || statusConfig['submitted'];
        
        statusIcon.className = `fas ${config.icon}`;
        statusIcon.style.color = config.color;
        statusText.textContent = config.text;
        statusDesc.textContent = config.desc;
        statusCard.style.borderColor = config.color;
        statusCard.style.background = `${config.color}15`;
    }

    function buildTimeline(history) {
        const timeline = document.getElementById('statusTimeline');
        timeline.innerHTML = '';
        
        if (history.length === 0) {
            timeline.innerHTML = '<p class="text-white-50 text-center">No status updates yet</p>';
            return;
        }
        
        history.forEach((item, index) => {
            const timelineItem = document.createElement('div');
            timelineItem.className = 'p-3 mb-3 rounded-3';
            timelineItem.style.background = 'rgba(255,255,255,0.05)';
            timelineItem.style.borderLeft = '3px solid #ef4444';
            
            timelineItem.innerHTML = `
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h6 class="text-white mb-1">${formatStatus(item.new_status)}</h6>
                        ${item.comment ? `<p class="text-white-50 small mb-0">${item.comment}</p>` : ''}
                    </div>
                    <small class="text-white-50">${formatDate(item.created_at)}</small>
                </div>
            `;
            
            timeline.appendChild(timelineItem);
        });
    }

    function showError() {
        document.getElementById('trackingForm').style.display = 'none';
        document.getElementById('errorMessage').style.display = 'block';
    }

    function formatServiceType(type) {
        return type.replace(/_/g, ' ').replace(/\b\w/g, l => l.toUpperCase());
    }

    function formatStatus(status) {
        return status.replace(/_/g, ' ').replace(/\b\w/g, l => l.toUpperCase());
    }

    function formatDate(dateString) {
        const date = new Date(dateString);
        return date.toLocaleDateString('en-GB', { 
            day: '2-digit', 
            month: 'short', 
            year: 'numeric',
            hour: '2-digit',
            minute: '2-digit'
        });
    }
});
</script>

<?= $this->endSection()?>
