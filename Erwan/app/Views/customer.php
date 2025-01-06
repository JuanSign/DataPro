<b>Foodmart</b>
<p>Data Customer Foodmart:</p>

<?php if (! empty($customer) && is_array($customer)): ?>
    <table>
        <tr>
            <th>fullname</th>
        </tr>
        <?php foreach ($customer as $customer_item): ?>
            <tr>
                <td><?= esc($customer_item->fullname)?></td>
            </tr> 
        <?php endforeach ?>
    </table>
<?php else: ?>
    <h3>Tidak ada data!</h3>
<?php endif ?>  