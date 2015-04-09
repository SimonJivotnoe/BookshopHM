<?php


class SubstitutionModel {

    public function __construct() {

    }

    public function parseAndReplace($page, $lang){
        $htmlToString = file_get_contents(TEMPLATES . $page[0]);
            $palette = $this->getPaletteName($page[0]).'Palette';
            $palette = str_replace('"','',$palette);
            $palette = ucfirst($palette);						
            $objPalette = new $palette();
            $result = strtr($htmlToString, $objPalette->getArr());
            //var_dump($result);
            $resultLang = strtr($result, $lang);
            return $resultLang;
    }

    private function getPaletteName($page){
        return str_replace('.html', '',$page);
    }

    public function langReplace($page, $arr){
        $result = strtr($page, $arr);
        return $result;
    }
} 
