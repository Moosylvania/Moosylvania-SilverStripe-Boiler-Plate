<?php
  /**
   * Defines the HomePage page type
   */

	class HomePage extends Page {
		private static $icon = "treeicons/home";

		private static $db = array(
						
     	);
		
		private static $has_one = array(
						
		);

		private static $allowed_children = array(
     	);

     	private static $can_be_root = true;

     	function getCMSFields() {
     		$fields = parent::getCMSFields();  //get all the fields...
			
     		return $fields;
     	}

     }

    class HomePage_Controller extends Page_Controller {
		public function init() {			
			//$this->addCss(array());
			//$this->addJs(array());
			parent::init();			
		}
    }