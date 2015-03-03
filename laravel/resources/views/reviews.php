<!DOCTYPE html>
<html>
<head>
    <title>DVD Search</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet"  href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
    <center><h1>DVD Details</h1></center>
    <table class="table">
        <thead>
        <tr>
            <th>Title</th>
            <th>Genre</th>
            <th>Rating</th>
            <th>Format</th>
            <th>Sound</th>
            <th>Label</th>
            <th>Release Date</th>
        </tr>
        </thead>
        <tbpdy>
        	<tr>
	            <td><?php echo $dvds[0]->title ?></td>
	            <td><?php echo $dvds[0]->genre_name ?></td>
	            <td><?php echo $dvds[0]->rating_name ?></td>
	            <td><?php echo $dvds[0]->format_name ?></td>
	            <td><?php echo $dvds[0]->sound_name ?></td>
	            <td><?php echo $dvds[0]->label_name ?></td>
	            <td><?php echo date("m/d/y g:i A", strtotime($dvds[0]->release_date)) ?></td>
            </tr>
        </tbpdy>

    </table>
</div>

<div class="container">
    <center><h1>Reviews</h1></center>
	    <?php foreach ($reviews as $review) :?>
	    	<div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                    	<span class="badge"><?php echo $review->rating ?></span>
                    	<?php echo $review->title ?>
                	</h4>
                </div>
                <div class="panel-body">
                	<?php echo $review->description ?>
                </div>
            </div>
	    <?php endforeach ?>
</div>

<div class="container">
    <center><h3>Submit Review</h3></center>
    <?php if (Session::has('success')) : ?>
        <p><?php echo Session::get('success') ?></p>
    <?php endif ?>

    <?php foreach ($errors->all() as $error) : ?>
        <p style="color:red"><?php echo $error ?></p>
    <?php endforeach ?>

    <form method = "post" action="/dvds/details/<?php echo $dvds[0]->id ?>">
        <input type = "hidden" name = "_token" value = "<?php echo csrf_token() ?>" >

        <div class="form-group">
            <label>Title</label>
            <input name = "title" class = "form-control" name = "title" value = "<?php echo Request::old('title') ?>">
        </div>
        <div class="form-group">
            <label>Rating</label>
            <select class="selectpicker" name = "rating" value="<?php echo Request::old('rating') ?>">
                <option value = "1">1</option>
                <option value = "2">2</option>
                <option value = "3">3</option>
                <option value = "4">4</option>
                <option value = "5">5</option>
                <option value = "6">6</option>
                <option value = "7">7</option>
                <option value = "8">8</option>
                <option value = "9">9</option>
                <option value = "10">10</option>
            </select>
        </div>
        <div class="form-group">
            <textarea rows = "10" cols = "90" name = "description"><?php echo Request::old('description') ?></textarea>
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
    </form>
</div>


</body>
</html>