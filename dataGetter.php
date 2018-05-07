<?php
class dataGetter{
    public $returns;
    public $measures;
    public $db;
    public $allMeasures;
    function __construct($db)
    {
      $recentMeasure = $db->prepare("SELECT * FROM sensor");
      $recentMeasure->execute();
      $this->returns = $recentMeasure->fetchAll();

      $this->db = $db;

      $recentMeasure = $db->prepare("SELECT decibel, MAX(timeTaken), sensorId FROM sensorintel");
      $recentMeasure->execute();
      $this->measures = $recentMeasure->fetch(PDO::FETCH_ASSOC);

      $recentMeasure = $db->prepare("SELECT * FROM `sensorintel`");
      $recentMeasure->execute();
      $this->allMeasures = $recentMeasure->fetchAll(PDO::FETCH_ASSOC);
    }
    function getReturn(){
        return $this->returns;
    }
    function getMeasure(){
        return $this->measures;
    }
    function getAllRecs(){
        return $this->allMeasures;
    }
}
?>