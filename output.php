<?php
class output{
    public $data;
    function __construct($db)
    {
        $recentMeasure = $db->prepare("SELECT decibel, MAX(timeTaken), sensorId FROM sensorintel");
        $recentMeasure->bindParam(':sensor', $_POST['email']);
        $recentMeasure->execute();
        $this->data = $recentMeasure->fetch(PDO::FETCH_ASSOC);
    }
    function getData(){
        return $this->data;
    }
    function getAllRecords($item){
        $recentMeasure = $db->prepare("SELECT decibel, timeTaken, sensorId FROM sensorintel WHERE sensorId = '$item'");
        $recentMeasure->bindParam(':sensor', $_POST['email']);
        $recentMeasure->execute();
        return $recentMeasure->fetch(PDO::FETCH_ASSOC);
    }
}
?>