<div class="mb-4 pb-3 border-bottom">
    <a href="<?= base_url('admin/dashboard?tab=officials') ?>" class="btn btn-sm btn-outline-secondary mb-3">
        <i class="fas fa-arrow-left me-1"></i> Back to Roster
    </a>
    <h2 class="fw-bold text-slate-800 mb-1">Edit Elected Official: <?= esc($official['name']) ?></h2>
    <p class="text-muted small mb-0">Modify contact details, sort priorities, and biographical records.</p>
</div>

<?php if (session()->getFlashdata('errors')): ?>
    <div class="alert alert-danger border-0 shadow-sm mb-4">
        <ul class="mb-0">
            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                <li><?= esc($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<div class="card border-0 shadow-sm rounded-3">
    <div class="card-body p-4">
        <form method="POST" action="<?= base_url('admin/officials/' . $official['id'] . '/edit') ?>" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-medium">Full Name</label>
                    <input type="text" name="name" class="form-control" value="<?= esc(old('name', $official['name'])) ?>" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-medium">Official Position Title</label>
                    <input type="text" name="position" class="form-control" value="<?= esc(old('position', $official['position'])) ?>" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-medium">Assigned Department</label>
                    <input type="text" name="department" class="form-control" value="<?= esc(old('department', $official['department'])) ?>">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-medium">Display Sort Order</label>
                    <input type="number" name="sort_order" class="form-control" value="<?= esc(old('sort_order', $official['sort_order'])) ?>">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-medium">Email Address</label>
                    <input type="email" name="email" class="form-control" value="<?= esc(old('email', $official['email'])) ?>">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-medium">Phone Number</label>
                    <input type="text" name="phone" class="form-control" value="<?= esc(old('phone', $official['phone'])) ?>">
                </div>
                <div class="col-md-12">
                    <label class="form-label fw-medium">Replace Photo</label>
                    <input type="file" name="photo" class="form-control mb-2">
                    <?php if($official['photo']): ?>
                        <div class="text-muted small">Current: <code><?= esc($official['photo']) ?></code></div>
                    <?php endif; ?>
                </div>
                <div class="col-md-12">
                    <label class="form-label fw-medium">Biography / Profile Context</label>
                    <textarea name="bio" class="form-control" rows="4"><?= esc(old('bio', $official['bio'])) ?></textarea>
                </div>
                <div class="col-md-12">
                    <div class="form-check form-switch mt-2">
                        <input class="form-check-input" type="checkbox" name="is_active" id="isActiveSwitch" value="1" <?= $official['is_active'] ? 'checked' : '' ?>>
                        <label class="form-check-label fw-medium" for="isActiveSwitch">Keep publicly active on website roster</label>
                    </div>
                </div>
                <div class="col-md-12 text-end pt-3">
                    <button type="submit" class="btn btn-primary px-4">Update Profile</button>
                </div>
            </div>
        </form>
    </div>
</div>