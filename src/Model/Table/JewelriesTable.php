<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Jewelries Model
 *
 * @method \App\Model\Entity\Jewelry get($primaryKey, $options = [])
 * @method \App\Model\Entity\Jewelry newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Jewelry[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Jewelry|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Jewelry patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Jewelry[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Jewelry findOrCreate($search, callable $callback = null)
 */
class JewelriesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('jewelries');
        $this->displayField('name');
        $this->primaryKey('id');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->requirePresence('description', 'create')
            ->notEmpty('description');

        return $validator;
    }

    ///////////////////////////////////////////////////////////////////////////////
    public function gullfunn_get_code($string){
        $arr = explode(" ", trim($string));
        return $arr[count($arr) - 1];
    }
    
    ///////////////////////////////////////////////////////////////////////////////
    public function bjorklund_get_product_info($string, $diamond_colors, $diamond_clarities, $global_stones){
        $product_info = array();
        $string = str_ireplace("<li>", "", $string);
        $stones_string = $string;
        $string = explode("</li>", trim($string));

        $product_info['code'] = $string[0];
        foreach ($string as $key=>$value){
            if (stristr($value, "Materiale")){
                $value = str_replace("Materiale:", "", $value);
                $metalstamp = $this->get_metalstamp($value);
                if ($metalstamp){
                    $product_info['metalstamp'] = $metalstamp;
                    $value = str_replace($metalstamp, "", $value);
                }
                $product_info['material'] = trim($value);
            } else if (stristr($value, "Overflatebehandling")){
                $value = str_replace("Overflatebehandling:", "", $value);
                $product_info['surface'] = trim($value);
            } else if (stristr($value, "Diamantvekt")){
                $value = str_replace("Diamantvekt:", "", $value);
                $value = str_replace("ct.", "", $value);
                $value = str_replace(",", ".", $value);
                $product_info['diamond_weight'] = trim($value);
            } else if (stristr($value, "Diamantslip")){
                $value = str_replace("Diamantslip:", "", $value);
                $product_info['diamond_cut'] = trim($value);
            } else if (stristr($value, "Diamantkvalitet")){
                $value = str_replace("Diamantkvalitet:", "", $value);
                $values = explode(" / ", $value);
                if (isset($diamond_colors[trim($values[0])])){
                    $product_info['diamond_color_id'] = $diamond_colors[trim($values[0])];
                }
                //$product_info['diamond_clarity_id'] = $diamond_clarities[trim($values[1])];
                if (isset($values[1])){
                    $product_info['diamond_clarity_id'] = $this->resolve_diamond_clarities(trim($values[1]), $diamond_clarities);
                }
            } else if (stristr($value, "diamant")){
                preg_match('/(?P<digit1>\d+) diamant/', $value, $matches);
                if ($matches){
                    $product_info['diamond_number'] = $matches['digit1'];
                } 
            }
        }
        //$product_info['Stones'] = $this->general_get_stones($string, $global_stones);
        return $product_info;
    }
    
    private function resolve_diamond_clarities($clarity, $diamond_clarities){
        if ($clarity == "P1") $clarity = "I1";
        if ($clarity == "P2") $clarity = "I2";
        if ($clarity == "P3") $clarity = "I3";
        if ($clarity == "P4") $clarity = "I4";
        return $diamond_clarities[$clarity];
    }
    
    ///////////////////////////////////////////////////////////////////////////////
    public function bjorklund_get_stones_info($string){
        $stones = array();
        $string = str_ireplace("<p>", "", $string);
        $string = str_ireplace("</p>", "", $string);
        $string = trim($string);
        return $string; //TODO!!!!!!!!!!!!!!!!!!!!!1
    }
    
    ///////////////////////////////////////////////////////////////////////////////
    public function bjorklund_get_diamond_cut_info($string){
        $cut = NULL;
        switch ($string) {
            case "8/8":
                $cut = "Eight cut";
                break;
            case "Brilliant, (Full cut)":
                $cut = "Full cut";
                break;
        }
        return $cut;
    }
    
    ///////////////////////////////////////////////////////////////////////////////
    public function global_get_diamond_clarity_info($string, $global_diamond_clarities){
        if (stristr($string, "Vvs1") !== FALSE)             return $global_diamond_clarities["VVS1"];
        if (stristr($string, "Vvs2") !== FALSE)             return $global_diamond_clarities["VVS2"];
        if (stristr($string, "Vvs") !== FALSE)              return $global_diamond_clarities["VVS"];
        if (stristr($string, "Vs1") !== FALSE)              return $global_diamond_clarities["VS1"];
        if (stristr($string, "Vs2") !== FALSE)              return $global_diamond_clarities["VS2"];
        if (stristr($string, "Vs") !== FALSE)               return $global_diamond_clarities["VS"];
        if (stristr($string, "Si1") !== FALSE)              return $global_diamond_clarities["SI1"];
        if (stristr($string, "Si2") !== FALSE)              return $global_diamond_clarities["SI2"];
        if (stristr($string, "Si") !== FALSE)               return $global_diamond_clarities["SI"];
        if (stristr($string, "Pique IIII") !== FALSE)       return $global_diamond_clarities["I3"];
        if (stristr($string, "Pique III") !== FALSE)        return $global_diamond_clarities["I3"];
        if (stristr($string, "Pique II") !== FALSE)         return $global_diamond_clarities["I2"];
        if (stristr($string, "Pique I") !== FALSE)          return $global_diamond_clarities["I1"];
        if (stristr($string, "P") !== FALSE)                return $global_diamond_clarities["I"];
    }
    
    ///////////////////////////////////////////////////////////////////////////////
    public function set_diamond_color($diamond_color, $global_diamond_colors){
        //bjorklund specials::
        if (stristr($diamond_color, "H (Hvit, Wesselton)") !== FALSE)
            return $global_diamond_colors["H"];
        else if (stristr($diamond_color, "I (Lett tonet hvit, Top Crystal)") !== FALSE)
            return $global_diamond_colors["I"];
        else if (stristr($diamond_color, "L (Tonet hvit, Top Cape)") !== FALSE)
            return $global_diamond_colors["L"];
        else if (stristr($diamond_color, "-K (Tonet hvit, Top Cape)") !== FALSE)
            return $global_diamond_colors["K"];
        else if (stristr($diamond_color, "M (Tonet)") !== FALSE)
            return $global_diamond_colors["M"];
        else if (stristr($diamond_color, "G (Sjelden hvit, Top Wesselton)") !== FALSE)
            return $global_diamond_colors["G"];
        //default from pdf::
        else if (stristr($diamond_color, "River") !== FALSE)
            return $global_diamond_colors["R"];
        else if (stristr($diamond_color, "Top Wesselton") !== FALSE)
            return $global_diamond_colors["TW"];
        else if (stristr($diamond_color, "Wesselton") !== FALSE)
            return $global_diamond_colors["W"];
        else if (stristr($diamond_color, "Top Crystal") !== FALSE)
            return $global_diamond_colors["TCR"];
        else if (stristr($diamond_color, "Crystal") !== FALSE)
            return $global_diamond_colors["CR"];
        else if (stristr($diamond_color, "Top Cape") !== FALSE)
            return $global_diamond_colors["TC"];
        else if (stristr($diamond_color, "Cape") !== FALSE)
            return $global_diamond_colors["C"];
    }
    
    ///////////////////////////////////////////////////////////////////////////////
    public function gullfunn_get_price($string){
        $price = strip_tags($string);
        $price = str_ireplace(",-", "", $price);
        $price = str_replace(" ", "", $price);
        return $price;
    }
    
    ///////////////////////////////////////////////////////////////////////////////
    public function gullfunn_get_diamond_weight($description){
        $diamond_weight = 0;
        preg_match('/(?P<digit1>\d+),(?P<digit2>\d+)\s*ct/', $description, $matches);
        if ($matches){
            $diamond_weight = $matches[1] . '.' . $matches[2];
        } 
        
        return $diamond_weight;
    }
    
    ///////////////////////////////////////////////////////////////////////////////
    public function gullfunn_get_material_info($product, $materials, $material_colors){
        
        $material_info = $this->gullfunn_get_material($product['description']);
        
        if (isset($materials[$material_info['material']])){
            $product['material_id'] = $materials[$material_info['material']];
        } else if (isset($product['material']) && $product['material']){
            $product['material_id'] = $materials[$product['material']];
        } else {
            $product['material_id'] = $materials['Gold'];
        }
        if (isset($material_colors[$material_info['material_color']])){
            $product['material_color_id'] = $material_colors[$material_info['material_color']];
        } else if (isset($product['material_color']) && $product['material_color']){
            $product['material_color_id'] = $material_colors[$product['material_color']];
        } else {
            $product['material_color_id'] = 0;
        }
        return $product;
    }
    
    public function gullfunn_get_diamonds_number($products){
        foreach($products as $key=>$value){
            if (stristr($value['description'], "diamanter")){
                //
            } else if (stristr($value['description'], "diamant")){
                $products[$key]['diamond_number'] = 1;
            }
        }
        
        return $products;
    }
    
    ///////////////////////////////////////////////////////////////////////////////
    public function gullfunn_get_material($description){
        $material = NULL;
        $material_color = NULL;
        if (stripos($description, 'sølv') !== FALSE) {
            $material = "Silver";
            $material_color = NULL;
        }
        else if (stripos($description, 'hvg') !== FALSE 
            || stripos($description, 'hvitt gull') !== FALSE 
            || stripos($description, 'hv.g.') !== FALSE) {
            $material = "Gold";
            $material_color = 'White';
        }
        else if (stripos($description, 'gull') !== FALSE){
            $material = "Gold";
            //$material_color = 'Yellow';
        } else if (stripos())
        $info = array();
        $info['material'] = $material;
        $info['material_color'] = $material_color;
        return $info;
    }
    
    ///////////////////////////////////////////////////////////////////////////////
    public function gullfunn_and_thune_get_diamond_clarity_and_color($product, $d_clarities_flip, $d_colors_flip, $website_name){
        //TODO:: set diamond clarity and color
        if ($website_name == "gullfunn"){
            $string = $product['description'];
        } 
        if ($website_name == "thune"){
            $string = $product['stone_info'];
        } 
        
        $product = $this->help_gullfunn_and_thune_get_diamond_clarity_and_color(
            $string, $product, $d_clarities_flip, $d_colors_flip
        );
        
        if (!isset($product['diamond_clarity_id']) && $website_name == "thune"){
            $product = $this->help_gullfunn_and_thune_get_diamond_clarity_and_color(
                $product['description'], $product, $d_clarities_flip, $d_colors_flip
            );
        }
        return $product;
    }
    
    ///////////////////////////////////////////////////////////////////////////////
    private function help_gullfunn_and_thune_get_diamond_clarity_and_color($string, $product, $d_clarities_flip, $d_colors_flip){
        
        if (stripos($string, "W/P") || stripos($string, "ct w.p") || stripos($string, "ct WP")){
            $product['diamond_clarity_id'] = $d_clarities_flip["I"];
            $product['diamond_color_id'] = $d_colors_flip["W"];
        }
        if (stripos($string, "W.SI") || stripos($string, "W/SI") || stripos($string, "W.Si")){
            $product['diamond_clarity_id'] = $d_clarities_flip["SI"];
            $product['diamond_color_id'] = $d_colors_flip["W"];
        }
        if (stripos($string, "W.VS") || stripos($string, "W/VS") || stripos($string, "W.Vs")){
            $product['diamond_clarity_id'] = $d_clarities_flip["VS"];
            $product['diamond_color_id'] = $d_colors_flip["W"];
        }
        if (stripos($string, "tw.si") || stripos($string, "TW.SI") || stripos($string, "TW/SI")){
            $product['diamond_clarity_id'] = $d_clarities_flip["SI"];
            $product['diamond_color_id'] = $d_colors_flip["TW"];
        }
        
        if (stripos($string, "Tw.vvs.") || stripos($string, "Tw/vvs")){
            $product['diamond_clarity_id'] = $d_clarities_flip["VVS"];
            $product['diamond_color_id'] = $d_colors_flip["TW"];
        }
        else if (stripos($string, "vs.")){
            $product['diamond_clarity_id'] = $d_clarities_flip["VS"];
        }
        else if (stripos($string, "TW.vs") || stripos($string, "TW/vs")){
            $product['diamond_clarity_id'] = $d_clarities_flip["VS"];
            $product['diamond_color_id'] = $d_colors_flip["TW"];
        }
        else if (stripos($string, "TWvs.")){
            $product['diamond_clarity_id'] = $d_clarities_flip["VS"];
            $product['diamond_color_id'] = $d_colors_flip["TW"];
        }
        else if (stripos($string, "TWvs")){
            $product['diamond_clarity_id'] = $d_clarities_flip["VS"];
            $product['diamond_color_id'] = $d_colors_flip["TW"];
        }
        else if (stripos($string, "TLB/IF")){
            $product['diamond_clarity_id'] = $d_clarities_flip["IF"];
            $product['diamond_color_id'] = $d_colors_flip["TLB"];
        }
        
        $product = $this->get_diamond_cut($product, $string);
        
        return $product;
    }
    
    ///////////////////////////////////////////////////////////////////////////////
    public function get_diamond_cut($product, $string){
        if (stripos($string, "brilliant") !== FALSE){
            $product['diamond_cut'] = 'Brilliant';
        }
        else if (stripos($string, "Princess") !== FALSE){
            $product['diamond_cut'] = 'Princess';
        }
        else if (stripos($string, "baguett") !== FALSE){
            $product['diamond_cut'] = 'Baguette';
        }
        return $product;
    }
    
    ///////////////////////////////////////////////////////////////////////////////
    public function thune_get_short_product_info($product, $master_categories){
        $a = array_filter(explode("<br>", $product['info']));
        $info = array();
        $info['stone_info'] = NULL;
        
        foreach ($a as $k=>$v){
            $a[$k] = trim($v);
            //start reading the array::
            if (strpos($a[$k], "Materialbeskrivelse:") === 0){
                $info['material_info'] = str_ireplace("Materialbeskrivelse: ", "", $a[$k]);
            }
            if (strpos($a[$k], "Bredde:") === 0){
                $info['pearl_info'] = str_ireplace("Bredde: ", "", $a[$k]);
            }
            if (strpos($a[$k], "Stener:") === 0){
                $info['stone_info'] = str_ireplace("Stener: ", "", $a[$k]);
            }
            if (strpos($a[$k], "Lengde:") === 0){
                $info['length_info'] = str_ireplace("Lengde: ", "", $a[$k]);
            }
            if (strpos($a[$k], "Varenummer:") === 0){
                $info['code'] = str_ireplace("Varenummer: ", "", $a[$k]);
            }
            if (!isset($info['length_info']) && ($product['master_category_id'] == 6 || $product['master_category_id'] == 15)){
                $info['length_info'] = $product['description'];
            }
        }
        //pr($info);
        //decode material info
        preg_match_all(
            "/([0-9]+)?([a-z- ]+)/s",
            $info['material_info'],
            $matches,
            PREG_SET_ORDER
        );
        if ($matches){
            $info['metalstamp'] = $matches[0][1];
            
            $material = NULL;
            $material_color = NULL;
            if (strpos($info['material_info'], 'sølv') !== FALSE) {
                $material = "Silver";
                $material_color = NULL;
            } else if (strpos($info['material_info'], 'gult og hvitt gull') !== FALSE) {
                $material = "Gold";
                $material_color = "Yellow & White";
            } else if (strpos($info['material_info'], 'hvitt og gult gull') !== FALSE) {
                $material = "Gold";
                $material_color = "Yellow & White";
            } else if (strpos($info['material_info'], 'gult gull') !== FALSE) {
                $material = "Gold";
                $material_color = "Yellow";
            } else if (strpos($info['material_info'], 'hvitt gull') !== FALSE) {
                $material = "Gold";
                $material_color = "White";
            } else if (strpos($info['material_info'], 'rose gull') !== FALSE) {
                $material = "Gold";
                $material_color = "Yellow";
            }
        }
        //a special case where only 925 is as "Materialbeskrivelse:"
        
        if (stripos($info['material_info'], "925") !== FALSE ){
            $info['metalstamp'] = "925";
            $material = "Silver";
            $material_color = NULL;
        }
        
        $info['material'] = $material;
        $info['material_color'] = $material_color;
        return $info;
    }
    
    ///////////////////////////////////////////////////////////////////////////////
    public function thune_get_split_stone_info($product, $string, $global_stones){
        $description = $product['description'];
        $stone_info = array();
        
        $a = explode(" og ", $string);
        if (count($a) > 1){
            foreach ($a as $part){
                $stone_info[] = $this->thune_get_stone_info($description, $part, $global_stones);
            }
        } else {
            $a = explode("+", $string);
            if (count($a) > 1){
                foreach ($a as $part){
                    $stone_info[] = $this->thune_get_stone_info($description, $part, $global_stones);
                }
            } else {
                $a = explode(" med ", $string);
                if (count($a) > 1){
                    foreach ($a as $part){
                        $stone_info[] = $this->thune_get_stone_info($description, $part, $global_stones);
                    }
                } else {
                    $stone_info[] = $this->thune_get_stone_info($description, $a[0], $global_stones);
                }
            }
        }
        
        $a = explode(" med ", $description);
        if (count($a) > 1){
            foreach ($a as $part){
                $stone_info[] = $this->thune_get_stone_info($description, $part, $global_stones);
            }
        }
        
        $a = explode(" av ", $description);
        if (count($a) > 1){
            foreach ($a as $part){
                $stone_info[] = $this->thune_get_stone_info($description, $part, $global_stones);
            }
        }
        
        $a = explode(" og ", $description);
        if (count($a) > 1){
            foreach ($a as $part){
                $stone_info[] = $this->thune_get_stone_info($description, $part, $global_stones);
            }
        } else {
            $a = explode("+", $description);
            if (count($a) > 1){
                foreach ($a as $part){
                    $stone_info[] = $this->thune_get_stone_info($description, $part, $global_stones);
                }
            } else {
                $a = explode(" med ", $description);
                if (count($a) > 1){
                    foreach ($a as $part){
                        $stone_info[] = $this->thune_get_stone_info($description, $part, $global_stones);
                    }
                } else {
                    $stone_info[] = $this->thune_get_stone_info($description, $a[0], $global_stones);
                }
            }
        }   
        
        $stones = array();
        $has_pearls = false;
        foreach ($stone_info as $stone){
            if (isset($stone['stone'])) {
                $stones[] = $stone['stone'];
            }  
        }
        $stones = array_unique($stones);
        $product['Stones'] = $stones;
        $product = $this->set_multiple_carats_comment(array($product), $global_stones['Diamond'], "thune_stone_info");
        
        if (isset($product[0]['comments'])){
            $stone_info['comments'] = $product[0]['comments']; 
        } else {
            $stone_info['comments'] = NULL;
        }
        
        if ($product[0]['code'] == '23179'){
            //pr($stone_info);die();
        }
        //pr($product); pr($stone_info);die();
        return $stone_info;
    }

    ///////////////////////////////////////////////////////////////////////////////
    private function thune_get_stone_info($description, $string, $global_stones){
        $stone_info = array();
        //if (stripos($string, "diamant") !== FALSE){
        //  $stone_info['stone'] = "Diamond";
            //preg_match('/(?P<digit1>\d+),(?P<digit2>\d+)/', $a, $matches);
            //if ($matches){
            //  $stone_info['diamond_weight'] = $matches[1] . '.' . $matches[2];
            //}
        //}
        
        $stone_info['description'] = $string;
        if (stripos($string, "m/dia") !== FALSE
            || stripos($string, "diamant") !== FALSE
            || stripos($string, "brillianter") !== FALSE
            || stripos($string, "princess") !== FALSE)              $stone_info['stone'] = $global_stones['Diamond'];
        else if (stripos($string, "zirkonia") !== FALSE 
            || stripos($string, "stk cz") !== FALSE
            || stripos($string, "zirkoner") !== FALSE
            || stripos($string, "blanke cz") !== FALSE
            || stripos($string, "cub.zirk") !== FALSE)              $stone_info['stone'] = $global_stones['Cubic zirconia'];
        else if (stripos($string, "Ametyst") !== FALSE)             $stone_info['stone'] = $global_stones['Amethyst'];
        else if (stripos($string, "kvarts") !== FALSE)              $stone_info['stone'] = $global_stones['Quartz'];
        else if (stripos($string, "Ferskvannsperle") !== FALSE
            || stripos($string, "ferskvanns-perle") !== FALSE
            || stripos($string, "syntetiske perler") !== FALSE)     $stone_info['stone'] = $global_stones['Freshwater pearl'];
        else if (stripos($string, "Kulturperle") !== FALSE)         $stone_info['stone'] = $global_stones['Freshwater pearl'];
        else if (stripos($string, "Mabe perle") !== FALSE)          $stone_info['stone'] = $global_stones['Mother of pearl'];
        else if (stripos($string, "Safir") !== FALSE
            || stripos($string, "Safirer") !== FALSE)               $stone_info['stone'] = $global_stones['Sapphire'];
        else if (stripos($string, "Onyx") !== FALSE)                $stone_info['stone'] = $global_stones['Onyx'];
        else if (stripos($string, "Topas") !== FALSE)               $stone_info['stone'] = $global_stones['Topaz'];
        else if (stripos($string, "Rubin") !== FALSE)               $stone_info['stone'] = $global_stones['Ruby'];
        else if (stripos($string, "Smaragd") !== FALSE)             $stone_info['stone'] = $global_stones['Emerald'];
        else if (stripos($string, "Månesten") !== FALSE)            $stone_info['stone'] = $global_stones['Moon Stone'];
        else if (stripos($string, "Skjellperle") !== FALSE)         $stone_info['stone'] = $global_stones['Shell Pearl'];
        else if (stripos($string, "Perle") !== FALSE)               $stone_info['stone'] = $global_stones['Pearl'];
        //not found by added by me::
        else if (stripos($string, "Agate"))                         $stone_info['stone'] = $global_stones['Agate'];
        else if (stripos($string, "ametyst"))                       $stone_info['stone'] = $global_stones['Amethyst'];
        else if (stripos($string, "citrin"))                        $stone_info['stone'] = $global_stones['Citrine'];
        else if (stripos($string, "krystall"))                      $stone_info['stone'] = $global_stones['Crystal'];
        else if (stripos($string, "granat"))                        $stone_info['stone'] = $global_stones['Garnet'];
        else if (stripos($string, "hematitt"))                      $stone_info['stone'] = $global_stones['Hematite'];
        else if (stripos($string, "opal"))                          $stone_info['stone'] = $global_stones['Opal'];
        else if (stripos($string, "peridot"))                       $stone_info['stone'] = $global_stones['Peridot'];
        else if (stripos($string, "Saltvann kultivert perle"))      $stone_info['stone'] = $global_stones['Salt water cultured pearl'];
        else if (stripos($string, "syntetisk perle"))               $stone_info['stone'] = $global_stones['Synthetic pearl'];
        else if (stripos($string, "syntetisk rubin"))               $stone_info['stone'] = $global_stones['Synthetic ruby'];
        else if (stripos($string, "syntetisk safir"))               $stone_info['stone'] = $global_stones['Synthetic sapphire'];
        else if (stripos($string, "Swarovski"))                     $stone_info['stone'] = $global_stones['Swarovski Crystal']; 
        else if (stripos($string, "Tanzanite"))                     $stone_info['stone'] = $global_stones['Tanzanite'];
        else if (stripos($string, "Tourmaline"))                    $stone_info['stone'] = $global_stones['Tourmaline'];
        else if (stripos($string, "turkis"))                        $stone_info['stone'] = $global_stones['Turquoise'];
        else if (stripos($string, "bergkrystall"))                  $stone_info['stone'] = $global_stones['Rock Crystal'];
        else if (stripos($string, "grått glass"))                   $stone_info['stone'] = $global_stones['Glass Stone'];
        else if (stripos($string, "Synt. sten") ||
            stripos($string, "hvite stener"))                        $stone_info['stone'] = $global_stones['Other Synthetic Stones'];
        
        else {
            preg_match('/(?P<digit1>\d+),(?P<digit2>\d+)mm/', $string, $matches);
            
            if (!$matches){
                //it might show only carats and clarity/color
                preg_match('/(?P<digit1>\d+),(?P<digit2>\d+)/', $string, $matches);
                if ($matches){
                    preg_match('/Bredde: (?P<digit1>\d+),(?P<digit2>\d+)/', $string, $nomatches);
                    if (!$nomatches){
                        $stone_info['stone'] = $global_stones['Diamond'];
                        $stone_info['diamond_number'] = 1;
                        //20130616
                        $stone_info['stone_weight'] = $matches[1] . '.' . $matches[2];
                    }
                }
            }
        }
        
        preg_match('/(?P<digit1>\d+),(?P<digit2>\d+)mm/', $string, $matches);
        if (!$matches){
            preg_match('/(?P<digit1>\d+),(?P<digit2>\d+)/', $string, $matches);
            if ($matches) {
                preg_match('/Bredde: (?P<digit1>\d+),(?P<digit2>\d+)/', $string, $nomatches);
                if (!$nomatches){
                    $stone_info['stone_weight'] = $matches[1] . '.' . $matches[2];
                    $stone_info['diamond_number'] = 1;
                    /**
                     * following is not needed
                     */
                    if (stripos($string, " x ") !== FALSE){
                        preg_match('/(?P<digit0>\d+) x (?P<digit1>\d+),(?P<digit2>\d+)/', $string, $matches);
                        if ($matches){
                            $stone_info['stone_weight'] = $matches[1] * $stone_info['stone_weight'];
                            $stone_info['diamond_number'] = $matches[1];
                        }
                    }
                    //please see above comment
                    preg_match('/(?P<digit0>\d+)\s*x\s*(?P<digit1>\d+),(?P<digit2>\d+)/', $string, $matches);
                    if ($matches){
                        $stone_info['stone_weight'] = $matches[1] * $stone_info['stone_weight'];
                        $stone_info['diamond_number'] = $matches[1];
                    }
                    
                    preg_match('/(?P<digit0>\d+) brillianter/', $string, $matches);
                    if ($matches){
                        $stone_info['diamond_number'] = $matches[1];
                    }
                }
            }
        }
        
        if (isset($stone_info['stone']) && 
            $stone_info['stone'] == $global_stones['Diamond'] && 
            !isset($stone_info['stone_weight'])){
            preg_match('/(?P<digit1>\d+),(?P<digit2>\d+)ct/', $description, $matches);
            if ($matches) {
                $stone_info['diamond_number'] = 1;
                $stone_info['stone_weight'] = $matches[1] . '.' . $matches[2];
                if (stripos($string, " x ") !== FALSE){
                    preg_match('/(?P<digit0>\d+) x (?P<digit1>\d+),(?P<digit2>\d+)/', $description, $matches);
                    if ($matches){
                        $stone_info['stone_weight'] = $matches[1] * $stone_info['stone_weight'];
                        $stone_info['diamond_number'] = $matches[1];
                    }
                }
                preg_match('/(?P<digit0>\d+)x(?P<digit1>\d+),(?P<digit2>\d+)/', $string, $matches);
                if ($matches){
                    $stone_info['stone_weight'] = $matches[1] * $stone_info['stone_weight'];
                    $stone_info['diamond_number'] = $matches[1];
                }
            }
            /*
            if (!$stone_info['stone_weight']){
                preg_match('/Diamanter (?P<digit1>\d+),(?P<digit2>\d+)', $description, $matches);
                if ($matches){
                    $stone_info['stone_weight'] = $matches['digit1'] . '.' . $matches['digit2'];
                }
            }*/
        }
        
        //now get the stone cut::
        if (stripos($description, "brilliant") !== FALSE) $stone_info['diamond_cut'] = "Brilliant";
        else if (stripos($description, "princess") !== FALSE || stripos($string, "Princ.") !== FALSE) $stone_info['diamond_cut'] = "Princess";
        else if (stripos($description, "baguett") !== FALSE) $stone_info['diamond_cut'] = "Baguette";
        return $stone_info;
    }
    
    ///////////////////////////////////////////////////////////////////////////////
    public function get_metalstamp($string){
        if (strpos($string, "375") !== FALSE) {return 375;}
        if (strpos($string, "417") !== FALSE) {return 417;}
        if (strpos($string, "585") !== FALSE) {return 585;}
        if (strpos($string, "625") !== FALSE) {return 625;}
        if (strpos($string, "750") !== FALSE) {return 750;}
        if (strpos($string, "833") !== FALSE) {return 833;}
        if (strpos($string, "916") !== FALSE) {return 916;}
        if (strpos($string, "925") !== FALSE) {return 925;}
        if (strpos($string, "999") !== FALSE) {return 999;}
        return "";
    }
    
    ///////////////////////////////////////////////////////////////////////////////
    public function get_material_id($string, $materials){
        if (stripos($string, "gull") !== FALSE) {return $materials['Gold'];}
        if (stripos($string, "sølv") !== FALSE
            || stripos($string, "925") !== FALSE) {return $materials['Silver'];}
        if (stripos($string, "hvg") !== FALSE) { return $materials['Gold'];}
        if (stripos($string, "Stål") !== FALSE) { return $materials['Steel'];}
        if (stripos($string, "Bronse") !== FALSE ||
            stripos($string, "Bronze") !== FALSE ) { return $materials['Bronze'];}
        if (stripos($string, "Skinn") !== FALSE) { return $materials['Leather'];}
        return "";
    }
    
    ///////////////////////////////////////////////////////////////////////////////
    public function get_material_color_id($string, $material_colors){
        if (stripos($string, "hvitt") !== FALSE
            || stripos($string, "hvg") !== FALSE)           {return $material_colors['White'];}
        if (stripos($string, "gult og hvitt") !== FALSE)    {return $material_colors['Yellow & White'];}
        if (stripos($string, "gult") !== FALSE)             {return $material_colors['Yellow'];}
        if (stripos($string, "steg") !== FALSE
            || stripos($string, "rose") !== FALSE)          {return $material_colors['Rose'];}
        if (stripos($string, "rosa") !== FALSE)             {return $material_colors['Pink'];}
        if (stripos($string, "rødt") !== FALSE)             {return $material_colors['Red'];}
        //todo:: add all kinds
        return "";
    }
    
    ///////////////////////////////////////////////////////////////////////////////
    public function edit_item($old_item, $new_item){
        
        if ($old_item['Item']['name'] != $new_item['Item']['name']){
            $new_item['Item']['changed_name'] = $new_item['Item']['name'];
            $new_item['Item']['name'] = $old_item['Item']['name'];
        }
        
        if ($old_item['Item']['description'] != $new_item['Item']['description']){
            $new_item['Item']['changed_description'] = $new_item['Item']['description'];
            $new_item['Item']['description'] = $old_item['Item']['description'];
        }

        if ($old_item['Item']['material_id'] !== $new_item['Item']['material_id'] ||
            $new_item['Item']['material_id'] != $old_item['Item']['changed_material_id']){
            if ($new_item['Item']['material_id'] == NULL) 
                $new_item['Item']['material_id'] = 0;
            $new_item['Item']['changed_material_id'] = $new_item['Item']['material_id'];
            $new_item['Item']['material_id'] = $old_item['Item']['material_id'];
        }
        
        if ($old_item['Item']['material_color_id'] != $new_item['Item']['material_color_id'] ||
            $new_item['Item']['material_color_id'] != $old_item['Item']['changed_material_color_id']){
            if ($new_item['Item']['material_color_id'] == NULL) 
                $new_item['Item']['material_color_id'] = 0;
            $new_item['Item']['changed_material_color_id'] = $new_item['Item']['material_color_id'];
            $new_item['Item']['material_color_id'] = $old_item['Item']['material_color_id'];
        }
        
        if ($old_item['Item']['metalstamp'] != $new_item['Item']['metalstamp']){
            $new_item['Item']['changed_metalstamp'] = $new_item['Item']['metalstamp'];
            $new_item['Item']['metalstamp'] = $old_item['Item']['metalstamp'];
        }
        
        if ($old_item['Item']['surface_id'] != $new_item['Item']['surface_id'] ||
            $new_item['Item']['surface_id'] != $old_item['Item']['changed_surface_id']){
            if ($new_item['Item']['surface_id'] == NULL) 
                $new_item['Item']['surface_id'] = 0;
            $new_item['Item']['changed_surface_id'] = $new_item['Item']['surface_id'];
            $new_item['Item']['surface_id'] = $old_item['Item']['surface_id'];
        }

        if ($old_item['Item']['diamond_weight'] != $new_item['Item']['diamond_weight']){
            $new_item['Item']['changed_diamond_weight'] = $new_item['Item']['diamond_weight'];
            $new_item['Item']['diamond_weight'] = $old_item['Item']['diamond_weight'];
        }
        
        if ($old_item['Item']['diamond_color_id'] != $new_item['Item']['diamond_color_id'] ||
            $new_item['Item']['diamond_color_id'] != $old_item['Item']['changed_diamond_color_id']){
            if ($new_item['Item']['diamond_color_id'] == NULL) 
                $new_item['Item']['diamond_color_id'] = 0;
            $new_item['Item']['changed_diamond_color_id'] = $new_item['Item']['diamond_color_id'];
            $new_item['Item']['diamond_color_id'] = $old_item['Item']['diamond_color_id'];
        }

        if ($old_item['Item']['diamond_clarity_id'] != $new_item['Item']['diamond_clarity_id'] ||
            $new_item['Item']['diamond_clarity_id'] != $old_item['Item']['changed_diamond_clarity_id']){
            if ($new_item['Item']['diamond_clarity_id'] == NULL) 
                $new_item['Item']['diamond_clarity_id'] = 0;
            $new_item['Item']['changed_diamond_clarity_id'] = $new_item['Item']['diamond_clarity_id'];
            $new_item['Item']['diamond_clarity_id'] = $old_item['Item']['diamond_clarity_id'];
        }

        if ($old_item['Item']['diamond_number'] != $new_item['Item']['diamond_number']){
            $new_item['Item']['changed_diamond_number'] = $new_item['Item']['diamond_number'];
            $new_item['Item']['diamond_number'] = $old_item['Item']['diamond_number'];
        }
        
        if ($old_item['Item']['diamond_cut'] != $new_item['Item']['diamond_cut']){
            $new_item['Item']['changed_diamond_cut'] = $new_item['Item']['diamond_cut'];
            $new_item['Item']['diamond_cut'] = $old_item['Item']['diamond_cut'];
        }
        
        if ($old_item['Item']['brand'] != $new_item['Item']['brand']){
            $new_item['Item']['changed_brand'] = $new_item['Item']['brand'];
            $new_item['Item']['brand'] = $old_item['Item']['brand'];
        }
        
        if ($old_item['Item']['gender_id'] != $new_item['Item']['gender_id'] ||
            $new_item['Item']['gender_id'] != $old_item['Item']['changed_gender_id']){
            if ($new_item['Item']['gender_id'] == NULL) 
                $new_item['Item']['gender_id'] = 0;
            $new_item['Item']['changed_gender_id'] = $new_item['Item']['gender_id'];
            $new_item['Item']['gender_id'] = $old_item['Item']['gender_id'];
        }

        if ($old_item['Item']['designer'] != $new_item['Item']['designer']){
            $new_item['Item']['changed_designer'] = $new_item['Item']['designer'];
            $new_item['Item']['designer'] = $old_item['Item']['designer'];
        }
        
        /*
        if ($old_item['Item']['occasion_id'] != $new_item['Item']['occasion_id'] ||
            $new_item['Item']['occasion_id'] != $old_item['Item']['changed_occasion_id']){
            if ($new_item['Item']['occasion_id'] == NULL) 
                $new_item['Item']['occasion_id'] = 0;
            $new_item['Item']['changed_occasion_id'] = $new_item['Item']['occasion_id'];
            $new_item['Item']['occasion_id'] = $old_item['Item']['occasion_id'];
        }*/

        return $new_item;
    }
    
    ///////////////////////////////////////////////////////////////////////////////
    public function check_item_for_differeces($new_item, $old_item){
        if ($old_item['Item']['changed_name']) {
            $new_item['Item']['changed_name']               = $old_item['Item']['changed_name'];
        }
        if ($old_item['Item']['changed_description']) {
            $new_item['Item']['changed_description']        = $old_item['Item']['changed_description'];
        }
        if ($old_item['Item']['changed_material_id'] !== NULL) {
            $new_item['Item']['changed_material_id']        = $old_item['Item']['changed_material_id'];
        }
        if ($old_item['Item']['changed_material_color_id']) {
            $new_item['Item']['changed_material_color_id']  = $old_item['Item']['changed_material_color_id'];
        }
        if ($old_item['Item']['changed_metalstamp']) {
            $new_item['Item']['changed_metalstamp']         = $old_item['Item']['changed_metalstamp'];
        }
        if ($old_item['Item']['changed_surface_id'] !== NULL) {
            $new_item['Item']['changed_surface_id']         = $old_item['Item']['changed_surface_id'];
        }
        if ($old_item['Item']['changed_diamond_weight']) {
            $new_item['Item']['changed_diamond_weight']     = $old_item['Item']['changed_diamond_weight'];
        }
        if ($old_item['Item']['changed_diamond_color_id'] !== NULL) {
            $new_item['Item']['changed_diamond_color_id']   = $old_item['Item']['changed_diamond_color_id'];
        }
        if ($old_item['Item']['changed_diamond_clarity_id'] !== NULL) {
            $new_item['Item']['changed_diamond_clarity_id'] = $old_item['Item']['changed_diamond_clarity_id'];
        }
        if ($old_item['Item']['changed_diamond_number']) {
            $new_item['Item']['changed_diamond_number']     = $old_item['Item']['changed_diamond_number'];
        }
        if ($old_item['Item']['changed_diamond_cut']) {
            $new_item['Item']['changed_diamond_cut']        = $old_item['Item']['changed_diamond_cut'];
        }
        if ($old_item['Item']['changed_brand']) {
            $new_item['Item']['changed_brand']              = $old_item['Item']['changed_brand'];
        }
        if ($old_item['Item']['changed_gender_id'] !== NULL) {
            $new_item['Item']['changed_gender_id']          = $old_item['Item']['changed_gender_id'];
        }
        if ($old_item['Item']['changed_designer']) {
            $new_item['Item']['changed_designer']           = $old_item['Item']['changed_designer'];
        }
        /*
        if ($old_item['Item']['changed_occasion_id'] !== NULL) {
            $new_item['Item']['changed_occasion_id']        = $old_item['Item']['changed_occasion_id'];
        }*/
        return $new_item;
    }
    
    ///////////////////////////////////////////////////////////////////////////////
    public function check_for_changes_before_showing_form($data){
        if ($data['Item']['changed_name'] !== NULL) $data['Item']['name'] = $data['Item']['changed_name'];
        if ($data['Item']['changed_description'] !== NULL) $data['Item']['description'] = $data['Item']['changed_description'];
        if ($data['Item']['changed_material_id'] !== NULL) $data['Item']['material_id'] = $data['Item']['changed_material_id'];
        if ($data['Item']['changed_material_color_id'] !== NULL) $data['Item']['material_color_id'] = $data['Item']['changed_material_color_id'];
        if ($data['Item']['changed_metalstamp'] !== NULL) $data['Item']['metalstamp'] = $data['Item']['changed_metalstamp'];
        if ($data['Item']['changed_surface_id'] !== NULL) $data['Item']['surface_id'] = $data['Item']['changed_surface_id'];
        if ($data['Item']['changed_diamond_weight'] !== NULL) $data['Item']['diamond_weight'] = $data['Item']['changed_diamond_weight'];
        if ($data['Item']['changed_diamond_color_id'] !== NULL) $data['Item']['diamond_color_id'] = $data['Item']['changed_diamond_color_id'];
        if ($data['Item']['changed_diamond_clarity_id'] !== NULL) $data['Item']['diamond_clarity_id'] = $data['Item']['changed_diamond_clarity_id'];
        if ($data['Item']['changed_diamond_number'] !== NULL) $data['Item']['diamond_number'] = $data['Item']['changed_diamond_number'];
        if ($data['Item']['changed_diamond_cut'] !== NULL) $data['Item']['diamond_cut'] = $data['Item']['changed_diamond_cut'];
        if ($data['Item']['changed_brand'] !== NULL) $data['Item']['brand'] = $data['Item']['changed_brand'];
        if ($data['Item']['changed_gender_id'] !== NULL) $data['Item']['gender_id'] = $data['Item']['changed_gender_id'];
        if ($data['Item']['changed_designer'] !== NULL) $data['Item']['designer'] = $data['Item']['changed_designer'];
        //if ($data['Item']['changed_occasion_id'] !== NULL) $data['Item']['occasion_id'] = $data['Item']['changed_occasion_id'];
        return $data;
    }
    
    ///////////////////////////////////////////////////////////////////////////////
    public function get_multiple_occasions_info($global_occasions, $name, $description = NULL){
        $occasions = array();
        
        if (stripos($name, "allianse") !== FALSE || 
            stripos($name, "alliance") !== FALSE) 
        $occasions[] = $global_occasions['Alliance'];
        
        if (stripos($name, "Engagement") !== FALSE ||
            stripos($name, "forlove") !== FALSE ||
            stripos($name, "forlovelse") !== FALSE ||
            stripos($name, "FRIERRINGEN") !== FALSE ||
            stripos($description, "forlovelsesringer"))
        $occasions[] = $global_occasions['Engagement'];
        
        if (stripos($name, "Anniversary") !== FALSE ||
            stripos($name, "jubileum") !== FALSE ||
            stripos($name, "årsdag") !== FALSE)
        $occasions[] = $global_occasions['Anniversary'];
        
        if (stripos($name, "Promisering") !== FALSE ||
            stripos($name, "løfte") !== FALSE || 
            stripos($name, "Promiseringer") !== FALSE ||
            stripos($name, "Promise Bridal") !== FALSE)
        $occasions[] = $global_occasions['Promisering'];
        
        if (stripos($name, "Wedding") !== FALSE ||
            stripos($name, "bryllup") !== FALSE ||
            stripos($name, "brud") !== FALSE ||
            stripos($description, "giftering") !== FALSE && 
            !in_array($global_occasions['Promisering'], $occasions))
        $occasions[] = $global_occasions['Wedding'];
        
        if (stripos($name, "Confirmation") !== FALSE ||
            stripos($name, "konfirmasjon") !== FALSE)
        $occasions[] = $global_occasions['Confirmation'];
        
        if (stripos($name, "Baptism") !== FALSE ||
            stripos($name, "dåp") !== FALSE)
        $occasions[] = $global_occasions['Baptism'];
        
        return $occasions;
    }
    
    ///////////////////////////////////////////////////////////////////////////////
    public function get_multiple_occasions_info_for_gullfunn($global_occasions, $name, $occasion_id){
        $occasions = $this->get_multiple_occasions_info($global_occasions, $name);
        if ($occasion_id){
            if (!in_array($occasion_id, $occasions)){
                $occasions[] = $occasion_id;
            }
        }
        if ($occasions) return $occasions;
        else return NULL;
    }
    
    ///////////////////////////////////////////////////////////////////////////////
    /**
     * set style_id, clasp_id, chain_id 
     */
    public function get_item_special_attribute($attributes, $string){
        $attribute_id = NULL;
        foreach ($attributes as $key=>$value){
            if (stripos($string, $key) != NULL){
                $attribute_id = $value;
                break;
            }
        }
        return $attribute_id;
    }
    
    ///////////////////////////////////////////////////////////////////////////////
    /**
     * get bracelet's length
     */
    
    public function get_gulfunn_item_lengths($string){
        $length_set = false;
        $lengths = array();
        
        if (!$length_set){
            preg_match('/Lengde(.*?)(?P<digit1>\d+),(?P<digit2>\d+)\+(?P<digit3>\d+)\s*cm/', $string, $matches);
            if ($matches){
                //var_dump($matches);
                $lengths = array();
                $lengths[] = $matches['digit1'].".".$matches['digit2'] + $matches['digit3'];
                $length_set = true;
            }
        }
        
        if (!$length_set){
            preg_match('/Lengde(.*?)(?P<digit1>\d+),(?P<digit2>\d+)\s*cm/', $string, $matches);
            if ($matches){
                //var_dump($matches);
                $lengths = array();
                $lengths[] = $matches['digit1'].".".$matches['digit2'];
                $length_set = true;
            }
        }
        
        if (!$length_set){
            preg_match('/Lengde(.*?)(?P<digit1>\d+)\s*cm/', $string, $matches);
            if ($matches){
                //var_dump($matches);
                $lengths = array();
                $lengths[] = $matches['digit1'];
                $length_set = true;
            }
        }
        return $lengths;
    }
    
    public function get_item_lengths($string){
        /** above found on davidandersen
        //Lengde: 19cm.                                         ----------
        //lengde: 16,5 cm og 18 cm.                             ----------
        //lenge 16,5 cm og 18 cm.                               ----------
        //Lengde: 18 cm                                         ----------
        //Str 18,5,  21,5 og 23cm                               ----------
        //Str Medium    
        //lengde 34-37 cm                                       ----------                      
        //65mm høy
        //32mm høy. Str S/M. 
        //Justerbar lengde: 16,5 cm og 18 cm.                   ----------
        //S/M (62mm i diamater) og M/L (65mm i diameter)        ----------
        //. 19 cm.
        //17+1 cm
         */
        //pr($string);
        $length_set = false;
        $lengths = array();
        if (stristr($string, "Lengde") ||
            stristr($string, "lenge") ||
            stristr($string, "Str S/M") ||
            stristr($string, "Str ") ||
            stristr($string, "Str.M") ||
            stristr($string, "Ankerkjede m.") ||
            stristr($string, "kjede") ||
            stristr($string, "kj.") ||
            stristr($string, "diameter") 
        ) {//that means it has length description (on DA)
            if (!$length_set){
                preg_match('/lengde på kjede:(.*?)cm./', $string, $matches);
                if ($matches){
                    $lengths = $this->set_lengths_1($matches);
                    $length_set = true;
                }
            }
            if (!$length_set){
                preg_match('/lengde på kjedet \((?P<digit1>\d+)cm\)/', $string, $matches);
                if ($matches){
                    $lengths = $this->set_lengths_1($matches);
                    $length_set = true;
                }
            }
            
            if (!$length_set){
                preg_match('/engde på kjede(.*?)cm/', $string, $matches);
                if ($matches){
                    $lengths = $this->set_lengths_1($matches);
                    $length_set = true;
                }
            }
            if (!$length_set){
                preg_match('/Lengde på kjede er (?P<digit1>\d+)\/(?P<digit2>\d+)cm./', $string, $matches);
                if ($matches){
                    $lengths = $this->set_lengths_2($matches);
                    $length_set = true;
                }
            }
        
            if (!$length_set){
                preg_match('/lengde på kjedet:(.*?)cm/', $string, $matches);
                if ($matches){
                    $lengths = $this->set_lengths_1($matches);
                    $length_set = true;
                }
            }
            if (!$length_set){
                preg_match('/lengde på kjedet(.*?)cm/', $string, $matches);
                if ($matches){
                    $lengths = $this->set_lengths_1($matches);
                    $length_set = true;
                }
            }
            if (!$length_set){
                preg_match('/Lengden på kjedet kan justeres: (.*?) cm/', $string, $matches);
                if ($matches){
                    $lengths = $this->set_lengths_1($matches);
                    $length_set = true;
                }
            }
            if (!$length_set){
                preg_match('/(?P<digit1>\d+)cm langt kjede/s', $string, $matches);
                if ($matches){
                    $lengths = $this->set_lengths_1($matches);
                    $length_set = true;
                }
            }
            if (!$length_set){
                preg_match('/kj.(?P<digit1>\d+)\/(?P<digit2>\d+)\/(?P<digit3>\d+)cm/', $string, $matches);
                if ($matches){
                    $lengths = $this->set_lengths_3a($matches);
                    $length_set = true;
                }
            }
            if (!$length_set){
                preg_match('/m.\s*pynt, (.*?)cm./', $string, $matches);
                if ($matches){
                    $lengths = $this->set_lengths_1($matches);
                    $length_set = true;
                }
            }
            
            if (!$length_set){
                preg_match('/engde:(?P<digit1>\d+)cm og (?P<digit2>\d+)cm/', $string, $matches);
                if ($matches){
                    $lengths = $this->set_lengths_array($matches);
                    $length_set = true;
                }
            }
            if (!$length_set){
                preg_match('/enge(.*?)cm og (.*?)cm/', $string, $matches);
                if ($matches){
                    $lengths = $this->set_lengths_array($matches);
                    $length_set = true;
                }
            }
            
            if (!$length_set){
                preg_match('/Str(.*?)cm og (.*?)cm/', $string, $matches);
                if ($matches){
                    $lengths = $this->set_lengths_array($matches);
                    $length_set = true;
                }
            }
            if (!$length_set){
                preg_match('/(?P<digit1>\d+)mm i diamater/s', $string, $matches);
                if ($matches){
                    $lengths = $this->set_lengths_array_diameter($matches, $string);
                    $length_set = true;
                }
            }
            if (!$length_set){
                //Str 18,5,  21,5 og 23cm
                preg_match('/\Str\s+?(.*?),\s+?(.*?)\s+?og\s+?(.*?)cm/s', $string, $matches);
                if ($matches){
                    $lengths = $this->set_lengths_3($matches);
                }
            }
            if (!$length_set){
                preg_match('/engde:(.*?)cm/', $string, $matches);
                if ($matches){
                    $lengths = $this->set_lengths_1($matches);
                    $length_set = true;
                }
            }           
            
            if (!$length_set){
                preg_match('/engde(.*?)cm/', $string, $matches);
                if ($matches){
                    $lengths = $this->set_lengths_1($matches);
                    $length_set = true;
                }
            }

            if (!$length_set){
                if (stripos($string, "str.M")){
                    $lengths = $this->set_lengths_by_name("Medium");
                    $length_set = true;
                }
            }
            
            if (!$length_set){
                if (stripos($string, "Str S/M")){
                    $lengths = $this->set_lengths_by_name("S/M");
                    $length_set = true;
                }
            }
            
            if (!$length_set){
                if (stripos($string, "Str Medium")){
                    $lengths = $this->set_lengths_by_name("Medium");
                    $length_set = true;
                }
            }
            if (!$length_set){
                preg_match('/(?P<digit1>\d+)cm/s', $string, $matches);
                if ($matches){
                    $lengths = $this->set_lengths_1($matches);
                    $length_set = true;
                }
            }
        }
        if (!$length_set){
            preg_match('/(?P<digit1>\d+),(?P<digit2>\d+) cm/s', $string, $matches);
            if ($matches){
                $lengths = $this->set_lengths_plus($matches);
                $length_set = true;
            }
        }
        if (!$length_set){
            preg_match('/(?P<digit1>\d+)\+(?P<digit2>\d+) cm/s', $string, $matches);
            if ($matches){
                $lengths = $this->set_lengths_plus($matches);
                $length_set = true;
            }
        }
        if (!$length_set){
            preg_match('/(?P<digit1>\d+) cm/s', $string, $matches);
            if ($matches){
                $lengths = $this->set_lengths_1($matches);
                $length_set = true;
            }
        }
        if (stripos($string, "Størrelse") && isset($lengths) && !stripos($string, "kjede")){
            unset($lengths);
        }
        //pr($lengths);
        if (isset($lengths))
            return $lengths;
        else 
            return NULL;
    }
    
    ///////////////////////////////////////////////////////////////////////////////
    /** 
     * used on $this->get_item_lengths()
     * items like 16,5 cm og 18 cm. 
     */
    private function set_lengths_array($matches){
        $lengths = array();
        $lengths[] = trim(str_ireplace(",", ".", $matches[1]));
        $lengths[] = trim(str_ireplace(",", ".", $matches[2]));
        return $lengths;
    }
    
    ///////////////////////////////////////////////////////////////////////////////
    /** 
     * used on $this->get_item_lengths()
     * items like Lengde på kjede er 42/45cm.
     */
    private function set_lengths_2($matches){
        $lengths = array();
        $lengths[] = $matches[1];
        $lengths[] = $matches[2];
        return $lengths;
    }
    
    ///////////////////////////////////////////////////////////////////////////////
    /** 
     * used on $this->get_item_lengths()
     * items like Anh.925s.m./kj.45/50/55cm
     */
    private function set_lengths_3a($matches){
        $lengths = array();
        $lengths[] = $matches[1];
        $lengths[] = $matches[2];
        $lengths[] = $matches[3];
        return $lengths;
    }
    
    ///////////////////////////////////////////////////////////////////////////////
    /**
     * items like S/M (62mm i diamater) og M/L (65mm i diameter)
     */
    private function set_lengths_array_diameter($matches, $string){
        $lengths[] = round($matches[1] * pi()) / 10;
        preg_match('/(?P<digit1>\d+)mm i diameter/s', $string, $matches);
        if ($matches){
            $lengths[] = round($matches[1] * pi()) / 10;
        }
        return $lengths;
    }
    
    ///////////////////////////////////////////////////////////////////////////////
    /**
     * items like Str 18,5,  21,5 og 23cm
     */
    private function set_lengths_3($matches){
        $lengths = array();
        $lengths[] = trim(str_ireplace(",", ".", $matches[1]));
        $lengths[] = trim(str_ireplace("&nbsp;", "", str_ireplace(",", ".", substr($matches[2], 2))));
        $lengths[] = trim(str_ireplace(",", ".", $matches[3]));
        return $lengths;
    }
    
    ///////////////////////////////////////////////////////////////////////////////
    /**
     * items like Lengde: 18 cm
     * lengde 34-37 cm
     */
    private function set_lengths_1($matches){
        $lengths = array();
        $lengths[] = trim(str_ireplace(",", ".", $matches[1]));
        return $lengths;
    }
    
    ///////////////////////////////////////////////////////////////////////////////
    /**
     * items like 17+1 cm
     */
    private function set_lengths_plus($matches){
        $lengths = array();
        $lengths[] = $matches[1] + $matches[2];
        return $lengths;
    }
    
    private function set_lengths_comma($matches){
        $lengths = array();
        $lengths[] = $matches[1] . '.' . $matches[2];
        return $lengths;
    }
    
    private function set_lengths_comma_plus($matches){
        $lengths = array();
        $lengths[] = $matches[1] . '.' . $matches[2] + $matches[3] ;
        return $lengths;
    }
    
    ///////////////////////////////////////////////////////////////////////////////
    /**
     * items like Str S/M
     */
    private function set_lengths_by_name($name){
        $lengths = array();
        $lengths[] = $name;
        return $lengths;
    }
    
    ///////////////////////////////////////////////////////////////////////////////
    public function get_item_height($string){
        //Høyde 5,6cm
        //32mm høy
        preg_match('/Høyde (.*?)cm/', $string, $matches);
        if ($matches){
            $height = $this->set_height_cm($matches[1]);
            return $height;
        }
        preg_match('/(?P<digit1>\d+)mm høy/s', $string, $matches);
        if ($matches){
            $height = $this->set_height_mm($matches[1]);
            return $height;
        }
        
    }
    
    ///////////////////////////////////////////////////////////////////////////////
    private function set_height_cm($string){
        $string = trim(str_ireplace(",", ".", $string));
        return $string;
    } 
    
    ///////////////////////////////////////////////////////////////////////////////
    private function set_height_mm($string){
        $string = trim(str_ireplace(",", ".", $string));
        $string = $string / 10;
        return $string;
    }

    ///////////////////////////////////////////////////////////////////////////////
    public function general_get_stones($s, $global_stones){
        $other_pearl_type           = FALSE;
        $freshwater_cultured_pearl  = FALSE;
        $other_crystal              = FALSE;
        $stones = array();
        if (    stristr($s, "agate")                                != NULL ||
                stristr($s, "agat")                                 != NULL 
        )   $stones[] = $global_stones['Agate'];
        
        if (    stristr($s, "ametyst")                              != NULL 
        )   $stones[] = $global_stones['Amethyst'];
        
        if (    stristr($s, "akvamarin")                            != NULL ||
                stristr($s, "aquamarine")                           != NULL     
        )   $stones[] = $global_stones['Aquamarine'];
        
        if (    stristr($s, "citrin")                               != NULL
        )   $stones[] = $global_stones['Citrine'];
        
        if (    stristr($s, "karneoler")                            != NULL
        )   $stones[] = $global_stones['Carnelian'];
        
        if (    stristr($s, "krysopras")                            != NULL
        )   $stones[] = $global_stones['Chrysoprase'];
        
        //if (  stristr($s, "bomullssnor")                          != NULL
        //) $stones[] = $global_stones['Cotton Drawstring'];
        
        if (    stristr($s, "blanke cz")                            != NULL ||
                stristr($s, "cub.zirk")                             != NULL ||
                stristr($s, "cubic zirkonia")                       != NULL ||
                stristr($s, "cubik zirikonia")                      != NULL ||
                stristr($s, "cubik zirkoni")                        != NULL ||
                stristr($s, "cubik zirkonia")                       != NULL ||
                stristr($s, "Cubik zrikonia")                       != NULL ||
                strstr($s, "CZ")                                    != NULL ||
                strstr($s, "cz ")                                   != NULL ||
                strstr($s, "sort cz")                               != NULL ||
                stristr($s, "stk cz")                               != NULL ||
                stristr($s, "syntetisk cubic zirkonia")             != NULL ||
                stristr($s, "zirkoner")                             != NULL ||
                stristr($s, "zirkonia")                             != NULL
        )   $stones[] = $global_stones['Cubic zirconia'];
        
        if ((   stristr($s, "brillianter")                          != NULL ||
                stristr($s, "cognac diamant")                       != NULL ||
                stristr($s, "cognac diamanter")                     != NULL ||
                stristr($s, "cognacfargede diamanter")              != NULL ||
                strstr($s, "Dia")                                   != NULL ||
                stristr($s, "diamant")                              != NULL ||
                stristr($s, "diamanter")                            != NULL ||
                stristr($s, "diamantene")                           != NULL ||
                stristr($s, "diamond_weight")                       != NULL ||
                stristr($s, "hvite diamanter")                      != NULL ||
                stristr($s, "m/dia")                                != NULL ||
                stristr($s, "princess")                             != NULL) &&
                stristr($s, "diaslip")                              == NULL &&
                stristr($s, "diacut")                               == NULL
        )   $stones[] = $global_stones['Diamond'];
        
        if (    stristr($s, "smaragd")                              != NULL
        )   $stones[] = $global_stones['Emerald'];
        
        //if (  stristr($s, "emalje")                               != NULL ||
        //      stristr($s, "emaljert")                             != NULL
        //) $stones[] = $global_stones['Enamel'];
        
        if (    stristr($s, "Ferksvanns kulturperle")               != NULL ||
                stristr($s, "ferskvanns kulturperle")               != NULL ||
                stristr($s, "Ferksvanns kulturperle")               != NULL
        )   {
            $other_pearl_type = TRUE;
            $freshwater_cultured_pearl = TRUE;
            $stones[] = $global_stones['Freshwater cultured pearl'];
            $stones[] = $global_stones['Cultured pearl'];
        }
        
        if ((   stristr($s, "ferskvannsperle")                      != NULL ||
                stristr($s, "ferskvansperle")                       != NULL ||
                stristr($s, "Ferksvanns perle")                     != NULL ||
                stristr($s, "Ferksvannsperle")                      != NULL// ||
                //stristr($s, "kulturperle")                            != NULL ||
                //stristr($s, "kulturperler")                       != NULL
            ) && !$freshwater_cultured_pearl
        )   {
            $other_pearl_type = TRUE;
            $stones[] = $global_stones['Freshwater pearl'];
        }
        
        
        
        if (    stristr($s, "Saltvanns kulturperle")                != NULL //||
                //stristr($s, "Saltvanns perle")                        != NULL
        )   {
            $other_pearl_type = TRUE;
            $stones[] = $global_stones['Salt water cultured pearl'];
            $stones[] = $global_stones['Cultured pearl'];
        }
        
        if (    stristr($s, "Saltvanns perle")                      != NULL
        )   {
            $other_pearl_type = TRUE;
            $stones[] = $global_stones['Salt water pearl'];
        }
        
        if (    stristr($s, "Akoya perle")                          != NULL
        ) {
            $other_pearl_type = TRUE;
            $stones[] = $global_stones['Akoya pearl'];
        }
        
        if (    stristr($s, "tahitiperler")                         != NULL ||
                stristr($s, "tahiti perle")                         != NULL
        ) {
            $other_pearl_type = TRUE;
            $stones[] = $global_stones['Tahiti pearl'];
        }
        
        if (    stristr($s, "Tahiti kulturperle")                   != NULL
        ) {
            $other_pearl_type = TRUE;
            $stones[] = $global_stones['Cultured pearl'];
            $stones[] = $global_stones['Tahiti pearl'];
        }
        
        if (    stristr($s, "granat")                               != NULL
        )   $stones[] = $global_stones['Garnet'];
        
        if (    stristr($s, "glass")                                != NULL ||
                stristr($s, "glassten")                             != NULL
        )   $stones[] = $global_stones['Glass Stone'];
        
        if (    stristr($s, "hematitt")                             != NULL
        )   $stones[] = $global_stones['Hematite'];
        
        if (    stristr($s, "månesten")                             != NULL ||
                stristr($s, "månest")                               != NULL //månest - found on David Andersen
        )   $stones[] = $global_stones['Moon Stone'];
        
        if (    stristr($s, "mabe perle")                           != NULL ||
                stristr($s, "Perlemor")                             != NULL
        ){
            $other_pearl_type = TRUE;
            $stones[] = $global_stones['Mother of pearl'];
        }   
        
        if (    stristr($s, "onyx")                                 != NULL
        )   $stones[] = $global_stones['Onyx'];
        
        if (    stristr($s, "opal")                                 != NULL
        )   $stones[] = $global_stones['Opal'];
        
        /** 
         * this is to get xx stener and save it as other stones
         */
        preg_match_all('/(?P<digit1>\d+) stener/s', $s, $matches);
        
        if (    stristr($s, "andre steiner")                        != NULL ||
                stristr($s, "sorte stener")                         != NULL ||
                stristr($s, "lilla stener")                         != NULL ||
                stristr($s, "blå sten")                             != NULL ||
                stristr($s, "sort sten")                            != NULL ||
                stristr($s, "stenmix")                              != NULL ||
                stristr($s, "koral caborchon")                      != NULL ||
                stristr($s, "Synt Aqua")                            != NULL ||
                isset($matches['digit1'][0])
        )   $stones[] = $global_stones['Other Stones'];
        
        if (    stristr($s, "obsidian")                             != NULL
        )   $stones[] = $global_stones['Obsidian'];
        
        if (    stristr($s, "andre syntetiske steiner")             != NULL ||
                stristr($s, "syntetisk sten")                       != NULL ||
                stristr($s, "syntetiske stener")                    != NULL ||
                stristr($s, "syntetiske fargestener")               != NULL
        )   $stones[] = $global_stones['Other Synthetic Stones'];
        
        if (    stristr($s, "peridot")                              != NULL
        )   $stones[] = $global_stones['Peridot'];
        
        if (    stristr($s, "Kvarts")                               != NULL ||
                stristr($s, "røkkvarts")                            != NULL
        )   $stones[] = $global_stones['Quartz'];
        
        if (    stristr($s, "resin")                                != NULL ||
                stristr($s, "resing")                               != NULL
        )   $stones[] = $global_stones['Resin'];
        
        if (    stristr($s, "bergkrystall")                         != NULL
        )   $stones[] = $global_stones['Rock crystal'];
        
        if (    stristr($s, "rubin")                                != NULL
        )   $stones[] = $global_stones['Ruby'];
        
        if (    stristr($s, "saltvann kultivert perle")             != NULL ||
                stristr($s, "Salt water cultured pearl")            != NULL
        )   {
            $other_pearl_type = TRUE;
            $stones[] = $global_stones['Salt water cultured pearl'];
        }
        
        if (    stristr($s, "safir")                                != NULL ||
                stristr($s, "Safirer")                              != NULL
        )   $stones[] = $global_stones['Sapphire'];
        
        if (    stristr($s, "skjellperle")                          != NULL
        )   {
            $other_pearl_type = TRUE;
            $stones[] = $global_stones['Shell Pearl'];
        }
        
        if (    stristr($s, "sydhavsperler")                        != NULL
        )   {
            $other_pearl_type = TRUE;
            $stones[] = $global_stones['Pacific pearls'];
        }
        
        if (    stristr($s, "swarovski")                            != NULL ||
                stristr($s, "swarovski krystal")                    != NULL ||
                stristr($s, "swarovski krystall")                   != NULL ||
                stristr($s, "swarovski krystaller")                 != NULL ||
                stristr($s, "swarovski krystaller")                 != NULL
        )   {
            $other_crystal = TRUE;
            $stones[] = $global_stones['Swarovski Crystal'];
        }
        
        if (    stristr($s, "syntetisk perle")                      != NULL ||
                stristr($s, "syntetiske perler")                    != NULL ||
                stristr($s, "synt perler")                          != NULL ||
                stristr($s, "synt. perle")                          != NULL
        )   {
            $other_pearl_type = TRUE;
            $stones[] = $global_stones['Synthetic pearl'];
        }
        
        if (    stristr($s, "syntetisk rubin")                      != NULL 
        )   $stones[] = $global_stones['Synthetic ruby'];
        
        if (    stristr($s, "syntetisk safir")                      != NULL 
        )   $stones[] = $global_stones['Synthetic sapphire'];
        
        if (    stristr($s, "tanzanite")                            != NULL 
        )   $stones[] = $global_stones['Tanzanite'];
        
        if (    stristr($s, "terbium")                              != NULL 
        )   $stones[] = $global_stones['Terbium'];
        
        if (    stristr($s, "topas")                                != NULL ||
                stristr($s, "topaz")                                != NULL 
        )   $stones[] = $global_stones['Topaz'];
        
        if (    stristr($s, "tourmaline")                           != NULL 
        )   $stones[] = $global_stones['Tourmaline'];
        
        if (    stristr($s, "turkis")                               != NULL 
        )   $stones[] = $global_stones['Turquoise'];
        
        if ((   stristr($s, " pearl")                               != NULL ||
                stristr($s, " perle")                               != NULL ||
                stristr($s, "perle")                                != NULL) &&
                !$other_pearl_type
        )   $stones[] = $global_stones['Pearl'];
        
        if ((   stristr($s, "krystall")                             != NULL) &&
                !$other_crystal
        )   $stones[] = $global_stones['Crystal'];
        
        if (    stristr($s, "kalcedon")                             != NULL ||
                stristr($s, "kalsedon")                             != NULL ||
                stristr($s, "calcedon")                             != NULL     
        )   $stones[] = $global_stones['Kalsedon'];
        
        if (    stristr($s, "prasiolitt")                               != NULL
        )   $stones[] = $global_stones['Prasiolite'];
        
        if (    stristr($s, "labradoritt")                              != NULL
        )   $stones[] = $global_stones['Labradorite'];
        
        if (    stristr($s, "markasitter")                              != NULL
        )   $stones[] = $global_stones['Marcasite'];
        
        return array_unique($stones);
    }

    ///////////////////////////////////////////////////////////////////////////////
    public function set_multiple_carats_comment($products, $diamond_id, $thune = NULL){
        //pr($products);
        foreach ($products as $key=>$value){
            /*
            $string = $this->prepare_string_for_multiple_carat_search($products[$key]['name']);
            preg_match_all('/Dia\s+?(?P<digit1>\d+).(?P<digit2>\d+)\s+?ct/s', $string, $matches, PREG_SET_ORDER);
            if(count($matches) > 1){
                pr($name);
                pr($matches);
                $carats = array();
                foreach ($matches as $match){
                    $carats[] = $match[1] . "." . $match[2];
                }
                pr($carats);
            }*/
            if (!isset($thune)){
                $string = $this->prepare_string_for_multiple_carat_search($products[$key]['description']);
            } else {
                if ($thune == "thune_stone_info"){
                    $string = $this->prepare_string_for_multiple_carat_search($products[$key]['stone_info']);
                }
            }
            if (isset($thune)){
                preg_match_all('/(?P<digit1>\d+).(?P<digit2>\d+)/s', $string, $matches);
            } else {
                preg_match_all('/ (?P<digit1>\d+).(?P<digit2>\d+)\s*ct/s', $string, $matches);
            }
            //pr($products[$key]);die();
            if ($matches){
                //pr($string); //pr($matches);
                if (count($matches[0]) > 1) {
                    $diamond_found = false;
                    $only_diamonds = true;
                    foreach ($products[$key]['Stones'] as $stone){
                        if ($stone == $diamond_id){
                            $diamond_found = true;
                        } else {
                            $only_diamonds = false;
                        }
                    }
                    //pr($only_diamonds);pr($diamond_found);
                    if ($only_diamonds && $diamond_found && !isset($thune)){
                        //pr($products[$key]);
                        //pr($matches);
                        $carats = array();
                        for ($i = 0; $i < count($matches[0]); $i++){
                            $carat_string = $matches[1][$i] . "." . $matches[2][$i];
                            $carats[] = floatval($carat_string);
                        }
                        $carats = array_unique($carats);
                        if (count($carats) > 1){
                            $products[$key]['comments'] = "Found multiple carats";
                        }
                    }
                    else if ($diamond_found && isset($thune)){
                        //echo 'here';pr($products[$key]);die();
                        //pr($products[$key]);
                        //pr($matches);
                        $carats = array();
                        for ($i = 0; $i < count($matches[0]); $i++){
                            $carats[] = $matches[1][$i] . "." . $matches[2][$i];
                        }
                        $carats = array_unique($carats);
                        if (count($carats) > 1){
                            $products[$key]['comments'] = "Found multiple carats";
                        }
                    }
                    
                }
            }
            //if ($products[$key]['code'] == '25611'){
            //  pr($string);pr($matches);pr($products[$key]);die();
            //}
        }
        //pr($products);
        return $products;
        echo "ending set_multiple_carats_comment()";
        die();
    }
    
    ///////////////////////////////////////////////////////////////////////////////
    private function prepare_string_for_multiple_carat_search($string){
        $string = str_ireplace(",", ".", $string);
        $string = str_ireplace("Dia.", "Dia", $string);
        //$string = str_ireplace(" ", "", $string);
        return $string;
    }

    ///////////////////////////////////////////////////////////////////////////////
    public function set_metal_and_colors($product, $global_metal_and_colors, $global_materials, $global_material_colors){
        $product['metal_and_colors'] = array();
        if (isset($product['material_id'])) switch ($product['material_id']){
            case $global_materials['Silver']:
                $product['metal_and_colors'][] = $global_metal_and_colors['Silver'];
                break;
            case $global_materials['Gold']:
                $product['metal_and_colors'][] = $global_metal_and_colors['Gold (All)'];
                if (isset($product['material_color_id'])){
                    switch ($product['material_color_id']){
                        case $global_material_colors['White']:
                            $product['metal_and_colors'][] = $global_metal_and_colors['White Gold'];
                            break;
                        case $global_material_colors['Yellow']:
                            $product['metal_and_colors'][] = $global_metal_and_colors['Yellow Gold'];
                            break;
                        case $global_material_colors['Yellow & White']:
                            $product['metal_and_colors'][] = $global_metal_and_colors['Yellow & White Gold'];
                            break;
                        case $global_material_colors['Rose']:
                            $product['metal_and_colors'][] = $global_metal_and_colors['Rose Gold'];
                            break;
                        case $global_material_colors['Red']:
                            $product['metal_and_colors'][] = $global_metal_and_colors['Red Gold'];
                            break;
                        case $global_material_colors['Red & Rose']:
                            $product['metal_and_colors'][] = $global_metal_and_colors['Red & Rose Gold'];
                            break;
                        case $global_material_colors['Red & White']:
                            $product['metal_and_colors'][] = $global_metal_and_colors['Red & White Gold'];
                            break;
                        case $global_material_colors['Red & Pink']:
                            $product['metal_and_colors'][] = $global_metal_and_colors['Red & Pink Gold'];
                            break;
                        case $global_material_colors['Pink']:
                            $product['metal_and_colors'][] = $global_metal_and_colors['Pink Gold'];
                            break;
                        case $global_material_colors['Rose & White']:
                            $product['metal_and_colors'][] = $global_metal_and_colors['Rose & White Gold'];
                            break;
                        case $global_material_colors['Red, White & Yellow']:
                            $product['metal_and_colors'][] = $global_metal_and_colors['Red, White & Yellow Gold'];
                            break;
                        case $global_material_colors['Yellow & Pink']:
                            $product['metal_and_colors'][] = $global_metal_and_colors['Yellow & Pink Gold'];
                            break;
                        case $global_material_colors['White & Pink']:
                            $product['metal_and_colors'][] = $global_metal_and_colors['White & Pink Gold'];
                            break;
                        case $global_material_colors['Rose & White']:
                            $product['metal_and_colors'][] = $global_metal_and_colors['Rose & White Gold'];
                            break;
                    }
                }
                break;
            case $global_materials['Silver & Gold']:
                $product['metal_and_colors'][] = $global_metal_and_colors['Gold (All)'];
                $product['metal_and_colors'][] = $global_metal_and_colors['Silver'];
                switch ($product['material_color_id']){
                    case $global_material_colors['White']:
                        $product['metal_and_colors'][] = $global_metal_and_colors['White Gold'];
                        break;
                    case $global_material_colors['Yellow']:
                        $product['metal_and_colors'][] = $global_metal_and_colors['Yellow Gold'];
                        break;
                    case $global_material_colors['Yellow & White']:
                        $product['metal_and_colors'][] = $global_metal_and_colors['Yellow & White Gold'];
                        break;
                    case $global_material_colors['Rose']:
                        $product['metal_and_colors'][] = $global_metal_and_colors['Rose Gold'];
                        break;
                    case $global_material_colors['Red']:
                        $product['metal_and_colors'][] = $global_metal_and_colors['Red Gold'];
                        break;
                    case $global_material_colors['Red & Rose']:
                        $product['metal_and_colors'][] = $global_metal_and_colors['Red & Rose Gold'];
                        break;
                    case $global_material_colors['Red & White']:
                        $product['metal_and_colors'][] = $global_metal_and_colors['Red & White Gold'];
                        break;
                    case $global_material_colors['Red & Pink']:
                        $product['metal_and_colors'][] = $global_metal_and_colors['Red & Pink Gold'];
                        break;
                    case $global_material_colors['Pink']:
                        $product['metal_and_colors'][] = $global_metal_and_colors['Pink Gold'];
                        break;
                    case $global_material_colors['Rose & White']:
                        $product['metal_and_colors'][] = $global_metal_and_colors['Rose & White Gold'];
                        break;
                    case $global_material_colors['Red, White & Yellow']:
                        $product['metal_and_colors'][] = $global_metal_and_colors['Red, White & Yellow Gold'];
                        break;
                    case $global_material_colors['Yellow & Pink']:
                        $product['metal_and_colors'][] = $global_metal_and_colors['Yellow & Pink Gold'];
                        break;
                    case $global_material_colors['White & Pink']:
                        $product['metal_and_colors'][] = $global_metal_and_colors['White & Pink Gold'];
                        break;
                    case $global_material_colors['Rose & White']:
                        $product['metal_and_colors'][] = $global_metal_and_colors['Rose & White Gold'];
                        break;
                }
                break;
            case $global_materials['Steel']:
                $product['metal_and_colors'][] = $global_metal_and_colors['Steel'];
                break;
            case $global_materials['Silver & Gold']:
                $product['metal_and_colors'][] = $global_metal_and_colors['Gold (All)'];
                $product['metal_and_colors'][] = $global_metal_and_colors['Silver'];
                break;
            case $global_materials['Bronze']:
                $product['metal_and_colors'][] = $global_metal_and_colors['Bronze'];
                break;
        }
        return $product;
    }
    
    /**
     * used for Necklacess & Pendants
     */
    public function set_special_master_category($product, $data, $master_categories, $websites){
        //pr($product); pr($data); pr($master_categories); pr($websites);die();
        if ($product['website_id'] == $websites['Mestergull']){
            if (stristr($product['description'], "kjede") !== FALSE){
                $product['master_category_id'] = $master_categories['Necklacess & Pendants'];
            } else {
                $product['master_category_id'] = $master_categories['Pendants'];
            }
        }
        else if ($product['website_id'] == $websites['David Andersen'] ||
            $product['website_id'] == $websites['Gullfunn']){
            if (stristr($product['description'], "kjede") !== FALSE &&
                stristr($product['description'], "anheng") !== FALSE){
                $product['master_category_id'] = $master_categories['Necklacess & Pendants'];
            } else if (stristr($product['description'], "kjede") !== FALSE){
                $product['master_category_id'] = $master_categories['Necklacess'];
            } else if (stristr($product['description'], "anheng") !== FALSE){
                $product['master_category_id'] = $master_categories['Pendants'];
            }
        } else if ($product['website_id'] == $websites['Thune']){
            if (stristr($product['description'], "uten kjede") !== FALSE ||
                stristr($product['description'], "eksklusiv kjede") !== FALSE){
                $product['master_category_id'] = $master_categories['Pendants'];                
            } else if (stristr($product['description'], "med kjede") !== FALSE ||
                stristr($product['description'], "Leveres komplett") !== FALSE || 
                stristr($product['description'], "leveres med") !== FALSE){
                $product['master_category_id'] = $master_categories['Necklacess & Pendants'];
            }
        }
        return $product;
    }
    
    /**
     * Set Necklace & Pendants as master category and set necklace types
     */
    public function set_necklace_types($product, $global_master_categories, $websites, $global_necklace_types, $global_stones){
        if ($product['website_id'] == $websites['Bjørklund']){
            if ($product['real_category_name'] == 'halssmykker'){
                $product['NecklaceTypes'][] = $global_necklace_types['Pendant (All)'];
                foreach ($product['Stones'] as $stone){
                    if ($stone == $global_stones['Freshwater pearl'] ||
                        $stone == $global_stones['Mother of pearl'] ||
                        $stone == $global_stones['Shell Pearl'] ||
                        $stone == $global_stones['Pearl']){
                        $product['NecklaceTypes'][] = $global_necklace_types['Pearl Necklace'];
                        break;
                    }
                }
            }
            if ($product['real_category_name'] == 'halskjeder'){
                $product['NecklaceTypes'][] = $global_necklace_types['Necklace (All)'];
                foreach ($product['Stones'] as $stone){
                    if ($stone == $global_stones['Freshwater pearl'] ||
                        $stone == $global_stones['Mother of pearl'] ||
                        $stone == $global_stones['Shell Pearl'] ||
                        $stone == $global_stones['Pearl']){
                        $product['NecklaceTypes'][] = $global_necklace_types['Pearl Necklace'];
                        break;
                    }
                }
                if (stristr($product['name'], "Ankelkjede") !== FALSE){
                    $product['NecklaceTypes'][] = $global_necklace_types['Ankle Chain'];
                }
            }
        } else if ($product['website_id'] == $websites['Mestergull']){
            $is_pendant = false; $is_necklace = false;
            if (stristr($product['description'], "kjede") !== FALSE){
                $is_necklace = true;
                $product['NecklaceTypes'][] = $global_necklace_types['Necklace (All)'];
            } else {
                $is_pendant = true;
                $product['NecklaceTypes'][] = $global_necklace_types['Pendant (All)'];
            }
            if (stristr($product['name'], "Ankelkjede") !== FALSE){
                $product['NecklaceTypes'][] = $global_necklace_types['Ankle Chain'];
            }
            foreach ($product['Stones'] as $stone){
                if ($stone == $global_stones['Freshwater pearl'] ||
                    $stone == $global_stones['Mother of pearl'] ||
                    $stone == $global_stones['Shell Pearl'] ||
                    $stone == $global_stones['Pearl']){
                    if ($is_necklace)
                        $product['NecklaceTypes'][] = $global_necklace_types['Pearl Necklace'];
                    if ($is_pendant)
                        $product['NecklaceTypes'][] = $global_necklace_types['Pearl Pendant'];  
                    break;
                }
            }
        } else if ($product['website_id'] == $websites['David Andersen']){
            $is_pendant = false; $is_necklace = false;
            if (stristr($product['description'], "kjede") !== FALSE &&
                stristr($product['description'], "anheng") !== FALSE){
                $is_necklace = true; $is_pendant = true;
                $product['NecklaceTypes'][] = $global_necklace_types['Necklace (All)'];
                $product['NecklaceTypes'][] = $global_necklace_types['Pendant (All)'];
            } else if (stristr($product['description'], "kjede") !== FALSE ||
                stristr($product['description'], "Sweet Drop") !== FALSE){
                $is_necklace = true;
                $product['NecklaceTypes'][] = $global_necklace_types['Necklace (All)'];
            } else if (stristr($product['description'], "anheng") !== FALSE){
                $is_pendant = true;
                $product['NecklaceTypes'][] = $global_necklace_types['Pendant (All)'];
            }
            if (stristr($product['name'], "Ankelkjede") !== FALSE){
                $product['NecklaceTypes'][] = $global_necklace_types['Ankle Chain'];
            }
            foreach ($product['Stones'] as $stone){
                if ($stone == $global_stones['Freshwater pearl'] ||
                    $stone == $global_stones['Mother of pearl'] ||
                    $stone == $global_stones['Shell Pearl'] ||
                    $stone == $global_stones['Pearl']){
                    if ($is_necklace)
                        $product['NecklaceTypes'][] = $global_necklace_types['Pearl Necklace'];
                    if ($is_pendant)
                        $product['NecklaceTypes'][] = $global_necklace_types['Pearl Pendant'];  
                    break;
                }
            }
        } else if ($product['website_id'] == $websites['Gullfunn']){
            $is_pendant = false; $is_necklace = false;
            if (stristr($product['name'], "kjede") !== FALSE &&
                stristr($product['name'], "anheng") !== FALSE){
                $is_necklace = true; $is_pendant = true;
                $product['NecklaceTypes'][] = $global_necklace_types['Necklace (All)'];
                $product['NecklaceTypes'][] = $global_necklace_types['Pendant (All)'];
            } else if (stristr($product['description'], "kjede") !== FALSE ||
                stristr($product['name'], "kjede") !== FALSE ||
                stristr($product['description'], "Sweet Drop") !== FALSE ||
                stristr($product['name'], "Collier") !== FALSE || 
                stristr($product['name'], "halssmykke") !== FALSE){
                $is_necklace = true;
                $product['NecklaceTypes'][] = $global_necklace_types['Necklace (All)'];
            } else if (stristr($product['description'], "anheng") !== FALSE ||
                stristr($product['description'], "charms") !== FALSE ||
                stristr($product['name'], "charms") !== FALSE){
                $is_pendant = true;
                $product['NecklaceTypes'][] = $global_necklace_types['Pendant (All)'];
            }
            if (stristr($product['name'], "Ankelkjede") !== FALSE){
                $product['NecklaceTypes'][] = $global_necklace_types['Ankle Chain'];
            }
            foreach ($product['Stones'] as $stone){
                if ($stone == $global_stones['Freshwater pearl'] ||
                    $stone == $global_stones['Mother of pearl'] ||
                    $stone == $global_stones['Shell Pearl'] ||
                    $stone == $global_stones['Pearl']){
                    if ($is_necklace)
                        $product['NecklaceTypes'][] = $global_necklace_types['Pearl Necklace'];
                    if ($is_pendant)
                        $product['NecklaceTypes'][] = $global_necklace_types['Pearl Pendant'];  
                    break;
                }
            }
        } else if ($product['website_id'] == $websites['Thune']){
            $is_pendant = false; $is_necklace = false;
            if (stripos($product['description'], "uten kjede") !== FALSE ||
                stripos($product['description'], "eksklusiv kjede") !== FALSE ||
                stripos($product['description'], "Kjede ikke inkludert") !== FALSE){
                $is_pendant = true;
                $product['NecklaceTypes'][] = $global_necklace_types['Pendant (All)'];          
            } else if (stripos($product['description'], "med kjede") !== FALSE ||
                stripos($product['description'], "Leveres komplett") !== FALSE || 
                stripos($product['description'], "leveres med") !== FALSE){
                $is_pendant = true; $is_necklace = true;
                $product['NecklaceTypes'][] = $global_necklace_types['Necklace (All)'];
                $product['NecklaceTypes'][] = $global_necklace_types['Pendant (All)'];
            } else if (stripos($product['description'], "kjede") !== FALSE) {
                $is_necklace = true;
                $product['NecklaceTypes'][] = $global_necklace_types['Necklace (All)'];
            } else if (stripos($product['description'], "anheng") !== FALSE) {
                $is_pendant = true;
                $product['NecklaceTypes'][] = $global_necklace_types['Pendant (All)'];
            }
            if (stripos($product['name'], "Ankelkjede") !== FALSE){
                $product['NecklaceTypes'][] = $global_necklace_types['Ankle Chain'];
            }

            foreach ($product['Stones'] as $stone){
                if ($stone == $global_stones['Freshwater pearl'] ||
                    $stone == $global_stones['Mother of pearl'] ||
                    $stone == $global_stones['Shell Pearl'] ||
                    $stone == $global_stones['Pearl']){
                    if ($is_necklace)
                        $product['NecklaceTypes'][] = $global_necklace_types['Pearl Necklace'];
                    if ($is_pendant)
                        $product['NecklaceTypes'][] = $global_necklace_types['Pearl Pendant'];  
                    break;
                }
            }
        }
        
        return $product;
    }
    
    /**
     * used on MG scrappers to get the formatted product url:: 
     */
    public function set_mestergull_product_link($product, $node, $match){
        $product['link'] = str_replace("ajax_product_search", "productSearch", $node['url']) . "&id=" . $match[2];
        $product['link'] = str_replace("ajax_product_search", "productSearch", $node['url']) . "&id=" . $match[2];
        $product['link'] = str_replace("GULT%20GULL", "GULT+GULL", $product['link']);
        $product['link'] = str_replace("HVITT%20GULL", "Hvitt+gull", $product['link']);
        $product['link'] = str_replace("ROS* GULL", "Ros*+gull", $product['link']);
        $product['link'] = str_replace("Flerfarget*%20gull", "Flerfarget+gull", $product['link']);
        $product['link'] = str_replace("&single_page=true&sort=ascending&page=", "#page=", $product['link']);
        
        return $product['link'];
    }
    
    /** 
     * used on Thune
     */
    public function set_surface($product, $global_surfaces){
        if (isset($product['surface'])){
            if ($product['surface'] == 'Rhodinering' || $product['surface'] == 'Rhodinert')
                $product['surface_id'] = $global_surfaces['Rhodinated'];
            if ($product['surface'] == 'Oksidering' || $product['surface'] == 'Oksidert')
                $product['surface_id'] = $global_surfaces['Oxidized'];
            if ($product['surface'] == 'Hvit/forgylt')
                $product['surface_id'] = $global_surfaces['White/plated'];
            if ($product['surface'] == 'Forgylling' || $product['surface'] == 'Forgylt')
                $product['surface_id'] = $global_surfaces['Plated'];
            if ($product['surface'] == 'Emaljert')
                $product['surface_id'] = $global_surfaces['Enamelled'];
            if ($product['surface'] == 'Delvis rhodinert')
                $product['surface_id'] = $global_surfaces['Partly rhodinated'];
            if ($product['surface'] == 'Delvis forgylt')
                $product['surface_id'] = $global_surfaces['Partly plated'];
            if ($product['surface'] == 'Delvis emaljert')
                $product['surface_id'] = $global_surfaces['Partly enamelled'];
            if ($product['surface'] == 'Annet')
                $product['surface_id'] = $global_surfaces['Other'];
            
            //$product['surface_id'] = $global_surfaces[$product['surface']];
        } else if (stripos($product['description'], "rhodinert") !== FALSE){
            $product['surface_id'] = $global_surfaces['Rhodinated'];
        }
        return $product;
    }
    
}
