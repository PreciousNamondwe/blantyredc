<?= $this->extend('templates/layout.php') ?>

<?= $this->section('content') ?>

<div class="max-w-4xl mx-auto my-12 p-8 bg-white border border-slate-200 shadow-2xl rounded-2xl">
    <div class="border-b border-slate-200 pb-6 mb-6 text-center">
        <h1 class="text-3xl font-extrabold text-indigo-900 tracking-tight">Blantyre District Council</h1>
        <p class="text-slate-500 mt-2 text-sm font-medium">Digital Business Operation License Application Form Pipeline</p>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-900 rounded-lg text-sm font-bold">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="mb-6 p-4 bg-rose-50 border border-rose-200 text-rose-900 rounded-lg text-sm font-semibold">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <form action="<?= base_url('business-license/submit') ?>" method="POST" enctype="multipart/form-data" class="space-y-6">
        <?= csrf_field() ?>

        <div class="bg-indigo-50 p-4 rounded-xl grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-bold text-indigo-900 uppercase tracking-wider mb-1">Application Request Type *</label>
                <select name="application_type" class="w-full border border-slate-300 rounded-lg p-2 bg-white font-medium" required>
                    <option value="new">New Business Operation Startup</option>
                    <option value="renewal">Annual Statutory License Renewal</option>
                    <option value="amendment">Structure or Ownership Amendment Modification</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-bold text-indigo-900 uppercase tracking-wider mb-1">Bylaw Business Category Class *</label>
                <select name="business_category" class="w-full border border-slate-300 rounded-lg p-2 bg-white font-medium" required>
                    <option value="General Commerce">General Commerce / Retail Trade Shop</option>
                    <option value="Hospitality">Hospitality / Rest Houses, Bars & Lodges</option>
                    <option value="Manufacturing">Manufacturing & Processing (Maize Mill, Workshops)</option>
                    <option value="Liquor Premises">Liquor Outlets & Entertainment Establishments</option>
                </select>
            </div>
        </div>

        <h2 class="text-base font-bold text-slate-700 uppercase tracking-wider border-b pb-2">1. Enterprise Identity Configuration</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold mb-1">Official Registered Business Name *</label>
                <input type="text" name="business_name" class="w-full border rounded-lg p-2 bg-white" placeholder="e.g., Linthipe Agro Traders" required>
            </div>
            <div>
                <label class="block text-sm font-semibold mb-1">Trading Name (If alternative DBA exists)</label>
                <input type="text" name="trading_name" class="w-full border rounded-lg p-2 bg-white" placeholder="e.g., Chikondi Agro-Inputs Wholesale">
            </div>
            <div class="md:col-span-2">
                <label class="block text-sm font-semibold mb-1">Detailed Business Activity Type *</label>
                <input type="text" name="business_type" class="w-full border rounded-lg p-2 bg-white" placeholder="e.g., Retail Distribution of Hybrid Seeds and Farm Inputs" required>
            </div>
        </div>

        <h2 class="text-base font-bold text-slate-700 uppercase tracking-wider border-b pb-2">2. Proprietor Demographics & Identity</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold mb-1">Full Legal Owner Name *</label>
                <input type="text" name="owner_name" class="w-full border rounded-lg p-2 bg-white" required>
            </div>
            <div>
                <label class="block text-sm font-semibold mb-1">Malawi National ID Number (NID) *</label>
                <input type="text" name="owner_national_id" minlength="8" maxlength="20" class="w-full border rounded-lg p-2 bg-white placeholder-slate-400" placeholder="e.g., BM74920K" required>
            </div>
            <div>
                <label class="block text-sm font-semibold mb-1">Primary Mobile Contact *</label>
                <input type="text" name="owner_phone" class="w-full border rounded-lg p-2 bg-white" placeholder="e.g., +265888123456" required>
            </div>
            <div>
                <label class="block text-sm font-semibold mb-1">Owner Email Address</label>
                <input type="email" name="owner_email" class="w-full border rounded-lg p-2 bg-white" placeholder="optional">
            </div>
            <div class="md:col-span-2 bg-amber-50 p-4 border border-amber-200 rounded-xl">
                <label class="block text-sm font-bold text-amber-950 mb-1">Upload National ID Image Copy (Scan/Clear Photo) *</label>
                <p class="text-xs text-amber-700 mb-2">Required document proof to finalize verification. Allowed system extensions: JPG, PNG, PDF.</p>
                <input type="file" name="owner_id_image" class="w-full bg-white border border-amber-200 p-2 rounded-lg text-sm" required>
            </div>
        </div>

        <h2 class="text-base font-bold text-slate-700 uppercase tracking-wider border-b pb-2">3. Geographical Demarcation Location</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-semibold mb-1">Traditional Authority (T/A) *</label>
                <input type="text" name="traditional_authority" class="w-full border rounded-lg p-2 bg-white" placeholder="e.g., T/A Kapeni" required>
            </div>
            <div>
                <label class="block text-sm font-semibold mb-1">Village or Market Area *</label>
                <input type="text" name="village_or_area" class="w-full border rounded-lg p-2 bg-white" placeholder="e.g., Lunzu Market Centre" required>
            </div>
            <div>
                <label class="block text-sm font-semibold mb-1">Plot Number (Urban layouts)</label>
                <input type="text" name="plot_number" class="w-full border rounded-lg p-2 bg-white" placeholder="e.g., Plot 102/4 Area B">
            </div>
            <div class="md:col-span-3">
                <label class="block text-sm font-semibold mb-1">Descriptive Physical Landmark Location Directions *</label>
                <textarea name="physical_address" rows="2" class="w-full border rounded-lg p-2 bg-white" placeholder="Provide distinct geographical directions relative to accessible trade roads..." required></textarea>
            </div>
        </div>

        <h2 class="text-base font-bold text-slate-700 uppercase tracking-wider border-b pb-2">4. Revenue and Corporate Registries Verification</h2>
        <div class="p-4 bg-slate-100 border border-slate-200 rounded-xl">
            <div class="flex items-center mb-3">
                <input type="checkbox" id="is_formal_sector" name="is_formal_sector" class="h-4 w-4 text-indigo-600 rounded border-slate-300 focus:ring-indigo-500" onclick="toggleFormalFields()">
                <label for="is_formal_sector" class="ml-2 block text-sm font-bold text-slate-900">This enterprise belongs to the Formal Corporate Sector</label>
            </div>
            
            <div id="formal_fields_block" class="hidden grid grid-cols-1 md:grid-cols-3 gap-4 mt-3 pt-3 border-t border-slate-200">
                <div>
                    <label class="block text-sm font-semibold mb-1">MBRS Registration Number</label>
                    <input type="text" id="mbrs_registration_number" name="mbrs_registration_number" class="w-full border rounded-lg p-2 bg-white" placeholder="Registrar General Serial">
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-1">Malawi Revenue Authority TPIN</label>
                    <input type="text" id="mra_tpin" name="mra_tpin" class="w-full border rounded-lg p-2 bg-white" placeholder="MRA Tax Identification Code">
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-1">Estimated Annual Turnover (MWK)</label>
                    <input type="number" step="0.01" name="estimated_annual_turnover" class="w-full border rounded-lg p-2 bg-white" value="0.00">
                </div>
            </div>
        </div>

        <div class="pt-4 text-center">
            <button type="submit" class="w-full md:w-auto bg-indigo-900 text-white font-bold py-3 px-12 rounded-xl shadow-lg hover:bg-indigo-800 transition-all cursor-pointer transform hover:-translate-y-0.5">
                Submit Digital Application to Council System
            </button>
        </div>
    </form>
</div>

<script>
    function toggleFormalFields() {
        const isChecked = document.getElementById('is_formal_sector').checked;
        const targetContainer = document.getElementById('formal_fields_block');
        const mbrsField = document.getElementById('mbrs_registration_number');
        const mraField = document.getElementById('mra_tpin');

        if (isChecked) {
            targetContainer.classList.remove('hidden');
            mbrsField.setAttribute('required', 'required');
            mraField.setAttribute('required', 'required');
        } else {
            targetContainer.classList.add('hidden');
            mbrsField.removeAttribute('required');
            mraField.removeAttribute('required');
            mbrsField.value = '';
            mraField.value = '';
        }
    }
</script>

<?= $this->endSection() ?>