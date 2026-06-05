<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($application['reference_number']) ?> - Application PDF</title>
    <style>
        body {
            color: #1f2933;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 13px;
            line-height: 1.45;
            margin: 0;
            background: #eef2f5;
        }
        .toolbar {
            background: #263238;
            padding: 12px 24px;
            position: sticky;
            top: 0;
        }
        .toolbar a,
        .toolbar button {
            background: #fff;
            border: 0;
            border-radius: 4px;
            color: #263238;
            cursor: pointer;
            display: inline-block;
            font-weight: 700;
            margin-right: 8px;
            padding: 8px 12px;
            text-decoration: none;
        }
        .page {
            background: #fff;
            box-shadow: 0 8px 24px rgba(15, 23, 42, 0.12);
            margin: 24px auto;
            max-width: 820px;
            padding: 36px 44px;
        }
        .header {
            border-bottom: 3px solid #1b5e20;
            display: flex;
            justify-content: space-between;
            gap: 24px;
            padding-bottom: 18px;
        }
        h1, h2, h3 { margin: 0; }
        h1 { color: #1b5e20; font-size: 22px; }
        h2 { font-size: 17px; margin-top: 24px; border-bottom: 1px solid #d9e2ec; padding-bottom: 6px; }
        .meta { text-align: right; }
        .badge {
            border: 1px solid #94a3b8;
            border-radius: 999px;
            display: inline-block;
            font-weight: 700;
            margin-top: 6px;
            padding: 4px 10px;
            text-transform: uppercase;
        }
        .grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 10px 18px;
            margin-top: 12px;
        }
        .item {
            border: 1px solid #d9e2ec;
            border-radius: 4px;
            padding: 10px;
            min-height: 44px;
            page-break-inside: avoid;
        }
        .label {
            color: #52606d;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.03em;
            text-transform: uppercase;
        }
        .value { margin-top: 4px; word-break: break-word; }
        .documents table {
            border-collapse: collapse;
            margin-top: 12px;
            width: 100%;
        }
        .documents th,
        .documents td {
            border: 1px solid #d9e2ec;
            padding: 8px;
            text-align: left;
        }
        .signature-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 32px;
            margin-top: 48px;
            page-break-inside: avoid;
        }
        .signature {
            border-top: 1px solid #1f2933;
            padding-top: 8px;
        }
        @media print {
            body { background: #fff; }
            .toolbar { display: none; }
            .page {
                box-shadow: none;
                margin: 0;
                max-width: none;
                padding: 0;
            }
            h2, .item, tr { break-inside: avoid; page-break-inside: avoid; }
            @page { margin: 16mm; }
        }
    </style> 
</head>
<body>
    <div class="toolbar">
        <button onclick="window.print()">Print / Save as PDF</button>
        <a href="<?= base_url('admin/applications/' . $application['id']) ?>">Back to Details</a>
    </div>

    <main class="page">
        <section class="header">
            <div>
                <h1>Blantyre District Council</h1>
                <h3><?= esc($application['service']['service_name'] ?? 'Application') ?> Application</h3>
                <p>Official application record</p>
            </div>
            <div class="meta">
                <div><strong>Reference:</strong> <?= esc($application['reference_number']) ?></div>
                <div><strong>Date:</strong> <?= date('M j, Y H:i', strtotime($application['created_at'])) ?></div>
                <span class="badge"><?= esc(str_replace('_', ' ', $application['status'])) ?></span>
            </div>
        </section>

        <h2>Application Summary</h2>
        <div class="grid">
            <div class="item">
                <div class="label">Service</div>
                <div class="value"><?= esc($application['service']['service_name'] ?? $application['service_key']) ?></div>
            </div>
            <div class="item">
                <div class="label">Priority</div>
                <div class="value"><?= esc(ucfirst($application['priority'])) ?></div>
            </div>
            <div class="item">
                <div class="label">Submitted At</div>
                <div class="value"><?= esc($application['submitted_at'] ?: $application['created_at']) ?></div>
            </div>
            <div class="item">
                <div class="label">Assigned To</div>
                <div class="value"><?= esc($application['assigned_user']['full_name'] ?? 'Unassigned') ?></div>
            </div>
        </div>

        <?php foreach (($application['application_data'] ?? []) as $section => $data): ?>
            <h2><?= esc(ucfirst(str_replace('_', ' ', $section))) ?></h2>
            <div class="grid">
                <?php foreach ($data as $key => $value): ?>
                    <div class="item">
                        <div class="label"><?= esc(ucfirst(str_replace('_', ' ', $key))) ?></div>
                        <div class="value">
                            <?php if (is_array($value)): ?>
                                <?php foreach ($value as $subKey => $subValue): ?>
                                    <div>
                                        <strong><?= esc(ucfirst(str_replace('_', ' ', $subKey))) ?>:</strong>
                                        <?php if (is_array($subValue)): ?>
                                            <pre><?= esc(json_encode($subValue, JSON_PRETTY_PRINT)) ?></pre>
                                        <?php else: ?>
                                            <?= esc($subValue) ?>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <?= esc($value) ?>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>

        <?php if (!empty($application['documents'])): ?>
            <section class="documents">
                <h2>Submitted Documents</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Document Type</th>
                            <th>File Name</th>
                            <th>Size</th>
                            <th>Uploaded</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($application['documents'] as $document): ?>
                            <tr>
                                <td><?= esc($document['document_type']) ?></td>
                                <td><?= esc($document['file_name']) ?></td>
                                <td><?= number_format($document['file_size'] / 1024, 1) ?> KB</td>
                                <td><?= date('M j, Y', strtotime($document['uploaded_at'])) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </section>
        <?php endif; ?>

        <div class="signature-row">
            <div class="signature">Applicant Signature</div>
            <div class="signature">Council Officer Signature</div>
        </div>
    </main>

    <script>
        window.addEventListener('load', () => {
            if (new URLSearchParams(window.location.search).get('print') === '1') {
                window.print();
            }
        });
    </script>
</body>
</html>
