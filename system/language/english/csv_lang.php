<?php

//csv webpage
$lang['csv_title']            = "Import several elements using a CSV file";
$lang['csv_title_hint']       = "For further information, check the tutorial. <br/> 
                                 Remember using the models provided in the downloads section.";
$lang['csv_no_transaction']      = "Import at best (every non-failing entry will be saved)";
$lang['csv_transaction']   = "Import nothing if there is at least one error";
$lang['csv_import_button']    = "Import";

$lang['csv_total_success']    = "Your %s csv file was successfuly imported";
$lang['csv_total_failure']    = "<b>Failure</b> : your %s csv file contained 
                                 %d error(s) and haven't been imported";
$lang['csv_partial_success']  = "<b>Unfortunately</b>, the following %s couldn't be saved : ";
$lang['csv_advice']           = "Be sure to check your file, check that it is following the instruction
                                 and read carefully the error report. If you still have trouble, please
                                 try to reach a moderator or an administrator";
$lang['csv_continue']         = "You can carry on importing csv file";

//csv error message
$lang['csv_rel_date_begin']         = " (beginning date is not valid)";
$lang['csv_rel_date_end']           = " (ending date is not valid)";
$lang['csv_rel_error_begin']    = "the relation between <b>%s</b> and <b>%s</b>";
$lang['csv_rel_invalid']        = " (objects found but information is not valid)";
$lang['csv_rel_unknown']        = " (objects found but the kind of relation (label) is not valid)";
$lang['csv_rel_do_not_exist']   = " does not exist";
$lang['csv_rel_crit_error']     = "The file could not be parsed, please check the extension and 
                                   the separators of your csv file (sould be '@@')";

$lang['csv_obj_general']        = " (general informations)";
$lang['csv_obj_already_exist']  = " (the objet already exist)";
$lang['csv_obj_geom_or_date']   = " (geometry or dates)";

$lang['csv_ress_already_exist']     = " already exist, ";
$lang['csv_ress_date_begin']        = "beginning date is not valid, ";
$lang['csv_ress_img_date_begin']    = "picture's date is not valid, ";
$lang['csv_ress_vid_date_begin']    = "production date is not valid, ";
$lang['csv_ress_pagination']        = "the number of page is not valid (pagination field must be an integer), ";
$lang['csv_ress_color']             = "color fiel not valid, use TRUE or FALSE, ";

$lang['csv_doc_error_begin']        = "the documentation link between <b>%s</b> and <b>%s</b>";
$lang['csv_doc_no_type']            = " (the type of documentation is not \"textuelle\", \"graphique\" or \"video\")";
$lang['csv_doc_do_not_exist']       = " does not exist, ";

/* End of file common.php */
/* Location : ./system/language/english/csv_lang.php */