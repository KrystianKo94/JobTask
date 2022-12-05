
<?php

namespace App\Services;

class GenerateCategories 
{

    public function generateSpecialData($data)
    {
        $fullArray = array();
        foreach ($data as $item){
            $fullArray += [$item->masterId => $item->name];
            foreach ($item->children as $child){
                $fullArray += [$child->masterId => $child->name];
            }
        }
        return $fullArray;
    }
}