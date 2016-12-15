<?php

##########################################
#      Date Format Call                  #
##########################################

function date_format_call($db){

    $q = 'SELECT * FROM '.PRFX.'TABLE_COMPANY';
        if(!$rs = $db->execute($q)){
            force_page('core', 'error&error_msg=MySQL Error: '.$db->ErrorMsg().'&menu=1&type=database');
            exit;
        } else {
            return $rs->fields['COMPANY_DATE_FORMAT'];        
        }
}

##########################################
# Convert dates into Timestamp           #
# including UK to US date conversion     #
##########################################

function date_to_timestamp($db, $check_date){

    $date_format = date_format_call($db);

    // Change and clean UK date to US date format
    if ($date_format == "%d/%m/%Y" || $date_format == "%d/%m/%y"){

        // Removes all non valid seperators and replaces them with a / (slash)
        $newseparator = array('/', '/');
        $oldseparator = array('-', 'g');
        $cleaned_date = str_replace($oldseparator, $newseparator, $check_date);

        // Convert a UK date (DD/MM/YYYY) to a US date (MM/DD/YYYY) and vice versa
        $aDate = split ("/", $cleaned_date);
        $USdate = $aDate[1]."/".$aDate[0]."/".$aDate[2];

        // Converts date to string time
        return strtotime($USdate);
        
    // If already US format just run string to time    
    } else if ($date_format == "%m/%d/%Y" || $date_format == "%m/%d/%y"){

        // Converts date to string time
        return strtotime($check_date);                   
    }
}

##########################################
#     Timestamp to dates                 #
##########################################

function timestamp_to_date($db, $timestamp){

    $date_format = date_format_call($db);     

    switch($date_format){
      
          case "%d/%m/%Y":
          return date("d/m/Y", $timestamp);          

          case "%d/%m/%y":
          return date("d/m/y", $timestamp);         

          case "%m/%d/%Y":
          return date("m/d/Y", $timestamp);          

          case "%m/%d/%y":
          return date("m/d/y", $timestamp);          
    }
}