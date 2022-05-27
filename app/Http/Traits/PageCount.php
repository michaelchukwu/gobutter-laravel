<?php

namespace App\Http\Traits;

use Stevebauman\Location\Facades\Location;

use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\RichText\Run;
use stdClass;

trait PageCount
{
    public function counter()
    {
        // get the request
        $user_agent = request()->server('HTTP_USER_AGENT');
        $ip = request()->ip();
        $location = Location::get(request()->ip());
        $link = url()->current();
        // check to see if it exists exactly
        if ($location) {
            $this->runHere($user_agent, $ip, $location->cityName, $location->countryName, $location->longitude, $location->latitude, $link);
        } else {
            $this->runHere($user_agent, $ip, null, null, null, null, $link);
        }
    }
    public function runHere($user_agent, $ip, $city, $country, $longitude, $latitude, $link)
    {
        $pageCount = DB::table('page_views')->where('ip', $ip)
            ->where('user_agent', $user_agent)
            ->where('location',  $city . ', ' . $country)
            ->where('longitude', $longitude)
            ->where('latitude', $latitude)
            ->where('link', $link);
        // if it doesnt create one with view count 1
        if ($pageCount->first()) {
            $pageCount->increment('views', 1);
            $pageCount->update(['updated_at' => now()]);
        } else {
            DB::table('page_views')->insert([
                'ip' => $ip,
                'user_agent' => $user_agent,
                'location' => $city . ', ' . $country,
                'longitude' => $longitude,
                'latitude' => $latitude,
                'link' => $link,
                'views' => 1,
                'created_at' => now()
            ]);
        }
    }
}
