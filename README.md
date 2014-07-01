Moosylvania SilverStripe Boiler Plate
=====================================

Boiler Plate setup of SilverStripe configured with best practices in mind.

This is loosely based off of the HTML5 Boiler Plate and provides a blank
skeleton for you to start rapidly developing your site.

## Requirements

* SilverStripe 3.1.0+

## Installation

1. Clone Repository or with Composer

        "require" : { "moosylvania/moosylvania-silverstripe-boiler-plate":"dev-master" }

2. Edit /mysite/_config.php and

 * update the database configuration.  The domain name set on line 10 would be your production url.
 * Set your default admin password on line 35
 * Set default admin email on line 62

3. Update /mysite/_config/config.yml

 * update the admin email address for error reporting.  This will send you emails of errors on the site when in production.

4. Edit /mysite/code/Page.php

 * update $jsItems on line 58 to specify your global scripts
 * update $cssItems on line 77 to specify your global stylesheets

## Documentation

### CSS and JS Minification

One benefit of this boilerplate is we have setup auto concatenation and minification of
your css and js files based off of each page type.

On the init function of your custom Page types controller, example HomePage - you would add the following

        $this->addCss(array('cssfileone', 'cssfiletwo'));
		$this->addJs(array('jsfileone', jsfiletwo));

In the example above cssfileone would be the name of a css file in /themes/mytheme/css without the .css.
jsfileone would be a file located in /themes/mytheme/js/ without the .js extension

As a note, if you are using a different theme name the project will detect that and use the custom theme to locate the css and js files.

Lastly if you are running the site in 'Dev' mode - the files will not be concatenated or minified making it easier to debug.

### Google Analytics

Simply update /themes/mytheme/js/ga.js with your proper UA number, this is automatically included on every page.

### Facebook and Twitter JS SDK

This is automatically included via /themes/mytheme/js/SocialScripts.js.  You can remove this from being included by changing your Page.php file

### Sass

Should you choose to use Sass, we have a Sass folder under /themes/mytheme.  When creating your Sass sheets, I would create a new file for each Page Type.  Then when compiling, have the output go to /themes/mytheme/css

When doing this you will be able to use the CSS minification and concatenation features already built into the site.

### Robots.txt for QA and Production Environments

In the .htaccess file on lines 579-583, you will want to update the domain.com domain to your production site domain.  This will then serve up a proper robots.txt file when your site is in production.
