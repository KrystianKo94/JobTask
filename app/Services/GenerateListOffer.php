<?php

namespace App\Services;

use App\Models\Address;
use App\Models\Offer;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class GenerateListOffer
{

    public function generateSpecialData($data)
    {
        $offer = new Offer();
        $address = new Address();
        $listOffers = array();
        foreach ($data as $element){
            $offer = new Offer();
            $address = new Address();
            $offer->setIdCategory($element->mainCategory);
            $offer->setTitle($element->title);
            if(isset($element->shortDescription)){
                $offer->setDescription($element->shortDescription);
            }
            else{
                if(isset($element->longDescription)){
                    Log::alert("[GenerateListOffer:generateSpecialData]: Brak krótkiego opisu, dodnie długiego opisu ");
                    $offer->setDescription($element->longDescription);
                }
                else{
                    Log::alert("[GenerateListOffer:generateSpecialData]: Brak długiego i krótkiego opisu, wstawiam pustą wartość");
                    $offer->setDescription('Brak opisu');
                    Log::debug("[GenerateListOffer:generateSpecialData]: Dane : ".json_encode($element));
                }

            }
            if(isset($element->events[0]->address->city)){
                $address->setCity($element->events[0]->address->city);
            }
            else{
                Log::alert("[GenerateListOffer:generateSpecialData]: Brak wprowadzonej nazwy miejscowości, wprowadzanie miejscowiści Wrosław");
                $address->setCity('Wrocław');
            }
            if(isset($element->events[0]->address->country)){
                $address->setCountry($element->events[0]->address->country);
            }
            else{
                Log::alert("[GenerateListOffer:generateSpecialData]: Brak wprowadzonej nazwy kraju, wprowadzanie wartości domyślnej: Polska");
                $address->setCountry('Polska');
            }
            if(isset($element->events[0]->address->street)){
                $address->setStreet($element->events[0]->address->street);
            }
            else{
                Log::info("[GenerateListOffer:generateSpecialData]: Brak nazwy ulicy, wprowadzanie puste wartości");
                $address->setStreet('');
            }
            if(isset($element->events[0]->address->zipCode)){
                $address->setZipCode($element->events[0]->address->zipCode);
            }
            else{
                Log::alert("[GenerateListOffer:generateSpecialData]: Brak kodu pocztowego, wporwadzanie pustej wartości");
                $address->setZipCode('');
            }
            if(isset($element->events[0]->startDate)){
                $offer->setStartEvent($element->events[0]->startDate);
            }
            else{
                Log::alert("[GenerateListOffer:generateSpecialData]: Brak daty wydarzenia ustawianie aktualnej daty");
                $offer->setStartEvent(Carbon::now());
            }
            $offer->setAddress($address);
            array_push($listOffers,$offer);
        }
        return $listOffers;
    }
}
