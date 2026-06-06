<div class="card dashboard-card p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="fw-bold m-0">Add New Management Member</h5>
        <a href="<?= base_url('admin/management') ?>" class="btn btn-sm btn-outline-secondary">Back to Directory</a>
    </div>

    <?php if (session()->getFlashdata('errors')): ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="POST" action="<?= base_url('admin/management/create') ?>" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label fw-semibold">Full Name *</label>
                <input type="text" name="name" class="form-value form-control" value="<?= old('name') ?>" required>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-semibold">Position *</label>
                <input type="text" name="position" class="form-control" value="<?= old('position') ?>" required>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-semibold">Email</label>
                <input type="email" name="email" class="form-control" value="<?= old('email') ?>">
            </div>
            <div class="col-md-6">
                <label class="form-label fw-semibold">Phone</label>
                <input type="text" name="phone" class="form-control" value="<?= old('phone') ?>">
            </div>
            <div class="col-12">
                <label class="form-label fw-semibold">Biography</label>
                <textarea name="bio" class="form-control" rows="4"><?= old('bio') ?></textarea>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-semibold">Profile Photo</label>
                <input type="file" name="photo" class="form-control">
            </div>
            <div class="col-md-6 d-flex align-items-center mt-4">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="is_active" id="isActiveSwitch" value="1" checked>
                    <label class="form-check-label fw-semibold" for="isActiveSwitch">Active Status</label>
                </div>
            </div>
            <div class="col-12 text-end mt-4">
                <button type="submit" class="btn btn-primary px-4">Save Profile</button>
            </div>
        </div>
    </form>
</div>