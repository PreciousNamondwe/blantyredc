<div class="card dashboard-card p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="fw-bold m-0">Edit Management Member: <?= esc($member['name']) ?></h5>
        <a href="<?= base_url('admin/management') ?>" class="btn btn-sm btn-outline-secondary">Back to Directory</a>
    </div>

    <form method="POST" action="<?= base_url('admin/management/edit/' . $member['id']) ?>" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label fw-semibold">Full Name *</label>
                <input type="text" name="name" class="form-control" value="<?= esc(old('name', $member['name'])) ?>" required>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-semibold">Position *</label>
                <input type="text" name="position" class="form-control" value="<?= esc(old('position', $member['position'])) ?>" required>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-semibold">Email</label>
                <input type="email" name="email" class="form-control" value="<?= esc(old('email', $member['email'])) ?>">
            </div>
            <div class="col-md-6">
                <label class="form-label fw-semibold">Phone</label>
                <input type="text" name="phone" class="form-control" value="<?= esc(old('phone', $member['phone'])) ?>">
            </div>
            <div class="col-12">
                <label class="form-label fw-semibold">Biography</label>
                <textarea name="bio" class="form-control" rows="4"><?= esc(old('bio', $member['bio'])) ?></textarea>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-semibold">Profile Photo (Leave blank to keep current)</label>
                <input type="file" name="photo" class="form-control mb-2">
                <?php if ($member['photo']): ?>
                    <img src="<?= base_url($member['photo']) ?>" class="rounded" style="width: 60px; height: 60px; object-fit: cover;">
                <?php endif; ?>
            </div>
            <div class="col-md-6 d-flex align-items-center mt-4">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="is_active" id="editActiveSwitch" value="1" <?= $member['is_active'] ? 'checked' : '' ?>>
                    <label class="form-check-label fw-semibold" for="editActiveSwitch">Active Status</label>
                </div>
            </div>
            <div class="col-12 text-end mt-4">
                <button type="submit" class="btn btn-success px-4">Update Profile</button>
            </div>
        </div>
    </form>
</div>