<?php


class LocalStorageCtrl {
    public function __construct() {
        if(isset($_POST['guest'])) {
            $json = $_POST['guest'];
            $json = (json_decode($json, true));
            echo $json;
            foreach ($json as $key => $val) {
                if ($val['book'] == 0) {

                } else {
                   DataContModel::getInstance()->setData($json);
                    exit;
                }
            }
        }
    }
} 