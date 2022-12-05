<?php

namespace App\Http\Controllers;

use App\Models\Cache;
use App\Services\AddCategoryToOffer;
use App\Services\ConvertStringDataToTimestamp;
use App\Services\GenerateCategories;
use App\Services\GenerateListOffer;
use App\Services\GenerateNameCategory;
use App\Services\ListOfferFullGenerator;
use App\Services\OfferCSV;
use App\Services\OfferGenerateFromApi;
use App\Singletons\RestApiConnection;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class JobController extends Controller
{
    public function main (){
        $cache = new Cache();
        $location = $cache->getFileLocation(Carbon::now());
        $listOffers = array();
        if(!is_null($location)){
            Log::debug("[HomeworkController:main]: Pobieranie danych z cache-u CSV = ".$location);
            $offerCSV = new OfferCSV();
            $listOffers=$offerCSV->read($location,env("FILE_CSV_SEPARATOR"));
        }
        else{
            Log::debug("[HomeworkController:main]: Brak cache-u konieczność pobrania danych z API");
            $listOffers= ListOfferFullGenerator::generateListOffer();
        }
        echo "<ol>";
        foreach ($listOffers as $offer){
            echo '<li>'.$offer->separateClass(';').'</li>';
        }
        echo '</ol>';
    }
}
