<?php 

namespace App\Services;
use Illuminate\Support\Facades\Cache;
class RottenTomatoes {
    
    public function search($dvd_title) {
        
        if(Cache::has("rottentomato-$dvd_title")) {
       
        	$jsonString = Cache::get("rottentomato-$dvd_title");

       } else {
     
        	$url = "http://api.rottentomatoes.com/api/public/v1.0/movies.json?page=1&apikey=zbs499s75azv8rh6msfhktgf&q=$dvd_title";     
        	if(!$url) 
            	return null;
        
	        $jsonString = file_get_contents($url);
	        Cache::put("rottentomato-$dvd_title", $jsonString, 60);
   
        }
   
        $rottenTomatoData = json_decode($jsonString);
        return $rottenTomatoData->movies;
  }
}