<a href="<?= base_url('coba/add') ?>">Add Data</a>
<br><br>
<?php if (!empty($coba) && is_array($coba)): ?>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Value</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($coba as $coba_item): ?>
            <tr>
                <td><?= esc($coba_item->id) ?></td>
                <td><?= esc($coba_item->value) ?></td>
                <td>
                    <!-- Tombol Edit -->
                    <a href="<?= base_url('coba/edit/' . $coba_item->id) ?>">Edit</a> |
                    <!-- Tombol Delete -->
                    <a href="<?= base_url('coba/delete/' . $coba_item->id) ?>" 
                    onclick="return confirm('Are you sure you want to delete this item?');">
                    Delete
                    </a>
                </td>
            </tr>
        <?php endforeach ?>
    </table>
<?php else: ?>
    <h3>No data available!</h3>
<?php endif ?>
