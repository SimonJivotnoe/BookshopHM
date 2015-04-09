<?php

class DataContModel
{
    private $whichPageStart = array();
    private $dataInPageArr = array();
    private $infoFlag = '';

    private static $_instance;
    public static function getInstance()
    {
        if(!(self::$_instance instanceof self)){
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    public function __construct()
    {
    }

    function setStartPage($startPage) {
        array_push($this->whichPageStart, $startPage);
        return $this;
    }

    function setData($dataInPageArr)
    {
        $this->dataInPageArr =  $dataInPageArr;
        return $this;
    }

    function getStartPage()
    {
        return array_splice($this->whichPageStart, 0);
    }

    function getData()
    {
        return array_splice($this->dataInPageArr, 0);

    }

    /**
     * @return string
     */
    public function getInfoFlag()
    {
        return $this->infoFlag;
    }

    /**
     * @param string $repFlag
     */
    public function setInfoFlag($repFlag)
    {
        $this->infoFlag = $repFlag;
    }
     function clearInfoFlag(){
         $this->infoFlag = '';
     }
}