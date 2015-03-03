<?php 
namespace App\Http\Controllers;
 
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
        // if (!$request->input('dvd_title')) {
        //     return redirect('/dvds/search');
        // }

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

    public function details($id) {
        $query = new DvdModel();
        $dvds = $query->searchReviewId($id);
        $reviews = $query->getReview($id);

        return view('reviews', [    
                'id'=>$id,
                'reviews'=>$reviews, 
                'dvds'=>$dvds 
        ]);
    }      

    public function storeReview($id, Request $request) {
        $validate =  DvdModel::validate($request->all());

        if($validate->passes()){
            DvdModel::addReview([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'rating' => $request->input('rating'),
                'dvd_id' => $id
            ]);
            return redirect('dvds/' . $id)->with('success', 'Review successfully inserted into database.');
        }
        else {
            return redirect('dvds/'.$id)
                ->withInput()
                ->withErrors($validate);
        }
    }



}


?>