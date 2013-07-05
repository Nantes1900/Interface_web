<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * This contains the function to update the coordonnes.json file
 * which is used to render the map and create markers (addmarkers.js)
 *
 * @author paulyves
 */
if (!function_exists('update_coordonnees')) {
    //update coordonnes.json file, should be called after each modification
    //in objet and temp_geom table
    function update_coordonnes() {
        $objetManager = new Objet_model();
        $listObjet = $objetManager->get_objet_geo_list();

        $jsonList = array();

        foreach ($listObjet as $objetArray) {
            $jsonList[] = json_encode($objetArray);
        }
        $list = implode(', ', $jsonList);
        $fileContent = '[' . $list . ']';
        file_put_contents(FCPATH . '/assets/utils/coordonnees.json', $fileContent);
    }

}
/* End of file geom_helper.php */
/* Location : ./application/models/geom_helper.php */

