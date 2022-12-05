<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Cache extends Model
{
    use HasFactory;

    protected $table = 'cache_info';
    protected $primaryKey = 'id';

    protected $fillable = [
        'location_file',
        'file_name',
        'date_create',
        'date_expire',
    ];

    public function saveData($location, $fileName,$time){
        $this->location_file=$location;
        $this->file_name=$fileName;
        $this->date_create=Carbon::now();
        $this->date_expire=Carbon::now()->addMinutes($time);
        $this->save();
    }

    public function getFileLocation($date){
        $cache= Cache::where('date_create', '<', $date)->where('date_expire', '>', $date)->first();
        if(!is_null($cache)){
            return $cache->location_file;
        }
        else{
            Log::info("[Cache:getFileLocation]: Plik csv jest nie aktywny lub brak pliku");
            return null;
        }
    }
}
