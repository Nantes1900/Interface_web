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
            //convert text geometry to geomType, latitude and longitude
            $objetArray = geomTxtToLatLng($objetArray);
            $jsonList[] = json_encode($objetArray);
        }
        $list = implode(', ', $jsonList);
        $fileContent = '[' . $list . ']';
        file_put_contents(FCPATH . '/assets/utils/coordonnees.json', $fileContent);
    }
}

if (!function_exists('geomTxtToLatLng')) {
    //get an array with a geometry in text form
    //convert so that the array contains latitude and longitude
    //and also a typeGeom attribute
    function geomTxtToLatLng($geomArray){
        $geomTxt = $geomArray['geomtxt'];
        unset($geomArray['geomtxt']);
        if(preg_match("#^POINT#", $geomTxt)) {
            $geomArray['typeGeom'] = 'POINT';
        } elseif(preg_match("#^POLYGON#", $geomTxt)) {
            $geomArray['typeGeom'] = 'POLYGON';
        }
        $geomSplit = preg_split("/[\s\(\)\,]+/", $geomTxt);
        $length = count($geomSplit);
        $geomArray['longitude'] = '';
        $geomArray['latitude'] = '';
        for($i=2; $i<$length-1; $i=$i+2){
            $geomArray['latitude'] .= $geomSplit[$i].' ';
            $geomArray['longitude'] .= $geomSplit[$i-1].' ';
        }
        return $geomArray;
    }
}
/* End of file geom_helper.php */
/* Location : ./application/models/geom_helper.php */

