<?php
/**
 * $Id: xoops_version.php v 1.5 14 July 2003 Catwolf Exp $
 * Module: WF-Section
 * Release Date: 07 September 2003
 * Author: Catzwolf
 * Licence: GNU
 */
// Lets set up defines first
/**
 * Modules name and directory.
 *
 * If you want to set up WF-Sections as a secondary
 * module this is where you can do it from.
 */
global $xoopsDB, $xoopsConfig, $xoopsUser, $xoopsModule;
global $mimetypes, $wfsTemplates, $wfsPathConfig;
global $xoopsModuleConfig, $xoopsWFModule;

require_once XOOPS_ROOT_PATH . '/modules/wfsection/class/common.php';
require_once WFS_ROOT_PATH . '/include/groupaccess.php';
require_once WFS_ROOT_PATH . '/class/wfsarticle.php';

$modversion['name'] = _MI_WFS_NAME;
$modversion['version'] = 2.01;
$modversion['description'] = _MI_WFS_DESC;
$modversion['author'] = 'Catzwolf';
$modversion['credits'] = 'Catzwolf';

$modversion['help'] = 'wfsection.html';
$modversion['license'] = 'GNU see LICENSE';
$modversion['official'] = 1;
$modversion['image'] = 'images/wfs_slogo.gif';
$modversion['dirname'] = WFSECTION;

$modversion['sqlfile']['mysql'] = 'sql/wfsection.sql';

$modversion['tables'][1] = WFS_ARTICLE_DB;
$modversion['tables'][2] = WFS_ARTICLE_MOD_DB;
$modversion['tables'][3] = WFS_RESTORE;
$modversion['tables'][4] = WFS_BROKEN_DB;
$modversion['tables'][5] = WFS_CATEGORY_DB;
$modversion['tables'][6] = WFS_CHECKIN_DB;
$modversion['tables'][7] = WFS_CONFIG_DB;
$modversion['tables'][8] = WFS_FILES_DB;
$modversion['tables'][9] = WFS_INDEXPAGE;
$modversion['tables'][10] = WFS_MAINMENU_DB;
$modversion['tables'][11] = WFS_PERMISSIONS;
$modversion['tables'][12] = WFS_RELATED;
$modversion['tables'][13] = WFS_RELATEDLINKS;
$modversion['tables'][14] = WFS_REVIEWS;
$modversion['tables'][15] = WFS_SPOTLIGHT;
$modversion['tables'][16] = WFS_TEMPLATES;
$modversion['tables'][17] = WFS_VOTES;

$modversion['hasAdmin'] = 1;
$modversion['adminindex'] = 'admin/allarticles.php';
$modversion['adminmenu'] = 'admin/menu.php';

$modversion['blocks'][1]['file'] = 'wfs_artmenu.php';
$modversion['blocks'][1]['name'] = _MI_WFS_BNAME_ARTMENU;
$modversion['blocks'][1]['description'] = 'Shows Article menu';
$modversion['blocks'][1]['show_func'] = 'b_wfs_artmenu';
$modversion['blocks'][1]['template'] = $wfsTemplates['artmenublock'];

$modversion['blocks'][2]['file'] = 'wfs_menu.php';
$modversion['blocks'][2]['name'] = _MI_WFS_BNAME_MENU;
$modversion['blocks'][2]['description'] = 'Shows category menu';
$modversion['blocks'][2]['show_func'] = 'b_wfs_menu';
$modversion['blocks'][2]['template'] = $wfsTemplates['mainmenublock'];

$modversion['blocks'][3]['file'] = 'wfs_topics.php';
$modversion['blocks'][3]['name'] = _MI_WFS_TOPICS;
$modversion['blocks'][3]['description'] = 'WFS Category';
$modversion['blocks'][3]['show_func'] = 'b_wfs_topics_show';
$modversion['blocks'][3]['template'] = $wfsTemplates['topicsblock'];

$modversion['blocks'][4]['file'] = 'wfs_bigstory.php';
$modversion['blocks'][4]['name'] = _MI_WFS_BNAME3;
$modversion['blocks'][4]['description'] = 'Shows most read story of the day';
$modversion['blocks'][4]['show_func'] = 'b_wfs_bigstory_show';
$modversion['blocks'][4]['template'] = $wfsTemplates['bigartblock'];

$modversion['blocks'][5]['file'] = 'wfs_top.php';
$modversion['blocks'][5]['name'] = _MI_WFS_BNAME4;
$modversion['blocks'][5]['description'] = 'Shows top read news articles';
$modversion['blocks'][5]['show_func'] = 'b_wfs_top_show';
$modversion['blocks'][5]['edit_func'] = 'b_wfs_top_edit';
$modversion['blocks'][5]['options'] = 'counter|10|19';
//$modversion['blocks'][5]['options'] = "counter|10|19|1|1|1|1|100";
$modversion['blocks'][5]['template'] = $wfsTemplates['topartblock'];

$modversion['blocks'][6]['file'] = 'wfs_new.php';
$modversion['blocks'][6]['name'] = _MI_WFS_BNAME5;
$modversion['blocks'][6]['description'] = 'Shows recent articles';
$modversion['blocks'][6]['show_func'] = 'b_wfs_new_show';
$modversion['blocks'][6]['edit_func'] = 'b_wfs_new_edit';
//$modversion['blocks'][6]['options'] = "published|10|19";
$modversion['blocks'][6]['options'] = 'published|10|19|1|1|1|1|100';
$modversion['blocks'][6]['template'] = $wfsTemplates['newartblock'];

$modversion['blocks'][7]['file'] = 'wfs_newdown.php';
$modversion['blocks'][7]['name'] = _MI_WFS_BNAME6;
$modversion['blocks'][7]['description'] = 'Shows article downloads';
$modversion['blocks'][7]['show_func'] = 'b_wfs_down_show';
$modversion['blocks'][7]['edit_func'] = 'b_wfs_down_edit';
$modversion['blocks'][7]['options'] = 'date|10|19';
$modversion['blocks'][7]['template'] = $wfsTemplates['newdownblock'];

$modversion['blocks'][8]['file'] = 'wfs_author.php';
$modversion['blocks'][8]['name'] = _MI_WFS_BNAME7;
$modversion['blocks'][8]['description'] = 'Show Info about Author';
$modversion['blocks'][8]['show_func'] = 'b_wfs_author_show';
$modversion['blocks'][8]['options'] = 'published|10|25';
$modversion['blocks'][8]['template'] = $wfsTemplates['authorblock'];

$modversion['blocks'][9]['file'] = 'wfs_spotlight.php';
$modversion['blocks'][9]['name'] = _MI_WFS_BNAME8;
$modversion['blocks'][9]['description'] = 'Article Spotlight';
$modversion['blocks'][9]['show_func'] = 'b_wfsection_spotlight';
$modversion['blocks'][9]['template'] = $wfsTemplates['spotlightblock'];
/**
 * $modversion['blocks'][10]['file'] = "wfs_homecenter.php";
 * $modversion['blocks'][10]['name'] = _MI_WFS_BNAME9;
 * $modversion['blocks'][10]['description'] = "Shows Center block info for homepage";
 * $modversion['blocks'][10]['show_func'] = "b_wfs_homecenter_show";
 * $modversion['blocks'][10]['edit_func'] = "b_wfs_homecenter_edit";
 * $modversion['blocks'][10]['options'] = "published|10|25";
 * $modversion['blocks'][10]['template'] = 'wfs_block_homecenter.html';
 */
// Menu
$modversion['hasMain'] = 1;

$sql = $xoopsDB->query('SELECT * FROM ' . $xoopsDB->prefix(WFS_MAINMENU_DB));
$i = 1;
while (list($mm_id, $ca_id, $title, $type, $groupid) = $xoopsDB->fetchRow($sql)) {
    if (isset($xoopsModuleConfig['shortcatmenu'])) {
        if (!XOOPS_USE_MULTIBYTES) {
            if (mb_strlen($title) >= (int)$xoopsModuleConfig['shortcatlenmenu'] + 1) {
                $title = mb_substr($title, 0, (int)$xoopsModuleConfig['shortcatlenmenu']) . '...';
            }
        }
    }

    if (checkAccess($groupid)) {
        if (1 == $type) {
            $modversion['sub'][$i]['name'] = $title;

            $modversion['sub'][$i]['url'] = 'article.php?articleid=' . $ca_id . '';
        } else {
            $num = WfsArticle::countByCategory($ca_id);

            if ($num > 0) {
                $modversion['sub'][$i]['name'] = $title;

                $modversion['sub'][$i]['url'] = 'viewarticles.php?category=' . $ca_id . '';
            }
        }

        $i++;
    }
}

if (is_object($xoopsUser) && isset($xoopsModuleConfig['submitarts'])) {
    if (is_object($xoopsWFModule) && $xoopsWFModule->getVar('isactive')) {
        $groups = $xoopsUser->getGroups();

        if (array_intersect($xoopsModuleConfig['submitarts'], $groups)) {
            $modversion['sub'][$i + 1]['name'] = _MI_WFS_SUBMIT;

            $modversion['sub'][$i + 1]['url'] = 'submit.php';
        }
    }
} else {
    if (is_object($xoopsWFModule) && $xoopsWFModule->getVar('isactive')) {
        if (isset($xoopsModuleConfig['anonpost']) && 1 == $xoopsModuleConfig['anonpost']) {
            $modversion['sub'][$i + 1]['name'] = _MI_WFS_SUBMIT;

            $modversion['sub'][$i + 1]['url'] = 'submit.php';
        }
    }
}

$modversion['sub'][$i + 2]['name'] = _MI_WFS_POPULAR;
$modversion['sub'][$i + 2]['url'] = 'topten.php?counter=1';
$modversion['sub'][$i + 3]['name'] = _MI_WFS_RATEFILE;
$modversion['sub'][$i + 3]['url'] = 'topten.php?rate=1';
$modversion['sub'][$i + 4]['name'] = _MI_WFS_ARCHIVE;
$modversion['sub'][$i + 4]['url'] = 'archive.php';
// Search
$modversion['hasSearch'] = 1;
$modversion['search']['file'] = 'include/search.inc.php';
$modversion['search']['func'] = 'wfsection_search';
// Comments
$modversion['hasComments'] = 1;
$modversion['comments']['pageName'] = 'article.php';
$modversion['comments']['itemName'] = 'articleid';
// Comment callback functions
$modversion['comments']['callbackFile'] = 'include/comment_functions.php';
$modversion['comments']['callback']['approve'] = 'wfsection_com_approve';
$modversion['comments']['callback']['update'] = 'wfsection_com_update';

/**
 * Templates
 */
$templatedir = WFS_TEMPLATE_PATH;
$files = [];
$dir = opendir($templatedir);
while (false !== ($file = readdir($dir))) {
    if ((!preg_match('/^[.]{1,2}$/', $file) && false !== strpos($file, "html"))) {
        if ('cvs' != mb_strtolower($file) && !is_dir($file)) {
            $files[] = $file;
        }
    }
}
sort($files);
closedir($dir);

for ($i = 0, $iMax = count($files); $i < $iMax; $i++) {
    $modversion['templates'][$i]['file'] = $files[$i];

    $modversion['templates'][$i]['description'] = '';
}

$modversion['config'][1]['name'] = 'showauthor';
$modversion['config'][1]['title'] = '_MI_WFS_SHOWAUTHOR';
$modversion['config'][1]['description'] = '_MI_WFS_SHOWAUTHORDSC';
$modversion['config'][1]['formtype'] = 'yesno';
$modversion['config'][1]['valuetype'] = 'int';
$modversion['config'][1]['default'] = 1;

$modversion['config'][2]['name'] = 'realname';
$modversion['config'][2]['title'] = '_MI_WFS_SHOWREALNAME';
$modversion['config'][2]['description'] = '_MI_WFS_SHOWREALNAMEDSC';
$modversion['config'][2]['formtype'] = 'yesno';
$modversion['config'][2]['valuetype'] = 'int';
$modversion['config'][2]['default'] = 0;

$modversion['config'][3]['name'] = 'atavar';
$modversion['config'][3]['title'] = '_MI_WFS_SHOWATAV';
$modversion['config'][3]['description'] = '_MI_WFS_SHOWATAVDSC';
$modversion['config'][3]['formtype'] = 'yesno';
$modversion['config'][3]['valuetype'] = 'int';
$modversion['config'][3]['default'] = 1;

$modversion['config'][4]['name'] = 'useremail';
$modversion['config'][4]['title'] = '_MI_WFS_USEREMAIL';
$modversion['config'][4]['description'] = '_MI_WFS_USEREMAILDSC';
$modversion['config'][4]['formtype'] = 'yesno';
$modversion['config'][4]['valuetype'] = 'int';
$modversion['config'][4]['default'] = 0;

$modversion['config'][5]['name'] = 'emailprotect';
$modversion['config'][5]['title'] = '_MI_WFS_EMAILPROTECT';
$modversion['config'][5]['description'] = '_MI_WFS_EMAILPROTECTDSC';
$modversion['config'][5]['formtype'] = 'yesno';
$modversion['config'][5]['valuetype'] = 'int';
$modversion['config'][5]['default'] = 0;

$modversion['config'][6]['name'] = 'showhits';
$modversion['config'][6]['title'] = '_MI_WFS_SHOWHITS';
$modversion['config'][6]['description'] = '_MI_WFS_SHOWHITSDSC';
$modversion['config'][6]['formtype'] = 'yesno';
$modversion['config'][6]['valuetype'] = 'int';
$modversion['config'][6]['default'] = 1;

$modversion['config'][7]['name'] = 'showcomments';
$modversion['config'][7]['title'] = '_MI_WFS_SHOWCOMMENTS';
$modversion['config'][7]['description'] = '_MI_WFS_SHOWCOMMENTSDSC';
$modversion['config'][7]['formtype'] = 'yesno';
$modversion['config'][7]['valuetype'] = 'int';
$modversion['config'][7]['default'] = 1;

$modversion['config'][8]['name'] = 'showfile';
$modversion['config'][8]['title'] = '_MI_WFS_SHOWFILES';
$modversion['config'][8]['description'] = '_MI_WFS_SHOWFILESDSC';
$modversion['config'][8]['formtype'] = 'yesno';
$modversion['config'][8]['valuetype'] = 'int';
$modversion['config'][8]['default'] = 1;

$modversion['config'][9]['name'] = 'showrated';
$modversion['config'][9]['title'] = '_MI_WFS_SHOWRATED';
$modversion['config'][9]['description'] = '_MI_WFS_SHOWRATEDDSC';
$modversion['config'][9]['formtype'] = 'yesno';
$modversion['config'][9]['valuetype'] = 'int';
$modversion['config'][9]['default'] = 1;

$modversion['config'][10]['name'] = 'showvotes';
$modversion['config'][10]['title'] = '_MI_WFS_SHOWVOTES';
$modversion['config'][10]['description'] = '_MI_WFS_SHOWVOTESDSC';
$modversion['config'][10]['formtype'] = 'yesno';
$modversion['config'][10]['valuetype'] = 'int';
$modversion['config'][10]['default'] = 0;

$modversion['config'][11]['name'] = 'showupdated';
$modversion['config'][11]['title'] = '_MI_WFS_SHOWPUBLISHED';
$modversion['config'][11]['description'] = '_MI_WFS_SHOWPUBLISHEDDSC';
$modversion['config'][11]['formtype'] = 'yesno';
$modversion['config'][11]['valuetype'] = 'int';
$modversion['config'][11]['default'] = 0;

$modversion['config'][12]['name'] = 'showicons';
$modversion['config'][12]['title'] = '_MI_WFS_SHOWICONS';
$modversion['config'][12]['description'] = '_MI_WFS_SHOWICONSDSC';
$modversion['config'][12]['formtype'] = 'yesno';
$modversion['config'][12]['valuetype'] = 'int';
$modversion['config'][12]['default'] = 0;

$modversion['config'][13]['name'] = 'showiconstext';
$modversion['config'][13]['title'] = '_MI_WFS_SHOWTEXTICONS';
$modversion['config'][13]['description'] = '_MI_WFS_SHOWTEXTICONSDSC';
$modversion['config'][13]['formtype'] = 'yesno';
$modversion['config'][13]['valuetype'] = 'int';
$modversion['config'][13]['default'] = 0;

$modversion['config'][14]['name'] = 'daysnew';
$modversion['config'][14]['title'] = '_MI_WFS_DAYSNEW';
$modversion['config'][14]['description'] = '_MI_WFS_DAYSNEWDSC';
$modversion['config'][14]['formtype'] = 'textbox';
$modversion['config'][14]['valuetype'] = 'int';
$modversion['config'][14]['default'] = 10;

$modversion['config'][15]['name'] = 'daysupdated';
$modversion['config'][15]['title'] = '_MI_WFS_DAYSUPDATED';
$modversion['config'][15]['description'] = '_MI_WFS_DAYSUPDATEDDSC';
$modversion['config'][15]['formtype'] = 'textbox';
$modversion['config'][15]['valuetype'] = 'int';
$modversion['config'][15]['default'] = 10;

$modversion['config'][16]['name'] = 'popularamount';
$modversion['config'][16]['title'] = '_MI_WFS_POPULARS';
$modversion['config'][16]['description'] = '_MI_WFS_POPULARSDSC';
$modversion['config'][16]['formtype'] = 'textbox';
$modversion['config'][16]['valuetype'] = 'int';
$modversion['config'][16]['default'] = 50;

$modversion['config'][17]['name'] = 'showcatpic';
$modversion['config'][17]['title'] = '_MI_WFS_SHOWCATPIC';
$modversion['config'][17]['description'] = '_MI_WFS_SHOWCATPICDSC';
$modversion['config'][17]['formtype'] = 'yesno';
$modversion['config'][17]['valuetype'] = 'int';
$modversion['config'][17]['default'] = 0;

$modversion['config'][18]['name'] = 'showartlistings';
$modversion['config'][18]['title'] = '_MI_WFS_SHOWARTLISTINGS';
$modversion['config'][18]['description'] = '_MI_WFS_SHOWARTLISTINGSDSC';
$modversion['config'][18]['formtype'] = 'yesno';
$modversion['config'][18]['valuetype'] = 'int';
$modversion['config'][18]['default'] = 1;

$modversion['config'][19]['name'] = 'showartlistamount';
$modversion['config'][19]['title'] = '_MI_WFS_SHOWARTLISTAMOUNT';
$modversion['config'][19]['description'] = '_MI_WFS_SHOWARTLISTAMOUNTDSC';
$modversion['config'][19]['formtype'] = 'select';
$modversion['config'][19]['valuetype'] = 'int';
$modversion['config'][19]['default'] = 5;
$modversion['config'][19]['options'] = ['1' => 1, '2' => 2, '3' => 3, '4' => 4, '5' => 5, '6' => 6, '7' => 7];

$modversion['config'][20]['name'] = 'articlesapage';
$modversion['config'][20]['title'] = '_MI_WFS_ARTICLESAPAGE';
$modversion['config'][20]['description'] = '_MI_WFS_ARTICLESAPAGEDSC';
$modversion['config'][20]['formtype'] = 'select';
$modversion['config'][20]['valuetype'] = 'int';
$modversion['config'][20]['default'] = 10;
$modversion['config'][20]['options'] = ['5' => 5, '10' => 10, '15' => 15, '20' => 20, '25' => 25, '30' => 30, '50' => 50];

$modversion['config'][21]['name'] = 'orderbox';
$modversion['config'][21]['title'] = '_MI_WFS_SHOWORDERBOX';
$modversion['config'][21]['description'] = '_MI_WFS_SHOWORDERBOXDSC';
$modversion['config'][21]['formtype'] = 'yesno';
$modversion['config'][21]['valuetype'] = 'int';
$modversion['config'][21]['default'] = 0;

$modversion['config'][22]['name'] = 'aidxpathtype';
$modversion['config'][22]['title'] = '_MI_WFS_PATHTYPE';
$modversion['config'][22]['description'] = '_MI_WFS_PERPAGEDSC';
$modversion['config'][22]['formtype'] = 'select';
$modversion['config'][22]['valuetype'] = 'int';
$modversion['config'][22]['default'] = 0;
$modversion['config'][22]['options'] = [
_MI_WFS_SELECTBOX => 0,
    _MI_WFS_SELECTSUBS => 1,
    _MI_WFS_LINKEDPATH => 2,
    _MI_WFS_LINKSANDSELECT => 3,
    _MI_WFS_NONE => 4,
];

$qa = ' (A)';
$qd = ' (D)';
$modversion['config'][23]['name'] = 'aidxorder';
$modversion['config'][23]['title'] = '_MI_WFS_ARTICLESSORT';
$modversion['config'][23]['description'] = '_MI_WFS_ARTICLESSORTDSC';
$modversion['config'][23]['formtype'] = 'select';
$modversion['config'][23]['valuetype'] = 'text';
$modversion['config'][23]['default'] = 'title ASC';
$modversion['config'][23]['options'] = [
_MI_WFS_TITLE . $qa => 'title ASC',
    _MI_WFS_TITLE . $qd => 'title DESC',
    _MI_WFS_SUBMITTED2 . $qa => 'created ASC',
    _MI_WFS_SUBMITTED2 . $qd => 'created DESC',
    _MI_WFS_RATING . $qa => 'rating ASC',
    _MI_WFS_RATING . $qd => 'rating DESC',
    _MI_WFS_POPULARITY . $qa => 'hits ASC',
    _MI_WFS_POPULARITY . $qd => 'hits DESC',
    _MI_WFS_WEIGHT => 'weight',
];

$modversion['config'][24]['name'] = 'submenus';
$modversion['config'][24]['title'] = '_MI_WFS_SHOWSUBMENU';
$modversion['config'][24]['description'] = '_MI_WFS_SHOWSUBMENUDSC';
$modversion['config'][24]['formtype'] = 'yesno';
$modversion['config'][24]['valuetype'] = 'int';
$modversion['config'][24]['default'] = 0;

$modversion['config'][64]['name'] = 'shortcatmenu';
$modversion['config'][64]['title'] = '_MI_WFS_SHORTMENTITLE';
$modversion['config'][64]['description'] = '_MI_WFS_SHORTMENTITLEDSC';
$modversion['config'][64]['formtype'] = 'yesno';
$modversion['config'][64]['valuetype'] = 'int';
$modversion['config'][64]['default'] = 0;

$modversion['config'][65]['name'] = 'shortcatlenmenu';
$modversion['config'][65]['title'] = '_MI_WFS_SHORTMENLEN';
$modversion['config'][65]['description'] = '_MI_WFS_SHORTMENLENDSC';
$modversion['config'][65]['formtype'] = 'textbox';
$modversion['config'][65]['valuetype'] = 'int';
$modversion['config'][65]['default'] = 19;

$modversion['config'][25]['name'] = 'shortcat';
$modversion['config'][25]['title'] = '_MI_WFS_SHORTCATTITLE';
$modversion['config'][25]['description'] = '_MI_WFS_SHORTCATTITLEDSC';
$modversion['config'][25]['formtype'] = 'yesno';
$modversion['config'][25]['valuetype'] = 'int';
$modversion['config'][25]['default'] = 0;

$modversion['config'][26]['name'] = 'shortcatlen';
$modversion['config'][26]['title'] = '_MI_WFS_SHORTCATLEN';
$modversion['config'][26]['description'] = '_MI_WFS_SHORTCATLENDSC';
$modversion['config'][26]['formtype'] = 'textbox';
$modversion['config'][26]['valuetype'] = 'int';
$modversion['config'][26]['default'] = 19;

$modversion['config'][27]['name'] = 'shortart';
$modversion['config'][27]['title'] = '_MI_WFS_SHORTARTTITLE';
$modversion['config'][27]['description'] = '_MI_WFS_SHORTARTTITLEDSC';
$modversion['config'][27]['formtype'] = 'yesno';
$modversion['config'][27]['valuetype'] = 'int';
$modversion['config'][27]['default'] = 0;

$modversion['config'][28]['name'] = 'shortartlen';
$modversion['config'][28]['title'] = '_MI_WFS_SHORTARTLEN';
$modversion['config'][28]['description'] = '_MI_WFS_SHORTARTLENDSC';
$modversion['config'][28]['formtype'] = 'textbox';
$modversion['config'][28]['valuetype'] = 'int';
$modversion['config'][28]['default'] = 19;

$modversion['config'][29]['name'] = 'autoweight';
$modversion['config'][29]['title'] = '_MI_WFS_AUTOWEIGHT';
$modversion['config'][29]['description'] = '_MI_WFS_AUTOWEIGHTDSC';
$modversion['config'][29]['formtype'] = 'yesno';
$modversion['config'][29]['valuetype'] = 'int';
$modversion['config'][29]['default'] = 0;

$modversion['config'][30]['name'] = 'timestamp';
$modversion['config'][30]['title'] = '_MI_WFS_DEFAULTTIME';
$modversion['config'][30]['description'] = '_MI_WFS_DEFAULTTIMEDSC';
$modversion['config'][30]['formtype'] = 'textbox';
$modversion['config'][30]['valuetype'] = 'text';
$modversion['config'][30]['default'] = 'D, d-M-Y';

$modversion['config'][31]['name'] = 'novote';
$modversion['config'][31]['title'] = '_MI_WFS_SHOWVOTESINART';
$modversion['config'][31]['description'] = '_MI_WFS_SHOWVOTESINARTDSC';
$modversion['config'][31]['formtype'] = 'yesno';
$modversion['config'][31]['valuetype'] = 'int';
$modversion['config'][31]['default'] = 0;

$modversion['config'][32]['name'] = 'adminmimecheck';
$modversion['config'][32]['title'] = '_MI_WFS_ADMINMIMECHECK';
$modversion['config'][32]['description'] = '_MI_WFS_ADMINMIMECHECKDSC';
$modversion['config'][32]['formtype'] = 'yesno';
$modversion['config'][32]['valuetype'] = 'int';
$modversion['config'][32]['default'] = 1;

$modversion['config'][33]['name'] = 'selmimetype';
$modversion['config'][33]['title'] = '_MI_WFS_ALLOWEDMIMETYPES';
$modversion['config'][33]['description'] = '_MI_WFS_ALLOWEDMIMETYPESDSC';
$modversion['config'][33]['formtype'] = 'select_multi';
$modversion['config'][33]['valuetype'] = 'array';
$modversion['config'][33]['default'] = ['application/x-zip-compressed'];
$modversion['config'][33]['options'] = $mimetypes;

$modversion['config'][37]['name'] = 'file_prefix';
$modversion['config'][37]['title'] = '_MI_WFS_FILEPREFIX';
$modversion['config'][37]['description'] = '_MI_WFS_FILEPREFIXDSC';
$modversion['config'][37]['formtype'] = 'textbox';
$modversion['config'][37]['valuetype'] = 'text';
$modversion['config'][37]['default'] = '';

$modversion['config'][38]['name'] = 'maxfilesize';
$modversion['config'][38]['title'] = '_MI_WFS_UPLOADFILESIZE';
$modversion['config'][38]['description'] = '_MI_WFS_UPLOADFILESIZEDSC';
$modversion['config'][38]['formtype'] = 'textbox';
$modversion['config'][38]['valuetype'] = 'int';
$modversion['config'][38]['default'] = 2097152;

$modversion['config'][39]['name'] = 'nomaxfilesize';
$modversion['config'][39]['title'] = '_MI_WFS_NOUPLOADFILESIZE';
$modversion['config'][39]['description'] = '_MI_WFS_NOUPLOADFILESIZEDSC';
$modversion['config'][39]['formtype'] = 'yesno';
$modversion['config'][39]['valuetype'] = 'int';
$modversion['config'][39]['default'] = 0;

$modversion['config'][40]['name'] = 'wfsmode';
$modversion['config'][40]['title'] = '_MI_WFS_FILEMODE';
$modversion['config'][40]['description'] = '_MI_WFS_FILEMODEDSC';
$modversion['config'][40]['formtype'] = 'textbox';
$modversion['config'][40]['valuetype'] = 'int';
$modversion['config'][40]['default'] = 644;

$modversion['config'][41]['name'] = 'imgheight';
$modversion['config'][41]['title'] = '_MI_WFS_IMGHEIGHT';
$modversion['config'][41]['description'] = '_MI_WFS_IMGHEIGHTDSC';
$modversion['config'][41]['formtype'] = 'textbox';
$modversion['config'][41]['valuetype'] = 'int';
$modversion['config'][41]['default'] = 400;

$modversion['config'][42]['name'] = 'imgwidth';
$modversion['config'][42]['title'] = '_MI_WFS_IMGWIDTH';
$modversion['config'][42]['description'] = '_MI_WFS_IMGWIDTHDSC';
$modversion['config'][42]['formtype'] = 'textbox';
$modversion['config'][42]['valuetype'] = 'int';
$modversion['config'][42]['default'] = 400;

$modversion['config'][61]['name'] = 'noimgsizecheck';
$modversion['config'][61]['title'] = '_MI_WFS_NOUPIMGSIZE';
$modversion['config'][61]['description'] = '_MI_WFS_NOUPIMGSIZEDSC';
$modversion['config'][61]['formtype'] = 'yesno';
$modversion['config'][61]['valuetype'] = 'int';
$modversion['config'][61]['default'] = 0;

$modversion['config'][43]['name'] = 'stripspaces';
$modversion['config'][43]['title'] = '_MI_WFS_STRIPSPACES';
$modversion['config'][43]['description'] = '_MI_WFS_STRIPSPACESDSC';
$modversion['config'][43]['formtype'] = 'yesno';
$modversion['config'][43]['valuetype'] = 'int';
$modversion['config'][43]['default'] = 1;

$modversion['config'][44]['name'] = 'addext';
$modversion['config'][44]['title'] = '_MI_WFS_ADDEXT';
$modversion['config'][44]['description'] = '_MI_WFS_ADDEXTDSC';
$modversion['config'][44]['formtype'] = 'yesno';
$modversion['config'][44]['valuetype'] = 'int';
$modversion['config'][44]['default'] = 1;

$modversion['config'][45]['name'] = 'bannedchars';
$modversion['config'][45]['title'] = '_MI_WFS_BANNEDCHARS';
$modversion['config'][45]['description'] = '_MI_WFS_BANNEDCHARSDSC';
$modversion['config'][45]['formtype'] = 'select';
$modversion['config'][45]['valuetype'] = 'int';
$modversion['config'][45]['default'] = 1;
$modversion['config'][45]['options'] = [_MI_WFS_STRICT => 1, _MI_WFS_MEDIUM => 2, _MI_WFS_LIGHT => 3];

$modversion['config'][46]['name'] = 'stripchars';
$modversion['config'][46]['title'] = '_MI_WFS_STRIPCHARS';
$modversion['config'][46]['description'] = '';
$modversion['config'][46]['formtype'] = 'textbox';
$modversion['config'][46]['valuetype'] = 'text';
$modversion['config'][46]['default'] = '_';

$modversion['config'][47]['name'] = 'submitarts';
$modversion['config'][47]['title'] = '_MI_WFS_SUBMITART';
$modversion['config'][47]['description'] = '_MI_WFS_SUBMITARTDSC';
$modversion['config'][47]['formtype'] = 'group_multi';
$modversion['config'][47]['valuetype'] = 'array';
$modversion['config'][47]['default'] = '1 2 3';

$modversion['config'][48]['name'] = 'anonpost';
$modversion['config'][48]['title'] = '_MI_WFS_ANONPOST';
$modversion['config'][48]['description'] = '_MI_WFS_ANONPOSTDSC';
$modversion['config'][48]['formtype'] = 'yesno';
$modversion['config'][48]['valuetype'] = 'int';
$modversion['config'][48]['default'] = 0;

$modversion['config'][49]['name'] = 'submitfiles';
$modversion['config'][49]['title'] = '_MI_WFS_SUBMITFILES';
$modversion['config'][49]['description'] = '_MI_WFS_SUBMITFILESDSC';
$modversion['config'][49]['formtype'] = 'group_multi';
$modversion['config'][49]['valuetype'] = 'array';
$modversion['config'][49]['default'] = '1 2 3';

$modversion['config'][50]['name'] = 'submitfilesmimetype';
$modversion['config'][50]['title'] = '_MI_WFS_ALLOWEDUSERMIME';
$modversion['config'][50]['description'] = '_MI_WFS_ALLOWEDUSERMIMEDSC';
$modversion['config'][50]['formtype'] = 'select_multi';
$modversion['config'][50]['valuetype'] = 'array';
$modversion['config'][50]['default'] = ['application/x-zip-compressed'];
$modversion['config'][50]['options'] = $mimetypes;

$modversion['config'][51]['name'] = 'notifysubmit';
$modversion['config'][51]['title'] = '_MI_WFS_NOTIFYSUBMIT';
$modversion['config'][51]['description'] = '_MI_WFS_NOTIFYSUBMITDSC';
$modversion['config'][51]['formtype'] = 'yesno';
$modversion['config'][51]['valuetype'] = 'int';
$modversion['config'][51]['default'] = 0;

$modversion['config'][52]['name'] = 'autoapprove';
$modversion['config'][52]['title'] = '_MI_WFS_AUTOAPPROVE';
$modversion['config'][52]['description'] = '_MI_WFS_AUTOAPPROVEDSC';
$modversion['config'][52]['formtype'] = 'yesno';
$modversion['config'][52]['valuetype'] = 'int';
$modversion['config'][52]['default'] = 0;

$modversion['config'][53]['name'] = 'wysiwygeditor';
$modversion['config'][53]['title'] = '_MI_WFS_WYSIWYG';
$modversion['config'][53]['description'] = '_MI_WFS_WYSIWYGDSC';
$modversion['config'][53]['formtype'] = 'yesno';
$modversion['config'][53]['valuetype'] = 'int';
$modversion['config'][53]['default'] = 0;

$modversion['config'][60]['name'] = 'userwysiwygeditor';
$modversion['config'][60]['title'] = '_MI_WFS_USERWYSIWYG';
$modversion['config'][60]['description'] = '_MI_WFS_USERWYSIWYGDSC';
$modversion['config'][60]['formtype'] = 'yesno';
$modversion['config'][60]['valuetype'] = 'int';
$modversion['config'][60]['default'] = 0;

$modversion['config'][66]['name'] = 'groupswysiwygeditor';
$modversion['config'][66]['title'] = '_MI_WFS_GROUPUSERWYSIWYG';
$modversion['config'][66]['description'] = '_MI_WFS_SUBMITARTDSC';
$modversion['config'][66]['formtype'] = 'group_multi';
$modversion['config'][66]['valuetype'] = 'array';
$modversion['config'][66]['default'] = '1 2 3';

$modversion['config'][54]['name'] = 'htmltextarea';
$modversion['config'][54]['title'] = '_MI_WFS_USEHTMLAREA';
$modversion['config'][54]['description'] = '_MI_WFS_USEHTMLAREADSC';
$modversion['config'][54]['formtype'] = 'yesno';
$modversion['config'][54]['valuetype'] = 'int';
$modversion['config'][54]['default'] = 0;

$modversion['config'][56]['name'] = 'copyright';
$modversion['config'][56]['title'] = '_MI_WFS_ADDCOPYRIGHT';
$modversion['config'][56]['description'] = '_MI_WFS_ADDCOPYRIGHTDSC';
$modversion['config'][56]['formtype'] = 'yesno';
$modversion['config'][56]['valuetype'] = 'int';
$modversion['config'][56]['default'] = 0;

$modversion['config'][57]['name'] = 'textamount';
$modversion['config'][57]['title'] = '_MI_WFS_MAXTEXTAMOUNT';
$modversion['config'][57]['description'] = '';
$modversion['config'][57]['formtype'] = 'textbox';
$modversion['config'][57]['valuetype'] = 'int';
$modversion['config'][57]['default'] = 200;

$modversion['config'][58]['name'] = 'wiki';
$modversion['config'][58]['title'] = '_MI_WFS_WIKI';
$modversion['config'][58]['description'] = '_MI_WFS_WIKIDSC';
$modversion['config'][58]['formtype'] = 'yesno';
$modversion['config'][58]['valuetype'] = 'int';
$modversion['config'][58]['default'] = 1;

$modversion['config'][59]['name'] = 'phpcoding';
$modversion['config'][59]['title'] = '_MI_WFS_PHPCODING';
$modversion['config'][59]['description'] = '_MI_WFS_PHPCODINGDSC';
$modversion['config'][59]['formtype'] = 'yesno';
$modversion['config'][59]['valuetype'] = 'int';
$modversion['config'][59]['default'] = 1;

$modversion['config'][62]['name'] = 'version_inc';
$modversion['config'][62]['title'] = '_MI_WFS_VERSIONINC';
$modversion['config'][62]['description'] = '';
$modversion['config'][62]['formtype'] = 'textbox';
$modversion['config'][62]['valuetype'] = 'text';
$modversion['config'][62]['default'] = 0.01;

$modversion['config'][70]['name'] = 'use_thumbs';
$modversion['config'][70]['title'] = '_MI_WFS_USETHUMBS';
$modversion['config'][70]['description'] = '_MI_WFS_USETHUMBSDSC';
$modversion['config'][70]['formtype'] = 'yesno';
$modversion['config'][70]['valuetype'] = 'int';
$modversion['config'][70]['default'] = 1;

$modversion['config'][69]['name'] = 'updatethumbs';
$modversion['config'][69]['title'] = '_MI_WFS_IMGUPDATE';
$modversion['config'][69]['description'] = '_MI_WFS_IMGUPDATEDSC';
$modversion['config'][69]['formtype'] = 'yesno';
$modversion['config'][69]['valuetype'] = 'int';
$modversion['config'][69]['default'] = 1;

$modversion['config'][67]['name'] = 'imagequality';
$modversion['config'][67]['title'] = '_MI_WFS_QUALITY';
$modversion['config'][67]['description'] = '_MI_WFS_QUALITYDSC';
$modversion['config'][67]['formtype'] = 'textbox';
$modversion['config'][67]['valuetype'] = 'int';
$modversion['config'][67]['default'] = 100;

$modversion['config'][73]['name'] = 'keepaspect';
$modversion['config'][73]['title'] = '_MI_WFS_KEEPASPECT';
$modversion['config'][73]['description'] = '_MI_WFS_KEEPASPECTDSC';
$modversion['config'][73]['formtype'] = 'yesno';
$modversion['config'][73]['valuetype'] = 'int';
$modversion['config'][73]['default'] = 0;

$modversion['config'][71]['name'] = 'default_image';
$modversion['config'][71]['title'] = '_MI_WFS_DEF_IMAGE';
$modversion['config'][71]['description'] = '_MI_WFS_DEF_IMAGEDSC';
$modversion['config'][71]['formtype'] = 'textbox';
$modversion['config'][71]['valuetype'] = 'text';
$modversion['config'][71]['default'] = 'article.jpg';

$modversion['config'][72]['name'] = 'display_default_image';
$modversion['config'][72]['title'] = '_MI_WFS_DIS_DEF_IMAGE';
$modversion['config'][72]['description'] = '_MI_WFS_DIS_DEF_IMAGEDSC';
$modversion['config'][72]['formtype'] = 'yesno';
$modversion['config'][72]['valuetype'] = 'int';
$modversion['config'][72]['default'] = 1;

$modversion['config'][74]['name'] = 'display_default_image_art';
$modversion['config'][74]['title'] = '_MI_WFS_DIS_DEF_IMAGEART';
$modversion['config'][74]['description'] = '_MI_WFS_DIS_DEF_IMAGEARTDSC';
$modversion['config'][74]['formtype'] = 'yesno';
$modversion['config'][74]['valuetype'] = 'int';
$modversion['config'][74]['default'] = 0;

$modversion['config'][34]['name'] = 'iseditable';
$modversion['config'][34]['title'] = '_MI_WFS_ISEDITABLEFILE';
$modversion['config'][34]['description'] = '_MI_WFS_ISEDITABLEFILEDSC';
$modversion['config'][34]['formtype'] = 'select_multi';
$modversion['config'][34]['valuetype'] = 'array';
$modversion['config'][34]['options'] = $mimetypes;

$modversion['config'][35]['name'] = 'isviewable';
$modversion['config'][35]['title'] = '_MI_WFS_ISVIEWABLE';
$modversion['config'][35]['description'] = '_MI_WFS_ISVIEWABLEDSC';
$modversion['config'][35]['formtype'] = 'select_multi';
$modversion['config'][35]['valuetype'] = 'array';
$modversion['config'][35]['options'] = $mimetypes;

$modversion['config'][36]['name'] = 'filetypes';
$modversion['config'][36]['title'] = '_MI_WFS_NEWEDITANDVIEWEXT';
$modversion['config'][36]['description'] = '_MI_WFS_NEWEDITANDVIEWEXTDSC';
$modversion['config'][36]['formtype'] = 'textarea';
$modversion['config'][36]['valuetype'] = 'array';
$modversion['config'][36]['default'] = '';
// Article amount to be shown in WF-Section Admin
$modversion['config'][55]['name'] = 'lastart';
$modversion['config'][55]['title'] = '_MI_WFS_LASTART';
$modversion['config'][55]['description'] = '_MI_WFS_LASTARTDSC';
$modversion['config'][55]['formtype'] = 'select';
$modversion['config'][55]['valuetype'] = 'int';
$modversion['config'][55]['default'] = 10;
$modversion['config'][55]['options'] = ['5' => 5, '10' => 10, '15' => 15, '20' => 20, '25' => 25, '30' => 30, '50' => 50];

$modversion['config'][68]['name'] = 'use_restore';
$modversion['config'][68]['title'] = '_MI_WFS_USERESTORE';
$modversion['config'][68]['description'] = '_MI_WFS_USERESTOREDSC';
$modversion['config'][68]['formtype'] = 'yesno';
$modversion['config'][68]['valuetype'] = 'int';
$modversion['config'][68]['default'] = 0;
