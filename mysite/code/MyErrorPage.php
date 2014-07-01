<?php
  /**
   * Defines the My Error Page page type
   */

	class MyErrorPage extends ErrorPage {
		
        private static $icon = "treeicons/error";
        
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

    class MyErrorPage_Controller extends ErrorPage_Controller {
		public function init() {			
			
			parent::init();			
		}		
    }