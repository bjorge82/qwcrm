<?php
/**
 * @package   QWcrm
 * @author    Jon Brown https://quantumwarp.com/
 * @copyright Copyright (C) 2016 - 2017 Jon Brown, All rights reserved.
 * @license   GNU/GPLv3 or later; https://www.gnu.org/licenses/gpl.html
 */

defined('_QWEXEC') or die;

// when using SEF this command sets component and page_tpl
parseSEF($_SERVER['REQUEST_URI'], $VAR, true);
$page_controller = get_page_controller($db, $VAR, $QConfig, $user, $employee_id, $customer_id, $workorder_id, $invoice_id);

$BuildPage = get_page_content($db, $page_controller, $page_no, $VAR, $QConfig, $user);

############################
#  Build the page content  #
############################

function get_page_content($db, $page_controller, $page_no, $VAR = null, $QConfig = null, $user = null) {
    
    global $smarty;    
    
    // This varible holds the page as it is built
    $BuildPage = '';

    // If theme is set to Print mode then fetch the Page Content - Print system will output with its own format without need for headers and footers here
    if (isset($VAR['theme']) && $VAR['theme'] === 'print') {        
        require($page_controller);
        goto page_build_end;
    }
    
    // Set Page Header and Meta Data
    set_page_header_and_meta_data($VAR['component'], $VAR['page_tpl']);

    // Fetch Header Block
    if(!isset($VAR['theme']) || $VAR['theme'] != 'off') {     
        require(COMPONENTS_DIR.'core/blocks/theme_header_block.php');
    } else {
        //echo '<!DOCTYPE html><head></head><body>';
        require(COMPONENTS_DIR.'core/blocks/theme_header_theme_off_block.php');
    }

    // Fetch Header Legacy Template Code and Menu Block - Customers, Guests and Public users will not see the menu
    if((!isset($VAR['theme']) || $VAR['theme'] != 'off') && isset($user->login_token) && $user->login_usergroup_id != 7 && $user->login_usergroup_id != 8 && $user->login_usergroup_id != 9) {       
        $BuildPage .= $smarty->fetch('core/blocks/theme_header_legacy_supplement_block.tpl');

        // is the menu disabled
        if(!isset($VAR['theme']) || $VAR['theme'] != 'menu_off') {
            require(COMPONENTS_DIR.'core/blocks/theme_menu_block.php'); 
        }

    }    

    // Fetch the Page Content
    require($page_controller);    

    // Fetch Footer Legacy Template code Block (closes content table)
    if((!isset($VAR['theme']) || $VAR['theme'] != 'off') && isset($user->login_token) && $user->login_usergroup_id != 7 && $user->login_usergroup_id != 8 && $user->login_usergroup_id != 9) {
        $BuildPage .= $smarty->fetch('core/blocks/theme_footer_legacy_supplement_block.tpl');             
    }

    // Fetch the Footer Block
    if(!isset($VAR['theme']) || $VAR['theme'] != 'off'){        
        require(COMPONENTS_DIR.'core/blocks/theme_footer_block.php');        
    }    

    // Fetch the Debug Block
    if($QConfig->qwcrm_debug == true){
        require(COMPONENTS_DIR.'core/blocks/theme_debug_block.php');        
        $BuildPage .= "\r\n</body>\r\n</html>";
    } else {
        $BuildPage .= "\r\n</body>\r\n</html>";
    }

    page_build_end:
    
    // Process all of the pages links
    pages_links_to_sef($BuildPage);
        
    return $BuildPage;
    
}

######################################
#  Change all internal links to SEF  #
######################################

function pages_links_to_sef(&$BuildPage) {
    
    $BuildPage = preg_replace_callback('|href="(index\.php.*)"|U',
        function($matches) {
            
            return 'href="'.buildSEF($matches[1]).'"';

        }, $BuildPage);
    
    return $BuildPage;
    
}


####################################################################
#  Cycle through the built HTML and apss matches to link_parser()  #
####################################################################

function page_links_parser(&$BuildPage) {
    
    //preg_match_all('#<body[^>]*>(.*)</body>#siU', $phpInfo, $output);
    
    // send matched (full Matched link <a>...</a>) links to the parser - I should only do this when SEF is enabled?
    preg_replace_callback('|<a( href="(index\.php.*)")>.*<\/a>|', 'link_parser', $BuildPage);    
    
    return $BuildPage;
    
}

################################################################################
#  The is the wrapping function for the callback method from preg_match_all()  #
################################################################################

function link_parser($matches) {
    
    $url = $matches;
    
    $url = link_permission($url[0]);
    
    $sef_url = true;
    if($sef_url) { $url = buildSEF($url[2]); }  // change the link to SEF
    
    return $url;
    
}


#################################################################################
#  Does the user have permission to use/see the link - if not remove/modify it  #
#################################################################################

function link_permission($non_sef_url) {
    
    $db = QFactory::getDbo();
    $user = QFactory::getUser();
    
    // Move URL into an array
    $parsed_url = parse_url($non_sef_url);
    
    // Get URL Query Variables
    parse_str($parsed_url['query'], $parsed_url_query);
    
    // Check to see if user is allowed to use the asset
    if(check_acl($db, $user, $parsed_url_query['component'], $parsed_url_query['page_tpl'])) {
        
        
        // if permission denied - modify the link by removing the href="" as per HTML spec to disable the link
        $non_sef_url = preg_replace('|<a( href="index\.php.*")(.*)>(.*)<\/a>|u', "", $non_sef_url);
        
    }
    
    return $non_sef_url;
    
}