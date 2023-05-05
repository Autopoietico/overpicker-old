<?php

namespace App\Controllers;

use App\Models\Section;

class IndexController extends BaseController{

    public $DATES = [

        'LAST_DATA_UPDATE' => "2021-12-23",
        'COPY_DATE' => "2022"
    ];

    public function homeAction(){

        $title = ' - Overwatch tool made to build Composition based in Counter and Synergies';

        return $this->renderHTML('section-home.twig', [
            'title' => $title,
            'lastUpdate' => $this->DATES['LAST_DATA_UPDATE'],
            'copy' => $this->DATES['COPY_DATE']
        ]);
    }

    public function tiersAction(){

        //Download all the data necessary for the tiers page
        $url_heroes = "https://api.overpicker.win/hero-info";
        $url_tiers = "https://api.overpicker.win/hero-tiers";
        $url_img = "https://api.overpicker.win/hero-img";

        $data_heroes = file_get_contents($url_heroes);
        $data_tiers = file_get_contents($url_tiers);
        $data_img = file_get_contents($url_img);

        //converting string to objects
        $heroes_obj = json_decode($data_heroes, true);
        $tiers_obj = json_decode($data_tiers, true)[0]; //[0] this number means Top 500
        $img_obj = json_decode($data_img, true);

        //empty array
        $sorted_heroes = array();

        foreach($heroes_obj as $heroe){

            $item = [];//Empty object to be added in the array

            $item["name"] = $heroe["name"];
            $item["role"] = $heroe["general_rol"];
            $item["description"] = $heroe["description"];
            $item["value"] = $tiers_obj['hero-tiers'][$heroe["name"]]; //values are stored in the tiers json

            foreach($img_obj as $img){

                if($img["name"] == $heroe["name"]){

                    $item["img"] = $img["profile-img"]; //values are stored in the img json
                }
            }
            
            array_push($sorted_heroes, $item);
        }

        $title = ' - Tiers';

        return $this->renderHTML('section-tiers.twig', [
            'title' => $title,
            'lastUpdate' => $this->DATES['LAST_DATA_UPDATE'],
            'copy' => $this->DATES['COPY_DATE'],
            'tiers' => $sorted_heroes
        ]);
    }

    public function aboutAction(){

        $title = ' - About';

        return $this->renderHTML('section-about.twig', [
            'title' => $title,
            'lastUpdate' => $this->DATES['LAST_DATA_UPDATE'],
            'copy' => $this->DATES['COPY_DATE']
        ]);
    }

    public function sourcesAction(){

        $title = ' - Sources';

        return $this->renderHTML('section-sources.twig', [
            'title' => $title,
            'lastUpdate' => $this->DATES['LAST_DATA_UPDATE'],
            'copy' => $this->DATES['COPY_DATE']
        ]);
    }

    public function noRouteAction(){

        $title = ' - Error 404';
        
        return $this->renderHTML('section-404.twig', [
            'title' => $title,
            'lastUpdate' => $this->DATES['LAST_DATA_UPDATE'],
            'copy' => $this->DATES['COPY_DATE']
        ]);
    }
}