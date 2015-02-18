<?php namespace App\Http\Controllers;
 
use App\Models\DvdModel;
use Illuminate\Http\Request;
use DB;

class DvdController extends Controller {


	public function search() {

		$query = new DvdModel();

		$genres = $query->getAllGenres();
		$ratings = $query->getAllRatings();

		return view('search', [
			'genres' => $genres,
			'ratings' => $ratings
		]);

	}

  	public function results(Request $request) {
        $title = $request->input('titleInput');
        $genre = $request->input('genreSelect');
        $rating = $request->input('ratingSelect');
        $dvds = (new DvdModel())->search($title, $genre, $rating);

        $genre_name = (new DvdModel())->getGenreName($genre);
        $rating_name = (new DvdModel())->getRatingName($rating);
        
        return view('results', [
            'titleInput' => $title,
            'genreSelect' => $genre,
            'ratingSelect' => $rating,
            'dvds' => $dvds
        ]);
    }      


}


?>