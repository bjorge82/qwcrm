<!-- details_new_note.tpl  -->
<script src="{$theme_js_dir}tinymce/tinymce.min.js"></script>
<script src="{$theme_js_dir}editor-config.js"></script>

<table width="100%" border="0" cellpadding="20" cellspacing="0">
    <tr>
        <td>
            <table width="700" cellpadding="5" cellspacing="0" border="0" >
                <tr>
                    <td class="menuhead2" width="80%">{$translate_workorder_details_new_note_title} {$workorder_id}</td>
                </tr>
                <tr>
                    <td class="menutd2">                        
                        <table width="100%" class="olotable" cellpadding="5" cellspacing="0" border="0">
                            <tr>
                                <td width="100%" valign="top">                                                                     
                                    <form action="index.php?page=workorder:note_new" method="post" name="new_workorder_note" id="new_workorder_note">                                        
                                        <input type="hidden" name="workorder_id" value="{$workorder_id}">
                                        <table class="olotable" width="100%" border="0" summary="Work order display">
                                            <tr>
                                                <td class="olohead">{$translate_workorder_details_notes_title}</td>
                                            </tr>
                                            <tr>
                                                <td class="olotd"><textarea name="workorder_note" class="olotd4 mceCheckForContent" rows="15" cols="70"></textarea></td>
                                            </tr>
                                        </table>
                                        <br>
                                        <input name="submit" class="olotd4"  value="{$translate_workorder_submit}" type="submit" />    
                                    </form>
                                    <br>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>