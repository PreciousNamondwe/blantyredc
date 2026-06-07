<?= $this->extend('templates/layout') ?> <?= $this->section('content') ?>
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-xl-11">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white p-4">
                    <h4 class="mb-0">Official Digital Marriage Registration Portal</h4>
                    <p class="mb-0 text-white-50 small">The certificate ID number will be automatically generated upon clicking the submit button.</p>
                </div>
                <div class="card-body p-4">

                    <?php if (session()->getFlashdata('success')): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?= session()->getFlashdata('success') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <?php if (session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?= session()->getFlashdata('error') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <?php if (session()->getFlashdata('errors')): ?>
                        <div class="alert alert-danger">
                            <h6 class="alert-heading fw-bold">Please correct the following errors:</h6>
                            <ul class="mb-0 small">
                                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                                    <li><?= esc($error) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <form action="<?= site_url('marriage-certificates/store') ?>" method="POST" enctype="multipart/form-data">
                        <?= csrf_field() ?>

                        <h5 class="text-secondary border-bottom pb-2 mb-3">1. General Marriage Union Details</h5>
                        <div class="row g-3 mb-4">
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Marriage Type *</label>
                                <select name="marriage_type" class="form-select" required>
                                    <option value="">Choose Type...</option>
                                    <option value="Civil" <?= old('marriage_type') == 'Civil' ? 'selected' : '' ?>>Civil</option>
                                    <option value="Religious" <?= old('marriage_type') == 'Religious' ? 'selected' : '' ?>>Religious</option>
                                    <option value="Customary" <?= old('marriage_type') == 'Customary' ? 'selected' : '' ?>>Customary</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Scheduled Date of Marriage *</label>
                                <input type="date" name="date_of_marriage" class="form-control" value="<?= old('date_of_marriage') ?>" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Place of Marriage Ceremony *</label>
                                <input type="text" name="place_of_marriage" class="form-control" placeholder="e.g., Church, Venue Name, Registrar Office" value="<?= old('place_of_marriage') ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Officiating Officer Name *</label>
                                <input type="text" name="officiating_officer" class="form-control" placeholder="e.g., Pastor, Registrar, Reverend, Traditional Chief Name" value="<?= old('officiating_officer') ?>" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-semibold">Notice Date (Form B) *</label>
                                <input type="date" name="notice_date_form_b" class="form-control" value="<?= old('notice_date_form_b') ?>" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-semibold">Permit Date (Form D)</label>
                                <input type="date" name="permit_date_form_d" class="form-control" value="<?= old('permit_date_form_d') ?>">
                            </div>
                        </div>

                        <h5 class="border-bottom pb-2 mb-3 text-primary">2. Groom Particulars</h5>
                        <div class="row g-3 mb-4">
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">First Name *</label>
                                <input type="text" name="groom_first_name" class="form-control" value="<?= old('groom_first_name') ?>" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Last Name *</label>
                                <input type="text" name="groom_last_name" class="form-control" value="<?= old('groom_last_name') ?>" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Date of Birth *</label>
                                <input type="date" name="groom_date_of_birth" class="form-control" value="<?= old('groom_date_of_birth') ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">National ID (8 Characters) *</label>
                                <input type="text" name="groom_national_id" class="form-control" maxlength="8" placeholder="e.g., A1B2C3D4" value="<?= old('groom_national_id') ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Foreign Passport Number <span class="text-muted small">(If Applicable)</span></label>
                                <input type="text" name="groom_foreign_passport" class="form-control" value="<?= old('groom_foreign_passport') ?>">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Groom Home Village *</label>
                                <input type="text" name="groom_village" class="form-control" value="<?= old('groom_village') ?>" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Groom Traditional Authority *</label>
                                <input type="text" name="groom_ta" class="form-control" value="<?= old('groom_ta') ?>" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Groom Origin District *</label>
                                <input type="text" name="groom_district" class="form-control" value="<?= old('groom_district') ?>" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-semibold">Current Residential Address *</label>
                                <textarea name="groom_current_residence" class="form-control" rows="2" required><?= old('groom_current_residence') ?></textarea>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Groom ID Front Scan</label>
                                <input type="file" name="groom_id_upload_front" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Groom ID Back Scan</label>
                                <input type="file" name="groom_id_upload_back" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Groom Passport Bio-Page Scan</label>
                                <input type="file" name="groom_passport_bio_upload" class="form-control">
                            </div>
                        </div>

                        <h5 class="border-bottom pb-2 mb-3 text-danger">3. Bride Particulars</h5>
                        <div class="row g-3 mb-4">
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">First Name *</label>
                                <input type="text" name="bride_first_name" class="form-control" value="<?= old('bride_first_name') ?>" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Last Name *</label>
                                <input type="text" name="bride_last_name" class="form-control" value="<?= old('bride_last_name') ?>" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Date of Birth *</label>
                                <input type="date" name="bride_date_of_birth" class="form-control" value="<?= old('bride_date_of_birth') ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">National ID (8 Characters) *</label>
                                <input type="text" name="bride_national_id" class="form-control" maxlength="8" placeholder="e.g., X1Y2Z3W4" value="<?= old('bride_national_id') ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Foreign Passport Number <span class="text-muted small">(If Applicable)</span></label>
                                <input type="text" name="bride_foreign_passport" class="form-control" value="<?= old('bride_foreign_passport') ?>">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Bride Home Village *</label>
                                <input type="text" name="bride_village" class="form-control" value="<?= old('bride_village') ?>" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Bride Traditional Authority *</label>
                                <input type="text" name="bride_ta" class="form-control" value="<?= old('bride_ta') ?>" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Bride Origin District *</label>
                                <input type="text" name="bride_district" class="form-control" value="<?= old('bride_district') ?>" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-semibold">Current Residential Address *</label>
                                <textarea name="bride_current_residence" class="form-control" rows="2" required><?= old('bride_current_residence') ?></textarea>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Bride ID Front Scan</label>
                                <input type="file" name="bride_id_upload_front" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Bride ID Back Scan</label>
                                <input type="file" name="bride_id_upload_back" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Bride Passport Bio-Page Scan</label>
                                <input type="file" name="bride_passport_bio_upload" class="form-control">
                            </div>
                        </div>

                        <h5 class="text-secondary border-bottom pb-2 mb-3">4. Legal Marriage Witnesses</h5>
                        <div class="row mb-4 g-4">
                            <div class="col-md-6 border-end">
                                <h6 class="fw-bold text-primary mb-3">Groom's Witness</h6>
                                <div class="row g-2">
                                    <div class="col-12">
                                        <label class="form-label small mb-1">Full Name *</label>
                                        <input type="text" name="gw_full_name" class="form-control" value="<?= old('gw_full_name') ?>" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small mb-1">National ID *</label>
                                        <input type="text" name="gw_national_id" class="form-control" value="<?= old('gw_national_id') ?>" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small mb-1">Contact Number</label>
                                        <input type="text" name="gw_phone" class="form-control" value="<?= old('gw_phone') ?>">
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label small mb-1">Origin (Village / T.A. / District) *</label>
                                        <div class="input-group">
                                            <input type="text" name="gw_village" placeholder="Village" class="form-control" value="<?= old('gw_village') ?>" required>
                                            <input type="text" name="gw_ta" placeholder="T/A" class="form-control" value="<?= old('gw_ta') ?>" required>
                                            <input type="text" name="gw_district" placeholder="District" class="form-control" value="<?= old('gw_district') ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label small mb-1">Relationship to Groom *</label>
                                        <input type="text" name="gw_relationship" placeholder="e.g., Groom Representative" class="form-control" value="<?= old('gw_relationship') ?>" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small mb-1">ID Front</label>
                                        <input type="file" name="gw_id_upload_front" class="form-control form-control-sm">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small mb-1">ID Back</label>
                                        <input type="file" name="gw_id_upload_back" class="form-control form-control-sm">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <h6 class="fw-bold text-danger mb-3">Bride's Witness</h6>
                                <div class="row g-2">
                                    <div class="col-12">
                                        <label class="form-label small mb-1">Full Name *</label>
                                        <input type="text" name="bw_full_name" class="form-control" value="<?= old('bw_full_name') ?>" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small mb-1">National ID *</label>
                                        <input type="text" name="bw_national_id" class="form-control" value="<?= old('bw_national_id') ?>" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small mb-1">Contact Number</label>
                                        <input type="text" name="bw_phone" class="form-control" value="<?= old('bw_phone') ?>">
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label small mb-1">Origin (Village / T.A. / District) *</label>
                                        <div class="input-group">
                                            <input type="text" name="bw_village" placeholder="Village" class="form-control" value="<?= old('bw_village') ?>" required>
                                            <input type="text" name="bw_ta" placeholder="T/A" class="form-control" value="<?= old('bw_ta') ?>" required>
                                            <input type="text" name="bw_district" placeholder="District" class="form-control" value="<?= old('bw_district') ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label small mb-1">Relationship to Bride *</label>
                                        <input type="text" name="bw_relationship" placeholder="e.g., Bride Representative" class="form-control" value="<?= old('bw_relationship') ?>" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small mb-1">ID Front</label>
                                        <input type="file" name="bw_id_upload_front" class="form-control form-control-sm">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small mb-1">ID Back</label>
                                        <input type="file" name="bw_id_upload_back" class="form-control form-control-sm">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h5 class="text-secondary border-bottom pb-2 mb-3">5. Mandatory Supporting Documents</h5>
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Form B Notice Document Upload *</label>
                                <input type="file" name="form_b_notice_document_upload" class="form-control" required>
                                <div class="form-text text-muted">Please upload a scanned PDF or clear photo copy of your legal Form B notice document.</div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Letter of No Impediment Upload</label>
                                <input type="file" name="letter_of_no_impediment_upload" class="form-control">
                                <div class="form-text text-muted">Required only if either applicant is a non-citizen or previously divorced.</div>
                            </div>
                        </div>

                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" class="btn btn-success btn-lg shadow-sm">Submit Certificate Application</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>