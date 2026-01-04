<div class="content_inner">
    
    <h1>Payment</h1>
    <table class="table-bordered">
            <tr>
                <th>Id</th>
                <th>Title</th>
                <th>Created</th>
            </tr>
    
            <!-- Here is where we iterate through our $articles query object, printing out article info -->
    
        <?php foreach ($Payment as $a): ?>
            <tr>
                <td><?= $a->VCH_ID ?></td>
                <td>
                    <?= $this->Html->link($a->VCH_AMOUNT, ['action' => 'view', $a->VCH_ID]) ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>   