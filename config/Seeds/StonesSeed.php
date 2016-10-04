<?php
use Migrations\AbstractSeed;

/**
 * Stones seed.
 */
class StonesSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            array('id' => 1, 'name' => 'Agate'),
            array('id' => 2, 'name' => 'Amethyst - no - NO'),
            array('id' => 4, 'name' => 'Crystal'),
            array('id' => 5, 'name' => 'Cubic zirconia'),
            array('id' => 7, 'name' => 'Diamond'),
            array('id' => 8, 'name' => 'Emerald'),
            array('id' => 9, 'name' => 'Freshwater pearl'),
            array('id' => 11, 'name' => 'Hematite'),
            array('id' => 12, 'name' => 'Onyx'),
            array('id' => 13, 'name' => 'Quartz'),
            array('id' => 15, 'name' => 'Ruby - no - NO'),
            array('id' => 16, 'name' => 'Sapphire'),
            array('id' => 17, 'name' => 'Swarovski Crystal'),
            array('id' => 18, 'name' => 'Synthetic pearl'),
            array('id' => 19, 'name' => 'Synthetic ruby'),
            array('id' => 20, 'name' => 'Synthetic sapphire'),
            array('id' => 21, 'name' => 'Terbium'),
            array('id' => 22, 'name' => 'Topaz'),
            array('id' => 24, 'name' => 'Mother of pearl'),
            array('id' => 25, 'name' => 'Zircon'),
            array('id' => 27, 'name' => 'Pearl'),
            array('id' => 28, 'name' => 'Moon Stone'),
            array('id' => 29, 'name' => 'Shell Pearl'),
            array('id' => 30, 'name' => 'Pearlescent'),
            array('id' => 31, 'name' => 'Other Stones'),
            array('id' => 32, 'name' => 'Other Synthetic Stones'),
            array('id' => 33, 'name' => 'Aquamarine'),
            array('id' => 34, 'name' => 'Resin'),
            array('id' => 35, 'name' => 'Glass Stone'),
            array('id' => 36, 'name' => 'Garnet'),
            array('id' => 37, 'name' => 'Swarovski Pearl'),
            array('id' => 38, 'name' => 'Turquoise'),
            array('id' => 39, 'name' => 'Tourmaline'),
            array('id' => 40, 'name' => 'Opal'),
            array('id' => 41, 'name' => 'Peridot'),
            array('id' => 42, 'name' => 'Rock crystal'),
            array('id' => 43, 'name' => 'Morganite'),
            array('id' => 44, 'name' => 'Citrine'),
            array('id' => 45, 'name' => 'Salt water cultured pearl'),
            array('id' => 46, 'name' => 'Tanzanite'),
            array('id' => 47, 'name' => 'Coral'),
            array('id' => 48, 'name' => 'Beryl'),
            array('id' => 49, 'name' => 'Kalsedon'),
            array('id' => 50, 'name' => 'Prasiolite'),
            array('id' => 51, 'name' => 'Labradorite'),
            array('id' => 52, 'name' => 'Akoya pearl'),
            array('id' => 53, 'name' => 'Tahiti pearl'),
            array('id' => 54, 'name' => 'Obsidian'),
            array('id' => 55, 'name' => 'Pacific pearls'),
            array('id' => 56, 'name' => 'Salt water pearl'),
            array('id' => 57, 'name' => 'Freshwater cultured pearl'),
            array('id' => 58, 'name' => 'Cultured pearl'),
            array('id' => 59, 'name' => 'Ruby'),
            array('id' => 60, 'name' => 'Amethyst'),
            array('id' => 61, 'name' => 'Carnelian'),
            array('id' => 62, 'name' => 'Chrysoprase'),
            array('id' => 63, 'name' => 'Marcasite')
        );

        $table = $this->table('stones');
        $table->insert($data)->save();
    }
}
