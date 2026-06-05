<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payments Management - Blantyre District Council</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <style>
        .sidebar {
            min-height: 100vh;
            background: #343a40;
        }
        .sidebar .nav-link {
            color: rgba(255,255,255,.75);
            padding: 0.75rem 1rem;
        }
        .sidebar .nav-link:hover {
            color: #fff;
            background: rgba(255,255,255,.1);
        }
        .sidebar .nav-link.active {
            color: #fff;
            background: #0d6efd;
        }
        .status-badge {
            padding: 0.25rem 0.5rem;
            border-radius: 0.25rem;
            font-size: 0.75rem;
            font-weight: 500;
        }
        .status-completed { background: #d1e7dd; color: #0f5132; }
        .status-pending { background: #fff3cd; color: #664d03; }
        .status-failed { background: #f8d7da; color: #721c24; }
        .status-refunded { background: #e2e3e5; color: #383d41; }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
<div class="col-md-2 sidebar p-3">
				<h5 class="text-white mb-4"><i class="fas fa-cogs me-2"></i>Admin Panel</h5>
				<ul class="nav flex-column">
					<li class="nav-item">
						<a class="nav-link" href="<?= base_url('admin/dashboard') ?>">
							<i class="fas fa-tachometer-alt me-2"></i>Dashboard
						</a>
					</li>
						<li class="nav-item">
                            <a class="nav-link collapsed" data-bs-toggle="collapse" href="#applicationsCollapse" role="button" aria-expanded="false" aria-controls="applicationsCollapse">
                                <i class="fas fa-file-alt me-2"></i>Applications
                                <span class="float-end"><i class="fas fa-chevron-down"></i></span>
                            </a>
                            <div class="collapse" id="applicationsCollapse">
                                <ul class="nav flex-column ms-3">
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?= base_url('admin/applications'); ?>">All Applications</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?= base_url('admin/business-applications'); ?>">Business Applications</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
					                        <li class="nav-item">
                            <a class="nav-link collapsed" data-bs-toggle="collapse" href="#councilCollapse" role="button" aria-expanded="false" aria-controls="councilCollapse">
                                <i class="fas fa-landmark me-2"></i>Council
                                <span class="float-end"><i class="fas fa-chevron-down"></i></span>
                            </a>
                            <div class="collapse" id="councilCollapse">
                                <ul class="nav flex-column ms-3">
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?= base_url('admin/officials'); ?>">Elected Officials</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?= base_url('admin/management'); ?>">Management</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
					
					<li class="nav-item">
						<a class="nav-link" href="<?= base_url('admin/services') ?>">
							<i class="fas fa-cogs me-2"></i>Services
						</a>
					</li>
					                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('admin/projects') ?>">
                                <i class="fas fa-project-diagram me-2"></i>Projects
                            </a>
                        </li>
					<li class="nav-item">
						<a class="nav-link" href="<?= base_url('admin/news') ?>">
							<i class="fas fa-chart-bar me-2"></i>news
						</a>
					</li>
					                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('admin/notifications') ?>">
                                <i class="fas fa-bell me-2"></i>Notifications
                            </a>
                        </li>
					<li class="nav-item">
						<a class="nav-link" href="<?= base_url('admin/users') ?>">
							<i class="fas fa-users me-2"></i>Users
						</a>
					</li>
					<li class="nav-item mt-3">
						<a class="nav-link" href="<?= base_url('logout') ?>">
							<i class="fas fa-sign-out-alt me-2"></i>Logout
						</a>
					</li>
				</ul>
			</div>

            <!-- Main Content -->
            <main class="col-md-10 ms-sm-auto px-4">
                <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Payments Management</h1>
                    <div>
                        <button class="btn btn-outline-primary me-2" onclick="exportPayments()">
                            <i class="fas fa-download me-2"></i>Export
                        </button>
                        <button class="btn btn-primary" onclick="generateReport()">
                            <i class="fas fa-chart-bar me-2"></i>Generate Report
                        </button>
                    </div>
                </div>

                <!-- Statistics Cards -->
                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body text-center">
                                <i class="fas fa-money-bill-wave fa-2x text-success mb-2"></i>
                                <h4 class="mb-1">MWK <?= number_format($total_revenue ?? 0, 2) ?></h4>
                                <small class="text-muted">Total Revenue</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body text-center">
                                <i class="fas fa-check-circle fa-2x text-primary mb-2"></i>
                                <h4 class="mb-1"><?= $completed_payments ?? 0 ?></h4>
                                <small class="text-muted">Completed Payments</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body text-center">
                                <i class="fas fa-clock fa-2x text-warning mb-2"></i>
                                <h4 class="mb-1"><?= $pending_payments ?? 0 ?></h4>
                                <small class="text-muted">Pending Payments</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body text-center">
                                <i class="fas fa-exclamation-triangle fa-2x text-danger mb-2"></i>
                                <h4 class="mb-1"><?= $failed_payments ?? 0 ?></h4>
                                <small class="text-muted">Failed Payments</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Filters -->
                <div class="card mb-4">
                    <div class="card-body">
                        <form method="GET" class="row g-3">
                            <div class="col-md-3">
                                <label class="form-label">Status</label>
                                <select name="status" class="form-select">
                                    <option value="">All Status</option>
                                    <option value="completed" <?= $filters['status'] == 'completed' ? 'selected' : '' ?>>Completed</option>
                                    <option value="pending" <?= $filters['status'] == 'pending' ? 'selected' : '' ?>>Pending</option>
                                    <option value="failed" <?= $filters['status'] == 'failed' ? 'selected' : '' ?>>Failed</option>
                                    <option value="refunded" <?= $filters['status'] == 'refunded' ? 'selected' : '' ?>>Refunded</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Payment Method</label>
                                <select name="method" class="form-select">
                                    <option value="">All Methods</option>
                                    <option value="card" <?= $filters['method'] == 'card' ? 'selected' : '' ?>>Card</option>
                                    <option value="bank_transfer" <?= $filters['method'] == 'bank_transfer' ? 'selected' : '' ?>>Bank Transfer</option>
                                    <option value="mobile_money" <?= $filters['method'] == 'mobile_money' ? 'selected' : '' ?>>Mobile Money</option>
                                    <option value="cash" <?= $filters['method'] == 'cash' ? 'selected' : '' ?>>Cash</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Date From</label>
                                <input type="date" name="date_from" class="form-control" value="<?= $filters['date_from'] ?>">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Date To</label>
                                <input type="date" name="date_to" class="form-control" value="<?= $filters['date_to'] ?>">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Search</label>
                                <input type="text" name="search" class="form-control" placeholder="Transaction ID, Application ID, or Applicant" value="<?= esc($filters['search']) ?>">
                            </div>
                            <div class="col-md-2 d-flex align-items-end">
                                <button type="submit" class="btn btn-outline-primary me-2">
                                    <i class="fas fa-search me-1"></i>Filter
                                </button>
                                <a href="<?= base_url('admin/payments') ?>" class="btn btn-outline-secondary">
                                    <i class="fas fa-times me-1"></i>Clear
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Payments Table -->
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="paymentsTable" class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Application</th>
                                        <th>Applicant</th>
                                        <th>Amount</th>
                                        <th>Method</th>
                                        <th>Status</th>
                                        <th>Transaction ID</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($payments as $payment): ?>
                                    <tr>
                                        <td><?= $payment['id'] ?></td>
                                        <td>
                                            <a href="<?= base_url('admin/applications/' . $payment['application_id']) ?>" class="text-decoration-none">
                                                #<?= $payment['application_id'] ?>
                                            </a>
                                            <br>
                                            <small class="text-muted"><?= esc($payment['service_name']) ?></small>
                                        </td>
                                        <td>
                                            <div>
                                                <strong><?= esc($payment['applicant_name']) ?></strong>
                                                <br>
                                                <small class="text-muted"><?= esc($payment['applicant_email']) ?></small>
                                            </div>
                                        </td>
                                        <td>
                                            <strong>MWK <?= number_format($payment['amount'], 2) ?></strong>
                                        </td>
                                        <td>
                                            <span class="badge bg-secondary">
                                                <?= ucfirst(str_replace('_', ' ', $payment['payment_method'])) ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span class="status-badge status-<?= $payment['status'] ?>">
                                                <?= ucfirst($payment['status']) ?>
                                            </span>
                                        </td>
                                        <td>
                                            <code class="small"><?= esc($payment['transaction_id']) ?></code>
                                        </td>
                                        <td>
                                            <?= date('M d, Y', strtotime($payment['created_at'])) ?>
                                            <br>
                                            <small class="text-muted"><?= date('H:i', strtotime($payment['created_at'])) ?></small>
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button type="button" class="btn btn-sm btn-outline-info" title="View Details" onclick="viewPaymentDetails(<?= $payment['id'] ?>)">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <?php if ($payment['status'] == 'pending'): ?>
                                                <button type="button" class="btn btn-sm btn-outline-success" title="Mark as Completed" onclick="updatePaymentStatus(<?= $payment['id'] ?>, 'completed')">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                                <button type="button" class="btn btn-sm btn-outline-danger" title="Mark as Failed" onclick="updatePaymentStatus(<?= $payment['id'] ?>, 'failed')">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                                <?php endif; ?>
                                                <?php if ($payment['status'] == 'completed'): ?>
                                                <button type="button" class="btn btn-sm btn-outline-warning" title="Refund" onclick="refundPayment(<?= $payment['id'] ?>)">
                                                    <i class="fas fa-undo"></i>
                                                </button>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <?php if ($pager): ?>
                        <div class="d-flex justify-content-center mt-3">
                            <?= $pager->links() ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Payment Details Modal -->
    <div class="modal fade" id="paymentDetailsModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Payment Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div id="paymentDetailsContent">
                        <div class="text-center">
                            <div class="spinner-border" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Status Update Modal -->
    <div class="modal fade" id="statusUpdateModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Payment Status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to <span id="statusAction"></span> this payment?</p>
                    <div class="mb-3">
                        <label for="statusNote" class="form-label">Note (optional)</label>
                        <textarea class="form-control" id="statusNote" rows="3" placeholder="Add a note about this status change"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="confirmStatusUpdate">Confirm</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#paymentsTable').DataTable({
                "pageLength": 25,
                "order": [[0, "desc"]],
                "columnDefs": [
                    { "orderable": false, "targets": 8 }
                ]
            });
        });

        function viewPaymentDetails(paymentId) {
            const modal = new bootstrap.Modal(document.getElementById('paymentDetailsModal'));
            const content = document.getElementById('paymentDetailsContent');

            content.innerHTML = `
                <div class="text-center">
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            `;

            modal.show();

            // In a real implementation, you would fetch payment details via AJAX
            setTimeout(() => {
                content.innerHTML = `
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Payment Information</h6>
                            <p><strong>Payment ID:</strong> ${paymentId}</p>
                            <p><strong>Amount:</strong> MWK 1,500.00</p>
                            <p><strong>Method:</strong> Bank Transfer</p>
                            <p><strong>Status:</strong> <span class="badge bg-success">Completed</span></p>
                        </div>
                        <div class="col-md-6">
                            <h6>Application Details</h6>
                            <p><strong>Application ID:</strong> #12345</p>
                            <p><strong>Service:</strong> Business License</p>
                            <p><strong>Applicant:</strong> John Doe</p>
                        </div>
                    </div>
                    <hr>
                    <h6>Transaction History</h6>
                    <div class="timeline">
                        <div class="timeline-item">
                            <div class="timeline-marker bg-success"></div>
                            <div class="timeline-content">
                                <h6>Payment Completed</h6>
                                <p>Payment was successfully processed</p>
                                <small>2024-01-15 14:30</small>
                            </div>
                        </div>
                    </div>
                `;
            }, 1000);
        }

        function updatePaymentStatus(paymentId, status) {
            const modal = new bootstrap.Modal(document.getElementById('statusUpdateModal'));
            const statusAction = document.getElementById('statusAction');
            const confirmBtn = document.getElementById('confirmStatusUpdate');

            statusAction.textContent = status === 'completed' ? 'mark as completed' : 'mark as failed';
            confirmBtn.className = `btn ${status === 'completed' ? 'btn-success' : 'btn-danger'}`;

            confirmBtn.onclick = function() {
                const note = document.getElementById('statusNote').value;
                // In a real implementation, you would send AJAX request to update status
                alert(`Payment ${paymentId} marked as ${status}`);
                modal.hide();
                location.reload();
            };

            modal.show();
        }

        function refundPayment(paymentId) {
            if (confirm('Are you sure you want to process a refund for this payment?')) {
                // In a real implementation, you would send AJAX request to process refund
                alert(`Refund initiated for payment ${paymentId}`);
            }
        }

        function exportPayments() {
            // In a real implementation, this would trigger a download
            alert('Export functionality would generate a CSV/Excel file with payment data');
        }

        function generateReport() {
            // In a real implementation, this would generate a financial report
            alert('Report generation would create a detailed financial summary');
        }
    </script>
</body>
</html>
