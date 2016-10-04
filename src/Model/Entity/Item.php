<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Item Entity
 *
 * @property int $id
 * @property int $website_id
 * @property string $name
 * @property string $changed_name
 * @property string $description
 * @property string $changed_description
 * @property int $material_id
 * @property int $changed_material_id
 * @property int $material_color_id
 * @property int $changed_material_color_id
 * @property int $metalstamp
 * @property int $changed_metalstamp
 * @property string $other_stones
 * @property int $surface_id
 * @property int $changed_surface_id
 * @property string $diamond_abrasive
 * @property string $changed_diamond_abrasive
 * @property string $diamond_weight
 * @property string $changed_diamond_weight
 * @property int $diamond_color_id
 * @property int $changed_diamond_color_id
 * @property int $diamond_clarity_id
 * @property int $changed_diamond_clarity_id
 * @property int $diamond_number
 * @property int $changed_diamond_number
 * @property string $diamond_cut
 * @property string $changed_diamond_cut
 * @property int $stone_id
 * @property string $link
 * @property string $code
 * @property int $price
 * @property string $brand
 * @property string $changed_brand
 * @property string $image_small
 * @property bool $image_processed
 * @property bool $tags_processed
 * @property int $action_id
 * @property int $master_category_id
 * @property int $gender_id
 * @property int $changed_gender_id
 * @property string $designer
 * @property string $changed_designer
 * @property int $occasion_id
 * @property int $changed_occasion_id
 * @property string $comments
 * @property int $style_id
 * @property int $chain_id
 * @property int $clasp_id
 * @property string $height
 * @property bool $has_length
 * @property int $metal_and_color_id
 * @property bool $manual
 *
 * @property \App\Model\Entity\Website $website
 * @property \App\Model\Entity\Material $material
 * @property \App\Model\Entity\ChangedMaterial $changed_material
 * @property \App\Model\Entity\MaterialColor $material_color
 * @property \App\Model\Entity\ChangedMaterialColor $changed_material_color
 * @property \App\Model\Entity\Surface $surface
 * @property \App\Model\Entity\ChangedSurface $changed_surface
 * @property \App\Model\Entity\DiamondColor $diamond_color
 * @property \App\Model\Entity\ChangedDiamondColor $changed_diamond_color
 * @property \App\Model\Entity\DiamondClarity $diamond_clarity
 * @property \App\Model\Entity\ChangedDiamondClarity $changed_diamond_clarity
 * @property \App\Model\Entity\Stone $stone
 * @property \App\Model\Entity\Action $action
 * @property \App\Model\Entity\MasterCategory $master_category
 * @property \App\Model\Entity\Gender $gender
 * @property \App\Model\Entity\ChangedGender $changed_gender
 * @property \App\Model\Entity\Occasion $occasion
 * @property \App\Model\Entity\ChangedOccasion $changed_occasion
 * @property \App\Model\Entity\Style $style
 * @property \App\Model\Entity\Chain $chain
 * @property \App\Model\Entity\Clasp $clasp
 * @property \App\Model\Entity\MetalAndColor $metal_and_color
 * @property \App\Model\Entity\ItemFilterMetalAndColor[] $item_filter_metal_and_colors
 * @property \App\Model\Entity\ItemFilterStone[] $item_filter_stones
 * @property \App\Model\Entity\ItemLength[] $item_lengths
 * @property \App\Model\Entity\ItemMetalAndColor[] $item_metal_and_colors
 * @property \App\Model\Entity\ItemNecklaceType[] $item_necklace_types
 * @property \App\Model\Entity\ItemOccasion[] $item_occasions
 * @property \App\Model\Entity\ItemStone[] $item_stones
 * @property \App\Model\Entity\ItemTag[] $item_tags
 */
class Item extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
}
