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
			marker = L.marker([json[row].latitude, json[row].longitude]).addTo(map).
                                bindPopup('<b>'+json[row].nom_objet+'</b><br>'+
                                json[row].resume+
                                '<br><a href="'+base_url+'view_data/view_data/view_objet/'+json[row].objet_id+'"> Voir l\'objet </a>');
		}
	}
});

//Draw polygon representing mock-up bounds
var bounds = [[47.19447, -1.60970], [47.18908, -1.60863], [47.18599, -1.60611], [47.20479, -1.55415], [47.21052, -1.55556], [47.21317, -1.55857]];
L.polygon(bounds, {color: "#ff7800", weight: 5}).addTo(map);

//adding a new marker to add objet
map.on('dblclick', function(e){
    var latitude = e.latlng.lat;
    var longitude = e.latlng.lng;
    newMarker = L.marker([latitude, longitude]).addTo(map).bindPopup('<b style="color : blue"> Nouvel objet ! </b><br>'+
                ' debug : lat '+latitude+', long :'+longitude+'<br>'+
                '<a href="'+base_url+'data_center/ajout_objet/select_objet_geo/add_geo/'+latitude+'/'+longitude+
                '"> Cliquez ici pour lier un objet existant à cet emplacement </a> <br>'+
                '<a href="'+base_url+'data_center/ajout_objet/formulaire_objet_geo/'+latitude+'/'+longitude+
                '"> Cliquez ici pour créer un nouvel objet à cet emplacement </a>'   ).openPopup();
});