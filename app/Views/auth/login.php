<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Blantyre District Council</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f5f7fb;
        }
        .auth-card {
            max-width: 420px;
            margin: 5rem auto;
            border: 1px solid #e3e6ef;
            border-radius: 16px;
            background: #ffffff;
            box-shadow: 0 12px 30px rgba(33, 35, 86, 0.08);
        }
        .auth-card .card-body {
            padding: 2rem;
        }
        .brand-logo {
            width: 54px;
            height: 54px;
            background: #0d6efd;
            border-radius: 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-weight: 700;
            font-size: 1.2rem;
        }
    </style>
</head>
<body>
    <div class="auth-card">
        <div class="card-body">
            <div class="text-center mb-4">
                <div class="brand-logo mb-3">B</div>
                <h4 class="mb-1">Admin Login</h4>
                <p class="text-muted mb-0">Sign in to access the Blantyre District Council admin dashboard.</p>
            </div>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger"><?= esc(session()->getFlashdata('error')) ?></div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success"><?= esc(session()->getFlashdata('success')) ?></div>
            <?php endif; ?>

            <?php if (isset($validation)): ?>
                <div class="alert alert-danger">
                    <?= $validation->listErrors() ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="<?= base_url('login') ?>">
                <?= csrf_field() ?>

                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?= set_value('email') ?>" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">Sign In</button>
                </div>
            </form>

            <div class="text-center mt-4 text-muted">
                <small>Use your admin email and password to continue.</small>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
