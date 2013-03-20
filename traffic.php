<?php

// This is for the examples
require( '_system/config.php' );
$relevant_code = array(
	'\PHPGoogleMaps\Layer\TrafficLayer',
	'\PHPGoogleMaps\Layer\TrafficLayerDecorator'
);

// Autoload stuff
require( '_system/autoload.php' );

$map = new \PHPGoogleMaps\Map;
$traffic = new \PHPGoogleMaps\Layer\TrafficLayer;

$map->addObject( $traffic );
$map->setCenter( 'Brisbane, QLD Australia' );
$map->setZoom( 14 );
$map->disableAutoEncompass();

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Traffic Layer - <?php echo PAGE_TITLE ?></title>
	<link rel="stylesheet" type="text/css" href="_css/style.css">
	<?php $map->printHeaderJS() ?>
	<?php $map->printMapJS() ?>
</head>
<body>

<h1>Traffic Layer</h1>
<?php require( '_system/nav.php' ) ?>

<p>Implementation of a <a href="https://developers.google.com/maps/documentation/javascript/reference#TrafficLayer">Traffic layer</a>.</p>

<?php $map->printMap() ?>

</body>

</html>


