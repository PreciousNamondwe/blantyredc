<?php 
    $page_session = \CodeIgniter\Config\Services::session();
?>
<?= $this->extend('templates/layout.php')?>

<?= $this->section('content')?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<!-- Internal Hero -->
<section class="internal-hero">
    <img src="<?= base_url('image/new_hero.jpg'); ?>" class="internal-hero-bg" alt="Contact Blantyre DC">
    <div class="internal-hero-content">
        <div class="modern-breadcrumb mb-3">
            <a href="<?= base_url('/'); ?>">Overview</a>
            <span class="separator">//</span>
            <span>Connect</span>
            <span class="separator">//</span>
            <span>Contact Us</span>
        </div>
        <h1 class="internal-hero-title">Get In Touch</h1>
    </div>
</section>

<!-- Main Content Section -->
<section class="bg-slate-dark overlap-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="glass-card-modern">
                    <div class="row g-5">
                        
                        <!-- Contact Info -->
                        <div class="col-lg-5">
                            <h4 class="text-white fw-bold mb-4">Secretariat Address</h4>
                            <div class="d-flex mb-4">
                                <div class="text-danger fs-4 me-3"><i class="fas fa-map-marker-alt"></i></div>
                                <div>
                                    <p class="text-white-50 mb-0">
                                        District Commissioner,<br>
                                        Blantyre District Council,<br>
                                        Private Bag 97,<br>
                                        Blantyre, Malawi.
                                    </p>
                                </div>
                            </div>
                            
                            <div class="d-flex mb-4">
                                <div class="text-danger fs-4 me-3"><i class="fas fa-clock"></i></div>
                                <div>
                                    <h6 class="text-white mb-1">Office Hours</h6>
                                    <p class="text-white-50 small mb-0">Mon - Fri: 7:30 AM - 4:30 PM</p>
                                </div>
                            </div>

                            <div class="d-flex mb-4">
                                <div class="text-danger fs-4 me-3"><i class="fas fa-envelope"></i></div>
                                <div>
                                    <h6 class="text-white mb-1">Digital Mail</h6>
                                    <p class="text-white-50 small mb-0">dc.blantyre@blantyredc.gov.mw</p>
                                </div>
                            </div>

                            <div class="d-flex mb-4">
                                <div class="text-danger fs-4 me-3"><i class="fas fa-phone"></i></div>
                                <div>
                                    <h6 class="text-white mb-1">Direct Line</h6>
                                    <p class="text-white-50 small mb-0">+265 888 663 139</p>
                                </div>
                            </div>
                        </div>

                        <!-- Contact Form -->
                        <div class="col-lg-7 border-start border-secondary border-opacity-25 ps-lg-5">
                            <h4 class="text-white fw-bold mb-4">Send an Enquiry</h4>
                            
                            <?php if ($page_session->getTempdata('success')):?>
                                <div class="alert alert-success border-0 bg-success bg-opacity-10 text-success rounded-4 mb-4">
                                    <i class="fas fa-check-circle me-2"></i> <?= $page_session->getTempdata('success');?>
                                </div>
                            <?php endif;?>

                            <?php if ($page_session->getTempdata('error')):?>
                                <div class="alert alert-danger border-0 bg-danger bg-opacity-10 text-danger rounded-4 mb-4">
                                    <i class="fas fa-exclamation-circle me-2"></i> <?= $page_session->getTempdata('error');?>
                                </div>
                            <?php endif;?>

                            <form action="<?= base_url('contact-us'); ?>" method="post">
                                <?= csrf_field();?>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" name="name" id="name" placeholder="Full Name" required>
                                            <label for="name">Full Name</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
                                            <label for="subject">Subject</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <input type="email" class="form-control" name="email" id="email" placeholder="Email Address" required>
                                            <label for="email">Email Address</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <textarea class="form-control" id="message" name="message" placeholder="Message" style="height: 150px" required></textarea>
                                            <label for="message">Your Message</label>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-4 text-end">
                                        <button type="submit" name="submit" class="btn btn-visionary">
                                            <i class="fas fa-paper-plane me-2"></i> Dispatch Message
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection()?>