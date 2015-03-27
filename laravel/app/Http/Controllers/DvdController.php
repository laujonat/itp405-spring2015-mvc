<?php 
namespace App\Http\Controllers;
 
use App\Models\Dvd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\RottenTomatoes; 


class DvdController extends Controller {

    public function search() {
        $query = new Dvd();
        $genres = $query->getAllGenres();
        $ratings = $query->getAllRatings();

        return view('search', [
            'genres' => $genres,
            'ratings' => $ratings
        ]);
    }
    public function results(Request $request) {
        // if (!$request->input('dvd_title')) {
        //     return redirect('/dvds/search');
        // }
        $title = $request->input('titleInput');
        $genre = $request->input('genreSelect');
        $rating = $request->input('ratingSelect');
        $dvds = (new Dvd())->search($title, $genre, $rating);
        $genre_name = (new Dvd())->getGenreName($genre);
        $rating_name = (new Dvd())->getRatingName($rating);
        
        return view('results', [
            'titleInput' => $title,
            'genreSelect' => $genre,
            'ratingSelect' => $rating,
            'dvds' => $dvds
        ]);
    }

    public function details($id) {
        
        $query = new Dvd(); 
        $dvd = $query->searchReviewId($id); 
        $reviews = $query->getReview($id);
        
        $title = explode(" ", $dvd->title); 
        $titleSearch = implode("+", $title); 
        
        $rottentomatoes = new RottenTomatoes();
        $jsonString = $rottentomatoes->search($titleSearch); 
        
        $jj = json_encode($jsonString);
        $dvds = json_decode($jj);
        $rData =  null;
        if(array_key_exists("movies", $dvds)){
            $dvds = $dvds->movies; 
            foreach($dvds as $dd) {
                if((strcasecmp($dd->title, $dvd->title) >= -1 || (strcasecmp($dd->title, $dvd->title) <= 1))&& $dd->mpaa_rating == $dvd->rating_name){
                    $rData = $dd;
                    break;
                }
            }
        }
        
        return view('reviews', [
            'dvd_id' => $id,
            'dvd' => $dvd,
            'reviews' => $reviews,
            'rData' => $rData   
        ]); 
        
    }    
        
    public function storeReview($id, Request $request) {
        $validate =  Dvd::validate($request->all());
        if($validate->passes()){
            Dvd::addReview([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'rating' => $request->input('rating'),
                'dvd_id' => $id
            ]);
            return redirect('dvds/' . $id)->with('success', 'Review successfully inserted into database.');
        } else {
            return redirect('dvds/'.$id)
                ->withInput()
                ->withErrors($validate);
        }
    }

    public function postDvd(Request $request) {

        $validation = \Validator::make($request->all(),[
            'title' => 'required'
        ]);
        if($validation->passes()) {
            $dvd = new Dvd();
            $dvd->title = $request->input('title');
            $dvd->genre_id = $request->input('genre_id');
            $dvd->rating_id = $request->input('rating_id');
            $dvd->label_id = $request->input('label_id');
            $dvd->sound_id = $request->input('sound_id');
            $dvd->format_id = $request->input('format_id');
            $dvd->save();

            return redirect('dvds/create')->with('success', 'You sucessfully created a new DVD');
        } else {
            return redirect('dvds/create')
                ->withInput()
                ->withErrors($validation);
        }
        
    }

    public function create() {
        $ratings = Dvd::getAllRatings();
        $genres = Dvd::getAllGenres();
        $labels = Dvd::getAllLabels();
        $sounds = Dvd::getAllSounds();
        $formats = Dvd::getAllFormats();

        return view('create', [
            'genre' => $genres,
            'rating' => $ratings,
            'label' => $labels,
            'sound' => $sounds,
            'format' => $formats,
        ]);
    }
}
?>