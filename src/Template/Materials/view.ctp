<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Material'), ['action' => 'edit', $material->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Material'), ['action' => 'delete', $material->id], ['confirm' => __('Are you sure you want to delete # {0}?', $material->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Materials'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Material'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Items'), ['controller' => 'Items', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Item'), ['controller' => 'Items', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="materials view large-9 medium-8 columns content">
    <h3><?= h($material->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($material->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($material->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Items') ?></h4>
        <?php if (!empty($material->items)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Website Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Changed Name') ?></th>
                <th scope="col"><?= __('Description') ?></th>
                <th scope="col"><?= __('Changed Description') ?></th>
                <th scope="col"><?= __('Material Id') ?></th>
                <th scope="col"><?= __('Changed Material Id') ?></th>
                <th scope="col"><?= __('Material Color Id') ?></th>
                <th scope="col"><?= __('Changed Material Color Id') ?></th>
                <th scope="col"><?= __('Metalstamp') ?></th>
                <th scope="col"><?= __('Changed Metalstamp') ?></th>
                <th scope="col"><?= __('Other Stones') ?></th>
                <th scope="col"><?= __('Surface Id') ?></th>
                <th scope="col"><?= __('Changed Surface Id') ?></th>
                <th scope="col"><?= __('Diamond Abrasive') ?></th>
                <th scope="col"><?= __('Changed Diamond Abrasive') ?></th>
                <th scope="col"><?= __('Diamond Weight') ?></th>
                <th scope="col"><?= __('Changed Diamond Weight') ?></th>
                <th scope="col"><?= __('Diamond Color Id') ?></th>
                <th scope="col"><?= __('Changed Diamond Color Id') ?></th>
                <th scope="col"><?= __('Diamond Clarity Id') ?></th>
                <th scope="col"><?= __('Changed Diamond Clarity Id') ?></th>
                <th scope="col"><?= __('Diamond Number') ?></th>
                <th scope="col"><?= __('Changed Diamond Number') ?></th>
                <th scope="col"><?= __('Diamond Cut') ?></th>
                <th scope="col"><?= __('Changed Diamond Cut') ?></th>
                <th scope="col"><?= __('Stone Id') ?></th>
                <th scope="col"><?= __('Link') ?></th>
                <th scope="col"><?= __('Code') ?></th>
                <th scope="col"><?= __('Price') ?></th>
                <th scope="col"><?= __('Brand') ?></th>
                <th scope="col"><?= __('Changed Brand') ?></th>
                <th scope="col"><?= __('Image Small') ?></th>
                <th scope="col"><?= __('Image Processed') ?></th>
                <th scope="col"><?= __('Tags Processed') ?></th>
                <th scope="col"><?= __('Action Id') ?></th>
                <th scope="col"><?= __('Master Category Id') ?></th>
                <th scope="col"><?= __('Gender Id') ?></th>
                <th scope="col"><?= __('Changed Gender Id') ?></th>
                <th scope="col"><?= __('Designer') ?></th>
                <th scope="col"><?= __('Changed Designer') ?></th>
                <th scope="col"><?= __('Occasion Id') ?></th>
                <th scope="col"><?= __('Changed Occasion Id') ?></th>
                <th scope="col"><?= __('Comments') ?></th>
                <th scope="col"><?= __('Style Id') ?></th>
                <th scope="col"><?= __('Chain Id') ?></th>
                <th scope="col"><?= __('Clasp Id') ?></th>
                <th scope="col"><?= __('Height') ?></th>
                <th scope="col"><?= __('Has Length') ?></th>
                <th scope="col"><?= __('Metal And Color Id') ?></th>
                <th scope="col"><?= __('Manual') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($material->items as $items): ?>
            <tr>
                <td><?= h($items->id) ?></td>
                <td><?= h($items->website_id) ?></td>
                <td><?= h($items->name) ?></td>
                <td><?= h($items->changed_name) ?></td>
                <td><?= h($items->description) ?></td>
                <td><?= h($items->changed_description) ?></td>
                <td><?= h($items->material_id) ?></td>
                <td><?= h($items->changed_material_id) ?></td>
                <td><?= h($items->material_color_id) ?></td>
                <td><?= h($items->changed_material_color_id) ?></td>
                <td><?= h($items->metalstamp) ?></td>
                <td><?= h($items->changed_metalstamp) ?></td>
                <td><?= h($items->other_stones) ?></td>
                <td><?= h($items->surface_id) ?></td>
                <td><?= h($items->changed_surface_id) ?></td>
                <td><?= h($items->diamond_abrasive) ?></td>
                <td><?= h($items->changed_diamond_abrasive) ?></td>
                <td><?= h($items->diamond_weight) ?></td>
                <td><?= h($items->changed_diamond_weight) ?></td>
                <td><?= h($items->diamond_color_id) ?></td>
                <td><?= h($items->changed_diamond_color_id) ?></td>
                <td><?= h($items->diamond_clarity_id) ?></td>
                <td><?= h($items->changed_diamond_clarity_id) ?></td>
                <td><?= h($items->diamond_number) ?></td>
                <td><?= h($items->changed_diamond_number) ?></td>
                <td><?= h($items->diamond_cut) ?></td>
                <td><?= h($items->changed_diamond_cut) ?></td>
                <td><?= h($items->stone_id) ?></td>
                <td><?= h($items->link) ?></td>
                <td><?= h($items->code) ?></td>
                <td><?= h($items->price) ?></td>
                <td><?= h($items->brand) ?></td>
                <td><?= h($items->changed_brand) ?></td>
                <td><?= h($items->image_small) ?></td>
                <td><?= h($items->image_processed) ?></td>
                <td><?= h($items->tags_processed) ?></td>
                <td><?= h($items->action_id) ?></td>
                <td><?= h($items->master_category_id) ?></td>
                <td><?= h($items->gender_id) ?></td>
                <td><?= h($items->changed_gender_id) ?></td>
                <td><?= h($items->designer) ?></td>
                <td><?= h($items->changed_designer) ?></td>
                <td><?= h($items->occasion_id) ?></td>
                <td><?= h($items->changed_occasion_id) ?></td>
                <td><?= h($items->comments) ?></td>
                <td><?= h($items->style_id) ?></td>
                <td><?= h($items->chain_id) ?></td>
                <td><?= h($items->clasp_id) ?></td>
                <td><?= h($items->height) ?></td>
                <td><?= h($items->has_length) ?></td>
                <td><?= h($items->metal_and_color_id) ?></td>
                <td><?= h($items->manual) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Items', 'action' => 'view', $items->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Items', 'action' => 'edit', $items->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Items', 'action' => 'delete', $items->id], ['confirm' => __('Are you sure you want to delete # {0}?', $items->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
