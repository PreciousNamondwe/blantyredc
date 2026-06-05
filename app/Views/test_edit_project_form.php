<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Project - Blantyre District Council</title>

    <!-- Bootstrap + Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

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
    </style>
</head>

<body>
<div class="container-fluid">
    <div class="row">

        <!-- Sidebar -->
        <nav class="col-md-2 sidebar p-0">
            <div class="p-3">
                <h5 class="text-white mb-4">
                    <i class="fas fa-cogs me-2"></i>Admin Panel
                </h5>

                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('admin/dashboard') ?>">
                            <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="<?= base_url('admin/projects') ?>">
                            <i class="fas fa-project-diagram me-2"></i>Projects
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="col-md-10 ms-sm-auto px-4">

            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Edit Project</h1>
                <a href="<?= base_url('admin/projects') ?>" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Back
                </a>
            </div>

            <!-- Card -->
            <div class="card shadow-sm">
                <div class="card-body">

                    <!-- YOUR ORIGINAL FORM (UNCHANGED LOGIC) -->
                    <form method="post" action="<?= base_url('project/update/' . $project['id']) ?>">
                        <?= csrf_field() ?>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Title</label>
                                <input type="text" name="title" class="form-control"
                                    value="<?= esc($project['title']) ?>">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Category</label>
                                <input type="text" name="category" class="form-control"
                                    value="<?= esc($project['category']) ?>">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control"><?= esc($project['description']) ?></textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Location</label>
                                <input type="text" name="location" class="form-control"
                                    value="<?= esc($project['location']) ?>">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Status</label>
                                <select name="status" class="form-select">
                                    <option value="planning" <?= $project['status'] == 'planning' ? 'selected' : '' ?>>Planning</option>
                                    <option value="ongoing" <?= $project['status'] == 'ongoing' ? 'selected' : '' ?>>Ongoing</option>
                                    <option value="completed" <?= $project['status'] == 'completed' ? 'selected' : '' ?>>Completed</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Progress (%)</label>
                            <input type="number" name="progress_percentage" class="form-control"
                                value="<?= esc($project['progress_percentage']) ?>">
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Start Date</label>
                                <input type="date" name="start_date" class="form-control"
                                    value="<?= esc($project['start_date']) ?>">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Estimated Completion</label>
                                <input type="date" name="estimated_completion_date" class="form-control"
                                    value="<?= esc($project['estimated_completion_date']) ?>">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Budget</label>
                            <input type="number" step="0.01" name="budget" class="form-control"
                                value="<?= esc($project['budget']) ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Spent Amount</label>
                            <input type="number" step="0.01" name="spent_amount" class="form-control"
                                value="<?= esc($project['spent_amount']) ?>">
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Contractor</label>
                                <input type="text" name="contractor" class="form-control"
                                    value="<?= esc($project['contractor']) ?>">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Fund Source</label>
                                <input type="text" name="fund_source" class="form-control"
                                    value="<?= esc($project['fund_source']) ?>">
                            </div>
                        </div>

                        <input type="hidden" name="is_active" value="1">

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Update Project
                            </button>

                            <a href="<?= base_url('admin/projects') ?>" class="btn btn-secondary">
                                <i class="fas fa-times me-2"></i>Cancel
                            </a>
                        </div>

                    </form>
                    <!-- END FORM -->

                </div>
            </div>

        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>