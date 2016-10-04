<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Item'), ['action' => 'edit', $item->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Item'), ['action' => 'delete', $item->id], ['confirm' => __('Are you sure you want to delete # {0}?', $item->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Items'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Item'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Websites'), ['controller' => 'Websites', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Website'), ['controller' => 'Websites', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Materials'), ['controller' => 'Materials', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Material'), ['controller' => 'Materials', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Material Colors'), ['controller' => 'MaterialColors', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Material Color'), ['controller' => 'MaterialColors', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Surfaces'), ['controller' => 'Surfaces', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Surface'), ['controller' => 'Surfaces', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Diamond Colors'), ['controller' => 'DiamondColors', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Diamond Color'), ['controller' => 'DiamondColors', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Diamond Clarities'), ['controller' => 'DiamondClarities', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Diamond Clarity'), ['controller' => 'DiamondClarities', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Stones'), ['controller' => 'Stones', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Stone'), ['controller' => 'Stones', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Actions'), ['controller' => 'Actions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Action'), ['controller' => 'Actions', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Master Categories'), ['controller' => 'MasterCategories', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Master Category'), ['controller' => 'MasterCategories', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Genders'), ['controller' => 'Genders', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Gender'), ['controller' => 'Genders', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Occasions'), ['controller' => 'Occasions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Occasion'), ['controller' => 'Occasions', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Styles'), ['controller' => 'Styles', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Style'), ['controller' => 'Styles', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Chains'), ['controller' => 'Chains', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Chain'), ['controller' => 'Chains', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Clasps'), ['controller' => 'Clasps', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Clasp'), ['controller' => 'Clasps', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Metal And Colors'), ['controller' => 'MetalAndColors', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Metal And Color'), ['controller' => 'MetalAndColors', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Item Filter Metal And Colors'), ['controller' => 'ItemFilterMetalAndColors', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Item Filter Metal And Color'), ['controller' => 'ItemFilterMetalAndColors', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Item Filter Stones'), ['controller' => 'ItemFilterStones', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Item Filter Stone'), ['controller' => 'ItemFilterStones', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Item Lengths'), ['controller' => 'ItemLengths', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Item Length'), ['controller' => 'ItemLengths', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Item Metal And Colors'), ['controller' => 'ItemMetalAndColors', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Item Metal And Color'), ['controller' => 'ItemMetalAndColors', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Item Necklace Types'), ['controller' => 'ItemNecklaceTypes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Item Necklace Type'), ['controller' => 'ItemNecklaceTypes', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Item Occasions'), ['controller' => 'ItemOccasions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Item Occasion'), ['controller' => 'ItemOccasions', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Item Stones'), ['controller' => 'ItemStones', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Item Stone'), ['controller' => 'ItemStones', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Item Tags'), ['controller' => 'ItemTags', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Item Tag'), ['controller' => 'ItemTags', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="items view large-9 medium-8 columns content">
    <h3><?= h($item->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Website') ?></th>
            <td><?= $item->has('website') ? $this->Html->link($item->website->name, ['controller' => 'Websites', 'action' => 'view', $item->website->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($item->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Changed Name') ?></th>
            <td><?= h($item->changed_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Material') ?></th>
            <td><?= $item->has('material') ? $this->Html->link($item->material->name, ['controller' => 'Materials', 'action' => 'view', $item->material->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Material Color') ?></th>
            <td><?= $item->has('material_color') ? $this->Html->link($item->material_color->name, ['controller' => 'MaterialColors', 'action' => 'view', $item->material_color->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Other Stones') ?></th>
            <td><?= h($item->other_stones) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Surface') ?></th>
            <td><?= $item->has('surface') ? $this->Html->link($item->surface->name, ['controller' => 'Surfaces', 'action' => 'view', $item->surface->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Diamond Abrasive') ?></th>
            <td><?= h($item->diamond_abrasive) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Changed Diamond Abrasive') ?></th>
            <td><?= h($item->changed_diamond_abrasive) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Diamond Weight') ?></th>
            <td><?= h($item->diamond_weight) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Changed Diamond Weight') ?></th>
            <td><?= h($item->changed_diamond_weight) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Diamond Color') ?></th>
            <td><?= $item->has('diamond_color') ? $this->Html->link($item->diamond_color->name, ['controller' => 'DiamondColors', 'action' => 'view', $item->diamond_color->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Diamond Clarity') ?></th>
            <td><?= $item->has('diamond_clarity') ? $this->Html->link($item->diamond_clarity->name, ['controller' => 'DiamondClarities', 'action' => 'view', $item->diamond_clarity->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Diamond Cut') ?></th>
            <td><?= h($item->diamond_cut) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Changed Diamond Cut') ?></th>
            <td><?= h($item->changed_diamond_cut) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Stone') ?></th>
            <td><?= $item->has('stone') ? $this->Html->link($item->stone->name, ['controller' => 'Stones', 'action' => 'view', $item->stone->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Link') ?></th>
            <td><?= h($item->link) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Code') ?></th>
            <td><?= h($item->code) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Brand') ?></th>
            <td><?= h($item->brand) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Changed Brand') ?></th>
            <td><?= h($item->changed_brand) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Image Small') ?></th>
            <td><?= h($item->image_small) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Action') ?></th>
            <td><?= $item->has('action') ? $this->Html->link($item->action->id, ['controller' => 'Actions', 'action' => 'view', $item->action->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Master Category') ?></th>
            <td><?= $item->has('master_category') ? $this->Html->link($item->master_category->name, ['controller' => 'MasterCategories', 'action' => 'view', $item->master_category->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Gender') ?></th>
            <td><?= $item->has('gender') ? $this->Html->link($item->gender->name, ['controller' => 'Genders', 'action' => 'view', $item->gender->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Designer') ?></th>
            <td><?= h($item->designer) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Changed Designer') ?></th>
            <td><?= h($item->changed_designer) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Occasion') ?></th>
            <td><?= $item->has('occasion') ? $this->Html->link($item->occasion->name, ['controller' => 'Occasions', 'action' => 'view', $item->occasion->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Comments') ?></th>
            <td><?= h($item->comments) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Style') ?></th>
            <td><?= $item->has('style') ? $this->Html->link($item->style->name, ['controller' => 'Styles', 'action' => 'view', $item->style->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Chain') ?></th>
            <td><?= $item->has('chain') ? $this->Html->link($item->chain->name, ['controller' => 'Chains', 'action' => 'view', $item->chain->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Clasp') ?></th>
            <td><?= $item->has('clasp') ? $this->Html->link($item->clasp->name, ['controller' => 'Clasps', 'action' => 'view', $item->clasp->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Height') ?></th>
            <td><?= h($item->height) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Metal And Color') ?></th>
            <td><?= $item->has('metal_and_color') ? $this->Html->link($item->metal_and_color->name, ['controller' => 'MetalAndColors', 'action' => 'view', $item->metal_and_color->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($item->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Changed Material Id') ?></th>
            <td><?= $this->Number->format($item->changed_material_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Changed Material Color Id') ?></th>
            <td><?= $this->Number->format($item->changed_material_color_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Metalstamp') ?></th>
            <td><?= $this->Number->format($item->metalstamp) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Changed Metalstamp') ?></th>
            <td><?= $this->Number->format($item->changed_metalstamp) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Changed Surface Id') ?></th>
            <td><?= $this->Number->format($item->changed_surface_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Changed Diamond Color Id') ?></th>
            <td><?= $this->Number->format($item->changed_diamond_color_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Changed Diamond Clarity Id') ?></th>
            <td><?= $this->Number->format($item->changed_diamond_clarity_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Diamond Number') ?></th>
            <td><?= $this->Number->format($item->diamond_number) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Changed Diamond Number') ?></th>
            <td><?= $this->Number->format($item->changed_diamond_number) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Price') ?></th>
            <td><?= $this->Number->format($item->price) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Changed Gender Id') ?></th>
            <td><?= $this->Number->format($item->changed_gender_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Changed Occasion Id') ?></th>
            <td><?= $this->Number->format($item->changed_occasion_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Image Processed') ?></th>
            <td><?= $item->image_processed ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Tags Processed') ?></th>
            <td><?= $item->tags_processed ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Has Length') ?></th>
            <td><?= $item->has_length ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Manual') ?></th>
            <td><?= $item->manual ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($item->description)); ?>
    </div>
    <div class="row">
        <h4><?= __('Changed Description') ?></h4>
        <?= $this->Text->autoParagraph(h($item->changed_description)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Item Filter Metal And Colors') ?></h4>
        <?php if (!empty($item->item_filter_metal_and_colors)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Item Id') ?></th>
                <th scope="col"><?= __('Filter Metal And Color Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($item->item_filter_metal_and_colors as $itemFilterMetalAndColors): ?>
            <tr>
                <td><?= h($itemFilterMetalAndColors->id) ?></td>
                <td><?= h($itemFilterMetalAndColors->item_id) ?></td>
                <td><?= h($itemFilterMetalAndColors->filter_metal_and_color_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'ItemFilterMetalAndColors', 'action' => 'view', $itemFilterMetalAndColors->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'ItemFilterMetalAndColors', 'action' => 'edit', $itemFilterMetalAndColors->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'ItemFilterMetalAndColors', 'action' => 'delete', $itemFilterMetalAndColors->id], ['confirm' => __('Are you sure you want to delete # {0}?', $itemFilterMetalAndColors->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Item Filter Stones') ?></h4>
        <?php if (!empty($item->item_filter_stones)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Item Id') ?></th>
                <th scope="col"><?= __('Filter Stone Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($item->item_filter_stones as $itemFilterStones): ?>
            <tr>
                <td><?= h($itemFilterStones->id) ?></td>
                <td><?= h($itemFilterStones->item_id) ?></td>
                <td><?= h($itemFilterStones->filter_stone_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'ItemFilterStones', 'action' => 'view', $itemFilterStones->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'ItemFilterStones', 'action' => 'edit', $itemFilterStones->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'ItemFilterStones', 'action' => 'delete', $itemFilterStones->id], ['confirm' => __('Are you sure you want to delete # {0}?', $itemFilterStones->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Item Lengths') ?></h4>
        <?php if (!empty($item->item_lengths)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Item Id') ?></th>
                <th scope="col"><?= __('Length Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($item->item_lengths as $itemLengths): ?>
            <tr>
                <td><?= h($itemLengths->id) ?></td>
                <td><?= h($itemLengths->item_id) ?></td>
                <td><?= h($itemLengths->length_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'ItemLengths', 'action' => 'view', $itemLengths->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'ItemLengths', 'action' => 'edit', $itemLengths->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'ItemLengths', 'action' => 'delete', $itemLengths->id], ['confirm' => __('Are you sure you want to delete # {0}?', $itemLengths->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Item Metal And Colors') ?></h4>
        <?php if (!empty($item->item_metal_and_colors)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Item Id') ?></th>
                <th scope="col"><?= __('Metal And Color Id') ?></th>
                <th scope="col"><?= __('Changed') ?></th>
                <th scope="col"><?= __('Deleted') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($item->item_metal_and_colors as $itemMetalAndColors): ?>
            <tr>
                <td><?= h($itemMetalAndColors->id) ?></td>
                <td><?= h($itemMetalAndColors->item_id) ?></td>
                <td><?= h($itemMetalAndColors->metal_and_color_id) ?></td>
                <td><?= h($itemMetalAndColors->changed) ?></td>
                <td><?= h($itemMetalAndColors->deleted) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'ItemMetalAndColors', 'action' => 'view', $itemMetalAndColors->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'ItemMetalAndColors', 'action' => 'edit', $itemMetalAndColors->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'ItemMetalAndColors', 'action' => 'delete', $itemMetalAndColors->id], ['confirm' => __('Are you sure you want to delete # {0}?', $itemMetalAndColors->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Item Necklace Types') ?></h4>
        <?php if (!empty($item->item_necklace_types)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Item Id') ?></th>
                <th scope="col"><?= __('Necklace Type Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($item->item_necklace_types as $itemNecklaceTypes): ?>
            <tr>
                <td><?= h($itemNecklaceTypes->id) ?></td>
                <td><?= h($itemNecklaceTypes->item_id) ?></td>
                <td><?= h($itemNecklaceTypes->necklace_type_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'ItemNecklaceTypes', 'action' => 'view', $itemNecklaceTypes->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'ItemNecklaceTypes', 'action' => 'edit', $itemNecklaceTypes->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'ItemNecklaceTypes', 'action' => 'delete', $itemNecklaceTypes->id], ['confirm' => __('Are you sure you want to delete # {0}?', $itemNecklaceTypes->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Item Occasions') ?></h4>
        <?php if (!empty($item->item_occasions)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Item Id') ?></th>
                <th scope="col"><?= __('Occasion Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($item->item_occasions as $itemOccasions): ?>
            <tr>
                <td><?= h($itemOccasions->id) ?></td>
                <td><?= h($itemOccasions->item_id) ?></td>
                <td><?= h($itemOccasions->occasion_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'ItemOccasions', 'action' => 'view', $itemOccasions->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'ItemOccasions', 'action' => 'edit', $itemOccasions->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'ItemOccasions', 'action' => 'delete', $itemOccasions->id], ['confirm' => __('Are you sure you want to delete # {0}?', $itemOccasions->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Item Stones') ?></h4>
        <?php if (!empty($item->item_stones)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Item Id') ?></th>
                <th scope="col"><?= __('Stone Id') ?></th>
                <th scope="col"><?= __('Changed') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($item->item_stones as $itemStones): ?>
            <tr>
                <td><?= h($itemStones->id) ?></td>
                <td><?= h($itemStones->item_id) ?></td>
                <td><?= h($itemStones->stone_id) ?></td>
                <td><?= h($itemStones->changed) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'ItemStones', 'action' => 'view', $itemStones->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'ItemStones', 'action' => 'edit', $itemStones->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'ItemStones', 'action' => 'delete', $itemStones->id], ['confirm' => __('Are you sure you want to delete # {0}?', $itemStones->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Item Tags') ?></h4>
        <?php if (!empty($item->item_tags)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Item Id') ?></th>
                <th scope="col"><?= __('Tag Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($item->item_tags as $itemTags): ?>
            <tr>
                <td><?= h($itemTags->id) ?></td>
                <td><?= h($itemTags->item_id) ?></td>
                <td><?= h($itemTags->tag_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'ItemTags', 'action' => 'view', $itemTags->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'ItemTags', 'action' => 'edit', $itemTags->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'ItemTags', 'action' => 'delete', $itemTags->id], ['confirm' => __('Are you sure you want to delete # {0}?', $itemTags->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
