<?php

global $project;
$project = 'mysite';



global $databaseConfig;

if(strpos($_SERVER['HTTP_HOST'], 'domain.com') === false){
    //dev db
    Director::set_environment_type('dev');
    $databaseConfig = array(
        "type" => 'MySQLDatabase',
        "server" => '',
        "username" => '',
        "password" => '',
        "database" => '',
        "path" => '',
    );
} else {
    //prod db
    Director::set_environment_type('live');
    $databaseConfig = array(
        "type" => 'MySQLDatabase',
        "server" => '',
        "username" => '',
        "password" => '',
        "database" => '',
        "path" => '',
    );
}

//require_once('conf/ConfigureFromEnv.php');
Security::setDefaultAdmin('admin','password');

MySQLDatabase::set_connection_charset('utf8');

SSViewer::setOption('rewriteHashlinks', false);

Requirements::set_combined_files_enabled(true);

// Set the site locale
i18n::set_locale('en_US');

HtmlEditorConfig::get('cms')->setOptions(array(
    'friendly_name' => 'Default CMS',
    'priority' => '100',
    'mode' => 'none', // initialized through LeftAndMain.EditFor.js logic

    'body_class' => 'typography',
    'document_base_url' => '',

    'cleanup_callback' => "sapphiremce_cleanup",

    'use_native_selects' => true, // fancy selects are bug as of SS 2.3.0
    'valid_elements' => "@[id|class|style|title],#a[id|rel|rev|dir|tabindex|accesskey|type|name|href|target|title|class],#strong/#b[class],#em/#i[class],#strike[class],#u[class],#p[id|dir|class|align|style],#ol[class],#ul[class],#li[class],br,img[id|dir|longdesc|usemap|class|src|border|alt=|title|width|height|align],#sub[class],#sup[class],#blockquote[dir|class],#table[border=0|cellspacing|cellpadding|width|height|class|align|summary|dir|id|style],#tr[id|dir|class|rowspan|width|height|align|valign|bgcolor|background|bordercolor|style],tbody[id|class|style],thead[id|class|style],tfoot[id|class|style],#td[id|dir|class|colspan|rowspan|width|height|align|valign|scope|style],#th[id|dir|class|colspan|rowspan|width|height|align|valign|scope|style],caption[id|dir|class],#div[id|dir|class|align|style],#span[class|align|style],#pre[class|align],address[class|align],#h1[id|dir|class|align|style],#h2[id|dir|class|align|style],#h3[id|dir|class|align|style],#h4[id|dir|class|align|style],#h5[id|dir|class|align|style],#h6[id|dir|class|align|style],hr[class],dd[id|class|title|dir],dl[id|class|title|dir],dt[id|class|title|dir],#header[id|class|style|title],#footer[id|class|style|title],#article[id|class|style|title],#aside[id|class|style|title],#section[id|class|style|title],#nav[id|class|style|title],@[id,style,class]",
    'extended_valid_elements' => "img[class|src|alt|title|hspace|vspace|width|height|align|onmouseover|onmouseout|name|usemap],iframe[src|name|width|height|align|frameborder|marginwidth|marginheight|scrolling],object[width|height|data|type],param[name|value],map[class|name|id],area[shape|coords|href|target|alt]",
    'spellchecker_rpc_url' => THIRDPARTY_DIR . '/tinymce-spellchecker/rpc.php'
));

Email::setAdminEmail('noreply@domain.com');
