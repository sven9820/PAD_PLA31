<?php
session_start();//start de sessie
if (!$r = session_id()){
    header("location: login.php");
}
$db = new PDO('mysql:host=localhost;port=3307;dbname=pad;charset=utf8', 'root', 'root');//pdo verbinding voor sql queries
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
error_reporting(E_ALL);
ini_set('display_errors', 1);
include "dataGetter.php";
include "chart.php";


?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://openlayers.org/en/v4.6.4/css/ol.css" type="text/css">
    <style>
        .map {
            height: 400px;
            width: 100%;
        }
        .info{
            background-color: white;
        }
        .info2{
            background-color: white;
        }
        h2 {
            text-decoration-color: white;
        }
    </style>
    <script src="https://openlayers.org/en/v4.6.4/build/ol.js" type="text/javascript"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="font-awesome/css/font-awesome.css">
    <script src="https://openlayers.org/en/v4.6.4/build/ol.js" type="text/javascript"></script>
    <title>PAD_PLA31</title>
</head>

<body>

<!--Achtergrond foto -->
<div id="intro" class="view">
    <div class="full-bg-img"></div>

    <!--Kop -->
    <h1 class="site-heading text-center text-white d-none d-lg-block">
        <span class="site-heading-upper  mb-3">Project Agile Development Planet</span>
    </h1>

    <!-- Navigation -->
    <?php
    include "navigation.php";
    if($_SESSION['id'] = null){
        header("location: index.php");

    }
    ?>

    <section class="page-section clearfix">
        <div class="container">
            <div class="intro">
                <img class="intro-img img-fluid mb-3 mb-lg-0 rounded" src="img/intro.jpg" alt="">
                <div class="intro-text left-0 text-center bg-faded p-5 rounded">

                </div>
            </div>
        </div>
    </section>
    <h2 class="text-white">My Map</h2>
    <div id="map" name="map" class="map"></div>
    <section class="page-section cta">

        <div class="container">
            <div class="row">
                <div class="col-xl-9 mx-auto">
                    <div class="cta-inner text-center rounded">
                        <h2 class="section-heading mb-4">
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <h1><div id="info" class="info">Select a point to check noise pollution</div></h1>
    <p><div id="info2" class="info2">The measured noise pollution in decibel is: <div id="db" class="db"></div></div></p>
    <div id="chartContainer" style="height: 370px; width: 100%;">Here, have a chart!</div>
    <script type="text/javascript">
        // a planet API key is required
        var planet_api_key = '7c43e05581e94ad9b907802ec0e9c903'
        // construct an Open Layers template string for a Planet item based
        // on its item_type and item_id
        function planet_template_url(item_type, item_id) {
            return 'https://tiles{1-3}.planet.com/data/v1/' + item_type +'/' + item_id + '/{z}/{x}/{y}.png?api_key=' + planet_api_key
        }
        // the geo json geometry object bounding Amsterdam
        geo_json_geometry = {
            "type": "Polygon",
            "coordinates": [
                [
                    [4.770812988281249,52.35180401565967],[4.803771972656249,52.335863527683586],[4.859046936035155,52.323274872052195],[4.915695190429687,52.32306503077291],
                    [4.946594238281248,52.2854874074429],[4.993629455566405,52.29115758313225],[4.99774932861328,52.3008162110651],[4.986419677734374,52.32159611395241],
                    [4.938354492187499,52.33859059756017],[4.965133666992187,52.358304406670584],[5.015258789062498,52.3440442328276],[5.024528503417968,52.35012634019213],
                    [4.950370788574218,52.40503711170865],[4.879302978515625,52.42702417458642],[4.7962188720703125,52.42451192222822],[4.73785400390625,52.42639612491925],
                    [4.782485961914063,52.383667752322566],[4.770812988281249,52.35180401565967]
                ]
            ]
        }
        // a search filter for items the overlap with our chosen geometry
        geometry_filter = {
            "type": "GeometryFilter",
            "field_name": "geometry",
            "config": geo_json_geometry
        }
        // a search filter that filters out scenes with 2% or more cloud cover
        cloud_cover_filter = {
            "type": "RangeFilter",
            "field_name": "cloud_cover",
            "config": {
                "lte": 0.02
            }
        }
        // a search filter for a specific date range
        date_range_filter = {
            "type": "DateRangeFilter",
            "field_name": "acquired",
            "config": {
                "gte": "2018-01-01T00:00:00.000Z",
                "lte": "2018-03-12T00:00:00.000Z"
            }
        }
        // a search filter that combines our date range filter
        // with our geometry filter
        combined_filter = {
            "type": "AndFilter",
            "config": [geometry_filter, date_range_filter, cloud_cover_filter]
        }
        // make a search request against the Planet Data API with a specified filter
        // and item_type
        function get_items(item_type, filter, callback) {
            search_endpoint_request = {
                "item_types": [item_type],
                "filter": filter
            }
            var xhr = new XMLHttpRequest();
            xhr.open("POST", 'https://api.planet.com/data/v1/quick-search')
            xhr.setRequestHeader("Authorization", "Basic " + btoa(planet_api_key + ":"));
            xhr.setRequestHeader("Content-Type", "application/json");
            console.log(JSON.stringify(search_endpoint_request))
            xhr.onload = function (e) {
                if (xhr.readyState === 4) {
                    console.log("made it")
                    callback(JSON.parse(xhr.responseText))
                }
            }
            xhr.send(JSON.stringify(search_endpoint_request))
        }
        function build_open_layers_map(layers) {
        }
        var vectorSource = new ol.source.Vector({
        });
        // run the script
        get_items("PSScene4Band", combined_filter, function(response) {
            // add OSM as the first layer
            layers = [
                new ol.layer.Tile({
                    source: new ol.source.OSM()
                }),
                new ol.layer.Vector({
                    source: vectorSource,
                    zIndex: 100
                })
            ]
            // loop over planet items from the seach api
            // and add them as layers
            var counter = 0;
            while (counter < 1) {
                response["features"].forEach(feature =>{
                    layers.push(
                    new ol.layer.Tile({
                        source: new ol.source.XYZ({url: planet_template_url("PSScene3Band", feature["id"])})
                    })
                )
            })
                counter++;
            }
            var view = new ol.View({
                center: ol.proj.fromLonLat([4.907,52.366]),//Amsterdam coords
                zoom: 12
            })
            build_open_layers_map(layers)
            var map = new ol.Map({
                layers: layers,
                target: 'map',
                view: view
            })
            //  function buildPoint(sensorCoord, sensorId){
            //    var ting = new ol.Feature({
            //      geometry: new ol.geom.Point(ol.proj.fromLonLat([sensorCoord])),
            //    })
            //  }
            <?php
            $recentMeasure = $db->prepare("SELECT * FROM sensor");
            $recentMeasure->execute();
            foreach ($recentMeasure->fetchAll() as $key => $value) {
                echo("var ting = new ol.Feature({
          geometry: new ol.geom.Point(ol.proj.fromLonLat([");echo ($value['sensorCoord']); echo("])),
          name: '"); echo($value['sensorId']); echo("'
        })");
                $recentMeasure = $db->prepare("SELECT decibel, MAX(timeTaken), sensorId FROM sensorintel WHERE sensorId = :sensor");
                $recentMeasure->bindParam(':sensor', $value['sensorId']);
                $recentMeasure->execute();
                $results = $recentMeasure->fetch(PDO::FETCH_ASSOC);
                $measure = $results['decibel'];
                echo("
        ting.setProperties({
          'db': "); echo($measure); echo(",
          'info': '"); echo($value['sensorName']); echo("'
        })
        vectorSource.addFeature(ting)");
                echo("
        if(ting.get('db') > 60){
          ting.setStyle(new ol.style.Style({
                  image: new ol.style.Icon(/** @type {olx.style.IconOptions} */ ({
                    color: 'red',
                    crossOrigin: 'anonymous',
                    src: 'https://openlayers.org/en/v4.6.4/examples/data/dot.png'
                  }))
                }));
        }
        else if (ting.get('db') > 40) {
          ting.setStyle(new ol.style.Style({
                  image: new ol.style.Icon(/** @type {olx.style.IconOptions} */ ({
                    color: 'yellow',
                    crossOrigin: 'anonymous',
                    src: 'https://openlayers.org/en/v4.6.4/examples/data/dot.png'
                  }))
                }));
        }
        else {
          ting.setStyle(new ol.style.Style({
                  image: new ol.style.Icon(/** @type {olx.style.IconOptions} */ ({
                    color: 'green',
                    crossOrigin: 'anonymous',
                    src: 'https://openlayers.org/en/v4.6.4/examples/data/dot.png'
                  }))
                }));
        }");
            }
            $dataGetter = new dataGetter($db);
            //var_dump($dataGetter->getAllRecs());
            $chart = new chart();
            $chart->make(1, $dataGetter->getAllRecs());
            ?>
            var value = <?php echo json_encode($dataGetter->getAllRecs(), JSON_NUMERIC_CHECK);?>;
            console.log(value);

            // select interaction working on "singleclick"
            var select = new ol.interaction.Select()
            map.addInteraction(select);
            select.on('select', function(e) {
                console.log(e.target.getFeatures().item(0).getProperties().info)
                console.log(e.target.getFeatures().item(0).getProperties().db)
                var target = e.target.getFeatures().item(0).getProperties()
                document.getElementById("info").innerHTML = target.info
                document.getElementById("db").innerHTML = target.db
                console.log(target);
                console.log(dps);
                //chart = null;
                dps = [];


                for (var i = 0; i < value.length; i++) {

                    console.log(value[i])
                    if(value[i].sensorId == target.name){
                        dps.push({
                            label: value[i].timeTaken,
                            y : value[i].decibel
                        });
                    }
                }
                chart.options.data[0].dataPoints = dps;
            chart.render();


            })
            function addNoise(sensor){
                <?php
                $recentMeasure = $db->prepare("SELECT decibel, MAX(timeTaken), sensorId FROM sensorintel WHERE sensorId = :sensor");
                $recentMeasure->bindParam(':sensor', $_POST['email']);
                $recentMeasure->execute();
                $results = $recentMeasure->fetch(PDO::FETCH_ASSOC);
                $measure = $results['decibel'];
                ?>
                alert(<?php echo($measure); ?>);
            }
            addNoise();
        })
    </script>

    <footer class="footer text-faded text-center py-5">
        <div class="container">
            <p class="m-0 small">PLA 31 &copy; Project Agile Development</p>
        </div>
    </footer>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>