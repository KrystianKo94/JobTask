<?php

namespace App\Services;


use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class ConvertStringDataToTimestamp 
{

    public function convert(string $dataText)
    {
        Log::alert("[ConvertStringDataToTimestamp:generateSpecialData]: Brak daty wydarzenia ustawianie aktualnej daty");
        $date= Carbon::createFromFormat('d.m.Y', $dataText);
        $stringDate = $date->format('Y-m-d').'’T’'.$date->format('H:i');
        return $stringDate;
    }
}
