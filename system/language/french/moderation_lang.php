<?php

$lang['moderation_main_title']          = "Modération de données";
$lang['moderation_mod_edit_m']          = "Editer un ";
$lang['moderation_mod_edit_f']          = "Editer une ";
$lang['moderation_mod_manage_s']        = "Gérer la ";
$lang['moderation_mod_manage_p']        = "Gérer les ";
$lang['moderation_mod_concerning']      = " vers un ";

$lang['moderation_validate_button']     = "Enregistrer les modifications";
$lang['moderation_validate_box']        = "Valider";
$lang['moderation_print_sheet']         = "Imprimer la fiche";

//objet success/failure message
$lang['moderation_obj_modify_success']      = "La modification de l'objet <b>%s</b> s'est déroulée avec succès";
$lang['moderation_obj_modify_failure']      = "Erreur : la modification de l'objet <b>%s</b> a échoué ";
$lang['moderation_obj_validate_success']    = "La validation de l'objet <b>%s</b> s'est déroulée avec succès";
$lang['moderation_obj_validate_failure']    = "Erreur : la validation de l'objet <b>%s</b> a échoué";
$lang['moderation_obj_deletion_success']    = "La suppression de l'objet <b>%s</b> s'est déroulée avec succès";
$lang['moderation_obj_deletion_failure']    = "Erreur : la suppression de l'objet <b>%s</b> a échoué ";
$lang['moderation_obj_addRel_success']      = "La relation entre <b>%s</b> et <b>%s</b> a été ajoutée avec succès";
$lang['moderation_obj_addRel_failure']      = "Erreur : la relation entre <b>%s</b> et <b>%s</b> n'a pas pu être ajouté";
$lang['moderation_obj_delRel_success']      = "La suppression de la relation entre <b>%s</b> et <b>%s</b> s'est déroulée avec succès";
$lang['moderation_obj_delRel_failure']      = "Erreur : la suppression de la relation entre <b>%s</b> et <b>%s</b> a échoué";
$lang['moderation_obj_geomDel_success']     = "La suppression du marqueur géographique de <b>%s</b> s'est déroulée avec succès. <br>
                                               Attention : l'objet existe encore, seules se coordonnées ont été supprimées";
$lang['moderation_obj_geomDel_failure']     = "Erreur : la suppression du marqueur géographique de <b>%s</b> a échoué, l'objet reste présent sur la carte";
$lang['moderation_obj_geomDel_unknown']     = "Erreur : l'objet n'existait pas, il n'a pas pu être effacé de la carte";

//ressource success/failure message
$lang['moderation_ress_modify_success']      = "La %s <b>%s</b> a bien été modifiée";
$lang['moderation_ress_modify_failure']      = "Erreur : la %s <b>%s</b> n'a pas pu être modifié";
$lang['moderation_ress_validate_success']    = "La validation de la ressource <b>%s</b> s'est déroulée avec succès";
$lang['moderation_ress_validate_failure']    = "Erreur : la validation de la ressource <b>%s</b> a échoué";
$lang['moderation_ress_deletion_success']    = "La suppression de la ressource <b>%s</b> s'est déroulée avec succès";
$lang['moderation_ress_deletion_failure']    = "Erreur : la suppression de la ressource <b>%s</b> a échoué ";
$lang['moderation_ress_addDoc_success']      = "La documentation entre <b>%s</b> et <b>%s</b> a été ajoutée avec succès";
$lang['moderation_ress_addDoc_failure']      = "Erreur : la documentation entre <b>%s</b> et <b>%s</b> n'a pas pu être ajouté";
$lang['moderation_ress_delDoc_success']      = "La suppression de la documentation entre <b>%s</b> et <b>%s</b> s'est déroulée avec succès";
$lang['moderation_ress_delDoc_failure']      = "Erreur : la suppression de la documentation entre <b>%s</b> et <b>%s</b> a échoué";

//about documentation
$lang['moderation_delDoc_title']             = "Suppression d'un lien de documentation";
$lang['moderation_delDoc_list']              = "Liste des objets liés à : ";
$lang['moderation_delDoc_obj_name']          = "Nom de l'objet lié";
$lang['moderation_delDoc_remove']            = "Supprimer la documentation";
$lang['moderation_delDoc_remove_this']       = "Supprimer cette documentation";
$lang['moderation_delDoc_warning_msg']       = "Vous vous apprêtez à supprimer définitivement la documentation de <em>%s</em>
                                                 à <em>%s</em>. Les informations de lien documentaire seront perdues, 
                                                 êtes vous certain de bien vouloir faire cela?";

//about relation
$lang['moderation_relation_creator']         = "Créateur de la relation";
$lang['moderation_relation_type']            = "Type de relation";
$lang['moderation_delRel_title']             = "Modification et suppression de relation";
$lang['moderation_delRel_remove']            = "Supprimer la relation";
$lang['moderation_delRel_modify']            = "Modifier la relation";
$lang['moderation_delRel_remove_this']       = "Supprimer cette relation";
$lang['moderation_delRel_warning_msg']       = "Vous vous apprêtez à supprimer définitivement la relation entre <em>%s</em>
                                                 et <em>%s</em>. Les informations de relation seront perdues, 
                                                 êtes vous certain de bien vouloir faire cela?";
$lang['moderation_modRel_modify_this']       = "Modifier cette relation";
$lang['moderation_modRel_title']             = "Modification de la relation entre <em>%s</em> et <em>%s</em>";

//about ressource
$lang['moderation_ress_re_upload']           = "Télécharger une nouvelle image";

//list of objects
$lang['moderation_go_back_link']            = "Revenir au centre de modération";
$lang['moderation_list_modif_valid']        = "Modifier/Valider";
$lang['moderation_list_lock_review']        = "Verrouillé par";
$lang['moderation_list_delete']             = "Supprimer";
$lang['moderation_list_create_rel']         = "Créer une relation avec un objet";
$lang['moderation_list_delete_rel']         = "Modification et suppression de relation";
$lang['moderation_list_modify_obj']         = "Modifier cet objet";
$lang['moderation_list_validate_obj']       = "Valider cet objet";
$lang['moderation_list_review_obj']         = "Verrouiller la modification";
$lang['moderation_list_delete_obj']         = "Supprimer cet objet";
$lang['moderation_del_obj_warning']         = "Vous vous apprêtez à supprimer définitivement <em>%s</em>,
                                                les informations seront définitivement perdues, êtes vous 
                                                certain de ne pas plutôt vouloir l'invalider?";
$lang['moderation_list_addRel']             = "Ajouter une relation";
$lang['moderation_list_delRel']             = "Modifier/supprimer";
$lang['moderation_list_create_doc']         = "Documenter un objet avec cette ressource";
$lang['moderation_list_delete_doc']         = "Supprimer un lien de documentation";
$lang['moderation_list_modify_ress']        = "Modifier cette ressource";
$lang['moderation_list_validate_ress']      = "Valider cette ressource";
$lang['moderation_list_delete_ress']        = "Supprimer cette ressource";
$lang['moderation_del_ress_warning']        = "Vous vous apprêtez à supprimer définitivement <em>%s</em>,
                                                les informations seront définitivement perdues, êtes vous 
                                                certain de ne pas plutôt vouloir l'invalider?";

/* End of file common.php */
/* Location : ./system/language/french/moderation_lang.php */

