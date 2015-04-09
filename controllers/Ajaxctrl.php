<?php
class Ajaxctrl {

    public function __construct(){
        $pdo = DataBaseModel::connect();
        $result= $pdo->select('* ')->from($_GET['table'])->exec();
        DataContModel::getInstance()->setData($result);
    }

}
