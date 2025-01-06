<b>Edit Data Coba</b>
<?php if (session()->getFlashdata('error')): ?>
    <p style="color:red;"><?= session()->getFlashdata('error') ?></p>
<?php endif; ?>
<?php if (session()->getFlashdata('success')): ?>
    <p style="color:green;"><?= session()->getFlashdata('success') ?></p>
<?php endif; ?>

<form action="<?= base_url('coba/update/' . $coba->id) ?>" method="post">
    <label for="id">ID:</label>
    <span><?= esc($coba->id) ?></span>
    <br>
    <label for="value">Value:</label>
    <input type="text" name="value" id="value" value="<?= esc($coba->value) ?>" required>
    <br>
    <button type="submit">Update</button>
</form>
<a href="<?= base_url('coba') ?>">Cancel</a>
