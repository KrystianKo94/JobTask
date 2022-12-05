<?php

namespace App\Services;

use App\Models\Address;
use App\Models\Offer;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;


class OfferCSV 
{

    public function read($location,$separator)
    {
        Log::debug("[OfferCSV:read]: Odczytywanie danych z pliku o ścieżka = $location, separator = $separator");
        $listOffer = array();
        $csvFile = fopen(base_path($location), "r");
        while (($data = fgetcsv($csvFile, 22000,$separator )) !== FALSE) {
            $offer = new Offer();
            $address = new Address();
            $offer->setCategoryName($data[0]);
            $offer->setTitle($data[1]);
            $offer->setDescription($data[2]);
            $offer->setStartEvent($data[3]);
            $offer->setIdCategory($data[4]);
            $address->setCountry($data[5]);
            $address->setCity($data[6]);
            $address->setStreet($data[7]);
            $address->setZipCode($data[8]);
            $offer->setAddress($address);
            array_push($listOffer,$offer);
        }
        fclose($csvFile);
        return $listOffer;
    }

    public function save($location, $data,$separator)
    {
        Log::debug("[OfferCSV:save]: Zapisywanie danych z pliku o ścieżka = $location, separator = $separator");
        $file=fopen(base_path($location),'w');
        foreach ($data as $offer){
              fputs($file,$offer->separateClass($separator)."\n");
        }
        fclose($file);
    }
}

