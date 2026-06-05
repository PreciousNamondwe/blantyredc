<?= $this->extend('templates/admin_layout') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Application Details: <?= esc($application['reference_number']) ?></h3>
                    <div class="card-tools">
                        <a href="<?= base_url('admin/applications') ?>" class="btn btn-sm btn-secondary">Back to Applications</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h4>General Information</h4>
                            <table class="table table-bordered table-striped">
                                <tbody>
                                    <tr>
                                        <th>Reference Number</th>
                                        <td><?= esc($application['reference_number']) ?></td>
                                    </tr>
                                    <tr>
                                        <th>Service</th>
                                        <td><?= esc($application['service']['service_name'] ?? 'N/A') ?></td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td><span class="badge badge-<?= getStatusBadgeClass($application['status']) ?>"><?= esc(ucwords(str_replace('_', ' ', $application['status']))) ?></span></td>
                                    </tr>
                                    <tr>
                                        <th>Priority</th>
                                        <td><?= esc(ucwords($application['priority'])) ?></td>
                                    </tr>
                                    <tr>
                                        <th>Submitted At</th>
                                        <td><?= esc($application['submitted_at']) ?></td>
                                    </tr>
                                    <tr>
                                        <th>Assigned To</th>
                                        <td><?= esc($application['assigned_user']['full_name'] ?? 'Unassigned') ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h4>Update Status & Assign</h4>
                            <form action="<?= base_url('admin/applications/' . $application['id'] . '/status') ?>" method="post">
                                <?= csrf_field() ?>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <?php
                                        $statuses = ['draft', 'submitted', 'under_review', 'approved', 'rejected', 'completed', 'cancelled'];
                                        foreach ($statuses as $statusOption) : ?>
                                            <option value="<?= $statusOption ?>" <?= ($application['status'] === $statusOption) ? 'selected' : '' ?>>
                                                <?= esc(ucwords(str_replace('_', ' ', $statusOption))) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="notes">Notes</label>
                                    <textarea name="notes" id="notes" class="form-control" rows="3"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Update Status</button>
                            </form>
                            <hr>
                            <form action="<?= base_url('admin/applications/' . $application['id'] . '/assign') ?>" method="post" class="mt-3">
                                <?= csrf_field() ?>
                                <div class="form-group">
                                    <label for="user_id">Assign To</label>
                                    <select name="user_id" id="user_id" class="form-control">
                                        <option value="">Select Staff</option>
                                        <?php foreach ($staff as $user) : ?>
                                            <option value="<?= $user['id'] ?>" <?= ($application['assigned_to'] == $user['id']) ? 'selected' : '' ?>>
                                                <?= esc($user['full_name']) ?> (<?= esc($user['role']) ?>)
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-info">Assign</button>
                            </form>
                        </div>
                    </div>

                    <hr>

                    <?php if (!empty($application['application_data']['applicant_info'])) : ?>
                        <h4>Applicant Information</h4>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <?php foreach ($application['application_data']['applicant_info'] as $key => $value) : ?>
                                    <tr>
                                        <th><?= esc(ucwords(str_replace('_', ' ', $key))) ?></th>
                                        <td><?= esc($value) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php endif; ?>

                    <?php if (!empty($application['application_data']['service_specific'])) : ?>
                        <h4>Business Details</h4>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <?php foreach ($application['application_data']['service_specific'] as $key => $value) : ?>
                                    <tr>
                                        <th><?= esc(ucwords(str_replace('_', ' ', $key))) ?></th>
                                        <td><?= esc($value) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php endif; ?>

                    <?php if (!empty($application['application_data']['other_form_fields'])) : ?>
                        <h4>Other Form Fields</h4>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <?php foreach ($application['application_data']['other_form_fields'] as $key => $value) : ?>
                                    <tr>
                                        <th><?= esc(ucwords(str_replace('_', ' ', $key))) ?></th>
                                        <td><?= esc($value) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php endif; ?>

                    <?php if (!empty($application['documents'])) : ?>
                        <h4>Uploaded Documents</h4>
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Document Type</th>
                                    <th>File Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($application['documents'] as $doc) : ?>
                                    <tr>
                                        <td><?= esc(ucwords(str_replace('_', ' ', $doc['document_type']))) ?></td>
                                        <td><?= esc($doc['file_name']) ?></td>
                                        <td><a href="<?= base_url('writable/' . $doc['file_path']) ?>" target="_blank" class="btn btn-sm btn-primary">View / Download</a></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php endif; ?>

                    <?php if (!empty($application['status_history'])) : ?>
                        <h4>Status History</h4>
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Old Status</th>
                                    <th>New Status</th>
                                    <th>Changed By</th>
                                    <th>Notes</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($application['status_history'] as $log) : ?>
                                    <tr>
                                        <td><?= esc(ucwords(str_replace('_', ' ', $log['old_status'] ?? 'N/A'))) ?></td>
                                        <td><?= esc(ucwords(str_replace('_', ' ', $log['new_status']))) ?></td>
                                        <td><?= esc($log['changed_by_name'] ?? 'System') ?></td>
                                        <td><?= esc($log['notes']) ?></td>
                                        <td><?= esc($log['created_at']) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
</div>

<?php
// Helper function for status badge class (can be moved to a helper file)
function getStatusBadgeClass($status)
{
    return match ($status) {
        'draft' => 'secondary',
        'submitted' => 'warning',
        'under_review' => 'info',
        'approved' => 'success',
        'rejected' => 'danger',
        'completed' => 'primary',
        'cancelled' => 'dark',
        default => 'secondary'
    };
}
?>
<?= $this->endSection() ?>