<!-- overview.tpl -->
{*
 * @package   QWcrm
 * @author    Jon Brown https://quantumwarp.com/
 * @copyright Copyright (C) 2016 - 2017 Jon Brown, All rights reserved.
 * @license   GNU/GPLv3 or later; https://www.gnu.org/licenses/gpl.html
*}
<table width="100%" border="0" cellpadding="20" cellspacing="5">
    <tr>
        <td>            
            <table width="700" cellpadding="3" cellspacing="0" border="0">
                <tr>
                    <td class="menuhead2" width="80%">&nbsp;{t}Cronjobs Overview{/t}</td>
                    <td class="menuhead2" width="20%" align="right" valign="middle">
                        <a>
                            <img src="{$theme_images_dir}icons/16x16/help.gif" border="0" onMouseOver="ddrivetip('<div><strong>{t escape=js}CRONJOB_OVERVIEW_HELP_TITLE{/t}</strong></div><hr><div>{t escape=js}CRONJOB_OVERVIEW_HELP_CONTENT{/t}</div>');" onMouseOut="hideddrivetip();">
                        </a>
                    </td>
                </tr>
                <tr>
                    <td class="menutd2" colspan="2">
                        <table class="olotable" width="100%" border="0" cellpadding="5" cellspacing="0">
                            <tr>
                                <td class="menutd">
                                    <table width="100%" border="0" cellpadding="10" cellspacing="0">                                        
                                        <tr>
                                            <td>
                                                <a name="cronjobs"></a>                                                
                                                {include file='cronjob/blocks/display_cronjobs_block.tpl' display_cronjobs=$display_cronjobs block_title=_gettext("Cron Jobs")}
                                            </td>
                                        </tr>                                                                                                                    
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>
                        <table width="100%" cellpadding="2" cellspacing="2" border="0">  
                            <tr>
                                <td align="right"><b>{t}Cronjob{/t} {t}System{/t} {t}Last Run Time{/t}:</b></td>
                                <td colspan="2">{$cronjob_system_details.last_run_time|date_format:$date_format} {$cronjob_system_details.last_run_time|date_format:'H:i:s'}</td>
                            </tr>
                            <tr>
                                <td align="right"><b>{t}Cronjob{/t} {t}System{/t} {t}Last Run Status{/t}:</b></td>
                                <td colspan="2">{if $cronjob_system_details.last_run_status}{t}Success{/t}{else}{t}Failed{/t}{/if}</td>
                            </tr>
                            <tr>
                                <td align="right"><b>{t}Cronjob{/t} {t}System{/t} {t}Locked{/t}:</b></td>
                                <td>{if $cronjob_system_details.locked}{t}Yes{/t}{else}{t}No{/t}{/if}</td>
                                <td>{if $cronjob_system_details.locked}<button type="button" class="olotd4" onclick="if (confirm('{t}Are you Sure you want to unlock the cron system?{/t}')) window.location.href='index.php?component=cronjob&page_tpl=unlock&unlock_type=system';">{t}Unlock{/t}</button>{/if}</td>
                            </tr>                            
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>