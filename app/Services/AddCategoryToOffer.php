<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

class AddCategoryToOffer
{
    public static function fillOfferList($listOffers, $listCategories){
        $listFilledArray = array();
        Log::debug(json_encode($listCategories));
        foreach( $listOffers as $offer ){
            $offer->setCategoryName($listCategories[$offer->getIdCategory()]);
            array_push($listFilledArray, $offer);
        }
        return $listFilledArray;

    }
}
