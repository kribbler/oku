<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Item'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Websites'), ['controller' => 'Websites', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Website'), ['controller' => 'Websites', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Materials'), ['controller' => 'Materials', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Material'), ['controller' => 'Materials', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Material Colors'), ['controller' => 'MaterialColors', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Material Color'), ['controller' => 'MaterialColors', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Surfaces'), ['controller' => 'Surfaces', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Surface'), ['controller' => 'Surfaces', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Diamond Colors'), ['controller' => 'DiamondColors', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Diamond Color'), ['controller' => 'DiamondColors', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Diamond Clarities'), ['controller' => 'DiamondClarities', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Diamond Clarity'), ['controller' => 'DiamondClarities', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Stones'), ['controller' => 'Stones', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Stone'), ['controller' => 'Stones', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Actions'), ['controller' => 'Actions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Action'), ['controller' => 'Actions', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Master Categories'), ['controller' => 'MasterCategories', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Master Category'), ['controller' => 'MasterCategories', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Genders'), ['controller' => 'Genders', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Gender'), ['controller' => 'Genders', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Occasions'), ['controller' => 'Occasions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Occasion'), ['controller' => 'Occasions', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Styles'), ['controller' => 'Styles', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Style'), ['controller' => 'Styles', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Chains'), ['controller' => 'Chains', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Chain'), ['controller' => 'Chains', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Clasps'), ['controller' => 'Clasps', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Clasp'), ['controller' => 'Clasps', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Metal And Colors'), ['controller' => 'MetalAndColors', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Metal And Color'), ['controller' => 'MetalAndColors', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Item Filter Metal And Colors'), ['controller' => 'ItemFilterMetalAndColors', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Item Filter Metal And Color'), ['controller' => 'ItemFilterMetalAndColors', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Item Filter Stones'), ['controller' => 'ItemFilterStones', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Item Filter Stone'), ['controller' => 'ItemFilterStones', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Item Lengths'), ['controller' => 'ItemLengths', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Item Length'), ['controller' => 'ItemLengths', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Item Metal And Colors'), ['controller' => 'ItemMetalAndColors', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Item Metal And Color'), ['controller' => 'ItemMetalAndColors', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Item Necklace Types'), ['controller' => 'ItemNecklaceTypes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Item Necklace Type'), ['controller' => 'ItemNecklaceTypes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Item Occasions'), ['controller' => 'ItemOccasions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Item Occasion'), ['controller' => 'ItemOccasions', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Item Stones'), ['controller' => 'ItemStones', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Item Stone'), ['controller' => 'ItemStones', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Item Tags'), ['controller' => 'ItemTags', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Item Tag'), ['controller' => 'ItemTags', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="items index large-9 medium-8 columns content">
    <h3><?= __('Items') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('website_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('changed_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('material_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('changed_material_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('material_color_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('changed_material_color_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('metalstamp') ?></th>
                <th scope="col"><?= $this->Paginator->sort('changed_metalstamp') ?></th>
                <th scope="col"><?= $this->Paginator->sort('other_stones') ?></th>
                <th scope="col"><?= $this->Paginator->sort('surface_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('changed_surface_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('diamond_abrasive') ?></th>
                <th scope="col"><?= $this->Paginator->sort('changed_diamond_abrasive') ?></th>
                <th scope="col"><?= $this->Paginator->sort('diamond_weight') ?></th>
                <th scope="col"><?= $this->Paginator->sort('changed_diamond_weight') ?></th>
                <th scope="col"><?= $this->Paginator->sort('diamond_color_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('changed_diamond_color_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('diamond_clarity_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('changed_diamond_clarity_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('diamond_number') ?></th>
                <th scope="col"><?= $this->Paginator->sort('changed_diamond_number') ?></th>
                <th scope="col"><?= $this->Paginator->sort('diamond_cut') ?></th>
                <th scope="col"><?= $this->Paginator->sort('changed_diamond_cut') ?></th>
                <th scope="col"><?= $this->Paginator->sort('stone_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('link') ?></th>
                <th scope="col"><?= $this->Paginator->sort('code') ?></th>
                <th scope="col"><?= $this->Paginator->sort('price') ?></th>
                <th scope="col"><?= $this->Paginator->sort('brand') ?></th>
                <th scope="col"><?= $this->Paginator->sort('changed_brand') ?></th>
                <th scope="col"><?= $this->Paginator->sort('image_small') ?></th>
                <th scope="col"><?= $this->Paginator->sort('image_processed') ?></th>
                <th scope="col"><?= $this->Paginator->sort('tags_processed') ?></th>
                <th scope="col"><?= $this->Paginator->sort('action_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('master_category_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('gender_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('changed_gender_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('designer') ?></th>
                <th scope="col"><?= $this->Paginator->sort('changed_designer') ?></th>
                <th scope="col"><?= $this->Paginator->sort('occasion_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('changed_occasion_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('comments') ?></th>
                <th scope="col"><?= $this->Paginator->sort('style_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('chain_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('clasp_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('height') ?></th>
                <th scope="col"><?= $this->Paginator->sort('has_length') ?></th>
                <th scope="col"><?= $this->Paginator->sort('metal_and_color_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('manual') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($items as $item): ?>
            <tr>
                <td><?= $this->Number->format($item->id) ?></td>
                <td><?= $item->has('website') ? $this->Html->link($item->website->name, ['controller' => 'Websites', 'action' => 'view', $item->website->id]) : '' ?></td>
                <td><?= h($item->name) ?></td>
                <td><?= h($item->changed_name) ?></td>
                <td><?= $item->has('material') ? $this->Html->link($item->material->name, ['controller' => 'Materials', 'action' => 'view', $item->material->id]) : '' ?></td>
                <td><?= $this->Number->format($item->changed_material_id) ?></td>
                <td><?= $item->has('material_color') ? $this->Html->link($item->material_color->name, ['controller' => 'MaterialColors', 'action' => 'view', $item->material_color->id]) : '' ?></td>
                <td><?= $this->Number->format($item->changed_material_color_id) ?></td>
                <td><?= $this->Number->format($item->metalstamp) ?></td>
                <td><?= $this->Number->format($item->changed_metalstamp) ?></td>
                <td><?= h($item->other_stones) ?></td>
                <td><?= $item->has('surface') ? $this->Html->link($item->surface->name, ['controller' => 'Surfaces', 'action' => 'view', $item->surface->id]) : '' ?></td>
                <td><?= $this->Number->format($item->changed_surface_id) ?></td>
                <td><?= h($item->diamond_abrasive) ?></td>
                <td><?= h($item->changed_diamond_abrasive) ?></td>
                <td><?= h($item->diamond_weight) ?></td>
                <td><?= h($item->changed_diamond_weight) ?></td>
                <td><?= $item->has('diamond_color') ? $this->Html->link($item->diamond_color->name, ['controller' => 'DiamondColors', 'action' => 'view', $item->diamond_color->id]) : '' ?></td>
                <td><?= $this->Number->format($item->changed_diamond_color_id) ?></td>
                <td><?= $item->has('diamond_clarity') ? $this->Html->link($item->diamond_clarity->name, ['controller' => 'DiamondClarities', 'action' => 'view', $item->diamond_clarity->id]) : '' ?></td>
                <td><?= $this->Number->format($item->changed_diamond_clarity_id) ?></td>
                <td><?= $this->Number->format($item->diamond_number) ?></td>
                <td><?= $this->Number->format($item->changed_diamond_number) ?></td>
                <td><?= h($item->diamond_cut) ?></td>
                <td><?= h($item->changed_diamond_cut) ?></td>
                <td><?= $item->has('stone') ? $this->Html->link($item->stone->name, ['controller' => 'Stones', 'action' => 'view', $item->stone->id]) : '' ?></td>
                <td><?= h($item->link) ?></td>
                <td><?= h($item->code) ?></td>
                <td><?= $this->Number->format($item->price) ?></td>
                <td><?= h($item->brand) ?></td>
                <td><?= h($item->changed_brand) ?></td>
                <td><?= h($item->image_small) ?></td>
                <td><?= h($item->image_processed) ?></td>
                <td><?= h($item->tags_processed) ?></td>
                <td><?= $item->has('action') ? $this->Html->link($item->action->id, ['controller' => 'Actions', 'action' => 'view', $item->action->id]) : '' ?></td>
                <td><?= $item->has('master_category') ? $this->Html->link($item->master_category->name, ['controller' => 'MasterCategories', 'action' => 'view', $item->master_category->id]) : '' ?></td>
                <td><?= $item->has('gender') ? $this->Html->link($item->gender->name, ['controller' => 'Genders', 'action' => 'view', $item->gender->id]) : '' ?></td>
                <td><?= $this->Number->format($item->changed_gender_id) ?></td>
                <td><?= h($item->designer) ?></td>
                <td><?= h($item->changed_designer) ?></td>
                <td><?= $item->has('occasion') ? $this->Html->link($item->occasion->name, ['controller' => 'Occasions', 'action' => 'view', $item->occasion->id]) : '' ?></td>
                <td><?= $this->Number->format($item->changed_occasion_id) ?></td>
                <td><?= h($item->comments) ?></td>
                <td><?= $item->has('style') ? $this->Html->link($item->style->name, ['controller' => 'Styles', 'action' => 'view', $item->style->id]) : '' ?></td>
                <td><?= $item->has('chain') ? $this->Html->link($item->chain->name, ['controller' => 'Chains', 'action' => 'view', $item->chain->id]) : '' ?></td>
                <td><?= $item->has('clasp') ? $this->Html->link($item->clasp->name, ['controller' => 'Clasps', 'action' => 'view', $item->clasp->id]) : '' ?></td>
                <td><?= h($item->height) ?></td>
                <td><?= h($item->has_length) ?></td>
                <td><?= $item->has('metal_and_color') ? $this->Html->link($item->metal_and_color->name, ['controller' => 'MetalAndColors', 'action' => 'view', $item->metal_and_color->id]) : '' ?></td>
                <td><?= h($item->manual) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $item->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $item->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $item->id], ['confirm' => __('Are you sure you want to delete # {0}?', $item->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
