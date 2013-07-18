<?php

//csv webpage
$lang['csv_title']            = "Importer plusieurs élément via un fichier CSV";
$lang['csv_title_hint']       = "Pour plus d'informations, consultez le tutoriel. <br/> 
                                 Pensez à utiliser les modèles fournis dans la section téléchargement.";
$lang['csv_no_transaction']   = "Importer les informations au mieux (ce qui ne contient pas d'erreur sera enregistré)";
$lang['csv_transaction']      = "Ne rien importer s'il y a la moindre erreur";
$lang['csv_import_button']    = "Importer";

$lang['csv_total_success']    = "Votre fichier csv de type %s a bien été importé";
$lang['csv_total_failure']    = "<b>Echec</b> : votre fichier csv de type %s contenait 
                                 %d erreur(s) et n'a pas été importé";
$lang['csv_partial_success']  = "<b>Malheureusement</b>, le(s) %s suivant(es) n'ont pas pu être entré(e)s : ";
$lang['csv_advice']           = "Essayez de revoir leur mise en forme et vérifier que votre fichier csv 
                                 est conforme aux instructions, ou encore de voir s'il n'existe pas déjà 
                                 des objets de même nom. Si le problème persiste, contactez un modérateur.";
$lang['csv_continue']         = "Vous pouvez continuer à en charger d'autres";

//csv error message
$lang['csv_rel_date_begin']         = " (date de début de relation non valide)";
$lang['csv_rel_date_end']           = " (date de fin de relation non valide)";
$lang['csv_rel_error_begin']        = "la relation entre <b>%s</b> et <b>%s</b>";
$lang['csv_rel_invalid']            = " (objets trouvés mais informations non valides)";
$lang['csv_rel_unknown']            = " (objets trouvés mais type de relation (label) non valide)";
$lang['csv_rel_do_not_exist']       = " n'existe pas";
$lang['csv_rel_crit_error']         = "Le fichier n'a pas pu être reconnu, vérifiez le format et les séparateurs de votre fichier csv";

$lang['csv_obj_general']            = " (information générales)";
$lang['csv_obj_already_exist']      = " (objet déjà existant)";
$lang['csv_obj_geom_or_date']       = " (géométrie ou dates)";

$lang['csv_ress_already_exist']     = " existe déjà, ";
$lang['csv_ress_date_begin']        = "date de début de ressource non valide, ";
$lang['csv_ress_img_date_begin']    = "date de prise de vue non valide, ";
$lang['csv_ress_vid_date_begin']    = "date de production non valide, ";
$lang['csv_ress_pagination']        = "nombre de page (pagination) non valide (utiliser un entier), ";
$lang['csv_ress_color']             = "couleur non valide, utiliser TRUE ou FALSE, ";

$lang['csv_doc_error_begin']        = "la documentation entre <b>%s</b> et <b>%s</b>";
$lang['csv_doc_no_type']            = " (le type de documentation ne correspond pas à \"textuelle\", \"graphique\" ou \"video\")";
$lang['csv_doc_do_not_exist']       = " n'existe pas, ";
/* End of file common.php */
/* Location : ./system/language/french/csv_lang.php */