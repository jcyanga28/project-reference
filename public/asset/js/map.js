$(document).ready(function(){
	$.fn.setmap = function(coordinate) {
		var wmsLayer = new ol.layer.Tile({
            source: new ol.source.OSM()
        });

        var view = new ol.View({
        	maxZoom: 19,
            center: ol.proj.transform([coordinate.lng, coordinate.lat], 'EPSG:4326', 'EPSG:3857'),
            zoom: 14
        });
        var iconGeometry = new ol.geom.Point(ol.proj.transform([coordinate.lng, coordinate.lat], 'EPSG:4326', 'EPSG:3857'));
        var iconFeature = new ol.Feature({
            geometry: iconGeometry,
            name: 'Null Island',
            population: 4000,
            rainfall: 500
        });

        var iconStyle = new ol.style.Style({
            image: new ol.style.Icon(({
                anchor: [0.5, 41],
                anchorXUnits: 'fraction',
                anchorYUnits: 'pixels',
                src: '/assets/images/marker-icon.png'
            }))
        });

        iconFeature.setStyle(iconStyle);

        var vectorSource = new ol.source.Vector({
            features: [iconFeature]
        });

        var vectorLayer = new ol.layer.Vector({
            source: vectorSource
        });
        var map = new ol.Map({
            layers: [wmsLayer, vectorLayer],
            target: $(this).attr('id'),
            view: view,
        });
        map.on('singleclick', function (evt) {
            iconGeometry.setCoordinates(evt.coordinate);
            $('#coordinates').val(ol.proj.transform(evt.coordinate, 'EPSG:3857', 'EPSG:4326'));
        });

        
  	}

    $.fn.staticmap = function(coordinate) {
        var wmsLayer = new ol.layer.Tile({
            source: new ol.source.OSM()
        });

        var view = new ol.View({
            maxZoom: 19,
            center: ol.proj.transform([coordinate.lng, coordinate.lat], 'EPSG:4326', 'EPSG:3857'),
            zoom: 14
        });
        var iconGeometry = new ol.geom.Point(ol.proj.transform([coordinate.lng, coordinate.lat], 'EPSG:4326', 'EPSG:3857'));
        var iconFeature = new ol.Feature({
            geometry: iconGeometry,
            name: 'Null Island',
            population: 4000,
            rainfall: 500
        });

        var iconStyle = new ol.style.Style({
            image: new ol.style.Icon(({
                anchor: [0.5, 41],
                anchorXUnits: 'fraction',
                anchorYUnits: 'pixels',
                src: '/assets/images/marker-icon.png'
            }))
        });

        iconFeature.setStyle(iconStyle);

        var vectorSource = new ol.source.Vector({
            features: [iconFeature]
        });

        var vectorLayer = new ol.layer.Vector({
            source: vectorSource
        });
        var map = new ol.Map({
            layers: [wmsLayer, vectorLayer],
            target: $(this).attr('id'),
            view: view,
        });
    }
});