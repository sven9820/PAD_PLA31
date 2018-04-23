<?php
include "output.php";
class chart extends output{

    public $dataPoints;
    function __construct()
    {
    }

    function make($sensorId, $allRecords)
    {
        $this->dataPoints = array();

        foreach($allRecords as $key){

            if($select = ($key["sensorId"] == $sensorId)){
                //echo ($key["timeTaken"]."   ".$key["decibel"]);
                array_push($this->dataPoints, array("label"=> $key["timeTaken"],
                "y"=> $key["decibel"]));
            }

        }
        echo "var chart = new CanvasJS.Chart(\"chartContainer\", {
	animationEnabled: true,
	//theme: \"light2\",
	title:{
		text: \"Noise\"
	},
	axisX:{
		crosshair: {
			enabled: true,
			snapToDataPoint: true
		}
	},
	axisY:{
		title: \"in Decibels\",
		crosshair: {
			enabled: true,
			snapToDataPoint: true
		}
	},
	toolTip:{
		enabled: false
	},
	data: [{
		type: \"area\",
		dataPoints: ".json_encode($this->dataPoints, JSON_NUMERIC_CHECK)."
	}]
});
chart.render();


";
    }
}
?>