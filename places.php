<?php
require( '_system/config.php' );
require( '_system/autoload.php' );

$map = new \PHPGoogleMaps\Map;

$map->setCenter( 'New York, NY' );
$map->setZoom( 10 );
$map->enablePlacesAutocomplete(array('autocomplete_input_id' => 'places_input'));
$map->enableInfoWindows();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Places - <?php echo PAGE_TITLE ?></title>
    <link rel="stylesheet" type="text/css" href="_css/style.css">
    <?php $map->printHeaderJS() ?>
    <?php $map->printMapJS() ?>
</head>
<body>

<h1>Places</h1>
<p>You must write your own listener for the 'place_changed' event.</p>
<script type="text/javascript">
google.maps.event.addDomListener(window, "load", 

    function(){
        google.maps.event.addListener(map.autocomplete, 'place_changed', function() {
        map.info_window.close();
        marker = new google.maps.Marker({map: map.map});
        marker.setVisible(false);
        var place = map.autocomplete.getPlace();
        if (!place.geometry) {
            alert( 'Place not found' );
            return;
        }

        // If the place has a geometry, then present it on a map.
        if (place.geometry.viewport) {
            map.map.fitBounds(place.geometry.viewport);
        }
        else {
            map.map.setCenter(place.geometry.location);
            map.map.setZoom(17);  // Why 17? Because it looks good.
        }
        
        var image = {
            url: place.icon,
            size: new google.maps.Size(71, 71),
            origin: new google.maps.Point(0, 0),
            anchor: new google.maps.Point(17, 34),
            scaledSize: new google.maps.Size(35, 35)
        };
        marker.setIcon(image);
        marker.setPosition(place.geometry.location);
        marker.setVisible(true);

        var address = '';
        if (place.address_components) {
            address = [
                (place.address_components[0] && place.address_components[0].short_name || ''),
                (place.address_components[1] && place.address_components[1].short_name || ''),
                (place.address_components[2] && place.address_components[2].short_name || '')
            ].join(' ');
        }

        map.info_window.setContent('<div><strong>' + place.name + '</strong><br>' + address);
        map.info_window.open(map.map, marker);
    });
}

);

</script>

<?php $map->printMap() ?>

Places: <input type="text" id="places_input" style="width:300px;">

