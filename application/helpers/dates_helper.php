<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('conc_date'))
{
        //Permet de créer automatiquement une date concaténée, et renvoie également la précision de la date
	function conc_date($jour, $mois, $annee)
	{
		//Calcul automatique de la précision de la date
                if( !$jour )
                {
                    if( !$mois )
                    {
                        $date_precision = 'Annee';
                    }
                    else
                    {
                        $date_precision = 'Mois';
                    }
                }
                else
                {
                    $date_precision = 'Jour';
                }
                
                if( !$annee )
                {
                    $date = NULL;                    
                    $date_precision = NULL;
                }
                else
                { 

                    //Calcul automatique du jour
                    if( !$jour )
                    {
                        $jour = '01';
                    }
                    
                    //Calcul automatique du mois
                    if( !$mois )
                    {
                        $mois = '01';
                    }
                    

                    //On concaténe la date complète
                    $date = $jour."/".$mois."/".$annee;
                
                }
                                               
                return array('date'=>$date,
                                'date_precision'=>$date_precision);
	}
        
}

if ( ! function_exists('conc_2_date'))
{
        //Permet de créer automatiquement une date_debut et une date_fin concaténées, et renvoie également la précision des dates
	function conc_2_date($jour_debut, $mois_debut, $annee_debut,$jour_fin,$mois_fin,$annee_fin)
        {
                //Calcul automatique de la précision de la date
                if( !$jour_debut or !$jour_fin)
                {
                    if( !$mois_debut or !$mois_fin )
                    {
                        $date_precision = 'Annee';
                    }
                    else
                    {
                        $date_precision = 'Mois';
                    }
                }
                else
                {
                    $date_precision = 'Jour';
                }
                                              
                if( !$annee_debut)
                {
                    $date_debut = NULL;
                    $date_precision = NULL;
                }
                else
                {  
                
                    //Calcul automatique du jour début
                    if( !$jour_debut )
                    {
                        $jour_debut = '01';
                    }

                    //Calcul automatique du mois début
                    if( !$mois_debut )
                    {
                        $mois_debut = '01';
                    }

                    //On concaténe la date début complète
                    $date_debut = $jour_debut."/".$mois_debut."/".$annee_debut;

                }
                
                if( !$annee_fin )
                {
                    $date_fin = NULL;                    
                    $date_precision = NULL;
                }
                else
                {    
                    //Calcul automatique du jour fin
                    if( !$jour_fin )
                    {
                        $jour_fin = '01';
                    }

                    //Calcul automatique du mois fin
                    if( !$mois_fin )
                    {
                        $mois_fin = '01';
                    }

                    //On concaténe la date fin complète
                    $date_fin = $jour_fin."/".$mois_fin."/".$annee_fin;

                }
                
                return array('date_debut'=>$date_debut,
                                'date_fin'=>$date_fin,
                                'date_precision'=>$date_precision);
        }
}

/* End of file dates_helper.php */
/* Location : ./application/helpers/dates_helper.php */
