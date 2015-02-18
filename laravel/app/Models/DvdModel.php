<?php 
namespace App\Models;

use DB;  

class DvdModel {

	public function getAllGenres() {

		return DB::table('genres')->get();

	}

	public function getAllRatings() {

		return DB::table('ratings')->get();
	
	}

	public function getGenreName($genre_id) {
        $query = DB::table('genres')
            ->where('id', '=', $genre_id)
            ->select('genre_name');
        return $query->first();
    }
    
    public function getRatingName($rating_id) {
        $query = DB::table('ratings')
            ->where('id', '=', $rating_id)
            ->select('rating_name');
        return $query->first();
    }

	public function search($title, $genre, $rating) {
		$query = DB::table('dvds')
			->join('genres', 'genres.id', '=', 'dvds.genre_id')
            ->join('ratings', 'ratings.id', '=', 'dvds.rating_id')
            ->join('labels', 'labels.id', '=', 'dvds.label_id')
            ->join('sounds', 'sounds.id', '=', 'dvds.sound_id')
            ->join('formats', 'formats.id', '=', 'dvds.format_id');

            if($title) {
            	$query->where('title', 'LIKE', '%' . $title .'%');
        	}
        	if($genre) {
				$query->where('genre_id', '=', $genre);
			}

			if($rating) {
				$query->where('rating_id', '=', $rating);
			}

			return $query->get();

	}

}

?>