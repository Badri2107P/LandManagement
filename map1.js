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
            center: ol.proj.transform([78.65837,10.81130], 'EPSG:4326', 'EPSG:3857'),
            zoom: 16
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
                layers: [plot,house]
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

function selectplotbyid(value)
{
console.log(value);
var cql= 'id='+value;	
	   // plot.getSource().updateParams({'LAYERS': 'plot:plot', 'TILED': true ,'CQL_FILTER': cql});
		var cqlplot =new ol.layer.Tile({
						opacity: 1,
                        source: new ol.source.TileWMS({
						url: 'http://localhost:8080/geoserver/plot/wms',
						params: {'LAYERS': 'plot:plot', 'TILED': true ,'CQL_FILTER': cql },
						serverType: 'geoserver',
						// Countries have transparency, so do not fade tiles:
						transition: 0
					  }),
                    });
if(!value){
			console.log("null");
			plot.setOpacity(1);	
			cqlplot.setOpacity(0);
}else{
	console.log("notnull");
					plot.setOpacity(0.3);
					map.addLayer(cqlplot);

}
}

function selectaadharidasset(value)
{
console.log(value);
var cql= 'aad_no='+value;	
	   // plot.getSource().updateParams({'LAYERS': 'plot:plot', 'TILED': true ,'CQL_FILTER': cql});
		var cqlplot =new ol.layer.Tile({
						opacity: 1,
                        source: new ol.source.TileWMS({
						url: 'http://localhost:8080/geoserver/plot/wms',
						params: {'LAYERS': 'plot:plot', 'TILED': true ,'CQL_FILTER': cql },
						serverType: 'geoserver',
						// Countries have transparency, so do not fade tiles:
						transition: 0
					  }),
                    });
if(!value){
			console.log("null");
			plot.setOpacity(1);	
			cqlplot.setOpacity(0);
}else{
	console.log("notnull");
					plot.setOpacity(0.3);
					map.addLayer(cqlplot);

}
}
function selecthouse()
{
//console.log("js");
	var plotid=document.getElementById("watersupply").value;
	var cql= 'name='+plotid;
	//document.write(cql);
	    watersupply.getSource().updateParams({'LAYERS': 'plot:watersupply', 'TILED': true ,'CQL_FILTER': cql});
}

function getplotvalue(attribute,value1,value2)
{
	//console.log(value1);

		if(attribute==1){
		var cql= 'bk_val<'+ value1;
	}
	if(attribute==2){
		var cql= 'bk_val>'+ value1;
	}
	if(attribute==3){
		var cql= 'bk_val BETWEEN ' + value1 + ' AND '+ value2;
	}
	//console.log(cql);
	   var cqlplot =new ol.layer.Tile({
						opacity: 1,
                        source: new ol.source.TileWMS({
						url: 'http://localhost:8080/geoserver/plot/wms',
						params: {'LAYERS': 'plot:plot', 'TILED': true ,'CQL_FILTER': cql },
						serverType: 'geoserver',
						// Countries have transparency, so do not fade tiles:
						transition: 0
					  }),
                    });
					if(!value1 ||!value2){
			console.log("null");
			plot.setOpacity(1);	
			cqlplot.setOpacity(0);
}else{
	console.log("notnull");
					plot.setOpacity(0.3);
					map.addLayer(cqlplot);
	}
}


