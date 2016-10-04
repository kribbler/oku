<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Jewelry'), ['action' => 'edit', $jewelry->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Jewelry'), ['action' => 'delete', $jewelry->id], ['confirm' => __('Are you sure you want to delete # {0}?', $jewelry->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Jewelries'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Jewelry'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="jewelries view large-9 medium-8 columns content">
    <h3><?= h($jewelry->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($jewelry->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Description') ?></th>
            <td><?= h($jewelry->description) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($jewelry->id) ?></td>
        </tr>
    </table>
</div>
