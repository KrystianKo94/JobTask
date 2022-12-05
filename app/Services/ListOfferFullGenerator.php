<?php

namespace App\Services;

use App\Models\Cache;
use Carbon\Carbon;
use App\Services\OfferGenerateFromApi;
use App\Singletons\RestApiConnection;
use App\Services\AddCategoryToOffer;
use App\Services\ConvertStringDataToTimestamp;
use App\Services\GenerateCategories;
use App\Services\GenerateListOffer;
use App\Services\GenerateNameCategory;

class ListOfferFullGenerator
{
        public static function generateListOffer(){
            $offerCSV = new OfferCSV();
            $cache = new Cache();
            $converterDate = new ConvertStringDataToTimestamp();
            $convertOfferService = new GenerateListOffer();
            $converter = new GenerateCategories();
            $ids = array();
            $fileName = 'list_offer'.Carbon::now()->format('dmYHis').'.csv';
            $fileLocation = 'storage/app/public/'.$fileName;
            $items = OfferGenerateFromApi::generateDataFromApi(RestApiConnection::getClient(),
                                      env("WROCLAW_API_KEY"),
                                      env("LIMIT_OFFER_ONE_REQUEST"),
                                      $converterDate->convert(env("DATE_SIENCE_REQUEST")),
                                      'eventDate');
            $listOffer=$convertOfferService->generateSpecialData($items);
            foreach ($listOffer as $offer){
                array_push($ids,$offer->getIdCategory());
            }
            $ids =array_unique($ids);
            $masterIds = implode(',',$ids);
            $listFullCategories = GenerateNameCategory::getCategoriesByIds(
                RestApiConnection::getClient(),
                env("WROCLAW_API_KEY"),
                $masterIds,
                'pl'
            );
            $listSpecial=$converter->generateSpecialData($listFullCategories);
            $listOffer=AddCategoryToOffer::fillOfferList($listOffer, $listSpecial);
            $offerCSV->save($fileLocation,$listOffer,env("FILE_CSV_SEPARATOR"));
            $cache->saveData($fileLocation,$fileName,env("CACHE_TIME_LIFE"));
            return $listOffer;
        }
}
