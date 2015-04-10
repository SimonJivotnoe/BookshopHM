<?php
/*
class Ajaxctrl {

    public function __construct(){
        $pdo = DataBaseModel::connect();
        $result= $pdo->select('* ')->from($_GET['table'])->exec();
        DataContModel::getInstance()->setData($result);
    }

}*/
/**
 * Class AjaxCtrl
 */
class AjaxCtrl {

    /**
     *
     */
    public function __construct(){
        $objModel = new AgentDBModel();
        $result = $objModel->selectAll($_GET['table']);
        DataContModel::getInstance()->setData($result);
    }

}
