<b>Add Data Coba</b>
<?php if (session()->getFlashdata('error')): ?>
    <p style="color:red;"><?= session()->getFlashdata('error') ?></p>
<?php endif; ?>
<?php if (session()->getFlashdata('success')): ?>
    <p style="color:green;"><?= session()->getFlashdata('success') ?></p>
<?php endif; ?>

<form action="<?= base_url('coba/add') ?>" method="post">
    <?= csrf_field() ?>
    <label for="value">Value:</label>
    <input type="text" name="value" id="value" required>
    <br>
    <button type="submit">Add</button>
</form>
<a href="<?= base_url('coba') ?>">Cancel</a>
