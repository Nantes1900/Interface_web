// get relative path for json coordinates file
var l = window.location;
var base_url = l.protocol + "//" + l.host + "/";
var coord_file = base_url + "assets/utils/coordonnees.json";

// create a map in the "map" div, set the view to a given place and zoom
var map = L.map('map').setView([47.2, -1.575], 14);

// add an OpenStreetMap tile layer
L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

//get json content
$.getJSON(coord_file, function(json) { // this will show the info it in firebug console
	for (var row in json) {
		// add a marker in the given location, attach some popup content to it and open the popup
		if (json[row].latitude !== '') //Do not handle entries with no geographical information
		{
                        var popupText = '<b>'+json[row].nom_objet+'</b><br>'+
                                    json[row].resume;
                            
                        if (json[row].date_debut_geom !== null && json[row].date_fin_geom !== null){
                            popupText += '<br><br> du '+dateToDMY(json[row].date_debut_geom)+' au '+dateToDMY(json[row].date_fin_geom);
                            popupText += '<br> précision au '+json[row].date_precision;
                        }    
                        popupText += '<br><br><a href="'+base_url+'view_data/view_data/view_objet/'+json[row].objet_id+'"> Voir l\'objet </a>'
                        //if the user has a level equal or superior to 5 (moderateur), he will be allowed
                        //to delete the geometry of an objet which will no longer appear on the map
                        if($('span#moderateur').attr('id')=='moderateur'){ 
                                popupText += '<br><a href="'+base_url+'moderation/modify_objet/delete_geom/'+
                                            json[row].geom_id+'/'+json[row].objet_id+'"> Supprimer le marqueur </a>';
                        }
                        if(json[row].typeGeom == 'POINT'){
                            marker = L.marker([json[row].latitude, json[row].longitude]).addTo(map).
                                bindPopup(popupText);
                        } else if (json[row].typeGeom == 'POLYGON') {
                            var arrayLng = json[row].longitude.split(" ");
                            var arrayLat = json[row].latitude.split(" ");
                            var length = arrayLng.length;
                            if (length === arrayLat.length){
                                var LatLngs = [];
                                for (var i = 0; i<length; i++){
                                    if (arrayLat[i]!=='' && arrayLng[i]!==''){
                                        var latlng = new L.LatLng(arrayLat[i], arrayLng[i]);
                                        LatLngs.push(latlng);
                                    }
                                }
                                var polygon = new L.Polygon(LatLngs, {color: 'blue'}).addTo(map).
                                bindPopup(popupText);;
                            }
                        } 
		}
	}
});


//if the user has a level equal or superior to 4 (chercheur), the following script will apply

if($('p#chercheur').attr('id')=='chercheur'){ 
    //adding a new temporary marker to add objet
    map.on('dblclick', function(e){
        var latitude = e.latlng.lat;
        var longitude = e.latlng.lng;
        newMarker = L.marker([latitude, longitude],{draggable:true}).addTo(map).bindPopup('<b style="color : blue"> Nouvel objet ! </b><br>'+
                '<a href="'+base_url+'data_center/ajout_objet/select_objet_geo/add_geo/'+latitude+'/'+longitude+
                '"> Cliquez ici pour lier un objet existant à cet emplacement </a> <br>'+
                '<a href="'+base_url+'data_center/ajout_objet/formulaire_objet_geo/'+latitude+'/'+longitude+
                '"> Cliquez ici pour créer un nouvel objet à cet emplacement </a>'   ).openPopup();
        
        //this create the opportunity to drag and drop the marker, updating the location of the future objet
        newMarker.on('dragend', function(e){
            var latlng = this.getLatLng();
            var content = '<b style="color : blue"> Nouvel objet ! </b><br>'+
                '<a href="'+base_url+'data_center/ajout_objet/select_objet_geo/add_geo/'+latlng.lat+'/'+latlng.lng+
                '"> Cliquez ici pour lier un objet existant à cet emplacement </a> <br>'+
                '<a href="'+base_url+'data_center/ajout_objet/formulaire_objet_geo/'+latlng.lat+'/'+latlng.lng+
                '"> Cliquez ici pour créer un nouvel objet à cet emplacement </a>';
            this.unbindPopup().bindPopup(content).openPopup();
        });
    });
}
if($('p#addPolygon').attr('id')=='addPolygon'){ 
    //adding a temporary polygon to the map
    var coord = new Array();
    var polyline = new L.Polyline(coord, {color: 'red'}).addTo(map);
    var polygon = new L.Polygon(coord, {color: 'green'});
    map.on('click', function(e){
        coord.push(e.latlng);
        polyline.setLatLngs(coord);
        
    });
    
    $("button#delPolygon").click(function(){
        coord = [];
        polyline.setLatLngs(coord);
        polygon.setLatLngs(coord);
    });
    
    $("button#okPolygon").click(function(){
        var length = coord.length;
        if(length>1){
            polygon.setLatLngs(coord).addTo(map);
            polyline.setLatLngs([]);
            //getting latitudes and longitudes
            var lats = '';
            var lngs = '';
            for(var i=0; i<length; i++){
                if(i!=0){
                    lats = lats+'%20';
                    lngs = lngs+'%20';
                }
                lats = lats+coord[i].lat;
                lngs = lngs+coord[i].lng;
            }
            //creating the popup
            var objet_id = $('div#objet_id').html();
            var popupText = '<b style="color : blue"> Nouvel objet ! </b><br>'+
                    '<form action="'+base_url+'data_center/ajout_objet/geometry_form/'+lats+'/'+lngs+'" method="post" accept-charset="utf-8">'+
                    '<input type="hidden" name="objet_id" value="'+objet_id+'" />'+
                    '<input type="hidden" name="latitudes" value="'+lats+'" />'+
                    '<input type="hidden" name="longitudes" value="'+lngs+'" />'+
                    '<input type="submit" value="Enregistrer ce polygone" />'+
                    '</form>';
            polygon.bindPopup(popupText);
            coord = [];
        }
    });
}

//zooming if a focus on a particular objet was in arguments of the page
if($('div#latitude').attr('id')=='latitude'){ 
    var lat = $('div#latitude').html();
    var lng = $('div#longitude').html();
    
    map.setView([lat, lng], 18);
}

//small js function to convert y-m-d to d/m/y
function dateToDMY(date){
    var ymdArrayDate = date.split("-");
    return ymdArrayDate[2]+"/"+ymdArrayDate[1]+"/"+ymdArrayDate[0];
}