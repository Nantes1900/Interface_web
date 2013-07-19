<?php

$lang['test']			= "Hello, this is test";

//about accueil folder controllers
$lang['common_welcome_page_link']   = "Go back to welcome page";
$lang['common_welcome_site']        = "Welcome on this website";
$lang['common_lang_title']          = "Language settings";
$lang['common_change_lang']         = "Change language";
$lang['common_welcome_info']        = "This site is still under <span class=\"hint\">development
                                      <span>If you notice a bug, report it to the administrators</span></span>";
$lang['common_welcome_warning']     = "This website relies on cookies. Be sure to activate cookies
                                       before browsing further.";
$lang['common_need_login']          = "Please, login :";
$lang['common_do_need_login']       = "You are not connected. Please, login:";

$lang['common_username']            = "Username :";
$lang['common_password']            = "Password :";
$lang['common_login']               = "Login";
$lang['common_signin_link']         = "New on the site? Click here to signin";

//generic terms of the application
$lang['common_objet']               = "Object";
$lang['common_objets']              = "Objects";
$lang['common_histo_objet']         = "Historical object";
$lang['common_ressource']           = "Ressource";
$lang['common_ressources']          = "Ressources";
$lang['common_ressource_txt']       = "Written ressource";
$lang['common_ressources_txt']      = "Written ressources";
$lang['common_ress_txt_detail']     = "Written ressource (book, letter,...)";
$lang['common_ressource_img']       = "Graphical ressource";
$lang['common_ressources_img']      = "Graphical ressources";
$lang['common_ress_img_detail']     = "Graphical ressource (photo, picture...)";
$lang['common_ressource_vid']       = "Video ressource";
$lang['common_ressources_vid']      = "Video ressources";
$lang['common_ress_vid_detail']     = "Video ressource (short movie, clip...)";
$lang['common_documentation']       = "Documentation";
$lang['common_doc_txt']             = "Textual documentation";
$lang['common_doc_img']             = "Graphical documentation";
$lang['common_doc_vid']             = "Video documentation";
$lang['common_obj_link']            = "Link between ".strtolower($lang['common_objets']);
$lang['common_obj_links']           = "Links between ".strtolower($lang['common_objets']);

//left sidebar and main menu
$lang['common_lsidebar_welcome']        = "Welcome page";
$lang['common_lsidebar_addData']        = "Add data";
$lang['common_lsidebar_objet']          = "Historical ".strtolower($lang['common_objet']);
$lang['common_lsidebar_relation']       = "Relation between two historical ".strtolower($lang['common_objets']);
$lang['common_lsidebar_csvImport']      = "CSV file import";
$lang['common_lsidebar_moderation']     = "Manage";
$lang['common_lsidebar_mod_objet']      = "Historical ".strtolower($lang['common_objet']);
$lang['common_lsidebar_mod_relation']   = "Links for ".strtolower($lang['common_objets']);
$lang['common_lsidebar_mod_ressTxt']    = $lang['common_ressource_txt'];
$lang['common_lsidebar_mod_docTxt']     = "Textual documentation for ".strtolower($lang['common_objets']);
$lang['common_lsidebar_mod_ressImg']    = $lang['common_ressource_img'];
$lang['common_lsidebar_mod_docImg']     = "Graphical documentation for ".strtolower($lang['common_objets']);
$lang['common_lsidebar_mod_ressVid']    = $lang['common_ressource_vid'];
$lang['common_lsidebar_mod_docVid']     = "Video documentation ".strtolower($lang['common_objets']);
$lang['common_lsidebar_view_data']      = "View data";
$lang['common_lsidebar_view_map']       = "Map of ".strtolower($lang['common_objets']);
$lang['common_lsidebar_profile_panel']  = "Profile";
$lang['common_lsidebar_admin_panel']    = "Administration center";
$lang['common_lsidebar_contact_panel']  = "Contacts";
$lang['common_lsidebar_downloads']      = "Downloads";
$lang['common_lsidebar_tutorial']       = "Tutorial";
$lang['common_lsidebar_logout']         = "Log out";
$lang['common_menu_profile_panel']      = "Check your profile";
$lang['common_menu_contact_panel']      = "Members' list";

//about data center
$lang['common_add_data_instruction']      = "Choose what you want to add to the database :";
$lang['common_add_data_min_instruction']  = "You would like to add :";
$lang['common_add_data_csv_import']       = "Add several elements with a CSV file";

$lang['common_add_obj_form']              = "Add an historical ".strtolower($lang['common_objet'])." form";
$lang['common_add_obj_form_submit']       = "Add this ".strtolower($lang['common_objet']);
$lang['common_add_obj_form_success']      = "The object <b>%s</b> was successfuly added";
$lang['common_add_obj_form_failure']      = "An error occured, <b>%s</b> has not been added";
$lang['common_add_geo_form_success']      = "The object <b>%s</b> was successfuly located";
$lang['common_add_geo_form_failure']      = "An error occured, <b>%s</b> has not been located";
$lang['common_add_obj_geo_form_success']  = "The object <b>%s</b> was successfuly created and located";
$lang['common_add_obj_geo_form_failure']  = "An error occured, <b>%s</b> has been created but not located";
$lang['common_add_obj_check_nom']         = "The name <b>%s</b> is already taken";
$lang['common_add_obj_check_date']        = "Invalid date";

$lang['common_add_rel_form']              = "Adding relation between two ".strtolower($lang['common_objets'])." form";
$lang['common_add_rel_obj1']              = " Select the first ".strtolower($lang['common_objet'])." :";
$lang['common_add_rel_obj2']              = " Select the second ".strtolower($lang['common_objet'])." :";
$lang['common_add_rel_sel_rel']           = " Select the kind of relation :";
$lang['common_add_rel_parent_rel']        = "Parent-child relation";
$lang['common_add_rel_form_submit']       = "Add this relation";
$lang['common_add_rel_form_success']      = "The relation between <b>%s</b> and <b>%s</b> was successfuly created";
$lang['common_add_rel_form_failure']      = "An error occured, <b>%s</b> and <b>%s</b> have not been linked";

$lang['common_add_ress_txt_form']         = "Adding a ".strtolower($lang['common_ress_txt_detail'])." form";
$lang['common_add_ress_img_form']         = "Adding a ".strtolower($lang['common_ress_img_detail'])." form";
$lang['common_add_ress_vid_form']         = "Adding a ".strtolower($lang['common_ress_vid_detail'])." form";
$lang['common_add_ress_linked']           = "linked to ";
$lang['common_add_ress_create_doc']       = "Create a documentation link with an ".strtolower($lang['common_objet']);
$lang['common_add_ress_create_doc_none']  = "None";
$lang['common_add_ress_link_doc']         = "Link the page :";
$lang['common_add_ress_link_doc_end']     = " of this ".strtolower($lang['common_ressource']);
$lang['common_add_ress_form_submit']      = "Add this ".strtolower($lang['common_ressource']);
$lang['common_add_ress_form_success']     = "The ".strtolower($lang['common_ressource'])." <b>%s</b> was successfuly added";
$lang['common_add_ress_form_failure']     = "An error occured, <b>%s</b> could not be added";
$lang['common_add_ress_check_title']      = "The title <b>%s</b> already exist";

$lang['common_add_doc_success']           = "The %s link between <b>%s</b> and <b>%s</b> was successfuly added";
$lang['common_add_doc_failure']           = "Error : the %s link between <b>%s</b> and <b>%s</b> have not been added";

//about objet
$lang['common_obj_nom_objet']             = "Name";
$lang['common_obj_creator']               = "Creator";
$lang['common_obj_resume']                = "Summary";
$lang['common_obj_historique']            = "History";
$lang['common_obj_description']           = "Description";
$lang['common_obj_adresse_postale']       = "Address";
$lang['common_obj_mots_cles']             = "Keywords";

//about ressources
$lang['common_ress_title']                = "Title";
$lang['common_ress_description']          = "Description";
$lang['common_ress_reference']            = "Reference";
$lang['common_ress_disponibilite']        = "Disponibility";
$lang['common_ress_theme_ressource']      = $lang['common_ressource']."'s theme";
$lang['common_ress_author']               = "Author(s)";
$lang['common_ress_editor']               = "Editor";
$lang['common_ress_edit_town']            = "Town of edition";
$lang['common_ress_keywords']             = "Keywords";
$lang['common_ress_subcategory']          = "Sub category";
$lang['common_ress_pagination']           = "Number of pages";
$lang['common_ress_page_hint']            = "Do not fill this field or put it to 0 if you don't 
                                             have this information (or if it is irrelevant)";
$lang['common_ress_legend']               = "Legend";
$lang['common_ress_shot_place']           = "Place of the shot";
$lang['common_ress_tec_used']             = "Technical specification";
$lang['common_ress_media']                = "Medium used";
$lang['common_ress_color']                = "Color";
$lang['common_ress_img_upload']           = "Upload image";
$lang['common_ress_img_url']              = "image URL";
$lang['common_ress_vid_upload']           = "Upload video";
$lang['common_ress_vid_url']              = "Link to the page hosting the video";
$lang['common_ress_length']               = "Length (minutes)";
$lang['common_ress_broadcast']            = "Broadcasted in :";
$lang['common_ress_version']              = "Version";
$lang['common_ress_distrib']              = "Distributed by";
$lang['common_ress_prod']                 = "Producted by";

//about moderation center
$lang['common_mod_obj']                     = "Modifying the ".strtolower($lang['common_objet'])." : ";

/* End of file common.php */
/* Location : ./system/language/english/common_lang.php */

