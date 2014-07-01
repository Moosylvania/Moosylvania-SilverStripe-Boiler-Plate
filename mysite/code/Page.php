<?php
class Page extends SiteTree {

	private static $db = array(
		'MetaTitle' => 'Varchar(255)'
	);

	private static $has_one = array(
	);

	function getCMSFields() {
 		$fields = parent::getCMSFields();  //get all the fields...
 		$fields->addFieldToTab('Root.Main', new TextField('MetaTitle', 'Meta Title'), 'MetaDescription');
 		return $fields;
 	}

}
class Page_Controller extends ContentController {

	/**
	 * An array of actions that can be accessed via a request. Each array element should be an action name, and the
	 * permissions or conditions required to allow the user to access it.
	 *
	 * <code>
	 * array (
	 *     'action', // anyone can access this action
	 *     'action' => true, // same as above
	 *     'action' => 'ADMIN', // you must have ADMIN permissions to access this action
	 *     'action' => '->checkAction' // you can only access this action if $this->checkAction() returns true
	 * );
	 * </code>
	 *
	 * @var array
	 */
	private static $allowed_actions = array (
	);

	protected $_css = array();
	protected $_js = array();

	public function init() {
		parent::init();

		self::loadStyles();

	}

	public function loadStyles() {

		$config = Config::inst();

		$_path = 'themes/' . $config->get("SSViewer", 'theme') .'/';
		$_isCustomCSSSpecified = count($this->_css);
        $_isCustomJSSpecified = count($this->_js);

		Requirements::clear();

        $jsItems = array(
        	THIRDPARTY_DIR.'/jquery/jquery.js',
    		THIRDPARTY_DIR.'/jquery-ui/jquery-ui.js',
    		$_path.'javascript/jquery.pubsub.js',
    		$_path.'javascript/getParameterByName.js',
    		$_path.'javascript/URLEncode.js',
    		$_path .'javascript/forCrappyBrowsers.js',
    		$_path .'javascript/ga.js',    		
    		$_path .'javascript/SocialScripts.js'
		);

		$jsItemsCustom = array();
		if($_isCustomJSSpecified) {
			foreach($this->_js as $jsFileName) {
				array_push($jsItemsCustom, $_path.'javascript/' . $jsFileName . '.js');
			}
		}

		$cssItems = array($_path . 'css/layout.css');
        $cssItemsCustom = array();

        if($_isCustomCSSSpecified) {
        	foreach ($this->_css as $cssFileName) {
                array_push($cssItemsCustom, $_path . 'css/' . $cssFileName . '.css');
            }
        }

        foreach($jsItems as $item) {
        	Requirements::javascript($item);
        }

        foreach ($cssItems as $item) {
            Requirements::css($item);
        }

        foreach ($jsItemsCustom as $item) {
            Requirements::javascript($item);
        }

        foreach ($cssItemsCustom as $item) {
            Requirements::css($item);
        }

         /*
         Combine the files, append the custom file name if specified to avoid conflict
         */
        Requirements::combine_files('assets/cache/css/cssmin.css', $cssItems);
        if ($_isCustomCSSSpecified) {
            Requirements::combine_files('assets/cache/css/cssmin_' . str_replace('/', '_', $this -> Link()) . '.css', $cssItemsCustom);
        }

        Requirements::combine_files('assets/cache/javascript/jsmin.js', $jsItems);
        if ($_isCustomJSSpecified) {
            Requirements::combine_files('assets/cache/javascript/jsmin_' . str_replace('/', '_', $this -> Link()) . '.js', $jsItemsCustom);
        }

        // Now do the combine
        Requirements::process_combined_files();

        if ($pos = strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE')) {
            $version = substr($_SERVER['HTTP_USER_AGENT'], $pos + 5, 3);
            if ($version <= 7) {
                Requirements::css($_path . 'css/iesucks.css');
            }
			Requirements::javascript($_path.'javascript/ie-placeholder.js');
        }

	}

	public function addCss($css) {
        if(is_array($css)) {
           $this->_css = array_merge($this->_css, $css);
        } else {
            $this->_css[] = $css;
        }
    }

    public function addJs($js) {
        if(is_array($js)) {
            $this->_js = array_merge($this->_js, $js);
        } else {
            $this->_js[] = $js;
        }
    }

    public function MetaTags($includeTitle = true) {
        $tags = "";
        if ($includeTitle === true || $includeTitle == 'true') {
            $tags .= "<title>" . Convert::raw2xml(($this -> MetaTitle) ? $this -> MetaTitle : $this -> Title) . "</title>\n";
        }

        $charset = ContentNegotiator::get_encoding();
        $tags .= "<meta charset=\"utf-8\"> \n<meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge,chrome=1\"> \n";
        if ($this -> MetaKeywords) {
            $tags .= "<meta name=\"keywords\" content=\"" . Convert::raw2att($this -> MetaKeywords) . "\" />\n";
        }
        if ($this -> MetaDescription) {
            $tags .= "<meta name=\"description\" content=\"" . Convert::raw2att($this -> MetaDescription) . "\" />\n";
        }

        $tags .= $this -> ViewPortMeta();

        if ($this -> ExtraMeta) {
            $tags .= $this -> ExtraMeta . "\n";
        }

        $this -> extend('MetaTags', $tags);

        return $tags;
    }

    //function to return the viewport meta for  mobile.
    public function ViewPortMeta() {
        return '<meta name="viewport" content="width=device-width,initial-scale=1">';
    }

}
