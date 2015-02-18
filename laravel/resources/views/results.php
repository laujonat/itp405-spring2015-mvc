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
	<h1>Your Results</h1>
	<code>
		You searched for <?php echo $titleInput ?> with genre <?php echo $genreSelect ?> and rating <?php echo $ratingSelect ?>:  
	</code>
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Title</th>
				<th>Rating</th>
				<th>Genre</th>
				<th>Label</th>				
				<th>Sound</th>
				<th>Format</th>
				<th>Release Date</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($dvds as $dvd) : ?>
			<tr>
				<td><?php echo $dvd->title ?></td>
				<td><?php echo $dvd->rating_name ?></td>
				<td><?php echo $dvd->genre_name ?></td>
				<td><?php echo $dvd->label_name ?></td>
				<td><?php echo $dvd->sound_name ?></td>
				<td><?php echo $dvd->format_name ?></td>
				<td><?php echo $dvd->release_date ?></td>
			</tr>
			<?php endforeach ?>	
		</tbody>
	</table>
	<script src="http://code.jquery.com/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>