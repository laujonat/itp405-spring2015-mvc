<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use Validator;


class Dvd extends Model{
    
    public static function getAllRatings() {
        
        return DB::table('ratings')->get();
    
    }
    public static function getAllGenres() {
        
        return DB::table('genres')->get();
    
    }
    public static function getAllLabels() {

        return DB::table('labels')->get();
    
    }
    
    public static function getAllSounds() {
        
        return DB::table('sounds')->get();
    
    }
    
    public static function getAllFormats() {
        
        return DB::table('formats')->get();
    
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
            ->join('formats', 'formats.id', '=', 'dvds.format_id')
            ->select('*', 'dvds.id');
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

    public function searchReviewId($id){
        $results = DB::table('dvds')
          ->join('ratings', 'ratings.id', '=', 'dvds.rating_id')
          ->join('genres', 'genres.id', '=', 'dvds.genre_id')
          ->join('labels', 'labels.id', '=', 'dvds.label_id')
          ->join('sounds', 'sounds.id', '=', 'dvds.sound_id')
          ->join('formats', 'formats.id', '=', 'dvds.format_id')
          ->where('dvds.id', '=', $id)
          ->get(array(
                'dvds.id',
                'title',
                'rating_name',
                'genre_name',
                'label_name',
                'sound_name',
                'format_name',
                'release_date'
            ));
        
        foreach ($results as $result){
            return $result; 
        }
    }
     public static function validate($input) {

        return Validator::make($input, [
            'title' => 'required|min:5',
            'description' => 'required|min:20',
            'rating' => 'required|integer'
        ]);
    }
}
?>