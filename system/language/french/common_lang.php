<?php

$lang['test']                       = "Salut, c'est un test";

//about accueil folder controllers
$lang['common_welcome_page_link']   = "Revenir à la page d'accueil";
$lang['common_welcome_site']        = "Bienvenue sur le site";
$lang['common_lang_title']          = "Paramètres de langue";
$lang['common_change_lang']         = "Changer la langue";
$lang['common_welcome_info']        = "Le site est actuellement en <span class=\"hint\">développement
                                      <span>Si vous notez un disfonctionnement, informez-en les administrateurs</span></span>";
$lang['common_welcome_warning']     = "Une grande partie des fonctionnalités de ce site repose sur l'utilisation des cookies. 
                                       Vous devez accepter les cookies pour pouvoir l'utiliser.";
$lang['common_need_login']          = "Connectez-vous :";
$lang['common_do_need_login']       = "Vous n'êtes pas connecté. Veuillez vous connecter :";

$lang['common_username']            = "Nom d'utilisateur :";
$lang['common_password']            = "Mot de passe :";
$lang['common_login']               = "Connexion";
$lang['common_signin_link']         = "Nouveau sur le site? Cliquez-ici pour vous inscrire";

//generic terms of the application
$lang['common_objet']               = "Objet";
$lang['common_objets']              = "Objets";
$lang['common_ressource']           = "Ressource";
$lang['common_ressources']          = "Ressources";
$lang['common_ressource_txt']       = "Ressource textuelle";
$lang['common_ressources_txt']      = "Ressources textuelles";
$lang['common_ress_txt_detail']     = "Ressource textuelle (livre, lettre,...)";
$lang['common_ressource_img']       = "Ressource graphique";
$lang['common_ressources_img']      = "Ressources graphiques";
$lang['common_ress_img_detail']     = "Ressource graphique (photo, image...)";
$lang['common_ressource_vid']       = "Ressource vidéo";
$lang['common_ressources_vid']      = "Ressources vidéos";
$lang['common_ress_vid_detail']     = "Ressource vidéo (film, clip...)";
$lang['common_documentation']       = "Documentation";
$lang['common_doc_txt']             = "Documentation textuelle";
$lang['common_doc_img']             = "Documentation graphique";
$lang['common_doc_vid']             = "Documentation video";
$lang['common_obj_link']            = "Relation entre ".strtolower($lang['common_objets']);

//left sidebar and main menu
$lang['common_lsidebar_welcome']        = "Accueil";
$lang['common_lsidebar_addData']        = "Ajout de données";
$lang['common_lsidebar_objet']          = $lang['common_objet']." historique";
$lang['common_lsidebar_relation']       = "Relation entre deux ".strtolower($lang['common_objets'])." historiques";
$lang['common_lsidebar_csvImport']      = "Import d'un fichier csv";
$lang['common_lsidebar_moderation']     = "Modération de données";
$lang['common_lsidebar_mod_objet']      = "Modifier un ".strtolower($lang['common_objet'])." historique";
$lang['common_lsidebar_mod_relation']   = "Relier des ".strtolower($lang['common_objets']);
$lang['common_lsidebar_mod_ressTxt']    = "Modifier une ".strtolower($lang['common_ressource_txt']);
$lang['common_lsidebar_mod_docTxt']     = "Documenter (texte) un ".strtolower($lang['common_objets']);
$lang['common_lsidebar_mod_ressImg']    = "Modifier une ".strtolower($lang['common_ressource_img']);
$lang['common_lsidebar_mod_docImg']     = "Documenter (image) un ".strtolower($lang['common_objets']);
$lang['common_lsidebar_mod_ressVid']    = "Modifier une ".strtolower($lang['common_ressource_vid']);
$lang['common_lsidebar_mod_docVid']     = "Documenter (video) un ".strtolower($lang['common_objets']);
$lang['common_lsidebar_view_data']      = "Visualisation de données";
$lang['common_lsidebar_view_map']       = "Carte des ".strtolower($lang['common_objets']);
$lang['common_lsidebar_profile_panel']  = "Profil personnel";
$lang['common_lsidebar_admin_panel']    = "Centre d'administration";
$lang['common_lsidebar_contact_panel']  = "Contacts";
$lang['common_lsidebar_downloads']      = "Téléchargements";
$lang['common_lsidebar_tutorial']       = "Tutoriel";
$lang['common_lsidebar_logout']         = "Déconnexion";
$lang['common_menu_profile_panel']      = "Consulter le profil personnel";
$lang['common_menu_contact_panel']      = "Listes des autres membres";

//about data center
$lang['common_add_data_instruction']      = "Sélectionnez ce que vous souhaitez ajouter à la base :";
$lang['common_add_data_min_instruction']  = "Vous souhaitez ajouter :";
$lang['common_add_data_csv_import']       = "Ajouter plusieurs éléments à partir d'un fichier CSV";

$lang['common_add_obj_form']              = "Formulaire d'ajout d'un ".strtolower($lang['common_objet'])." historique";
$lang['common_add_obj_form_submit']       = "Ajouter cet ".strtolower($lang['common_objet']);
$lang['common_add_obj_form_success']      = "L'ajout de l'objet <b>%s</b> s'est déroulé avec succès";
$lang['common_add_obj_form_failure']      = "Une erreur a eu lieu, l'objet <b>%s</b> n'a pas été ajouté";
$lang['common_add_geo_form_success']      = "L'objet <b>%s</b> a été localisé avec succès";
$lang['common_add_geo_form_failure']      = "Une erreur a eu lieu, l'objet <b>%s</b> n'a pas été localisé";
$lang['common_add_obj_geo_form_success']  = "L'objet <b>%s</b> a été créé et localisé avec succès";
$lang['common_add_obj_geo_form_failure']  = "Une erreur a eu lieu, l'objet <b>%s</b> a été créé mais pas localisé";
$lang['common_add_obj_check_nom']         = "Le nom <b>%s</b> est déjà pris";
$lang['common_add_obj_check_date']        = "Date invalide";

$lang['common_add_rel_form']              = "Formulaire d'ajout d'une relation entre deux ".strtolower($lang['common_objets']);
$lang['common_add_rel_obj1']              = " Selectionner le premier ".strtolower($lang['common_objet'])." :";
$lang['common_add_rel_obj2']              = " Selectionner le second ".strtolower($lang['common_objet'])." :";
$lang['common_add_rel_sel_rel']           = " Selectionner le type de relation :";
$lang['common_add_rel_parent_rel']        = "Relation Parent-Enfant";
$lang['common_add_rel_form_submit']       = "Ajouter cette relation";
$lang['common_add_rel_form_success']      = "L'ajout de relation entre les objets <b>%s</b> et <b>%s</b> s'est déroulé avec succès";
$lang['common_add_rel_form_failure']      = "Une erreur a eu lieu, les objets <b>%s</b> et <b>%s</b> n'ont pas été reliés";

//about objet
$lang['common_obj_nom_objet']             = "Nom";
$lang['common_obj_resume']                = "Résumé";
$lang['common_obj_historique']            = "Historique";
$lang['common_obj_description']           = "Description";
$lang['common_obj_adresse_postale']       = "Adresse Postale";
$lang['common_obj_mots_cles']             = "Mots-clés";


/* End of file common.php */
/* Location : ./system/language/french/common_lang.php */

