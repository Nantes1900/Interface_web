<?php

$lang['test']                       = "Salut, c'est un test";

//about accueil folder controllers
$lang['common_welcome_page_link']   = "Revenir à la page d'accueil";
$lang['common_welcome_site']        = "Bienvenue sur le projet Nantes1900";
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
$lang['common_histo_objet']         = "Objet historique";
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
$lang['common_doc_detail']          = "Documentation entre ".strtolower($lang['common_objets'])." et ".strtolower($lang['common_ressources']);
$lang['common_doc_txt']             = "Documentation textuelle";
$lang['common_doc_img']             = "Documentation graphique";
$lang['common_doc_vid']             = "Documentation video";
$lang['common_obj_link']            = "Relation entre ".strtolower($lang['common_objets']);
$lang['common_obj_links']           = "Relations entre ".strtolower($lang['common_objets']);

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
$lang['common_menu_admin_panel']        = "Listes des membres";

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

$lang['common_add_rel_form']              = "Formulaire d'ajout d'une relation entre <em>%s</em> et <em>%s</em>";
$lang['common_add_rel_obj1']              = " Selectionner le premier ".strtolower($lang['common_objet'])." :";
$lang['common_add_rel_obj2']              = " Selectionner le second ".strtolower($lang['common_objet'])." :";
$lang['common_add_rel_sel_rel']           = " Selectionner le type de relation :";
$lang['common_add_rel_parent_rel']        = "Relation Parent-Enfant";
$lang['common_add_rel_form_submit']       = "Ajouter cette relation";
$lang['common_add_rel_form_success']      = "L'ajout de relation entre les objets <b>%s</b> et <b>%s</b> s'est déroulé avec succès";
$lang['common_add_rel_form_failure']      = "Une erreur a eu lieu, les objets <b>%s</b> et <b>%s</b> n'ont pas été reliés";

$lang['common_add_ress_txt_form']         = "Formulaire d'ajout d'une ".strtolower($lang['common_ress_txt_detail']);
$lang['common_add_ress_img_form']         = "Formulaire d'ajout d'une ".strtolower($lang['common_ress_img_detail']);
$lang['common_add_ress_vid_form']         = "Formulaire d'ajout d'une ".strtolower($lang['common_ress_vid_detail']);
$lang['common_add_ress_linked']           = "liée à ";
$lang['common_add_ress_create_doc']       = "Créer un lien de documentation vers un ".strtolower($lang['common_objet']);
$lang['common_add_ress_create_doc_none']  = "Aucun";
$lang['common_add_ress_link_doc']         = "Lier la page :";
$lang['common_add_ress_link_doc_end']     = " de cette ".strtolower($lang['common_ressource']);
$lang['common_add_ress_form_submit']      = "Ajouter cette ".strtolower($lang['common_ressource']);
$lang['common_add_ress_form_success']     = "L'ajout de la ".strtolower($lang['common_ressource'])." <b>%s</b> s'est déroulé avec succès";
$lang['common_add_ress_form_failure']     = "Une erreur a eu lieu, la ".strtolower($lang['common_ressource'])." <b>%s</b> n'a pas été ajouté";
$lang['common_add_ress_check_title']      = "Le titre <b>%s</b> est déjà pris";

$lang['common_add_doc_success']           = "Le lien de %s entre <b>%s</b> et <b>%s</b> a été ajouté avec succès";
$lang['common_add_doc_failure']           = "Erreur : Le lien de %s entre <b>%s</b> et <b>%s</b> n'a pas pu être ajouté";

//about objet
$lang['common_obj_nom_objet']             = "Nom";
$lang['common_obj_creator']               = "Créateur";
$lang['common_obj_resume']                = "Résumé";
$lang['common_obj_historique']            = "Historique";
$lang['common_obj_description']           = "Description";
$lang['common_obj_adresse_postale']       = "Adresse Postale";
$lang['common_obj_mots_cles']             = "Mots-clés";

//about ressources
$lang['common_ress_title']                = "Titre";
$lang['common_ress_description']          = "Description";
$lang['common_ress_reference']            = "Référence";
$lang['common_ress_disponibilite']        = "Disponibilité";
$lang['common_ress_theme_ressource']      = "Thème de la ".strtolower($lang['common_ressource']);
$lang['common_ress_author']               = "Auteur(s)";
$lang['common_ress_editor']               = "Editeur";
$lang['common_ress_edit_town']            = "Ville d'édition";
$lang['common_ress_keywords']             = "Mots-clés";
$lang['common_ress_subcategory']          = "Sous-catégorie";
$lang['common_ress_pagination']           = "Nombre de pages";
$lang['common_ress_page_hint']            = "Laissez le champ vide ou mettez à 0 si vous ne disposez 
                                             pas de cette information (ou qu'elle n'est pas pertinente)";
$lang['common_ress_legend']               = "Légende";
$lang['common_ress_shot_place']           = "Lieu de la prise de vue";
$lang['common_ress_tec_used']             = "Technique utilisée";
$lang['common_ress_media']                = "Support de la ".strtolower($lang['common_ressource']);
$lang['common_ress_color']                = "Couleur";
$lang['common_ress_color_BW']             = "Noir et blanc";
$lang['common_ress_size']                 = "Dimension";
$lang['common_ress_img_upload']           = "Télécharger image";
$lang['common_ress_img_url']              = "URL image";
$lang['common_ress_img_title']            = "Image";
$lang['common_ress_link_to_img']          = "Lien vers l'image";
$lang['common_ress_vid_title']            = "Vidéo";
$lang['common_ress_vid_upload']           = "Télécharger vidéo";
$lang['common_ress_vid_url']              = "Lien vers la page hébergeant vidéo";
$lang['common_ress_length']               = "Durée (en minutes)";
$lang['common_ress_broadcast']            = "Diffusion";
$lang['common_ress_version']              = "Version de la vidéo";
$lang['common_ress_distrib']              = "Distribution";
$lang['common_ress_prod']                 = "Producteur";
$lang['common_ress_begin_date']           = "Date de début de la ".strtolower($lang['common_ressource']);
$lang['common_ress_precision']            = "précision : ";

//about moderation center
$lang['common_mod_obj']                     = "Modification de l'".strtolower($lang['common_objet'])." : ";
$lang['common_mod_ress_txt']                = "Modification de la ".strtolower($lang['common_ressource_txt'])." : ";
$lang['common_mod_ress_img']                = "Modification de la ".strtolower($lang['common_ressource_img'])." : ";
$lang['common_mod_ress_vid']                = "Modification de la ".strtolower($lang['common_ressource_vid'])." : ";
$lang['common_cancel']                      = "Annuler";

//about view_data in general
$lang['common_view_error_no_type']          = "Erreur : le type d'entité n'est pas identifié";
$lang['common_view_error_no_object']        = "Erreur : l'".strtolower($lang['common_objet'])." selectionné semble inexistant";
$lang['common_view_error_no_ress']          = "Erreur : la ".strtolower($lang['common_ressource'])." selectionnée semble inexistante";
$lang['common_view_select_type']            = "Visualiser les :";
$lang['common_view_go_back_link']           = "Revenir à la selection de données";
    
//about lists
$lang['common_select_data']                 = "Selection de données";
$lang['common_list_object']                 = "Liste des ".strtolower($lang['common_objets']);
$lang['common_list_ress_txt']               = "Liste des ".strtolower($lang['common_ressources_txt']);
$lang['common_list_ress_img']               = "Liste des ".strtolower($lang['common_ressources_img']);
$lang['common_list_ress_vid']               = "Liste des ".strtolower($lang['common_ressources_vid']);
$lang['common_list_link_rel']               = " à lier à ";
$lang['common_list_link_doc']               = " à lier à la ".strtolower($lang['common_ressource'])." ";
$lang['common_list_link_geo']               = " à relier à la coordonnée sélectionnée ";
$lang['common_list_sort_by']                = "Trier par :";
$lang['common_list_nom_objet']              = "Nom de l'".strtolower($lang['common_objet']);
$lang['common_list_creator_obj']            = "Pseudo du ".strtolower($lang['common_obj_creator']);
$lang['common_list_date_add_obj']           = "Date d'ajout de l'".strtolower($lang['common_objet']);
$lang['common_list_sort_dir_asc']           = "Croissant";
$lang['common_list_sort_dir_desc']          = "Décroissant";
$lang['common_list_select']                 = "Rechercher un(e) :";
$lang['common_list_filter_unvalid']         = $lang['common_objets']." non validés uniquement";
$lang['common_list_filter_unvalid_ress']    = $lang['common_ressources']." non validés uniquement";
$lang['common_list_sort_button']            = "Trier";
$lang['common_list_is_valid']               = "Validation";
$lang['common_list_valid']                  = "Valide";
$lang['common_list_unvalid']                = "Non valide";
$lang['common_list_link_obj_to']            = "Lier cet ".strtolower($lang['common_objet'])." à ";
$lang['common_list_do_link']                = "Relier";
$lang['common_list_title_ress']             = "Titre de la ".strtolower($lang['common_ressource']);
$lang['common_list_date_add_ress']          = "Date d'ajout de la ".strtolower($lang['common_ressource']);
$lang['common_list_link_ress']              = "Lier cette ".strtolower($lang['common_ressource']);
$lang['common_list_del_doc']                = "Supprimer une ".strtolower($lang['common_documentation']);
$lang['common_list_view']                   = "Visualiser";
$lang['common_list_view_obj']               = "Visualiser cet ".strtolower($lang['common_objet']);
$lang['common_list_view_ress']              = "Visualiser cette ".strtolower($lang['common_ressource']);
$lang['common_list_localize']               = "Localiser l'".strtolower($lang['common_objet']);
$lang['common_list_add_doc']                = "Documenter un ".strtolower($lang['common_objet'])." avec cette ".strtolower($lang['common_ressource']);

//about detailed view of a data
$lang['common_view_detail_obj']             = "Détails de l'".strtolower($lang['common_objet'])." : ";
$lang['common_view_detail_ress']            = "Détails de la ".strtolower($lang['common_ressource'])." : ";
$lang['common_view_author']                 = "Informations fournies par";
$lang['common_view_see_on_map']             = "Voir cet ".strtolower($lang['common_objet'])." sur la carte";
$lang['common_view_modify_obj']             = "Modifier cet ".strtolower($lang['common_objet']);
$lang['common_view_modify_ress']            = "Modifier cette ".strtolower($lang['common_ressource']);
$lang['common_view_add_ress']               = "Ajouter une ".strtolower($lang['common_ressource'])." liée à cet ".strtolower($lang['common_objet'])." :";
$lang['common_view_do_add_ress']            = "Ajouter ".strtolower($lang['common_ressource']);
$lang['common_view_video_alt']              = "Si la vidéo n'apparait pas, essayez avec un autre navigateur";

$lang['common_view_sidebar_obj']          = $lang['common_objets']." en relation";
$lang['common_view_sidebar_ress']         = $lang['common_ressources']." en relation";
$lang['common_view_sidebar_alt_obj']      = "voir ".strtolower($lang['common_objet']);
$lang['common_view_sidebar_alt_ress']     = "voir ".strtolower($lang['common_ressource']);
$lang['common_view_sidebar_page']         = "voir page ";

//about download section
$lang['common_download_title']              = "Section de téléchargement";
$lang['common_download_presentation']       = "Ici, divers outils sont mis à votre disposition 
                                              pour faciliter l'utilisation du site de ce projet.";
$lang['common_download_csv']                = "Modèles de tableurs";
$lang['common_download_csv_pres']           = "Si vous souhaitez utiliser des importations csv, il faut que 
                                               le nom des colonnes respecte un certain formalisme, et certaines
                                               cellules ont aussi un format particulier. Pour vous aider, voici en 
                                               téléchargement les modèles à utiliser.";
$lang['common_download_csv_ods']            = "Modèle au format ods :";
$lang['common_do_download_button']          = "Télécharger le fichier";

//about annotations
$lang['common_new_annot']                   ="Nouvelle annotation";
$lang['common_new_annot_instruction']       ="Entrez ici votre nouvelle annotation";
$lang['common_new_annot_create']            ="Créer";
$lang['common_annot_answer']                ="Répondre";
$lang['common_annot_delete']                ="Supprimer cette annotation";
$lang['common_annot_delete_com']            ="Supprimer ce commentaire";
$lang['common_annot_delete_warning']        ="Etes vous certain de vouloir supprimer l'annotation entière?";

/* End of file common.php */
/* Location : ./system/language/french/common_lang.php */

