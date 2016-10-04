<?php
namespace App\Shell;
use Cake\Console\Shell;
use Cake\Network\Http\Client;
#use Cake\Utility\Exception\XmlException; 
#use DOMDocument; 

class ScrapShell extends Shell
{

	public $mega_structure 		= array();
	public $bjorklund_website_url		= "http://www.bjorklund.no";
	public $mestergull_website_url		= "http://www.mestergull.no";
	public $davidandersen_website_url	= "http://david-andersen.no";
	public $gullfunn_website_url		= "http://www.gullfunn.no";
	public $thune_website_url			= "http://www.thune.no";
	public $counter2 = 0;

	public $mestergull_page_numbers		= 70;
	public $bjorklund_page_numbers		= 30; //normal is 30
	public $mestergull_action_id;
	public $bjorklund_action_id;
	public $global_stones 				= array();
	public $global_filter_stones		= array();
	public $global_occasions			= array();
	public $global_diamond_colors		= array();
	public $global_diamond_clarities	= array();
	public $global_surfaces				= array();
	public $global_materials			= array();
	public $global_material_colors		= array();
	public $global_styles				= array();
	public $global_chains				= array();
	public $global_clasps				= array();
	public $global_metal_and_colors		= array();
	public $global_master_categories	= array();
	public $global_websites				= array();
	public $global_necklace_types		= array();

	public $scraped_products 	= array();
	public $prescraped_products	= array();

	public $mestergull_pattern = NULL;
	public $mestergull_special_product_pattern 	= NULL;
	public $still_scrapping = true;

	public $bjorklund_pattern_next_link = null;
	public $bjorklund_page_limit 		= 10; // can be 50

	public function initialize()
	{
		parent::initialize();
		$this->loadModel('Jewelries');
		$this->loadModel('Stores');
		$this->loadModel('Websites');
		$this->loadModel('Categories');
		$this->loadModel('Actions');
		$this->loadModel('FilterStones');
		$this->loadModel('Stones');
		$this->loadModel('Occasions');
		$this->loadModel('DiamondColors');
		$this->loadModel('Surfaces');
		$this->loadModel('Materials');
		$this->loadModel('MaterialColors');
		$this->loadModel('MetalAndColors');
		$this->loadModel('DiamondClarities');
		$this->loadModel('MasterCategories');
		$this->loadModel('NecklaceTypes');
		$this->loadModel('ItemOccasions');
		$this->loadModel('Items');
		$this->loadModel('ItemStones');
		$this->loadModel('DiamondClarities');
		$this->loadModel('ItemMetalAndColors');
		$this->loadModel('ItemFilterStones');
		$this->loadModel('Styles');
		$this->loadModel('Chains');
		$this->loadModel('Clasps');
		$this->loadModel('ItemLengths');
		$this->loadModel('Lengths');
		$this->loadModel('ItemNecklaceTypes');

		$this->mestergull_pattern = "/";
		$this->mestergull_pattern .= "<li class=\"(.*?)\" data-id=\"(.*?)\"><a href=\"(.*?)\" class=\"product\">\s+?";
		$this->mestergull_pattern .= "<h3(.*?)>(.*?)<\/h3><span class=\"description\">(.*?)<\/span><img src=\"(.*?)\" alt=\"(.*?)\" title=\"(.*?)\" data-src=\"(.*?)\"><span class=\"article_number\">(.*?)<\/span><dl class=\"price_info clearfix\">\s+?";
		$this->mestergull_pattern .= "<dt class=\"price\">Kr<\/dt>\s+?";
		$this->mestergull_pattern .= "<dd class=\"price\">(.*?),-<\/dd>\s+?";
		$this->mestergull_pattern .= "<\/dl><\/a><\/li>/s";

		$this->mestergull_special_product_pattern = "/";
		$this->mestergull_special_product_pattern .= "<p class=\"description\">(.*?)<\/p>";
		$this->mestergull_special_product_pattern .= "/s";

		$this->bjorklund_pattern_next_link = "/<span class=\"next\"><a href=\"(.*?)\">(.*?)<\/a><\/span>/s";

		$this->bjorklund_page_pattern = "/<div class=\"image\">\s+?<a href=\"(.*?)\">/s";
		
		$this->bjorklund_pattern = "/<div class=\"product_right(.*?)\">\s+?";
		$this->bjorklund_pattern .= "<h1 class=\"hidden\">(.*?)<\/h1>\s+?";
        $this->bjorklund_pattern .= "<h2>(.*?)<\/h2>\s+?";
		$this->bjorklund_pattern .= "<form id=\"addToBasket\" action=\"\/content\/action\" method=\"post\">\s+?";
		$this->bjorklund_pattern .= "<div class=\"price\"><span class=\"currentprice\">KR (.*?),-<\/span><\/div>\s+?";
		$this->bjorklund_pattern .= "<h3>Beskrivelse<\/h3>\s+?";
		$this->bjorklund_pattern .= "(.*?)";
		$this->bjorklund_pattern .= "<p>(.*?)<\/p>\s+?";
		$this->bjorklund_pattern .= "<h3>Detaljer:<\/h3>\s+?";
		$this->bjorklund_pattern .= "<ul>\s+?";
		$this->bjorklund_pattern .= "(.*?)";
		$this->bjorklund_pattern .= "<\/ul>";
		$this->bjorklund_pattern .= "/s";
		
		$this->bjorklund_image_pattern = "/<a class=\"lightbox\" href=\"(.*?)\" target=\"_blank\">\s+?";
		$this->bjorklund_image_pattern .= "<img src=\"(.*?)\" alt=\"(.*?)\" \/>\s+?";
		$this->bjorklund_image_pattern .= "<\/a>/s";
	}

	public function main()
    {
        $this->out('Hello world.');
    }

    private function get_data($url) 
    {
    	$http = new Client();
    	$response = $http->get($url);
    	$html = $response->body();
		return $html;
	}

    public function scrapMestergull($category = null)
    {

    	$this->out('Scrapping ' . $category);

    	for ($i = 1; $i <= 70; $i++) {
	    	$main_url = 'http://www.mestergull.no/?template=ajax_product_search&templatefolderid=53&_ips_encoding=UTF-8&brand=-1&product_group=-1&product_type=Ring&material=GULT%20GULL&price=-1&query=&single_page=true&sort=ascending&page=' . $i;

	    	$pattern = "/";
	    	$pattern .= "<li class=\"(.*?)\" data-id=\"(.*?)\">\s*?";
	    	$pattern .= "<a href=\"(.*?)\" class=\"product\">\s*?";
	        $pattern .= "<h3 title=\"(.*?)\">(.*?)<\/h3>\s*?";
	        $pattern .= "<span class=\"description\">(.*?)<\/span>\s*?";
	        $pattern .= "<img src=\"(.*?)\" alt=\"(.*?)\" title=\"(.*?)\" data-src=\"(.*?)\">\s*?";
	        $pattern .= "<span class=\"article_number\">(.*?)<\/span>\s*?";
	        $pattern .= "<dl class=\"price_info clearfix\">\s*?";
			$pattern .= "<dt class=\"price\">Kr<\/dt>\s*?";
			$pattern .= "<dd class=\"price\">(.*?)<\/dd>\s*?";
			$pattern .= "<\/dl><\/a>\s*?";
			$pattern .= "<\/li>";
	    	$pattern .= "/s";

	    	$html = $this->get_data($main_url);
			$html = html_entity_decode($html, ENT_NOQUOTES, "UTF-8");

			preg_match_all(
				$pattern,
				$html,
				$matches,
				PREG_SET_ORDER
			);

			if (!$matches) {
				break;
			}
		}

    }

    public function start()
    {

    	$offset = 0;
    	$response = true;
    	do {
    		$this->out('Scrapping offset ' . $offset);
    		var_dump($this->still_scrapping);
    		$this->ajaxMegaScrap($offset);
    		$offset++;
    	} while ($this->still_scrapping);
    	
    }

    private function ajaxMegaScrap($offset = 0){
    	$to_scrap = array(
    		/*'Mestergull' => array(
    			'2' => '1',
    			'3' => '1',
    			'6' => '1',
    			'15' => '1',
    		),*/
    		'Bjørklund' => array(
    			'2' => '1',
    			'3' => '1',
    			'6' => '1',
    			'15' => '1',
    		),
    		/*'David Andersen' => array(
    			'2' => '1',
    			'3' => '1',
    			'6' => '1',
    			'15' => '1',
    		),
    		'Thune' => array(
    			'2' => '1',
    			'3' => '1',
    			'6' => '1',
    			'15' => '1',
    		)*/
    	);

		$this->build_mega_structure($to_scrap);

		foreach ($this->mega_structure as $key=>$value){
			if ($key != $offset) unset($this->mega_structure[$key]);
		}
		
		if (isset($this->mega_structure[$offset])){
			$this->out("Scrapping " . $this->mega_structure[$offset]['url']);
			switch ($this->mega_structure[$offset]['website_name']){
				case "Bjorklund":
					$this->mega_structure[$offset]['action_id'] = 
						$this->ajax_scrap_bjorklund_items($this->mega_structure[$offset]);
					break;
				case "Mestergull":
					$this->mega_structure[$offset]['action_id'] = 
						$this->ajax_scrap_mestergull_items($this->mega_structure[$offset]);
					break;
				case "David Andersen":
					$this->mega_structure[$offset]['action_id'] = 
						$this->ajax_scrap_davidandersen_items($this->mega_structure[$offset]);
					break;
				case "Gullfunn":
					$this->mega_structure[$offset]['action_id'] = 
						$this->ajax_scrap_gullfunn_items($this->mega_structure[$offset]);
					break;
				case "Thune":
					$this->mega_structure[$offset]['action_id'] = 
						$this->ajax_scrap_thune_items($this->mega_structure[$offset]);
					break;
			}
		} else {
			$this->out('Kind of DONE..');
			die();
		}
	}

	private function build_mega_structure($data){
		foreach ($data as $key=>$value){
			switch ($key){
				case "Bjørklund":
					foreach ($value as $master_category_id=>$v){
						$this->set_structure_for_bjorklund($master_category_id, $key);
					}
					break;
				case "Mestergull":
					foreach ($value as $master_category_id=>$v){
						$this->set_structure_for_mestergull($master_category_id, $key);
					}
					break;
				case "David Andersen":
					foreach ($value as $master_category_id=>$v){
						$this->set_structure_for_davidandersen($master_category_id, $key);
					}
					break;
				case "Gullfunn":
					foreach ($value as $master_category_id=>$v){
						$this->set_structure_for_gullfunn($master_category_id, $key);
					}
					break;
				case "Thune":
					foreach ($value as $master_category_id=>$v){
						$this->set_structure_for_thune($master_category_id, $key);
					}
					break;
			}
		}
	}

	private function set_structure_for_bjorklund($master_category_id, $website_pretty_name){
		$bjorklund_website_id = $this->get_website_id_by_pretty_name($website_pretty_name);
		$bjorklund_categories = $this->Categories->find('all', array(
			'conditions' => array(
				'Categories.website_id' => $bjorklund_website_id,
				'Categories.master_category_id' => $master_category_id
			),
//			'limit' => 1, // used to limit the scraper to 'Rings' category
//			'order' => array('Category.name' => 'ASC')
		));

		$bjorklund_categories->hydrate(false);
		$bjorklund_categories = $bjorklund_categories->all();
		$bjorklund_categories = $bjorklund_categories->toArray();
		foreach ($bjorklund_categories as $category){
			switch ($category['name']){
			//switch ($category_url_name){
				case "ringer":
					$page_code = "groups[]=176117";
					break;
				case "oeredobber":
					$page_code = "groups[]=176114";
					break;
				case "armbaand":
					$page_code = "groups[]=176116";
					break;
				case "halssmykker|halskjeder":
					$page_code = "groups[]=176115&groups[]=176118";
					$this->bjorklund_page_numbers = $this->bjorklund_page_numbers * 2;
					break;
			}
                            
			for ($page_nr = 1; $page_nr <= $this->bjorklund_page_numbers; $page_nr++){
				$start_from = ($page_nr - 1) * $this->bjorklund_page_limit;

				$bjorklund_structure['url'] = "http://www.bjorklund.no/produkter/smykker-flervalgsliste/(offset)/$start_from?price-min=&price-max=&$page_code&sort=price-desc";
				$bjorklund_structure['master_category_id'] = $category['master_category_id'];
				$bjorklund_structure['website'] = $this->bjorklund_website_url;
				$bjorklund_structure['website_name'] = "Bjorklund";
				$bjorklund_structure['website_id'] = $bjorklund_website_id;
				$bjorklund_structure['pattern_next_link'] = $this->bjorklund_pattern_next_link;
				$bjorklund_structure['category_scrap_name'] = $category['pretty_name'] . ' (' . $category['name'] . ')';
				$bjorklund_structure['real_category_name'] = $category['name'];
				$bjorklund_structure['page_number'] = $page_nr;
				$bjorklund_structure['page_numbers'] = $this->bjorklund_page_numbers;
				$this->mega_structure[] = $bjorklund_structure;
			}
		}
	}

	private function set_structure_for_mestergull($master_category_id, $website_pretty_name){
		$this->mega_structure = array();
		$mestergull_website_id = $this->get_website_id_by_pretty_name($website_pretty_name);
		$mestergull_categories = $this->Categories->find(
			'all', 
			array(
				'conditions' => array(
					'Categories.website_id' => $mestergull_website_id,
					'Categories.master_category_id' => $master_category_id
				),
			)
		);

		$mestergull_categories->hydrate(false);
		$mestergull_categories = $mestergull_categories->all();
		$mestergull_categories = $mestergull_categories->toArray();
		
		foreach ($mestergull_categories as $category){
			if ($category['name'] == "ringer"){
				for ($page_nr = 1; $page_nr <= $this->mestergull_page_numbers; $page_nr++){
					$mestergull_structure['url'] = 'http://www.mestergull.no/?template=ajax_product_search&templatefolderid=53&_ips_encoding=UTF-8&brand=-1&product_group=-1&product_type=Ring&material=GULT%20GULL&price=-1&query=&single_page=true&sort=ascending&page=' . $page_nr;
					$mestergull_structure['master_category_id'] = $category['master_category_id'];
					$mestergull_structure['website'] = $this->mestergull_website_url;
					$mestergull_structure['website_name'] = "Mestergull";
					$mestergull_structure['website_id'] = $mestergull_website_id;
					$mestergull_structure['category_scrap_name'] = "gult gull";
					$mestergull_structure['name'] = "gult gull";
					$mestergull_structure['material'] = "Gold";
					$mestergull_structure['material_color'] = "Yellow";
					$mestergull_structure['category_name'] = "ringer";
					$mestergull_structure['page_number'] = $page_nr;
					$mestergull_structure['page_numbers'] = $this->mestergull_page_numbers;
					$this->mega_structure[] = $mestergull_structure;
				}
				
				for ($page_nr = 1; $page_nr <= $this->mestergull_page_numbers; $page_nr++){
					$mestergull_structure['url'] = 'http://www.mestergull.no/?template=ajax_product_search&templatefolderid=53&_ips_encoding=UTF-8&brand=-1&product_group=-1&product_type=Ring&material=HVITT%20GULL&price=-1&query=&single_page=true&sort=ascending&page=' . $page_nr;
					$mestergull_structure['master_category_id'] = $category['master_category_id'];
					$mestergull_structure['website'] = $this->mestergull_website_url;
					$mestergull_structure['website_name'] = "Mestergull";
					$mestergull_structure['website_id'] = $mestergull_website_id;
					$mestergull_structure['category_scrap_name'] = "hvitt gull";
					$mestergull_structure['name'] = "hvitt gull";
					$mestergull_structure['material'] = "Gold";
					$mestergull_structure['material_color'] = "White";
					$mestergull_structure['category_name'] = "ringer";
					$mestergull_structure['page_number'] = $page_nr;
					$mestergull_structure['page_numbers'] = $this->mestergull_page_numbers;
					$this->mega_structure[] = $mestergull_structure;
				}
				
				
				for ($page_nr = 1; $page_nr <= $this->mestergull_page_numbers; $page_nr++){
					$mestergull_structure['url'] = 'http://www.mestergull.no/?template=ajax_product_search&templatefolderid=53&_ips_encoding=UTF-8&brand=-1&product_group=-1&product_type=Ring&material=ROS*%20GULL&price=-1&query=&single_page=true&sort=ascending&page=' . $page_nr;
					$mestergull_structure['master_category_id'] = $category['master_category_id'];
					$mestergull_structure['website'] = $this->mestergull_website_url;
					$mestergull_structure['website_name'] = "Mestergull";
					$mestergull_structure['website_id'] = $mestergull_website_id;
					$mestergull_structure['category_scrap_name'] = "rosè gull";
					$mestergull_structure['name'] = "rosè gull";
					$mestergull_structure['material'] = "Gold";
					$mestergull_structure['material_color'] = "Rose";
					$mestergull_structure['category_name'] = "ringer";
					$mestergull_structure['page_number'] = $page_nr;
					$mestergull_structure['page_numbers'] = $this->mestergull_page_numbers;
					$this->mega_structure[] = $mestergull_structure;
				}
				
				// TODO:: this is the multicolored scraping url::
				for ($page_nr = 1; $page_nr <= $this->mestergull_page_numbers; $page_nr++){
					$mestergull_structure['url'] = 'http://www.mestergull.no/no/?template=ajax_product_search&templatefolderid=53&_ips_encoding=UTF-8&brand=-1&product_group=-1&product_type=Ring&material=Flerfarget*%20gull&price=-1&query=&single_page=true&sort=ascending&page=' . $page_nr;
					$mestergull_structure['master_category_id'] = $category['master_category_id'];
					$mestergull_structure['website'] = $this->mestergull_website_url;
					$mestergull_structure['website_name'] = "Mestergull";
					$mestergull_structure['website_id'] = $mestergull_website_id;
					$mestergull_structure['category_scrap_name'] = "flerfarget gull";
					$mestergull_structure['name'] = "flerfarget gull";
					$mestergull_structure['material'] = "";
					$mestergull_structure['material_color'] = "";
					$mestergull_structure['category_name'] = "ringer";
					$mestergull_structure['page_number'] = $page_nr;
					$mestergull_structure['page_numbers'] = $this->mestergull_page_numbers;
					$this->mega_structure[] = $mestergull_structure;
				}
				
				for ($page_nr = 1; $page_nr <= $this->mestergull_page_numbers; $page_nr++){
					$mestergull_structure['url'] = 'http://www.mestergull.no/?template=ajax_product_search&templatefolderid=53&_ips_encoding=UTF-8&brand=-1&product_group=-1&product_type=Ring&material=&price=-1&query=perle&single_page=true&sort=ascending&page=' . $page_nr;
					$mestergull_structure['master_category_id'] = $category['master_category_id'];
					$mestergull_structure['website'] = $this->mestergull_website_url;
					$mestergull_structure['website_name'] = "Mestergull";
					$mestergull_structure['website_id'] = $mestergull_website_id;
					$mestergull_structure['category_scrap_name'] = "med perle";
					$mestergull_structure['name'] = "med perle";
					$mestergull_structure['material'] = "";
					$mestergull_structure['material_color'] = "";
					$mestergull_structure['category_name'] = "ringer";
					$mestergull_structure['page_number'] = $page_nr;
					$mestergull_structure['page_numbers'] = $this->mestergull_page_numbers;
					$this->mega_structure[] = $mestergull_structure;
				}

				for ($page_nr = 1; $page_nr <= $this->mestergull_page_numbers; $page_nr++){
					$mestergull_structure['url'] = 'http://www.mestergull.no/no/?template=ajax_product_search&templatefolderid=53&_ips_encoding=UTF-8&brand=-1&product_group=-1&product_type=Ring&material=S*lv&price=-1&query=&single_page=true&sort=ascending&page=' . $page_nr;
					$mestergull_structure['master_category_id'] = $category['master_category_id'];
					$mestergull_structure['website'] = $this->mestergull_website_url;
					$mestergull_structure['website_name'] = "Mestergull";
					$mestergull_structure['website_id'] = $mestergull_website_id;
					$mestergull_structure['category_scrap_name'] = "sølvringer";
					$mestergull_structure['name'] = "sølvringer";
					$mestergull_structure['material'] = "";
					$mestergull_structure['material_color'] = "";
					$mestergull_structure['category_name'] = "ringer";
					$mestergull_structure['page_number'] = $page_nr;
					$mestergull_structure['page_numbers'] = $this->mestergull_page_numbers;
					$this->mega_structure[] = $mestergull_structure;
				}
			}
			
			if ($category['name'] == "armband"){
				for ($page_nr = 1; $page_nr <= $this->mestergull_page_numbers; $page_nr++){
					$mestergull_structure['url'] = 'http://www.mestergull.no/?template=ajax_product_search&templatefolderid=53&_ips_encoding=UTF-8&brand=-1&product_group=-1&product_type=Armb*nd&material=GULT+GULL&price=-1&query=&single_page=true&sort=ascending&page=' . $page_nr;
					$mestergull_structure['master_category_id'] = $category['master_category_id'];
					$mestergull_structure['website'] = $this->mestergull_website_url;
					$mestergull_structure['website_name'] = "Mestergull";
					$mestergull_structure['website_id'] = $mestergull_website_id;
					$mestergull_structure['category_scrap_name'] = "gult gull";
					$mestergull_structure['name'] = "gult gull";
					$mestergull_structure['material'] = "Gold";
					$mestergull_structure['material_color'] = "Yellow";
					$mestergull_structure['category_name'] = "armband";
					$mestergull_structure['page_number'] = $page_nr;
					$mestergull_structure['page_numbers'] = $this->mestergull_page_numbers;
					$this->mega_structure[] = $mestergull_structure;
				}
				
				for ($page_nr = 1; $page_nr <= $this->mestergull_page_numbers; $page_nr++){
					$mestergull_structure['url'] = 'http://www.mestergull.no/?template=ajax_product_search&templatefolderid=53&_ips_encoding=UTF-8&brand=-1&product_group=-1&product_type=Armb*nd&material=Hvitt+gull&price=-1&query=&single_page=true&sort=ascending&page=' . $page_nr;
					$mestergull_structure['master_category_id'] = $category['master_category_id'];
					$mestergull_structure['website'] = $this->mestergull_website_url;
					$mestergull_structure['website_name'] = "Mestergull";
					$mestergull_structure['website_id'] = $mestergull_website_id;
					$mestergull_structure['category_scrap_name'] = "hvitt gull";
					$mestergull_structure['name'] = "hvitt gull";
					$mestergull_structure['material'] = "Gold";
					$mestergull_structure['material_color'] = "White";
					$mestergull_structure['category_name'] = "armband";
					$mestergull_structure['page_number'] = $page_nr;
					$mestergull_structure['page_numbers'] = $this->mestergull_page_numbers;
					$this->mega_structure[] = $mestergull_structure;
				}

				for ($page_nr = 1; $page_nr <= $this->mestergull_page_numbers; $page_nr++){
					$mestergull_structure['url'] = 'http://www.mestergull.no/?template=ajax_product_search&templatefolderid=53&_ips_encoding=UTF-8&brand=-1&product_group=-1&product_type=Armb*nd&material=&price=-1&query=dia&single_page=true&sort=ascending&page=' . $page_nr;
					$mestergull_structure['master_category_id'] = $category['master_category_id'];
					$mestergull_structure['website'] = $this->mestergull_website_url;
					$mestergull_structure['website_name'] = "Mestergull";
					$mestergull_structure['website_id'] = $mestergull_website_id;
					$mestergull_structure['category_scrap_name'] = "med diamanter";
					$mestergull_structure['name'] = "med diamanter";
					$mestergull_structure['material'] = "";
					$mestergull_structure['material_color'] = "";
					$mestergull_structure['category_name'] = "armband";
					$mestergull_structure['page_number'] = $page_nr;
					$mestergull_structure['page_numbers'] = $this->mestergull_page_numbers;
					$this->mega_structure[] = $mestergull_structure;
				}
				
				for ($page_nr = 1; $page_nr <= $this->mestergull_page_numbers; $page_nr++){
					$mestergull_structure['url'] = 'http://www.mestergull.no/?template=ajax_product_search&templatefolderid=53&_ips_encoding=UTF-8&brand=-1&product_group=-1&product_type=Armring&material=&price=-1&query=dia&single_page=true&sort=ascending&page=' . $page_nr;
					$mestergull_structure['master_category_id'] = $category['master_category_id'];
					$mestergull_structure['website'] = $this->mestergull_website_url;
					$mestergull_structure['website_name'] = "Mestergull";
					$mestergull_structure['website_id'] = $mestergull_website_id;
					$mestergull_structure['category_scrap_name'] = "Armring";
					$mestergull_structure['name'] = "med diamanter";
					$mestergull_structure['material'] = "";
					$mestergull_structure['material_color'] = "";
					$mestergull_structure['category_name'] = "Armring";
					$mestergull_structure['page_number'] = $page_nr;
					$mestergull_structure['page_numbers'] = $this->mestergull_page_numbers;
					$this->mega_structure[] = $mestergull_structure;
				}
			}
			
			if ($category['name'] == "orepynt"){
				for ($page_nr = 1; $page_nr <= $this->mestergull_page_numbers; $page_nr++){
					$mestergull_structure['url'] = 'http://www.mestergull.no/?template=ajax_product_search&templatefolderid=53&_ips_encoding=UTF-8&brand=-1&product_group=-1&product_type=*repynt&material=GULT%20GULL&price=-1&query=&single_page=true&sort=ascending&page=' . $page_nr;
					$mestergull_structure['master_category_id'] = $category['master_category_id'];
					$mestergull_structure['website'] = $this->mestergull_website_url;
					$mestergull_structure['website_name'] = "Mestergull";
					$mestergull_structure['website_id'] = $mestergull_website_id;
					$mestergull_structure['category_scrap_name'] = "Ørepynt - gult gull";
					$mestergull_structure['name'] = "gult gull";
					$mestergull_structure['material'] = "Gold";
					$mestergull_structure['material_color'] = "Yellow";
					$mestergull_structure['category_name'] = "orepynt";
					$mestergull_structure['page_number'] = $page_nr;
					$mestergull_structure['page_numbers'] = $this->mestergull_page_numbers;
					$this->mega_structure[] = $mestergull_structure;
				}

				for ($page_nr = 1; $page_nr <= $this->mestergull_page_numbers; $page_nr++){
					$mestergull_structure['url'] = 'http://www.mestergull.no/?template=ajax_product_search&templatefolderid=53&_ips_encoding=UTF-8&brand=-1&product_group=-1&product_type=*repynt&material=HVITT%20GULL&price=-1&query=&single_page=true&sort=ascending&page=' . $page_nr;
					$mestergull_structure['master_category_id'] = $category['master_category_id'];
					$mestergull_structure['website'] = $this->mestergull_website_url;
					$mestergull_structure['website_name'] = "Mestergull";
					$mestergull_structure['website_id'] = $mestergull_website_id;
					$mestergull_structure['category_scrap_name'] = "Ørepynt - hvitt gull";
					$mestergull_structure['name'] = "hvitt gull";
					$mestergull_structure['material'] = "Gold";
					$mestergull_structure['material_color'] = "White";
					$mestergull_structure['category_name'] = "orepynt";
					$mestergull_structure['page_number'] = $page_nr;
					$mestergull_structure['page_numbers'] = $this->mestergull_page_numbers;
					$this->mega_structure[] = $mestergull_structure;
				}
				
				for ($page_nr = 1; $page_nr <= $this->mestergull_page_numbers; $page_nr++){
					$mestergull_structure['url'] = 'http://www.mestergull.no/?template=ajax_product_search&templatefolderid=53&_ips_encoding=UTF-8&brand=-1&product_group=-1&product_type=*repynt&material=ROS*%20GULL&price=-1&query=&single_page=true&sort=ascending&page=' . $page_nr;
					$mestergull_structure['master_category_id'] = $category['master_category_id'];
					$mestergull_structure['website'] = $this->mestergull_website_url;
					$mestergull_structure['website_name'] = "Mestergull";
					$mestergull_structure['website_id'] = $mestergull_website_id;
					$mestergull_structure['category_scrap_name'] = "Ørepynt - rosè gull";
					$mestergull_structure['name'] = "rosè gull";
					$mestergull_structure['material'] = "Gold";
					$mestergull_structure['material_color'] = "Rose";
					$mestergull_structure['category_name'] = "orepynt";
					$mestergull_structure['page_number'] = $page_nr;
					$mestergull_structure['page_numbers'] = $this->mestergull_page_numbers;
					$this->mega_structure[] = $mestergull_structure;
				}
				
				for ($page_nr = 1; $page_nr <= $this->mestergull_page_numbers; $page_nr++){
					$mestergull_structure['url'] = 'http://www.mestergull.no/?template=ajax_product_search&templatefolderid=53&_ips_encoding=UTF-8&brand=-1&product_group=-1&product_type=*repynt&material=&price=-1&query=perle&single_page=true&sort=ascending&page=' . $page_nr;
					$mestergull_structure['master_category_id'] = $category['master_category_id'];
					$mestergull_structure['website'] = $this->mestergull_website_url;
					$mestergull_structure['website_name'] = "Mestergull";
					$mestergull_structure['website_id'] = $mestergull_website_id;
					$mestergull_structure['category_scrap_name'] = "Ørepynt - med perle";
					$mestergull_structure['name'] = "med perle";
					$mestergull_structure['material'] = "";
					$mestergull_structure['material_color'] = "";
					$mestergull_structure['category_name'] = "orepynt";
					$mestergull_structure['page_number'] = $page_nr;
					$mestergull_structure['page_numbers'] = $this->mestergull_page_numbers;
					$this->mega_structure[] = $mestergull_structure;
				}
				
				for ($page_nr = 1; $page_nr <= $this->mestergull_page_numbers; $page_nr++){
					$mestergull_structure['url'] = 'http://www.mestergull.no/?template=ajax_product_search&templatefolderid=53&_ips_encoding=UTF-8&brand=-1&product_group=-1&product_type=*repynt&material=&price=-1&query=dia&single_page=true&sort=ascending&page=' . $page_nr;
					$mestergull_structure['master_category_id'] = $category['master_category_id'];
					$mestergull_structure['website'] = $this->mestergull_website_url;
					$mestergull_structure['website_name'] = "Mestergull";
					$mestergull_structure['website_id'] = $mestergull_website_id;
					$mestergull_structure['category_scrap_name'] = "Ørepynt - med diamanter";
					$mestergull_structure['name'] = "med diamanter";
					$mestergull_structure['material'] = "";
					$mestergull_structure['material_color'] = "";
					$mestergull_structure['category_name'] = "orepynt";
					$mestergull_structure['page_number'] = $page_nr;
					$mestergull_structure['page_numbers'] = $this->mestergull_page_numbers;
					$this->mega_structure[] = $mestergull_structure;
				}
				
			}
			
			if ($category['name'] == "anheng"){
				for ($page_nr = 1; $page_nr <= $this->mestergull_page_numbers; $page_nr++){
					$mestergull_structure['url'] = 'http://www.mestergull.no/?template=ajax_product_search&templatefolderid=53&_ips_encoding=UTF-8&brand=-1&product_group=-1&product_type=Anheng&material=GULT+GULL&price=-1&query=dia&single_page=true&sort=ascending&page=' . $page_nr;
					$mestergull_structure['master_category_id'] = $category['master_category_id'];
					$mestergull_structure['website'] = $this->mestergull_website_url;
					$mestergull_structure['website_name'] = "Mestergull";
					$mestergull_structure['website_id'] = $mestergull_website_id;
					$mestergull_structure['category_scrap_name'] = "Anheng - gult gull";
					$mestergull_structure['name'] = "gult gull";
					$mestergull_structure['material'] = "Gold";
					$mestergull_structure['material_color'] = "Yellow";
					$mestergull_structure['category_name'] = "anheng";
					$mestergull_structure['page_number'] = $page_nr;
					$mestergull_structure['page_numbers'] = $this->mestergull_page_numbers;
					$this->mega_structure[] = $mestergull_structure;
				}
				
				for ($page_nr = 1; $page_nr <= $this->mestergull_page_numbers; $page_nr++){
					$mestergull_structure['url'] = 'http://www.mestergull.no/?template=ajax_product_search&templatefolderid=53&_ips_encoding=UTF-8&brand=-1&product_group=-1&product_type=Anheng&material=Hvitt+gull&price=-1&query=dia&single_page=true&sort=ascending&page=' . $page_nr;
					$mestergull_structure['master_category_id'] = $category['master_category_id'];
					$mestergull_structure['website'] = $this->mestergull_website_url;
					$mestergull_structure['website_name'] = "Mestergull";
					$mestergull_structure['website_id'] = $mestergull_website_id;
					$mestergull_structure['category_scrap_name'] = "Anheng - hvitt gull";
					$mestergull_structure['name'] = "hvitt gull";
					$mestergull_structure['material'] = "Gold";
					$mestergull_structure['material_color'] = "White";
					$mestergull_structure['category_name'] = "anheng";
					$mestergull_structure['page_number'] = $page_nr;
					$mestergull_structure['page_numbers'] = $this->mestergull_page_numbers;
					$this->mega_structure[] = $mestergull_structure;
				}
				
				for ($page_nr = 1; $page_nr <= $this->mestergull_page_numbers; $page_nr++){
					$mestergull_structure['url'] = 'http://www.mestergull.no/?template=ajax_product_search&templatefolderid=53&_ips_encoding=UTF-8&brand=-1&product_group=-1&product_type=Anheng&material=Ros*+gull&price=-1&query=dia&single_page=true&sort=ascending&page=' . $page_nr;
					$mestergull_structure['master_category_id'] = $category['master_category_id'];
					$mestergull_structure['website'] = $this->mestergull_website_url;
					$mestergull_structure['website_name'] = "Mestergull";
					$mestergull_structure['website_id'] = $mestergull_website_id;
					$mestergull_structure['category_scrap_name'] = "Anheng - Rose gull";
					$mestergull_structure['name'] = "rose gull";
					$mestergull_structure['material'] = "Gold";
					$mestergull_structure['material_color'] = "Rose";
					$mestergull_structure['category_name'] = "anheng";
					$mestergull_structure['page_number'] = $page_nr;
					$mestergull_structure['page_numbers'] = $this->mestergull_page_numbers;
					$this->mega_structure[] = $mestergull_structure;
				}
				
				for ($page_nr = 1; $page_nr <= $this->mestergull_page_numbers; $page_nr++){
					$mestergull_structure['url'] = 'http://www.mestergull.no/?template=ajax_product_search&templatefolderid=53&_ips_encoding=UTF-8&brand=-1&product_group=4981&product_type=Anheng&material=&price=-1&query=&single_page=true&sort=ascending&page=' . $page_nr;
					$mestergull_structure['master_category_id'] = $category['master_category_id'];
					$mestergull_structure['website'] = $this->mestergull_website_url;
					$mestergull_structure['website_name'] = "Mestergull";
					$mestergull_structure['website_id'] = $mestergull_website_id;
					$mestergull_structure['category_scrap_name'] = "Anheng - med perle";
					$mestergull_structure['name'] = "med perle";
					$mestergull_structure['material'] = "";
					$mestergull_structure['material_color'] = "";
					$mestergull_structure['category_name'] = "anheng";
					$mestergull_structure['page_number'] = $page_nr;
					$mestergull_structure['page_numbers'] = $this->mestergull_page_numbers;
					$this->mega_structure[] = $mestergull_structure;
				}
				
				for ($page_nr = 1; $page_nr <= $this->mestergull_page_numbers; $page_nr++){
					$mestergull_structure['url'] = 'http://www.mestergull.no/?template=ajax_product_search&templatefolderid=53&_ips_encoding=UTF-8&brand=-1&product_group=-1&product_type=Anheng&material=&price=-1&query=dia&single_page=true&sort=ascending&page=' . $page_nr;
					$mestergull_structure['master_category_id'] = $category['master_category_id'];
					$mestergull_structure['website'] = $this->mestergull_website_url;
					$mestergull_structure['website_name'] = "Mestergull";
					$mestergull_structure['website_id'] = $mestergull_website_id;
					$mestergull_structure['category_scrap_name'] = "Anheng - med diamanter";
					$mestergull_structure['name'] = "med diamanter";
					$mestergull_structure['material'] = "";
					$mestergull_structure['material_color'] = "";
					$mestergull_structure['category_name'] = "anheng";
					$mestergull_structure['page_number'] = $page_nr;
					$mestergull_structure['page_numbers'] = $this->mestergull_page_numbers;
					$this->mega_structure[] = $mestergull_structure;
				}
			}
		}
	}

	public function get_website_id_by_pretty_name($name){
		$websites = $this->Websites->find('all', array(
    		'fields' => array('Websites.id'),
    		'conditions' => array('Websites.pretty_name' => $name)
    	));

    	$website = $websites->first();
		return $website->id;
	}

	public function set_action_id($website_id, $website_name, $master_category_id){
		if ($website_name == 'mestergull') {
			$action_id = $this->mestergull_action_id;	
			if (!$action_id){
				$action_id = $this->create_action_id($website_id, $master_category_id);
				$this->mestergull_action_id = $action_id;
			}
		}

		if ($website_name == 'bjorklund') {
			$action_id = $this->bjorklund_action_id;	
			if (!$action_id){
				$action_id = $this->create_action_id($website_id, $master_category_id);
				$this->bjorklund_action_id = $action_id;
			}
		}
		
		return $action_id;
	}

	public function ajax_scrap_mestergull_items($data = NULL){
		$this->data = $data;
		ini_set("memory_limit","512M");
		set_time_limit(0);
		$action_id = $this->set_action_id(
			$this->data['website_id'], 
			'mestergull',
			$this->data['master_category_id']
		);
		$this->set_global_filter_stones();
		$this->set_global_stones();
		$this->set_global_occasions();
		$this->set_global_diamond_colors();
		$this->set_global_surfaces();
		$this->set_global_materials();
		$this->set_global_material_colors();
		$this->set_global_metal_and_colors();
		
		$k=0;
		$all_urls[0] = $this->data;
		
		foreach ($all_urls as $node){
			$ch = curl_init($node['url']);
			curl_setopt($ch,CURLOPT_FRESH_CONNECT,true);
			curl_setopt($ch,CURLOPT_CONNECTTIMEOUT, 30);
			curl_setopt($ch,CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)");
			curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
			curl_setopt($ch,CURLOPT_REFERER,NULL);
			curl_setopt($ch,CURLOPT_TIMEOUT,30);
			
			$output = curl_exec($ch); 
			curl_close($ch);

			if (strlen($output) > 500){
				//pr($output);
				preg_match_all(
					$this->mestergull_pattern,
					$output,
					$matches,
					PREG_SET_ORDER
				);
				foreach ($matches as $key=>$value){
					unset($matches[$key][0]);
					$this->scraped_products[$k] = $matches[$key];
					$this->scraped_products[$k]['material'] = $node['material'];
					$this->scraped_products[$k]['material_color'] = $node['material_color'];
					$this->scraped_products[$k]['link']	= $this->Jewelries->set_mestergull_product_link(
						$this->scraped_products[$k], 
						$node, 
						$matches[$key]
					);
					$this->scraped_products[$k]['master_category_id'] = $node['master_category_id'];
					$k++;
				}
			} else {
				return ($action_id);
				break;
			}
		}

		//get the diamond_clarities & diamond_colors arrays before processing items::
		$this->set_global_diamond_clarities();
		$this->set_global_stones();
		$items = array(); 
		foreach ($this->scraped_products as $key=>$value){
			if (!isset($this->scraped_products[$key][5])) unset ($this->scraped_products[$key]);
		}
		foreach ($this->scraped_products as $key=>$value){
			$this->scraped_products[$key]['url'] = $this->mestergull_website_url . $this->scraped_products[$key][3];
		}
		$new_mestergull = $this->curl_mestergull($this->scraped_products, null);
		$this->scraped_products = $new_mestergull;
		$category_name = $this->data['category_name'];
		if ($category_name == "armband" || $category_name == "anheng"){
			$this->set_global_styles();
			$this->set_global_chains();
			$this->set_global_clasps();
		}
		
		$this->set_global_master_categories();
		$this->set_global_necklace_types();
		$this->set_global_websites();
			
		foreach ($this->scraped_products as $key=>$value){
			if (isset($this->scraped_products[$key][5])){
				$this->scraped_products[$key]['brand'] = $this->scraped_products[$key][5];
				if ($this->scraped_products[$key]['brand'] == 'Mg Diamonds' ||
					$this->scraped_products[$key]['brand'] == 'Mg Basic' )
					$this->scraped_products[$key]['brand'] = 'Mestergull';
				
				$this->scraped_products[$key]['designer'] = $this->scraped_products[$key][5];
				$this->scraped_products[$key]['material'] = $node['material'];
				$this->scraped_products[$key]['material_color'] = $node['material_color'];
				if (!isset($this->scraped_products[$key]['description'])){
					$this->scraped_products[$key]['description'] = $this->scraped_products[$key][6];
				}
				
				$this->scraped_products[$key]['name'] = $this->scraped_products[$key]['description'];
				
				/*
				 * item 22-5024 is necklace but found in earrings:
				 */
				if (stristr($this->scraped_products[$key]['description'], "Kjede")){
					$this->scraped_products[$key]['master_category_id'] = $this->global_master_categories['Necklacess & Pendants'];
				}
				
				if (strstr($this->scraped_products[$key]['description'], "RWG ") !== FALSE){
					if (!$this->scraped_products[$key]['material'])
						$this->scraped_products[$key]['material'] = "Gold";
					if (!$this->scraped_products[$key]['material_color'])
						$this->scraped_products[$key]['material_color'] = "Rose & White";
				}
				if (strstr($this->scraped_products[$key]['description'], "WG ") !== FALSE){
					if (!$this->scraped_products[$key]['material'])
						$this->scraped_products[$key]['material'] = "Gold";
					if (!$this->scraped_products[$key]['material_color'])
						$this->scraped_products[$key]['material_color'] = "White";
				}

				if (strstr($this->scraped_products[$key]['description'], "YWG ") !== FALSE){
					//if (!$this->scraped_products[$key]['material'])
						$this->scraped_products[$key]['material'] = "Gold";
					//if (!$this->scraped_products[$key]['material_color'])
						$this->scraped_products[$key]['material_color'] = "Yellow & White";
				}
				if (strstr($this->scraped_products[$key]['description'], "YG ") !== FALSE){
					if (!$this->scraped_products[$key]['material'])
						$this->scraped_products[$key]['material'] = "Gold";
					if (!$this->scraped_products[$key]['material_color'])
						$this->scraped_products[$key]['material_color'] = "Yellow";
				}
				
				
				if (strstr($this->scraped_products[$key]['description'], "YRH ") !== FALSE ||
					strstr($this->scraped_products[$key]['description'], "SRH ") !== FALSE ||
					strstr($this->scraped_products[$key]['description'], "S BKRH") !== FALSE ||
					strstr($this->scraped_products[$key]['description'], "S / BKRH") !== FALSE){

					$this->scraped_products[$key]['surface_id'] = $this->global_surfaces["Rhodinert"];
				}
				
				if (strstr($this->scraped_products[$key]['description'], "S Ring") !== FALSE){
					if (!$this->scraped_products[$key]['material'])
						$this->scraped_products[$key]['material'] = "Silver";
				}
				if (strstr($this->scraped_products[$key]['description'], "SRH") !== FALSE ||
					strstr($this->scraped_products[$key]['description'], "S RH") !== FALSE ||
					strstr($this->scraped_products[$key]['description'], "S BKRH") !== FALSE ||
					strstr($this->scraped_products[$key]['description'], "S / BKRH") !== FALSE ||
					strstr($this->scraped_products[$key]['description'], "S RGP") !== FALSE ||
					strstr($this->scraped_products[$key]['description'], "S / RGP") !== FALSE ||
					strstr($this->scraped_products[$key]['description'], "S Herre") !== FALSE){
					if (!$this->scraped_products[$key]['material'])
						$this->scraped_products[$key]['material'] = "Silver";
				}
				
				//start evaluating the description::
				$desc_ringer = explode('Ring', $this->scraped_products[$key][8]);
				$desc_armband = explode('Armbånd', $this->scraped_products[$key][8]);
				$desc_armring = explode('Armring', $this->scraped_products[$key][8]);
				$desc_orepynt = explode('Ørepynt', $this->scraped_products[$key][8]);
				
				$desc_oreringer = explode('Øreringer', $this->scraped_products[$key][8]);
				if (!count($desc_oreringer) != 2)
					$desc_orering = explode('Ørering', $this->scraped_products[$key][8]);
				
				$desc_anhen = explode('anhen', strtolower($this->scraped_products[$key][8]));
				$desc_anheng = explode('anheng', strtolower($this->scraped_products[$key][8]));
				
				$desc_medaljong = explode('medaljong', strtolower($this->scraped_products[$key][8]));
			

				if (count($desc_ringer) == 2 || 
					count($desc_armband) == 2 ||
					count($desc_armring) == 2 ||
					count($desc_orepynt) == 2 ||
					count($desc_oreringer) == 2 ||
					count($desc_orering) == 2 ||
					count($desc_anhen) == 2 ||
					count($desc_anheng) == 2 ||
					count($desc_medaljong) == 2){
					if (count($desc_ringer) == 2)		$desc = $desc_ringer;
					if (count($desc_armband) == 2)		$desc = $desc_armband;
					if (count($desc_armring) == 2)		$desc = $desc_armring;
					if (count($desc_orepynt) == 2)		$desc = $desc_orepynt;
					if (count($desc_orering) == 2)		$desc = $desc_orering;
					if (count($desc_oreringer) == 2)	$desc = $desc_oreringer;
					if (count($desc_anhen) == 2)		$desc = $desc_anhen;
					if (count($desc_anheng) == 2)		$desc = $desc_anheng;
					if (count($desc_medaljong) == 2)	$desc = $desc_medaljong;
					$desc[1] = trim($desc[1]); 

					//check if diamond:
					$is_diamond = explode('ct', $desc[1]); 
					//pr($is_diamond);
					//pr($this->scraped_products[$key]);
					if (count($is_diamond) == 2){ //is diamond!
						$row1 = str_ireplace("dia", "Dia",$is_diamond[0]);
						//$row1 = str_ireplace("Dia.", "Dia",$is_diamond[0]);
						
						$row1 = explode('Dia', $row1);
						if (count($row1) >= 2){
							$this->scraped_products[$key]['stone'] = 'Diamond';
							if ($row1[0]) {
								$this->scraped_products[$key]['diamond_number'] = $row1[0];	
							}
							else $this->scraped_products[$key]['diamond_number'] = 1;
							
							$this->scraped_products[$key]['diamond_weight'] = str_replace(' ', '', $row1[1]);
							$this->scraped_products[$key]['diamond_weight'] = str_replace(',', '.', $this->scraped_products[$key]['diamond_weight']);
							$this->scraped_products[$key]['diamond_weight'] = str_replace('tot', '', $this->scraped_products[$key]['diamond_weight']);
							if (substr($this->scraped_products[$key]['diamond_weight'],0,1) == '.'){
								$this->scraped_products[$key]['diamond_weight'] = substr($this->scraped_products[$key]['diamond_weight'], 1);
							}
							
						} else {
							// just like this product: /filestore/Produktbilder/82-0583.png?size=163x0&gif2png=true&quality=75
							$this->scraped_products[$key]['stone'] = 'Diamond';
							$this->scraped_products[$key]['diamond_number'] = 1;
							$this->scraped_products[$key]['diamond_weight'] = str_replace(' ', '', $row1[0]);
							$this->scraped_products[$key]['diamond_weight'] = str_replace(',', '.', $this->scraped_products[$key]['diamond_weight']);
							if (substr($this->scraped_products[$key]['diamond_weight'],0,1) == '.'){
								$this->scraped_products[$key]['diamond_weight'] = substr($this->scraped_products[$key]['diamond_weight'], 1);
							}
						}
					} else {
						if (!stristr($desc[1], "Dia.")){
							$desc[1] = str_ireplace("Dia", "Dia.", $desc[1]);
						}
						$is_diamond = explode('Dia', $desc[1]);
						if (count($is_diamond) >= 2){
							//pr($is_diamond);
							//it's still diamond but 'ct' is not written:
							$this->scraped_products[$key]['stone'] = 'Diamond';
							$this->scraped_products[$key]['diamond_number'] = $is_diamond[0];
							$is_diamond[1] = trim($is_diamond[1]);
							$row1 = explode(" ", $is_diamond[1]);
                            if (is_array($row1) && isset($row[1])){
                                if ($row1[1] == 'tot') $row1[1] = $row1[2];
                                $this->scraped_products[$key]['diamond_weight'] = str_replace(' ', '', $row1[1]);
                                $this->scraped_products[$key]['diamond_weight'] = str_replace(',', '.', $this->scraped_products[$key]['diamond_weight']);
                                $this->scraped_products[$key]['diamond_weight'] = str_replace('tot', '', $this->scraped_products[$key]['diamond_weight']);
                                if (substr($this->scraped_products[$key]['diamond_weight'],0,1) == '.'){
                                        $this->scraped_products[$key]['diamond_weight'] = substr($this->scraped_products[$key]['diamond_weight'], 1);
                                }
                            }
						} else {
							if (isset($this->scraped_products[$key]['stone']) && $this->scraped_products[$key]['stone'] == $this->global_stones['Diamond']){
								if (!$this->scraped_products[$key]['diamond_number'])
									$this->scraped_products[$key]['diamond_number'] = 1;
							} else {
								$this->scraped_products[$key]['diamond_number'] = 0;
								$this->scraped_products[$key]['diamond_weight'] = 0;
							}
						}
					}
					
					/*
					 * following code extracts diamond number when desc is like 
					 * WG Ring Dia. 0,05 ct. HP1 13 Dia. 0,05 HP1 
					 */
					preg_match_all(
						'/(?P<digit1>\d+)\s+?Dia. /s', 
						$this->scraped_products[$key]['description'], 
						$matches, 
						PREG_SET_ORDER
					);
					if (isset($matches[0]['digit1']) && $matches[0]['digit1']){
						$this->scraped_products[$key]['diamond_number'] = $matches[0]['digit1'];
					}
					//end of extracting code
					
				} else {
					//the description is empty!?
					$this->scraped_products[$key]['stone'] = '';
					$this->scraped_products[$key]['diamond_number'] = 0;
					$this->scraped_products[$key]['diamond_weight'] = 0;
				}
				//pr($this->scraped_products[$key]);
				$this->scraped_products[$key]['image_small'] = "http://www.mestergull.no" . $this->scraped_products[$key][7];
				$this->scraped_products[$key]['code'] = $this->scraped_products[$key][11];
				$this->scraped_products[$key]['price'] = str_ireplace('.', '', $this->scraped_products[$key][12]);
				
				//now get the stone cut::
				if (stripos($this->scraped_products[$key]['description'], "brilliant") !== FALSE) 
					$this->scraped_products[$key]['diamond_cut'] = "Brilliant";
				else if (stripos($this->scraped_products[$key]['description'], "princess") !== FALSE || 
					stripos($this->scraped_products[$key]['description'], "Princ.") !== FALSE) 
					$this->scraped_products[$key]['diamond_cut'] = "Princess";
				else if (stripos($this->scraped_products[$key]['description'], "baguett") !== FALSE) 
					$this->scraped_products[$key]['diamond_cut'] = "Baguette";
		
				$this->scraped_products[$key]['occasions_info'] = 
					$this->Jewelries->get_multiple_occasions_info(
						$this->global_occasions,
						$this->scraped_products[$key][5]
					);
				
				//get diamond_color and diamond_clarity::
				$string = $this->scraped_products[$key]['description'];
				if (strpos($string, "HP1")){
					$this->scraped_products[$key]['diamond_clarity_id'] = $this->global_diamond_clarities["I1"];
					$this->scraped_products[$key]['diamond_color_id'] = $this->global_diamond_colors["H"];
				}
				else if (strpos($string, "HP")){
					$this->scraped_products[$key]['diamond_clarity_id'] = $this->global_diamond_clarities["I"];
					$this->scraped_products[$key]['diamond_color_id'] = $this->global_diamond_colors["H"];
				}
				else if (strpos($string, "HSI")){
					$this->scraped_products[$key]['diamond_clarity_id'] = $this->global_diamond_clarities["SI"];
					$this->scraped_products[$key]['diamond_color_id'] = $this->global_diamond_colors["H"];
				}
				else if (strpos($string, "H SI")){
					$this->scraped_products[$key]['diamond_clarity_id'] = $this->global_diamond_clarities["SI"];
					$this->scraped_products[$key]['diamond_color_id'] = $this->global_diamond_colors["H"];
				}
				else if (strpos($string, "JP1")){
					$this->scraped_products[$key]['diamond_clarity_id'] = $this->global_diamond_clarities["I1"];
					$this->scraped_products[$key]['diamond_color_id'] = $this->global_diamond_colors["J"];
				}
				else if (strpos($string, "GVS")){
					$this->scraped_products[$key]['diamond_clarity_id'] = $this->global_diamond_clarities["VS"];
					$this->scraped_products[$key]['diamond_color_id'] = $this->global_diamond_colors["G"];
				}
				else if (strpos($string, "GSI")){
					$this->scraped_products[$key]['diamond_clarity_id'] = $this->global_diamond_clarities["SI"];
					$this->scraped_products[$key]['diamond_color_id'] = $this->global_diamond_colors["G"];
				}
				else if (strpos($string, "HISI1")){
					$this->scraped_products[$key]['diamond_clarity_id'] = $this->global_diamond_clarities["SI1"];
					$this->scraped_products[$key]['diamond_color_id'] = $this->global_diamond_colors["H"];
				}
				else if (strpos($string, "HISI2")){
					$this->scraped_products[$key]['diamond_clarity_id'] = $this->global_diamond_clarities["SI2"];
					$this->scraped_products[$key]['diamond_color_id'] = $this->global_diamond_colors["H"];
				}
				else if (strpos($string, "IJSI")){
					$this->scraped_products[$key]['diamond_clarity_id'] = $this->global_diamond_clarities["SI"];
					$this->scraped_products[$key]['diamond_color_id'] = $this->global_diamond_colors["J"];
				}
				else if (strpos($string, "ct P2")){
					$this->scraped_products[$key]['diamond_clarity_id'] = $this->global_diamond_clarities["I2"];
				}
				
				$this->set_product_gender($string, $key);
				
				if ($category_name == "armband" || $category_name == "anheng"){
					$this->scraped_products[$key]['style_id'] = $this->Jewelries->get_item_special_attribute($this->global_styles, $this->scraped_products[$key]['description']);
					$this->scraped_products[$key]['lengths'] = $this->Jewelries->get_item_lengths($this->scraped_products[$key]['description']);
					if ($this->scraped_products[$key]['lengths'])
						$this->scraped_products[$key]['has_lengths'] = 1;
					$this->scraped_products[$key]['chain_id'] = $this->Jewelries->get_item_special_attribute($this->global_chains, $this->scraped_products[$key]['description']);
					$this->scraped_products[$key]['clasp_id'] = $this->Jewelries->get_item_special_attribute($this->global_clasps, $this->scraped_products[$key]['description']);
					$this->scraped_products[$key]['height'] = $this->Jewelries->get_item_height($this->scraped_products[$key]['description']);
				}
			}
		}

		foreach ($this->scraped_products as $key=>$value){
			$stones = array();
			//$stones = $this->Work->set_mestergull_stones_array($stones, $this->scraped_products[$key]['description'], $this->global_stones);
			$stones = $this->Jewelries->general_get_stones($this->scraped_products[$key]['description'], $this->global_stones);
			$stones = array_unique($stones);
			$this->scraped_products[$key]['Stones'] = $stones;
		}
		
		//start saving the producs in db::
		
		$requestTime = 0.1;
		//first prepare the id's of each attribute
		foreach ($this->scraped_products as $key=>$value){
			//let's save the oku's 'material' and 'material_color' attribute first::
			if (!$this->scraped_products[$key]['material']){
				$this->scraped_products[$key]['material_id'] = $this->global_materials['Gold'];
				if (isset($this->scraped_products[$key]['comment'])){
                                    $c = $this->scraped_products[$key]['comment'];
                                    $this->scraped_products[$key]['comment'] = $c . " | Material not found. Using Gold as Default";
                                }
			} else {
				$this->scraped_products[$key]['material_id'] = $this->global_materials[$this->scraped_products[$key]['material']];
			}
			if (isset($this->scraped_products[$key]['material_color']) && $this->scraped_products[$key]['material_color']){
				$this->scraped_products[$key]['material_color_id'] = $this->global_material_colors[$this->scraped_products[$key]['material_color']];
			}
			//now set metal_and_colors::
			$this->scraped_products[$key] =
				$this->Jewelries->set_metal_and_colors(
					$this->scraped_products[$key],
					$this->global_metal_and_colors,
					$this->global_materials,
					$this->global_material_colors
				);
		}

		$this->scraped_products = $this->Jewelries->set_multiple_carats_comment($this->scraped_products, $this->global_stones['Diamond']);
		
		//now saving the entire array::
		foreach ($this->scraped_products as $product){
			$start = microtime(true);
			$items = $this->Items->find('all', array(
	    		'fields' => array('Items.id'),
	    		'conditions' => array(
	    			'Items.action_id' => $this->mestergull_action_id, 
					'Items.code' => $product['code']
				)
	    	));
	    	$existing_product = $items->first();

			if (!$existing_product){
				$product['description'] = trim($product['description']);
				$product['website_id'] = $this->data['website_id'];
				$product['action_id'] = $this->mestergull_action_id;
				
				$my_array = array();
				$my_array['Item'] = $product;
				//$this->Item->recursive = -1;
				$items = $this->Items->find('all', array(
		    		'fields' => array('Items.id'),
		    		'conditions' => array(
						'Items.code' => $my_array['Item']['code']
					),
					'order' => array('Items.id' => 'desc')
		    	));
		    	$previously_scraped_item = $items->first();
				$my_array = $this->Jewelries->check_item_for_differeces(
					$my_array, 
					$previously_scraped_item
				);
				
				$item = $this->Items->newEntity();
				
				$item->name = $my_array['Item']['name'];
				$item->website_id = $my_array['Item']['website_id'];
				$item->description = $my_array['Item']['description'];
				$item->material_id = $my_array['Item']['material_id'];
				$item->surface_id = (isset($my_array['Item']['surface_id'])) ? 
					$my_array['Item']['surface_id'] : null;
				$item->diamond_number = $my_array['Item']['diamond_number'];
				$item->diamond_weight = (isset($my_array['Item']['diamond_weight'])) ?
					$my_array['Item']['diamond_weight'] : null;
				$item->diamond_color_id = (isset($my_array['Item']['diamond_color_id'])) ? 
					$my_array['Item']['diamond_color_id'] : null;
				$item->diamond_clarity_id = (isset($my_array['Item']['diamond_clarity_id'])) ? 
					$my_array['Item']['diamond_clarity_id'] : null;
				$item->link = $my_array['Item']['link'];
				$item->code = $my_array['Item']['code'];
				$item->price = $my_array['Item']['price'];
				$item->brand = $my_array['Item']['brand'];
				$item->image_small = $my_array['Item']['image_small'];
				$item->action_id = $my_array['Item']['action_id'];
				$item->master_category_id = $my_array['Item']['master_category_id'];
				$item->gender_id = $my_array['Item']['gender_id'];
				$item->designer = $my_array['Item']['designer'];
				$item->master_category_id = $my_array['Item']['master_category_id'];
				$item->comments = (isset($my_array['Item']['comments'])) ? 
					$my_array['Item']['comments'] : null;
				$result = $this->Items->save($item);
				
				/**
				 * try to save image from previous scrapings
				 */
				$product['id'] = $result->id;
				$item_id = $product['id'];
				
				$image_saved = $this->check_previously_saved_image($product);
				if ($image_saved){
					$this->Items->read(null, $result->id);
					$this->Items->set('image_processed', 1);
					$this->Items->save();
				}
				
				//now save item's occasions::
				$this->save_item_occasions(
					$item_id, 
					$product['occasions_info']
				);
				
				//now save item's lengths::
				if ($category_name == "armband" || $category_name == "anheng"){
					$this->save_item_lengths(
						$result->id,
						$product['lengths']
					);
				}

				/**
				 * now save item's metal_and_colors::
				 * this is done by using saveAll()
				 */
				$this->check_and_save_metal_and_colors($product, $previously_scraped_item, $item_id);
				
				//now save item's stones::
				$this->loadModel('ItemStone');
				$this->loadModel('ItemFilterStone');
				foreach ($product['Stones'] as $stone){
					$this->save_item_stone($item_id, $stone);
					$this->save_item_filter_pearl(
						$item_id, 
						$stone,
						$this->global_stones,
						$this->global_filter_stones['Pearl']
					);
				}
			
				if ($category_name == "anheng"){
					/**
					 * now save item's necklace types::
					 * this is done by using saveAll()
					 */
					$product = $this->Jewelries->set_necklace_types(
						$product, 
						$this->global_master_categories,
						$this->global_websites,
						$this->global_necklace_types,
						$this->global_stones
					); 
					$necklace_types = array_unique($product['NecklaceTypes']);
					$necklace_types_array = array();
					foreach ($necklace_types as $nt){
						$entity = $this->ItemNecklaceTypes->newEntity();
						$entity->item_id = $item_id;
						$entity->necklace_type_id = $nt;
						$this->ItemNecklaceTypes->save($entity);
					}
				}	 
			}
			//this line limits the scraping process for testing purposes
			//if ($this->test_count++ > 1) break; 
			//if ($product['code'] == "28-2417"){
			//	pr($product);die();
			//}
			if($timeTaken = microtime(true)-$start < $requestTime) {
				@usleep(($requestTime-$timeTaken)*1000000);
			}

		}
		return $action_id;
	}

	public function ajax_scrap_bjorklund_items($data = NULL){
		$this->data = $data;

		ini_set("memory_limit","5126M");
		set_time_limit(0);
		
		$all_urls[0] = $this->data;
		$this->counter = 0;

		$action_id = $this->set_action_id(
			$this->data['website_id'], 
			'bjorklund',
			$this->data['master_category_id']
		);
		
		$pass_data = array();
		$pass_data['master_category_id'] = $this->data['master_category_id'];
		$pass_data['website_id'] = $this->data['website_id'];
		$pass_data['action_id'] = $action_id;
		//var_dump($all_urls);//die();
		$start = microtime(true);
		$nodes = $this->curl_bjorklund_pages($all_urls, null, $pass_data);

		//var_dump($this->prescraped_products); die();
		//var_dump($this->data);die();
		$all_urls[0] = $this->data;

		//start saving the producs in db::
		$this->loadModel('Item');
		$this->loadModel('Material');
		$this->loadModel('MaterialColor');
		$this->loadModel('Surface');
		$this->loadModel('DiamondColor');
		$this->loadModel('DiamondClarity');
		$this->loadModel('Stone');
		$this->set_global_stones();
		$this->set_global_filter_stones();
		$this->set_global_occasions();
		$this->set_global_diamond_colors();
		$this->set_global_diamond_clarities();
		$this->set_global_materials();
		$this->set_global_material_colors();
		$this->set_global_metal_and_colors();
		$this->set_global_master_categories();
		$this->set_global_necklace_types();
		$this->set_global_websites();
		
		$this->curl($this->prescraped_products, null);
		$time_taken = microtime(true) - $start;
		
		/**
		 * 20140103. this bellow is to avoid invalid products. 
		 */
		foreach ($this->scraped_products as $key=>$value){
			if (!isset($this->scraped_products[$key]['name']) || !isset($this->scraped_products[$key]['description'])){
				unset($this->scraped_products[$key]);
			}
		}
		
		foreach ($this->scraped_products as $key=>$value){
			$this->scraped_products[$key]['master_category_id'] = $all_urls[0]['master_category_id'];
			$this->scraped_products[$key]['real_category_name'] = $all_urls[0]['real_category_name'];
			//let's save the oku's 'material' and 'material_color' attribute first::
			if (isset($this->scraped_products[$key]['material'])){
				switch ($this->scraped_products[$key]['material']){
					case 'Hvittgull':
						$this->scraped_products[$key]['material_color_id'] = $this->global_material_colors['White'];
						$this->scraped_products[$key]['material_id'] = $this->global_materials['Gold'];
						$this->scraped_products[$key]['metal_and_colors'][] = 
							$this->global_metal_and_colors['White Gold'];
						$this->scraped_products[$key]['metal_and_colors'][] = 
							$this->global_metal_and_colors['Gold (All)'];	
						break;
					case 'Hvitt gull':
						$this->scraped_products[$key]['material_color_id'] = $this->global_material_colors['White'];
						$this->scraped_products[$key]['material_id'] = $this->global_materials['Gold'];
						$this->scraped_products[$key]['metal_and_colors'][] = 
							$this->global_metal_and_colors['White Gold'];
						$this->scraped_products[$key]['metal_and_colors'][] = 
							$this->global_metal_and_colors['Gold (All)'];	
						break;
					case 'Sølv':
						//$this->read_or_create_material_and_color($this->scraped_products[$key]['material'], $key, "Silver");
						$this->scraped_products[$key]['material_id'] = $this->global_materials['Silver'];
						$this->scraped_products[$key]['metal_and_colors'][] = 
							$this->global_metal_and_colors['Silver'];
						break;
					case 'Gull (2-farget)':
						//$this->read_or_create_material_and_color($this->scraped_products[$key]['material'], $key, "Gold", "Yellow & White");
						$this->scraped_products[$key]['material_color_id'] = $this->global_material_colors['Yellow & White'];
						$this->scraped_products[$key]['material_id'] = $this->global_materials['Gold'];
						$this->scraped_products[$key]['metal_and_colors'][] = 
							$this->global_metal_and_colors['Yellow & White Gold'];
						$this->scraped_products[$key]['metal_and_colors'][] = 
							$this->global_metal_and_colors['Gold (All)'];
						break;
					case 'Gultgull':
						//$this->read_or_create_material_and_color($this->scraped_products[$key]['material'], $key, "Gold", "Yellow");
						$this->scraped_products[$key]['material_color_id'] = $this->global_material_colors['Yellow'];
						$this->scraped_products[$key]['material_id'] = $this->global_materials['Gold'];
						$this->scraped_products[$key]['metal_and_colors'][] = 
							$this->global_metal_and_colors['Yellow Gold'];
						$this->scraped_products[$key]['metal_and_colors'][] = 
							$this->global_metal_and_colors['Gold (All)'];
						break;
					case 'Gult gull':
						//$this->read_or_create_material_and_color($this->scraped_products[$key]['material'], $key, "Gold", "Yellow");
						$this->scraped_products[$key]['material_color_id'] = $this->global_material_colors['Yellow'];
						$this->scraped_products[$key]['material_id'] = $this->global_materials['Gold'];
						$this->scraped_products[$key]['metal_and_colors'][] = 
							$this->global_metal_and_colors['Yellow Gold'];
						$this->scraped_products[$key]['metal_and_colors'][] = 
							$this->global_metal_and_colors['Gold (All)'];
						break;
					case 'Rødtgull ':
						//$this->read_or_create_material_and_color($this->scraped_products[$key]['material'], $key, "Gold", "Yellow");
						$this->scraped_products[$key]['material_color_id'] = $this->global_material_colors['Red'];
						$this->scraped_products[$key]['material_id'] = $this->global_materials['Gold'];
						$this->scraped_products[$key]['metal_and_colors'][] = 
							$this->global_metal_and_colors['Red Gold'];
						$this->scraped_products[$key]['metal_and_colors'][] = 
							$this->global_metal_and_colors['Gold (All)'];
						break;
					case 'Rødt gull ':
						//$this->read_or_create_material_and_color($this->scraped_products[$key]['material'], $key, "Gold", "Yellow");
						$this->scraped_products[$key]['material_color_id'] = $this->global_material_colors['Red'];
						$this->scraped_products[$key]['material_id'] = $this->global_materials['Gold'];
						$this->scraped_products[$key]['metal_and_colors'][] = 
							$this->global_metal_and_colors['Red Gold'];
						$this->scraped_products[$key]['metal_and_colors'][] = 
							$this->global_metal_and_colors['Gold (All)'];
						break;
					case 'Stål':
						//all cases above should be treated like bellow::
						//$this->scraped_products[$key]['material_color_id'] = $this->global_material_colors[$this->scraped_products[$key]['material_color']];
						$this->scraped_products[$key]['material_id'] = $this->global_materials['Steel'];
						$this->scraped_products[$key]['metal_and_colors'][] = 
							$this->global_metal_and_colors['Steel'];
						break;
					case 'Bomull':
						$this->scraped_products[$key]['material_id'] = $this->global_materials['Cotton'];
						break;
					case 'Andre materialer':
						$this->scraped_products[$key]['material_id'] = $this->global_materials['Other Materials'];
						break;
					case 'annet metall':
						$this->scraped_products[$key]['material_id'] = $this->global_materials['Other Materials'];
						break;
				}
				//TODO: to be continued if needed
			}
			/*
			//now save 'diamant_color'::
			if (isset($this->scraped_products[$key]['diamond_color'])){
				$this->scraped_products[$key]['diamond_color_id'] = 
					$this->Jewelries->set_diamond_color(
						$this->scraped_products[$key]['diamond_color'],
						$this->global_diamond_colors
					);
			}*/
			
			/*
			if (isset($this->scraped_products[$key]['other_stones'])){
				$this->save_stone($this->scraped_products[$key]['stones'], $key);
			}*/
			
			$this->scraped_products[$key]['occasions_info'] = 
				$this->Jewelries->get_multiple_occasions_info(
					$this->global_occasions,
					$this->scraped_products[$key]['name']
				);
		}
		$requestTime = 0.1;
		//now saving the entire array::
		foreach ($this->scraped_products as $key=>$value){
			$stones = array();
			
			//$stones = $this->Work->set_bjorklund_stones_array($stones, $this->scraped_products[$key], $this->global_stones);
			$stones = $this->Jewelries->general_get_stones(
				$this->scraped_products[$key]['name'] . '-' . $this->scraped_products[$key]['description'], 
				$this->global_stones
			);
			$stones = array_unique($stones);
			$this->scraped_products[$key]['Stones'] = $stones;
		}
		
		$this->scraped_products = $this->Jewelries->set_multiple_carats_comment($this->scraped_products, $this->global_stones['Diamond']);
		foreach ($this->scraped_products as $product){
			if (isset($product['metal_and_colors'])){
				$metal_and_colors = array_unique($product['metal_and_colors']);
			}
			$start = microtime(true);
			$existing_product = null;
			$existing_product = $this->Item->find('first', array('conditions' => array('Item.action_id' => $this->bjorklund_action_id, 'Item.code' => $product['code'])));

			if (!$existing_product){
				if (isset($product['surface']) && trim($product['surface']) !== '-'){
					$this->set_global_surfaces();
					$product = $this->Jewelries->set_surface(
						$product, 
						$this->global_surfaces
					);
				} else {
					$product['surface_id'] = 0;
				}
					//$product['surface_id']				= $this->read_or_create_new_product_info($product['surface'], 'Surface', 'bjorklund');
				
				$product['description'] = trim($product['description']);
				$product['website_id'] = $all_urls[0]['website_id'];
				$product['action_id'] = $action_id;
				
				/**
				 * this shold be observed:
				 */
				//if (!$product['stones'] && (isset($product['other_stones']) && $product['other_stones'])) $product['stones'] = $product['other_stones'];
				
				$my_array = array();
				$my_array['Item'] = $product;
				//remake!
				//$my_array['Item']['other_stones'] = $my_array['Item']['stones'];
				
				/**
				 * this checks for any previous changes on items fields (not attributes! as the are not saved yet)
				 */
				$previously_scraped_item = $this->Item->find('first', array('conditions' => array('Item.code' => $my_array['Item']['code']), 'order' => array('Item.id' => 'DESC')));
				$my_array = $this->Jewelries->check_item_for_differeces(
					$my_array, 
					$previously_scraped_item
				);
				
				$this->Item->create();
				$this->Item->save($my_array);

				/**
				 * try to save image from previous scrapings
				 */
				$product['id'] = $this->Item->getInsertID();
				$image_saved = $this->check_previously_saved_image($product);
				if ($image_saved){
					$this->Item->read(null, $this->Item->getInsertID());
					$this->Item->set('image_processed', 1);
					$this->Item->save();
				}
				
				//now save item's occasions::
				$this->save_item_occasions(
					$this->Item->getInsertID(), 
					$product['occasions_info']
				);
				/*
				//now save item's stones::
				$item_id = $this->Item->getInsertID();
				$this->loadModel('ItemStone');
				$this->loadModel('ItemFilterStone');
				foreach ($product['Stones'] as $stone){
					$this->save_item_stone($item_id, $stone);
					if ($stone == $this->global_stones['Freshwater pearl'] ||
						$stone == $this->global_stones['Mother of pearl'] ||
						$stone == $this->global_stones['Shell Pearl'] ||
						$stone == $this->global_stones['Synthetic pearl'] ||
						$stone == $this->global_stones['Swarovski Pearl'] ||
						$stone == $this->global_stones['Pearl']){
						$this->save_item_filter_stone($item_id, $this->global_filter_stones['Pearl']);
					}
				}
				*/
				//now save item's stones::
				$item_id = $this->Item->getInsertID();
				$this->loadModel('ItemStone');
				$this->loadModel('ItemFilterStone');
				foreach ($product['Stones'] as $stone){
					$this->save_item_stone($item_id, $stone);
					$this->save_item_filter_pearl(
						$item_id, 
						$stone,
						$this->global_stones,
						$this->global_filter_stones['Pearl']
					);
				}
				//TODO:: save item filter stone as well
				//$this->save_item_filter_stones($product['Stones']);
				
				
				/**
				 * now save item's metal_and_colors::
				 * this is done by using saveAll()
				 */
				$this->check_and_save_metal_and_colors($product, $previously_scraped_item, $item_id);
								
				if ($this->data['real_category_name'] == "halssmykker" || $this->data['real_category_name'] == "halskjeder"){
					/**
					 * now save item's necklace types::
					 * this is done by using saveAll()
					 */
					$product = $this->Jewelries->set_necklace_types(
						$product, 
						$this->global_master_categories,
						$this->global_websites,
						$this->global_necklace_types,
						$this->global_stones
					); 
					$necklace_types = array_unique($product['NecklaceTypes']);
					$necklace_types_array = array();
					foreach ($necklace_types as $nt){
						$arr = array();
						$arr['ItemNecklaceType']['item_id'] = $item_id;
						$arr['ItemNecklaceType']['necklace_type_id'] = $nt;
						$necklace_types_array[] = $arr;
					}
					$this->loadModel('ItemNecklaceType');
					$this->ItemNecklaceType->saveAll($necklace_types_array);
				}
			}	
		}
		//die();
		return $action_id;
	}

	private function curl_bjorklund_pages($nodes, $referer=NULL, $pass_data){
		if  (in_array  ('curl_multi_info_read', get_loaded_extensions())) {}
		if(!$referer){
			$referer = $nodes[0]['url'];
		}
		
		$searched_url = $nodes[0]['url'];
		$ch = curl_init($searched_url);
			curl_setopt($ch,CURLOPT_FRESH_CONNECT,true);
			curl_setopt($ch,CURLOPT_CONNECTTIMEOUT, 30);
			curl_setopt($ch,CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)");
			curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
			curl_setopt($ch,CURLOPT_REFERER,$searched_url);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch,CURLOPT_TIMEOUT,30);		
		$output = curl_exec($ch);
		$start = microtime(true);
		preg_match_all(
			$this->bjorklund_page_pattern,
			$output,
			$matches,
			PREG_SET_ORDER
		);
		//var_dump($matches);die();

		if ($matches){
			for ($key = 0; $key < $this->bjorklund_page_limit; $key++){
				if (isset($matches[$key])){
					$product = array();
					$product['url'] = $nodes[0]['website'] . $matches[$key][1];
					$product['master_category_id'] = $pass_data['master_category_id'];
					$product['website_id'] = $pass_data['website_id'];
					$product['website'] = $nodes[0]['website'];
					$product['is_page'] = false;
					$product['action_id'] = $pass_data['action_id'];
					$this->prescraped_products[] = $product;
				}
			}
		} else {
			echo json_encode("End bjorklund curling"); die();
		}
	}

	public function create_action_id($website_id, $master_category_id){//used on scrappers controller
		$action = $this->Actions->newEntity();
		$action->date = date('Y-m-d h:i:s');
		$action->website_id = $website_id;
		$action->master_category_id = $master_category_id;
		$result = $this->Actions->save($action);;
		return $result->id;
	}

	public function set_global_filter_stones(){
		$stones = $this->FilterStones->find('all');
		$stones->hydrate(false);
		$stones = $stones->all();
		$stones = $stones->toArray();
		
		foreach ($stones as $key => $value){
			$this->global_filter_stones[$stones[$key]['name']] = $stones[$key]['id'];
		}
	}

	public function set_global_stones(){
		$stones = $this->Stones->find('all');
		$stones->hydrate(false);
		$stones = $stones->all();
		$stones = $stones->toArray();
		
		foreach ($stones as $key => $value){
			$this->global_stones[$stones[$key]['name']] = $stones[$key]['id'];
		}
	}

	public function set_global_occasions(){
		$results = $this->Occasions->find('all');
		$results->hydrate(false);
		$results = $results->all();
		$results = $results->toArray();
		
		foreach ($results as $key => $value){
			$this->global_occasions[$results[$key]['name']] = $results[$key]['id'];
		}
	}

	public function set_global_diamond_colors(){
		$results = $this->DiamondColors->find('all');
		$results->hydrate(false);
		$results = $results->all();
		$results = $results->toArray();
		
		foreach ($results as $key => $value){
			$this->global_diamond_colors[$results[$key]['name']] = $results[$key]['id'];
		}
	}

	public function set_global_surfaces(){
		$results = $this->Surfaces->find('all');
		$results->hydrate(false);
		$results = $results->all();
		$results = $results->toArray();
		
		foreach ($results as $key => $value){
			$this->global_surfaces[$results[$key]['name']] = $results[$key]['id'];
		}
	}

	public function set_global_materials(){
		$results = $this->Materials->find('all');
		$results->hydrate(false);
		$results = $results->all();
		$results = $results->toArray();
		
		foreach ($results as $key => $value){
			$this->global_materials[$results[$key]['name']] = $results[$key]['id'];
		}
	}

	public function set_global_material_colors(){
		$results = $this->MaterialColors->find('all');
		$results->hydrate(false);
		$results = $results->all();
		$results = $results->toArray();
		
		foreach ($results as $key => $value){
			$this->global_material_colors[$results[$key]['name']] = $results[$key]['id'];
		}
	}

	public function set_global_metal_and_colors(){
		$results = $this->MetalAndColors->find('all');
		$results->hydrate(false);
		$results = $results->all();
		$results = $results->toArray();
		
		foreach ($results as $key => $value){
			$this->global_metal_and_colors[$results[$key]['name']] = $results[$key]['id'];
		}
	}

	public function set_global_diamond_clarities(){
		$results = $this->DiamondClarities->find('all');
		$results->hydrate(false);
		$results = $results->all();
		$results = $results->toArray();
		
		foreach ($results as $key => $value){
			$this->global_diamond_clarities[$results[$key]['name']] = $results[$key]['id'];
		}
	}

	public function set_global_master_categories(){
		$results = $this->MasterCategories->find('all');
		$results->hydrate(false);
		$results = $results->all();
		$results = $results->toArray();
		
		foreach ($results as $key => $value){
			$this->global_master_categories[$results[$key]['name']] = $results[$key]['id'];
		}
	}

	public function set_global_necklace_types(){
		$results = $this->NecklaceTypes->find('all');
		$results->hydrate(false);
		$results = $results->all();
		$results = $results->toArray();
		
		foreach ($results as $key => $value){
			$this->global_necklace_types[$results[$key]['name']] = $results[$key]['id'];
		}
	}

	public function set_global_websites(){
		$results = $this->Websites->find('all');
		$results->hydrate(false);
		$results = $results->all();
		$results = $results->toArray();
		
		foreach ($results as $key => $value){
			$this->global_websites[$results[$key]['pretty_name']] = $results[$key]['id'];
		}
		//pr($this->global_websites); die();
	}

	public function set_global_styles(){
		$results = $this->Styles->find('all');
		$results->hydrate(false);
		$results = $results->all();
		$results = $results->toArray();
		
		foreach ($results as $key => $value){
			$this->global_styles[$results[$key]['name']] = $results[$key]['id'];
		}
	}

	public function set_global_chains(){
		$results = $this->Chains->find('all');
		$results->hydrate(false);
		$results = $results->all();
		$results = $results->toArray();
		
		foreach ($results as $key => $value){
			$this->global_chains[$results[$key]['name']] = $results[$key]['id'];
		}
	}

	public function set_global_clasps(){
		$results = $this->Clasps->find('all');
		$results->hydrate(false);
		$results = $results->all();
		$results = $results->toArray();
		
		foreach ($results as $key => $value){
			$this->global_clasps[$results[$key]['name']] = $results[$key]['id'];
		}
	}

	private function curl_mestergull($nodes, $referer){
		if (isset($nodes[0])){
			if  (in_array  ('curl_multi_info_read', get_loaded_extensions())) {}
			if(!$referer){
				$referer = $this->mestergull_website_url . $nodes[0]['url'];
			}
			
			$node_count = count($nodes);
			$curl_arr = array();
			$master = curl_multi_init();
			//$this->set_global_diamond_clarities();
	
			for($i = 0; $i < $node_count; $i++) {
				$curl_arr[$i] = curl_init($nodes[$i]['url']);
				curl_setopt($curl_arr[$i],CURLOPT_FRESH_CONNECT,true);
				curl_setopt($curl_arr[$i],CURLOPT_CONNECTTIMEOUT, 30);
				curl_setopt($curl_arr[$i],CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)");
				curl_setopt($curl_arr[$i],CURLOPT_RETURNTRANSFER,true);
				curl_setopt($curl_arr[$i],CURLOPT_REFERER,$referer);
				curl_setopt($curl_arr[$i],CURLOPT_TIMEOUT,30);
				curl_multi_add_handle($master, $curl_arr[$i]);
			}
			$finalresult = array();
			$returnedOrder = array();
			do {
				curl_multi_exec($master, $running);
				$info = curl_multi_info_read($master);
				if($info['handle']) {
					$index = array_search($info['handle'], $curl_arr, true);
					$html = curl_multi_getcontent($info['handle']);
					$html = html_entity_decode($html, ENT_NOQUOTES, "UTF-8");
					preg_match_all(
						$this->mestergull_special_product_pattern,
						$html,
						$matches,
						PREG_SET_ORDER
					);
					if ($matches){
						$nodes[$index]['description'] = $matches[0][1];
						$finalresult[] = $matches;
						$returnedOrder[] = $index;
					}
					curl_multi_remove_handle($master, $info['handle']);
					curl_close($curl_arr[end($returnedOrder)]);
				}
				
				
			} while($running > 0);
			curl_multi_close($master);	
			$return = array_combine($returnedOrder, $finalresult);
		}
		return $nodes;
	}

	public function set_product_gender($string, $key){
		if (stripos($string, "Herre")){
			$this->scraped_products[$key]['gender_id'] = 2;
		} else if (stripos($string, "Barn")) {
			$this->scraped_products[$key]['gender_id'] = 3;
		} else {
			$this->scraped_products[$key]['gender_id'] = 1;
		}
	}

	public function check_previously_saved_image($item){
		$items = $this->Items->find('all', array(
    		'conditions' => array(
    			'Items.code' => $item['code'],
				'Items.id <>' => $item['id']
			),
			'order' => array('Items.id' => 'DESC')
    	));
    	$items->hydrate(false);
    	$last_item = $items->first();
    	
		if ($last_item['image_processed'] && 
			file_exists('download/' . $last_item['id'] . '_small.jpg') &&
			file_exists('download/' . $last_item['id'] . '_reference.jpg')){
			copy('download/' . $last_item['id'] . '_small.jpg', 'download/' . $item['id'] . '_small.jpg');
			copy('download/' . $last_item['id'] . '_reference.jpg', 'download/' . $item['id'] . '_reference.jpg');
			return TRUE;
		} 
		else {
			return FALSE;
		}
	}

	public function save_item_occasions($item_id, $occasions){
		foreach ($occasions as $occasion){
			if ($occasion){
				$already = $this->ItemOccasions->find('all', array(
					'conditions' => array(
						'ItemOccasions.item_id' => $item_id, 
						'ItemOccasions.occasion_id' => $occasion
					)
				));
				$already = $already->first();
				if (!isset($already->id)){
					$entry = $this->ItemOccasions->newEntity();
					$entry->occasion_id = $occasion;
					$entry->item_id = $item_id;
					$this->ItemOccasions->save($entry);
				}
			}
		}
	}

	private function check_and_save_metal_and_colors($product, $previously_scraped_item, $item_id){
		if (!isset($product['metal_and_colors'])){
			return NULL;
		}
		$product['metal_and_colors'] = array_unique($product['metal_and_colors']);
		$simple_array_of_new_metals = $product['metal_and_colors'];
		foreach ($product['metal_and_colors'] as $key=>$value){
			$product['metal_and_colors'][$key] = array(
				'changed' => 0,
				'deleted' => 0,
				'metal_and_color_id' => $value
			);
		}

		$previously_scraped_item['ItemMetalAndColor'];
		$total = count($previously_scraped_item['ItemMetalAndColor']);
		if ($previously_scraped_item['ItemMetalAndColor']){
			foreach ($previously_scraped_item['ItemMetalAndColor'] as $key=>$value){
				$new_key = array_search($value['metal_and_color_id'], $simple_array_of_new_metals);
				
				if ($new_key !== FALSE){
					$metal_and_color_id = $product['metal_and_colors'][$new_key]['metal_and_color_id'];
					$product['metal_and_colors'][$new_key] = array(
						'changed' => $value['changed'],
						'deleted' => $value['deleted'],
						'metal_and_color_id' => $metal_and_color_id
					);
				} else {
					$product['metal_and_colors'][$total++] = array(
						'changed' => $value['changed'],
						'deleted' => $value['deleted'],
						'metal_and_color_id' => $value['metal_and_color_id']
					);
				}
			}
		}
		
		if (isset($product['metal_and_colors'])){
			$metal_and_colors = $product['metal_and_colors'];
			$metal_and_colors_array = array();
			foreach ($metal_and_colors as $mc){
				$metal_and_colors = $this->MetalAndColors->newEntity();
				$metal_and_colors->item_id = $item_id;
				$metal_and_colors->metal_and_color_id = $mc['metal_and_color_id'];
				$metal_and_colors->changed = $mc['changed'];
				$metal_and_colors->deleted = $mc['deleted'];
				$result = $this->ItemMetalAndColors->save($metal_and_colors);
				
			}
		}
	} 

	public function save_item_stone($item_id, $stone_id){
		$entry = $this->ItemStones->newEntity();
		$entry->stone_id = $stone_id;
		$entry->item_id = $item_id;
		
		$already = $this->ItemStones->find('all', array(
    		'conditions' => array(
    			'ItemStones.item_id' => $item_id,
    			'ItemStones.stone_id' => $stone_id
    		)
    	));

    	$already = $already->first();
		
		if (!isset($already->id)){
			$this->ItemStones->save($entry);
		}
	}

	public function save_item_filter_pearl($item_id, $stone_id, $global_stones, $filter_pearl_id){
		if ($stone_id == $this->global_stones['Freshwater pearl'] ||
			$stone_id == $this->global_stones['Freshwater cultured pearl'] ||
			$stone_id == $this->global_stones['Salt water pearl'] ||
			$stone_id == $this->global_stones['Salt water cultured pearl'] ||
			$stone_id == $this->global_stones['Mother of pearl'] ||
			$stone_id == $this->global_stones['Shell Pearl'] ||
			$stone_id == $this->global_stones['Synthetic pearl'] ||
			$stone_id == $this->global_stones['Swarovski Pearl'] ||
			$stone_id == $this->global_stones['Akoya pearl'] ||
			$stone_id == $this->global_stones['Tahiti pearl'] ||
			$stone_id == $this->global_stones['Pearl']
		){
			$entry = $this->ItemFilterStones->newEntity();
			$entry->filter_stone_id = $filter_pearl_id;
			$entry->item_id = $item_id;
			$already = $this->ItemFilterStones->find('all', array(
				'conditions' => array(
					'ItemFilterStones.item_id' => $item_id, 
					'ItemFilterStones.filter_stone_id' => $filter_pearl_id
				)
			));

			$already = $already->first();

			if (!isset($already->id)){
				$this->ItemFilterStones->save($entry);
			}	
		}
	}

	public function save_item_lengths($item_id, $lengths){
		if ($lengths){
			foreach ($lengths as $key=>$value){
				$lengths = $this->Lengths->find('all', array(
					'conditions' => array('Lengths.name' => $value)
				));
				$lengths->hydrate(false);
    			$first_length = $lengths->first();

    			if (isset($first_length->name)) {
    				$length_id = $first_length->id;
    			} else {
    				$length_id = $this->save_new_kind('Lengths', $value);
    			}
				$already = $this->ItemLengths->find('all', array(
					'conditions' => array(
						'ItemLengths.item_id' => $item_id, 
						'ItemLengths.length_id' => $length_id
					)
				));
				$already = $already->first();
				if (!isset($already->id)){
					$entry = $this->ItemLengths->newEntity();
					$entry->length_id = $length_id;
					$entry->item_id = $item_id;
					$this->ItemLengths->save($entry);
				}
			}
		}
	}	

	public function save_new_kind($model, $value){
		$entry = $this->$model->newEntity();
		$entry->name = $value;
		$result = $this->$model->save($entry);
		return $result->id;
	}

	private function curl($nodes, $referer) {
		if  (in_array  ('curl_multi_info_read', get_loaded_extensions())) {}
		else{}
		
		if(!$referer){
			$referer = $nodes[0]['url'];
		}

		$node_count = count($nodes);
		$curl_arr = array();
		$master = curl_multi_init();
		$this->set_global_diamond_clarities();

		for($i = 0; $i < $node_count; $i++) {
			$curl_arr[$i] = curl_init($nodes[$i]['url']);
			
			curl_setopt($curl_arr[$i],CURLOPT_FRESH_CONNECT,true);
			curl_setopt($curl_arr[$i],CURLOPT_CONNECTTIMEOUT, 30);
			curl_setopt($curl_arr[$i],CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)");
			curl_setopt($curl_arr[$i],CURLOPT_RETURNTRANSFER,true);
			curl_setopt($curl_arr[$i],CURLOPT_REFERER,$referer);
			curl_setopt($curl_arr[$i],CURLOPT_TIMEOUT,30);
			curl_setopt($curl_arr[$i], CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($curl_arr[$i], CURLOPT_SSL_VERIFYHOST, false);
			curl_multi_add_handle($master, $curl_arr[$i]);
		}
		
		$finalresult = array();
		$returnedOrder = array();
		do {
			curl_multi_exec($master, $running);
			$info = curl_multi_info_read($master);
			if($info['handle']) {
				$index = array_search($info['handle'], $curl_arr, true);
				$html = curl_multi_getcontent($info['handle']);
				$this->counter2++;
				//scraping process form http://david-andersen.no (ajax version)
				if ($nodes[$index]['website'] == "http://david-andersen.no"){
					
					$html = html_entity_decode($html, ENT_NOQUOTES, "UTF-8"); //this line converts
					 
					preg_match_all(
						$this->davidandersen_pattern,
						$html,
						$matches,
						PREG_SET_ORDER
					);
					
					if ($matches){
						foreach ($matches as $key=>$value){
							$matches[$key]['link'] = $nodes[$index]['link'];
						}
					} else {
						//echo json_encode("End davidandersen curling!"); die();
					}
				}
				
				//scraping process for links on http://thune.no::
				if ($nodes[$index]['website'] == $this->thune_website_url 
					&& $nodes[$index]['is_page']){
					preg_match_all(
						$this->thune_page_pattern,
						$html,
						$matches,
						PREG_SET_ORDER
					);

					foreach ($matches as $key=>$value){
						//pr($matches);
						$product = array();
						$product['url'] = $this->thune_website_url . str_ireplace("..", "", $matches[$key][1]);
						$product['master_category_id'] = $nodes[$index]['master_category_id'];
						$product['website_id'] = $nodes[$index]['website_id'];
						$product['website'] = $nodes[$index]['website'];
						$product['name'] = $matches[$key][4];
						$product['price'] = str_ireplace(",00", "", $matches[$key][7]);
						$product['image_small'] = $this->thune_website_url . str_ireplace("../", "/", $matches[$key][3]);
						$product['is_page'] = false;
						$this->prescraped_products[] = $product;
					}
					//$this->curl($this->prescraped_products, NULL);
				}
				
				//scraping process for items on http://thune.no::
				if ($nodes[$index]['website'] == $this->thune_website_url && $nodes[$index]['is_page'] == FALSE){
					preg_match_all(
						$this->thune_pattern,
						$html,
						$matches,
						PREG_SET_ORDER
					);
					foreach ($matches as $match){						
						//$split_info = $this->Work->get_thune_short_product_info($match[2]);
						$this->scraped_products[$this->counter]['website_id'] 			= $nodes[$index]['website_id'];
						$this->scraped_products[$this->counter]['name'] 				= $nodes[$index]['name'];
						$this->scraped_products[$this->counter]['description'] 			= (strip_tags(trim($match[1])));
						$this->scraped_products[$this->counter]['link'] 				= $nodes[$index]['url'];
						$this->scraped_products[$this->counter]['master_category_id'] 	= $nodes[$index]['master_category_id'];
						$this->scraped_products[$this->counter]['price'] 				= preg_replace ( '/[^0-9]/', '', $nodes[$index]['price'] );
						$this->scraped_products[$this->counter]['image_small'] 			= $nodes[$index]['image_small'];
						$this->scraped_products[$this->counter]['info'] = $match[2];
						$this->scraped_products[$this->counter]['code'] = trim($match[4]);
						$this->counter++;
					}
				}
				
				//scraping process form http://www.bjorklund.no
				if ($nodes[$index]['website'] == "http://www.bjorklund.no"){
					preg_match_all(
						$this->bjorklund_image_pattern,
						$html,
						$matches_image,
						PREG_SET_ORDER
					);
					
					$this->scraped_products[$this->counter]['image_small'] = $nodes[$index]['website'] . $matches_image[0][2];
					$this->scraped_products[$this->counter]['link'] = $nodes[$index]['url'];
					//var_dump($matches_image);die();
					preg_match_all(
						$this->bjorklund_pattern,
						$html,
						$matches,
						PREG_SET_ORDER
					);
					var_dump($matches); die();
					if ($matches){
						$matches = $matches[0];
						//unset($matches[0]);
						$this->scraped_products[$this->counter]['name'] = $matches[1];
						$this->scraped_products[$this->counter]['description'] = $matches[4];
						$this->scraped_products[$this->counter]['price'] = str_replace(".", "", $matches[2]);
						
						$split_info = $this->Jewelries->bjorklund_get_product_info(
							$matches[5],
							$this->global_diamond_colors, 
							$this->global_diamond_clarities,
							$this->global_stones
						);

						if (isset($split_info['code']) && $split_info['code']){
							$this->scraped_products[$this->counter]['code'] = $split_info['code'];
						}
						if (isset($split_info['material']) && $split_info['material'] != ""){
							$this->scraped_products[$this->counter]['material'] 			= $split_info['material'];
							//if (isset($split_info['Bimatriale']) && $split_info['Bimatriale'] != ""){
							//	$this->scraped_products[$this->counter]['bimaterial'] 		= $split_info['Bimatriale'];
							//}
						} else {
							// its a product without description fields:
							if (stripos($matches[1], "gult gull") !== FALSE){
								$this->scraped_products[$this->counter]['material']  = "Gult gull"; 
							}
							else if (stripos($matches[1], "hvitt gull") !== FALSE){
								$this->scraped_products[$this->counter]['material']  = "Hvitt gull"; 
							} 
							else if (stripos($matches[1], "rødt gull") !== FALSE){
								$this->scraped_products[$this->counter]['material']  = "Rødt gull "; 
							}
							else if (stripos($matches[1], "Sølv") !== FALSE ||
								stripos($matches[1], "SØLV") !== FALSE){
								$this->scraped_products[$this->counter]['material']  = "Sølv"; 
							}
							else if (stripos($matches[1], "stål") !== FALSE){
								$this->scraped_products[$this->counter]['material']  = "Stål"; 
							}
							else if (stripos($matches[1], "Bomull") !== FALSE){
								$this->scraped_products[$this->counter]['material']  = "Cotton"; 
							}
						}
						if (isset($split_info['metalstamp'])){
							$this->scraped_products[$this->counter]['metalstamp'] = $split_info['metalstamp'];
						}
						if (isset($split_info['surface'])){
							$this->scraped_products[$this->counter]['surface'] = $split_info['surface'];
						}
						if (isset($split_info['diamond_number'])){
							$this->scraped_products[$this->counter]['diamond_number'] = $split_info['diamond_number'];
						}
						if (isset($split_info['diamond_weight'])){
							$this->scraped_products[$this->counter]['diamond_weight'] = $split_info['diamond_weight'];
						}
						if (isset($split_info['diamond_color_id'])){
							$this->scraped_products[$this->counter]['diamond_color_id'] = $split_info['diamond_color_id'];
						}
						if (isset($split_info['diamond_clarity_id'])){
							$this->scraped_products[$this->counter]['diamond_clarity_id'] = $split_info['diamond_clarity_id'];
							$this->internal_scrap_info[] = $this->scraped_products[$this->counter]['diamond_clarity_id'];
						}
						if (isset($split_info['diamond_cut'])){
							$this->scraped_products[$this->counter]['diamond_cut'] = $split_info['diamond_cut'];
						}
						//if (isset($split_info['Andrestener'])){
						//	$this->scraped_products[$this->counter]['other_stones'] 		= $split_info['Andrestener'];
						//}
						//var_dump($this->scraped_products[$this->counter]);
						$this->counter++;
					} else {
						//echo json_encode("End bjorklund curling"); die();
						//break;
					}
				} //if ($nodes[$index]['website'] == "http://www.bjorklund.no")

				$finalresult[] = $matches;
				$returnedOrder[] = $index;
				curl_multi_remove_handle($master, $info['handle']);
				curl_close($curl_arr[end($returnedOrder)]);
			}
		} while($running > 0);
		curl_multi_close($master);
		
		if ($nodes[$index]['website'] == "http://david-andersen.no"){
			$this->set_global_occasions();
			$this->set_global_diamond_colors();
			if ($nodes[$index]['category_name'] == "armbånd"){
				$this->set_global_styles();
			}
			foreach ($finalresult as $matches){
				if ($matches){
					
					foreach ($matches as $key=>$value){
						unset($matches[$key][0]);
						unset($matches[$key][2]);
						unset($matches[$key][4]);
						unset($matches[$key][10]);
					}
					//pr($matches);die();
					foreach ($matches as $match){
						$this->scraped_products[$this->counter]['name'] = trim($match[8]);
						$this->get_davidandersen_product_info($match[9]);
						$this->scraped_products[$this->counter]['description'] = trim($match[9]);
						$this->set_product_gender(
							$this->scraped_products[$this->counter]['description'], 
							$this->counter
						);
						
						$this->scraped_products[$this->counter]['price'] = $this->Work->get_davidandersen_price($match[11]);
//						$this->scraped_products[$this->counter]['price'] = str_ireplace(",00", "", trim(str_ireplace("kr", "", trim($match[11]))));
//						$this->scraped_products[$this->counter]['price'] = preg_replace('/[^0-9,]|,[0-9]*$/','',$this->scraped_products[$this->counter]['price']);
						$this->scraped_products[$this->counter]['code'] = $this->Work->get_davidandersen_code($match[7]);
						$this->scraped_products[$this->counter]['brand'] = $this->Work->get_davidandersen_designer($match[6]);
						$this->scraped_products[$this->counter]['designer'] = $this->Work->get_davidandersen_designer($match[6]);
						$this->scraped_products[$this->counter]['image_small'] 	= str_replace("http://", "https://", $nodes[$index]['website']) . $match[3];
						$this->scraped_products[$this->counter]['website_id'] 	= $nodes[$index]['website_id'];
						//$this->scraped_products[$this->counter]['link'] 	= $match['link'];
						//$this->scraped_products[$this->counter]['link'] 	= 'https://david-andersen.no/produkter/'.$nodes[$index]['category_name'].'/0/0/0/0/#pi/' . $match[1];
						$this->scraped_products[$this->counter]['link'] 	= 'https://david-andersen.no/produkter/'.$nodes[$index]['category_name'].'/#pi/' . $match[1];
						//$this->scraped_products[$this->counter]['occasion_id'] = $this->Work->get_occasions_info($this->scraped_products[$this->counter]['name'], $this->global_occasions);
						$this->scraped_products[$this->counter]['occasions_info'] = 
							$this->Jewelries->get_multiple_occasions_info(
								$this->global_occasions,
								$this->scraped_products[$this->counter]['name']
							);
						//version 2: more hardcoded
						$string = $this->scraped_products[$this->counter]['description'];
						if (stripos($string, "Tw.vvs")){
							$this->scraped_products[$this->counter]['diamond_clarity_id'] = $this->global_diamond_clarities["VVS"];
							$this->scraped_products[$this->counter]['diamond_color_id'] = $this->global_diamond_colors["TW"];
						}
						else if (stripos($string, "TWvvs")){
							$this->scraped_products[$this->counter]['diamond_clarity_id'] = $this->global_diamond_clarities["VVS"];
							$this->scraped_products[$this->counter]['diamond_color_id'] = $this->global_diamond_colors["TW"];
						}
						else if (stripos($string, "TW.vs")){
							$this->scraped_products[$this->counter]['diamond_clarity_id'] = $this->global_diamond_clarities["VS"];
							$this->scraped_products[$this->counter]['diamond_color_id'] = $this->global_diamond_colors["TW"];
						}
						else if (stripos($string, "TWvs")){
							$this->scraped_products[$this->counter]['diamond_clarity_id'] = $this->global_diamond_clarities["VS"];
							$this->scraped_products[$this->counter]['diamond_color_id'] = $this->global_diamond_colors["TW"];
						}
						else if (stripos($string, "TW-vs")){
							$this->scraped_products[$this->counter]['diamond_clarity_id'] = $this->global_diamond_clarities["VS"];
							$this->scraped_products[$this->counter]['diamond_color_id'] = $this->global_diamond_colors["TW"];
						}
						else if (stripos($string, "TWsi")){
							$this->scraped_products[$this->counter]['diamond_clarity_id'] = $this->global_diamond_clarities["SI"];
							$this->scraped_products[$this->counter]['diamond_color_id'] = $this->global_diamond_colors["TW"];
						}
						else if (stripos($string, "TW.si")){
							$this->scraped_products[$this->counter]['diamond_clarity_id'] = $this->global_diamond_clarities["SI"];
							$this->scraped_products[$this->counter]['diamond_color_id'] = $this->global_diamond_colors["TW"];
						}
						else if (stripos($string, "vs.")){
							$this->scraped_products[$this->counter]['diamond_clarity_id'] = $this->global_diamond_clarities["VS"];
						}
						else if (stripos($string, "vs1.")){
							$this->scraped_products[$this->counter]['diamond_clarity_id'] = $this->global_diamond_clarities["VS1"];
						}
						else if (stripos($string, "River vs1.")){
							$this->scraped_products[$this->counter]['diamond_clarity_id'] = $this->global_diamond_clarities["VS1"];
							$this->scraped_products[$this->counter]['diamond_color_id'] = $this->global_diamond_colors["R"];
						}
						else if (stripos($string, "River vvs-2")){
							$this->scraped_products[$this->counter]['diamond_clarity_id'] = $this->global_diamond_clarities["VVS2"];
							$this->scraped_products[$this->counter]['diamond_color_id'] = $this->global_diamond_colors["R"];
						}
						else if (stripos($string, "Wesselton si")){
							$this->scraped_products[$this->counter]['diamond_clarity_id'] = $this->global_diamond_clarities["SI"];
							$this->scraped_products[$this->counter]['diamond_color_id'] = $this->global_diamond_colors["W"];
						}
						else if (stripos($string, "Top Wesselton. VS")){
							$this->scraped_products[$this->counter]['diamond_clarity_id'] = $this->global_diamond_clarities["VS"];
							$this->scraped_products[$this->counter]['diamond_color_id'] = $this->global_diamond_colors["TW"];
						}
						else if (stripos($string, "Renhet: v v s.")){
							$this->scraped_products[$this->counter]['diamond_clarity_id'] = $this->global_diamond_clarities["VVS"];
						} 
						
						//now special diamond color search::
						if (stripos($string, "River") !== FALSE){
							$this->scraped_products[$this->counter]['diamond_color_id'] = $this->global_diamond_colors["R"];
						}
						$this->scraped_products[$this->counter]['master_category_id'] = $nodes[$index]['master_category_id'];
						//pr($nodes[$index]['category_name']);
						if ($nodes[$index]['category_name'] == "armbånd" || $nodes[$index]['category_name'] == 'anheng-og-kjeder'){
							$this->scraped_products[$this->counter]['style_id'] = $this->Jewelries->get_item_special_attribute($this->global_styles, $string);
							$this->scraped_products[$this->counter]['lengths'] = $this->Jewelries->get_item_lengths($this->scraped_products[$this->counter]['description']);
							if ($this->scraped_products[$this->counter]['lengths'])
								$this->scraped_products[$this->counter]['has_lengths'] = 1;
							$this->scraped_products[$this->counter]['chain_id'] = $this->Jewelries->get_item_special_attribute($this->global_chains, $this->scraped_products[$this->counter]['description']);
							$this->scraped_products[$this->counter]['clasp_id'] = $this->Jewelries->get_item_special_attribute($this->global_clasps, $this->scraped_products[$this->counter]['description']);
							$this->scraped_products[$this->counter]['height'] = $this->Jewelries->get_item_height($this->scraped_products[$this->counter]['description']);
						} 
						//pr($this->scraped_products[$this->counter]);
						$this->counter++;
					}
				}
			}
		}

		$return = array_combine($returnedOrder, $finalresult);
		return $return;
	}
}


#bin/cake bake migration CreateItemFilterMetalAndColors item_id:integer filter_metal_and_color_id:integer
#bin/cake bake migration CreateItemFilterStones item_id:integer filter_stone_id:integer
#bin/cake bake migration CreateItemLengths item_id:integer length_id:integer
#bin/cake bake migration CreateItemNecklaceTypes item_id:integer necklace_type_id:integer
#bin/cake bake migration CreateItemTags item_id:integer tag_id:integer
#bin/cake bake migration CreateLengths item_id:integer name:string
