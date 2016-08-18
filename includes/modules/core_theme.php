<?php

/** Mandatory Code **/

##############################
# Load language translations #
##############################

if(!xml2php('core_theme')) {    
    $smarty->assign('error_msg', 'Error in core language file');
}

/** Misc **/

#########################################
#  Greeting Message Based on Time       #
#########################################

function greeting_message_based_on_time($employee_name){    
    
    $morning    = "Good morning! $employee_name";
    $afternoon  = "Good afternoon! $employee_name";
    $evening    = "Good evening! $employee_name";
    $night      = "Working late? $employee_name";
    
    $friday     = "Get ready for the weekend!";

    // Get the current hour
    $current_time = date('H');
    
    // Get the current day
    $current_day = date('l');
    
    // 06:00 - 11:59
    if ($current_time >= 6 && $current_time <=11) {
        $greeting_msg = $morning;
    }
    // 12:00 - 17:59
    elseif ($current_time >= 12 && $current_time <= 17) {
        $greeting_msg =  $afternoon;
    }
    // 18:00. - 23:59 p.m.
    elseif ($current_time >= 17 && $current_time <= 23) {
        $greeting_msg =  $evening;
    }
    // 00:00 - 05:59
    elseif ($current_time >= 0 && $current_time <= 5) {
        $greeting_msg = $night;
    }    
    
    // Friday
    if ($current_day === 'Friday'){
        $greeting_msg = $greeting_msg.' - '.$friday;
    }
    return $greeting_msg;
}

/* 
 * These are copied from includes/core.php but with menu added on the front of the name
 * These are only used to show numbers in the menu and could be removed
 * 
 */

/** Word Orders **/ 

##########################################
# Display single Work Order information  #
##########################################

function menu_display_single_workorder_record($db, $wo_id){
    
    $q = "SELECT * FROM ".PRFX."TABLE_WORK_ORDER WHERE WORK_ORDER_ID =".$db->qstr($wo_id);
    
    $rs = $db->Execute($q);
    return $rs->FetchRow();
}

#########################################
# Count Work Orders for a given status  #
#########################################

function menu_count_workorders_with_status($db, $workorder_status){
    
    $q = "SELECT COUNT(*) AS WORKORDER_STATUS_COUNT
            FROM ".PRFX."TABLE_WORK_ORDER
            WHERE WORK_ORDER_STATUS=".$db->qstr($workorder_status);
    
    $rs = $db->Execute($q);    
    return  $rs->fields['WORKORDER_STATUS_COUNT'];
}

/** Invoices **/

############################################
# Count Invoices with Status (paid/unpaid) #
############################################

function menu_count_invoices_with_status($db, $invoice_status){
    
    $q ="SELECT COUNT(*) AS INVOICE_COUNT FROM ".PRFX."TABLE_INVOICE WHERE INVOICE_PAID=".$db->qstr($invoice_status);
    
    $rs = $db->Execute($q);
    return $rs->fields['INVOICE_COUNT'];
}

#########################################
# Count Work Orders that are unassigned #
#########################################

// Open - Assigned
// This might not be 100% correct

function menu_count_unassigned_workorders($db){   
    return (menu_count_workorders_with_status($db, 10) - menu_count_workorders_with_status($db, 2));
}