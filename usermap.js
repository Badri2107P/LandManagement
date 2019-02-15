var plot =new ol.layer.Tile({
						opacity: 0.75,
						visible:true,
                        title: 'Land Layer',
                        source: new ol.source.TileWMS({
						url: 'http://localhost:8080/geoserver/plot/wms',
						params: {'LAYERS': 'plot:plot', 'TILED': true },
						serverType: 'geoserver',
						// Countries have transparency, so do not fade tiles:
						transition: 0
						
					  }),
                    });
					var house =new ol.layer.Tile({
						opacity: 1,
						visible:true,
                        title: 'House Layer',
                        source: new ol.source.TileWMS({
						url: 'http://localhost:8080/geoserver/plot/wms',
						params: {'LAYERS': 'plot:building_info', 'TILED': true },
						serverType: 'geoserver',
						// Countries have transparency, so do not fade tiles:
						transition: 0
						
					  }),
                    });
var view = new ol.View({
            center: ol.proj.transform([78.65827,10.81115], 'EPSG:4326', 'EPSG:3857'),
            zoom: 7
        })

var map = new ol.Map({
        target: 'map',
        layers: [
            new ol.layer.Group({
                'title': 'Base maps',
                layers: [
                    new ol.layer.Tile({
                        title: 'OSM',
                        type: 'base',
                        visible: true,
                        source: new ol.source.OSM()
                    })
                ]
            }),
            new ol.layer.Group({
                title: 'Overlays',
                layers: [plot,house
                ]
            })
        ],
        view
    });

    // LayerSwitcher

    var layerSwitcher = new ol.control.LayerSwitcher({
        tipLabel: 'Légende' // Optional label for button
    });
    map.addControl(layerSwitcher);

    // Popup

var popup = new Popup();
map.addOverlay(popup);

  /*  map.on('singleclick', function(evt) {
        var prettyCoord = ol.coordinate.toStringHDMS(ol.proj.transform(evt.coordinate, 'EPSG:3857', 'EPSG:4326'), 2);
        popup.show(evt.coordinate, '<div><h2>Coordinates</h2><p>' + prettyCoord + '</p></div>');
    });*/
	
function CenterMap(long, lat , zoom) {
    console.log("Long: " + long + " Lat: " + lat);
    map.getView().setCenter(ol.proj.transform([long, lat], 'EPSG:4326', 'EPSG:3857'));
    map.getView().setZoom(zoom);
}

map.on('singleclick', function(evt) {
	var viewResolution = /** @type {number} */ (map.getView().getResolution());
if(plot.getVisible()){
	var url = plot.getSource().getGetFeatureInfoUrl(evt.coordinate, viewResolution,
        'EPSG:3857', {'INFO_FORMAT': 'text/html'});
		console.log(url);
}
if(house.getVisible()){
	var url = house.getSource().getGetFeatureInfoUrl(evt.coordinate, viewResolution,
        'EPSG:3857', {'INFO_FORMAT': 'text/html'});
		console.log(url);
}

   if (url) {
	   $.post('popup_values.php', { dist: url }, function(result) { 
		//alert(result);
		//console.log(result);
		popup.show(evt.coordinate, result);
		});
  }
});