<!-- print_job_sheet.tpl - Job Sheet Print Template -->
<!DOCTYPE html>
<html lang="en-GB">
<head>
    <meta charset="utf-8">
    
    <!-- PDF Title -->
    <title>{t}Invoice{/t} {$invoice_details.INVOICE_ID}</title>   
        
    <!-- PDF Subject -->
    <meta name="description" content="{$meta_description}">
    
    <!-- PDF Keywords -->
    <meta name="keywords" content="{$meta_keywords}">
    
    <!-- PDF Author -->
    <meta name="author" content="QWcrm - QuantumWarp.com">       
    
    <link rel="icon" href="favicon.ico">
    <link rel="stylesheet" href="{$theme_css_dir}template.css">    
</head>

<body>

    <!-- Header Section -->
    <table width="900" border="0" cellpadding="2" cellspacing="0" style="border-collapse: collapse;">
        <tr>
            <td width="20%" valign="middle" align="center"><img src="{$company_logo}" alt="" height="50"></td>
            <td width="60%" align="center">                
                <p><b><font size="+3">{$company_details.COMPANY_NAME}</font></b><br></p>                
            </td>
            <td width="20%" valign="middle" align="center">{t}workorder_print_job_sheet_title{/t}</font></td>
        </tr>
    </table>

    <!-- Job Details -->
    <table width="900" border="0" cellpadding="2" cellspacing="0" style="border-collapse: collapse; border: 3px solid black;" bgcolor="#999999">
        <tr>

            <!-- Left Column -->
            <td style="width: 50%" valign="top">
                <table border="0" cellpadding="2" cellspacing="0" style="border-collapse: collapse;">
                    <tr>
                        <td style="width: 150px">                        
                            <b>{t}Customer{/t}: </b><br>
                            <b>{t}Workorder ID{/t}: </b><br>     
                            <b>{t}Date{/t}: <b><br>
                            <b>{t}Opened{/t}: <b><br>     
                            <b>{t}Phone{/t}: <b><br>
                            <b>{t}Mobile{/t}: <b><br>
                            <b>{t}Email{/t}: <b><br>                        
                        </td>
                        <td>
                            {$single_workorder[i].CUSTOMER_FIRST_NAME} {$single_workorder[i].CUSTOMER_LAST_NAME}<br>
                            {$single_workorder[i].WORK_ORDER_ID}<br>
                            {$smarty.now|date_format:$date_format}<br>
                            {$single_workorder[i].WORK_ORDER_OPEN_DATE|date_format:$date_format}<br>
                            {$single_workorder[i].CUSTOMER_WORK_PHONE}<br>
                            {$single_workorder[i].CUSTOMER_MOBILE_PHONE}<br>
                            {$single_workorder[i].CUSTOMER_EMAIL}<br>
                        </td>        
                    </tr>    
                </table>
            </td>

            <!-- Right Column -->
            <td style="width: 50%" valign="top">
                <table border="0" cellpadding="2" cellspacing="0" style="border-collapse: collapse;">
                    <tr>
                        <td style="width: 150px">
                            <b>{t}Contact{/t}: <b><br><br>
                            <b>{t}Address{/t}: <b><br><br>
                        </td>
                        <td>
                            {$single_workorder[i].CUSTOMER_ADDRESS}<br>
                            {$single_workorder[i].CUSTOMER_CITY}<br>
                            {$single_workorder[i].CUSTOMER_STATE}<br>
                            {$single_workorder[i].CUSTOMER_ZIP}<br />
                        </td>        
                    </tr>    
                </table>
            </td>      
        </tr>    
    </table>
    <br />

    <!-- Job Description -->
    <table width="900" border="0" cellpadding="2" cellspacing="0" style="border-collapse: collapse; border: 3px solid black;" bgcolor="#999999">
        <tr>
            <td><b>{t}Description{/t}:<b></td>       
        </tr>
        <tr>
            <td><div style="min-height: 140px;">{$single_workorder[i].WORK_ORDER_DESCRIPTION}</div></td>
        </tr>
        <tr>
            <td><b>{t}Required Passwords{/t}:</b><br /><br /></td>
        </tr>
    </table>
    <br />

    <!-- Notes -->
    <table width="900" border="0" cellpadding="2" cellspacing="0" style="border-collapse: collapse;">
        <tr style="border-bottom: 2px solid black;">
            <td style="width: 100px; text-align: center; border-right: 2px solid black;"><b>{t}Date{/t}</b></td>
            <td style="width: 100px; text-align: center; border-right: 2px solid black;"><b>{t}Start Time{/t}</b></td>
            <td style="width: 100px; text-align: center; border-right: 2px solid black;"><b>{t}End Time{/t}</b></td>
            <td style="text-align: center;"><b>{t}Notes{/t}</b></td>  
        </tr>
        <tr>
            <td style="width: 100px; text-align: center; border-right: 2px solid black; height: 500px;"></td>
            <td style="width: 100px; text-align: center; border-right: 2px solid black; height: 500px;"></td>
            <td style="width: 100px; text-align: center; border-right: 2px solid black; height: 500px;"></td>
            <td style="text-align: center; height: 500px;"></td>          
        </tr>
    </table>
    <br />

    <!-- Parts Used -->
    <table width="900" border="0" cellpadding="2" cellspacing="0" style="border-collapse: collapse; border: 3px solid black;" bgcolor="#999999">
        <tr>
            <td><b>{t}Parts Used{/t}:<b></td>       
        </tr>
        <tr>
            <td><div style="min-height: 100px;"></div></td>
        </tr>
    </table>
    <br />

    <!-- Work Carried Out-->
    <table width="900" border="0" cellpadding="2" cellspacing="0" style="border-collapse: collapse; border: 3px solid black;" bgcolor="#999999">
        <tr>
            <td><b>{t}Resolution{/t}:<b></td>       
        </tr>
        <tr>
            <td><div style="min-height: 100px;"></div></td>
        </tr>
        <tr>
            <td style="text-align: right;"><p><b>{t}Closed{/t}:  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b><br /><br /></td>
        </tr>
    </table>
    
</body>
</html>