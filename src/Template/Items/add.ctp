<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Items'), ['action' => 'index']) ?></li>
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
<div class="items form large-9 medium-8 columns content">
    <?= $this->Form->create($item) ?>
    <fieldset>
        <legend><?= __('Add Item') ?></legend>
        <?php
            echo $this->Form->input('website_id', ['options' => $websites]);
            echo $this->Form->input('name');
            echo $this->Form->input('changed_name');
            echo $this->Form->input('description');
            echo $this->Form->input('changed_description');
            echo $this->Form->input('material_id', ['options' => $materials, 'empty' => true]);
            echo $this->Form->input('changed_material_id');
            echo $this->Form->input('material_color_id', ['options' => $materialColors, 'empty' => true]);
            echo $this->Form->input('changed_material_color_id');
            echo $this->Form->input('metalstamp');
            echo $this->Form->input('changed_metalstamp');
            echo $this->Form->input('other_stones');
            echo $this->Form->input('surface_id', ['options' => $surfaces, 'empty' => true]);
            echo $this->Form->input('changed_surface_id');
            echo $this->Form->input('diamond_abrasive');
            echo $this->Form->input('changed_diamond_abrasive');
            echo $this->Form->input('diamond_weight');
            echo $this->Form->input('changed_diamond_weight');
            echo $this->Form->input('diamond_color_id', ['options' => $diamondColors, 'empty' => true]);
            echo $this->Form->input('changed_diamond_color_id');
            echo $this->Form->input('diamond_clarity_id', ['options' => $diamondClarities, 'empty' => true]);
            echo $this->Form->input('changed_diamond_clarity_id');
            echo $this->Form->input('diamond_number');
            echo $this->Form->input('changed_diamond_number');
            echo $this->Form->input('diamond_cut');
            echo $this->Form->input('changed_diamond_cut');
            echo $this->Form->input('stone_id', ['options' => $stones, 'empty' => true]);
            echo $this->Form->input('link');
            echo $this->Form->input('code');
            echo $this->Form->input('price');
            echo $this->Form->input('brand');
            echo $this->Form->input('changed_brand');
            echo $this->Form->input('image_small');
            echo $this->Form->input('image_processed');
            echo $this->Form->input('tags_processed');
            echo $this->Form->input('action_id', ['options' => $actions, 'empty' => true]);
            echo $this->Form->input('master_category_id', ['options' => $masterCategories]);
            echo $this->Form->input('gender_id', ['options' => $genders, 'empty' => true]);
            echo $this->Form->input('changed_gender_id');
            echo $this->Form->input('designer');
            echo $this->Form->input('changed_designer');
            echo $this->Form->input('occasion_id', ['options' => $occasions, 'empty' => true]);
            echo $this->Form->input('changed_occasion_id');
            echo $this->Form->input('comments');
            echo $this->Form->input('style_id', ['options' => $styles, 'empty' => true]);
            echo $this->Form->input('chain_id', ['options' => $chains, 'empty' => true]);
            echo $this->Form->input('clasp_id', ['options' => $clasps, 'empty' => true]);
            echo $this->Form->input('height');
            echo $this->Form->input('has_length');
            echo $this->Form->input('metal_and_color_id', ['options' => $metalAndColors, 'empty' => true]);
            echo $this->Form->input('manual');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
