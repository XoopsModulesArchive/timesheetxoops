<?php
// $Id: config.php,v 1.0 2005/06/23
// Config Translations

// Config Form
define('_TSX_CONFIG_RESET', 'Reset');

define('_TSX_CONFIG_TITLE', 'Configuration Parameters:');
define('_TSX_CONFIG_INTRO', 'This form allows you to change the basic operating parameters of timesheet.php.
						Please be careful here, as errors may cause pages not to display properly.
						Somewhere in one of these, you should include the placeholder %commandMenu%.
						This is where timesheet.php will place the menu options.');

define('_TSX_CONFIG_LBL_LOC', 'Locale');
define('_TSX_CONFIG_LBL_LOCDSC', 'The locale in which you want timesheet.php to work. This affects regional settings. Leave it blank if you want to use the system locale. An example locale is en_AU, for Australia.');

define('_TSX_CONFIG_LBL_TZ', 'Time Zone');
define('_TSX_CONFIG_LBL_TZDSC', 'The timezone to use when generating dates. Leave it blank to use the system timezone. An example timezone is Australia/Melbourne.');

define('_TSX_CONFIG_LBL_TF', 'Time Format');
define('_TSX_CONFIG_LBL_TFDSC', 'The format in which times should be displayed. For example:<BR>
     &nbsp;&nbsp;&nbsp;&nbsp;<i> 12 hour format:</i><code>&nbsp;5:35 pm</code>
					&nbsp;&nbsp;&nbsp;&nbsp;<i> 24 hour format:</i><code>&nbsp;17:35</code>');

define('_TSX_CONFIG_LBL_WSD', 'Week Start Day');
define('_TSX_CONFIG_LBL_WSDDSC', 'The starting day of the week. Some people prefer to calculate the week starting from Monday rather than Sunday.');

define('_TSX_CONFIG_LBL_HHTML', 'headerhtml');
define('_TSX_CONFIG_LBL_HHTMLDSC', 'Additional HTML to add to the HEAD area of documents, eg. links to stylesheets.');

define('_TSX_CONFIG_LBL_BHTML', 'bodyhtml');
define('_TSX_CONFIG_LBL_BHTMLDSC', 'Additional parameters to add to the BODY tag at the beginning of documents, eg. background image/colors, link colors, etc ');

define('_TSX_CONFIG_LBL_BANHTML', 'bannerhtml');
define('_TSX_CONFIG_LBL_BANHTMLDSC', 'The html that gets emitted at the head of every page. This is a good place to insert the placeholder %commandMenu%. You may also want to include the placeholder %username% as part of a welcome message.');

define('_TSX_CONFIG_LBL_FHTML', 'footerhtml');
define('_TSX_CONFIG_LBL_FHTMLDSC', 'HTML to add to the bottom of every page. If you include %time%, %date%, and %timezone% here, it will print the time and date the page was loaded.');

define('_TSX_CONFIG_LBL_EHTML', 'errorhtml');
define('_TSX_CONFIG_LBL_EHTMLDSC', 'This is what is printed out when a form is improperly filled out. %errormsg% is replaced by the actual error itself.');

define('_TSX_CONFIG_LBL_THTML', 'tablehtml');
define('_TSX_CONFIG_LBL_THTMLDSC', 'Additional parameters to add to the TABLE tag when displaying sheets, calenders, etc. This is often used to set the background color or background image of the table.');
