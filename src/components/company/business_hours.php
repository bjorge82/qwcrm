<?php
/**
 * @package   QWcrm
 * @author    Jon Brown https://quantumwarp.com/
 * @copyright Copyright (C) 2016 - 2017 Jon Brown, All rights reserved.
 * @license   GNU/GPLv3 or later; https://www.gnu.org/licenses/gpl.html
 */

defined('_QWEXEC') or die;

// If new times submitted
if(isset(\CMSApplication::$VAR['submit'])) {
    
    // Build the start and end times for comparison
    $opening_time = strtotime(\CMSApplication::$VAR['openingTime']['Time_Hour'].':'.\CMSApplication::$VAR['openingTime']['Time_Minute'].':'.'00');
    $closing_time = strtotime(\CMSApplication::$VAR['closingTime']['Time_Hour'].':'.\CMSApplication::$VAR['closingTime']['Time_Minute'].':'.'00');

    // Validate the submitted times
    if ($this->app->components->company->checkOpeningHoursValid($opening_time, $closing_time)) {
        
        // Update opening and closing Times into the database
        $this->app->components->company->updateOpeningHours(\CMSApplication::$VAR['openingTime'], \CMSApplication::$VAR['closingTime']);
        
    }
    
    // Assign varibles (for page load)
    $this->app->smarty->assign('opening_time', $opening_time   );
    $this->app->smarty->assign('closing_time', $closing_time   );

// If page is just loaded get the opening and closing times stored in the database
} else {    
    $this->app->smarty->assign('opening_time', $this->app->components->company->getOpeningHours('opening_time', 'smartytime'));
    $this->app->smarty->assign('closing_time', $this->app->components->company->getOpeningHours('closing_time', 'smartytime'));   
}