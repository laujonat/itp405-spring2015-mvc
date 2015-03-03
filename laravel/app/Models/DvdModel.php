<?php 
namespace App\Models;

use DB;  
use Validator;

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

    public static function addReview($review) {
        DB::table('reviews')->insert($review);
    }

    public function getReview($id) {
        $query = DB::table('reviews')
            ->where('dvd_id', '=', $id );
        return $query->get();
    }
    public function searchReviewId($id) {
        $results = DB::table('dvds')
            ->select('title', 'rating_name', 'genre_name', 'label_name', 'format_name', 'sound_name', 'release_date', 'dvds.id')
            ->join('genres', 'genres.id', '=', 'dvds.genre_id')
            ->join('labels', 'labels.id', '=', 'dvds.label_id')
            ->join('formats', 'formats.id', '=', 'dvds.format_id')
            ->join('sounds', 'sounds.id', '=', 'dvds.sound_id')
            ->join('ratings', 'ratings.id', '=', 'dvds.rating_id')
            ->where('dvds.id', '=', $id);
        return $results->get();
    }

     public static function validate($input) {
        // returns validator
        return Validator::make($input, [
            'title' => 'required|min:5',
            'description' => 'required|min:20',
            'rating' => 'required|integer'
        ]);
    }



}

?>