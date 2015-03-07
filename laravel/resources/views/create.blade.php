<!doctype html>
<html>
<head>
	<title>Create DVD</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">  
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</head>
<body>

<body>
<div class = "container">
    <div class = "row">
        <div class = "col-md-4 col-md-offset-4">
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger" role="alert"> {{ $error }} </div>
            @endforeach
            @if (Session::has('success'))
                <div class="alert alert-success" role="alert"> {{ Session::get('success') }} </div>
            @endif
            <center><h2>Add a DVD</h2></center>

            <form method = "post" class = "form-control" action = "{{ url('dvds') }}" >
                <div class = "input-group dvd-create">

                    <input type = "hidden"  name ="_token" value="{{ csrf_token() }}">

                    <input type="text" class="form-control" name = "title" placeholder="DVD Title">

                    <span>
                        <select name="genre_id" class="selectpicker" data-width="100%" >
                            <option value="">
                                Genres
                            </option>
                            @foreach($genre as $genre)
                                <option value="{{ $genre->id }}"> {{ $genre->genre_name }}</option>;
                            @endforeach
                        </select>

                        <select name="rating_id" class="selectpicker" data-width="100%" >
                            <option value="">
                                Ratings
                            </option>
                            @foreach($rating as $rating)
                                <option value="{{ $rating->id }}"> {{ $rating->rating_name }}</option>;
                            @endforeach
                        </select>

                        <select name="label_id" class="selectpicker" data-width="100%" data-width="100%">
                            <option value="">
                                Labels
                            </option>
                            @foreach($label as $label)
                                <option value="{{ $label->id }}"> {{ $label->label_name }}</option>;
                            @endforeach
                        </select>

                        <select name="sound_id" class="selectpicker" data-width="100%">
                            <option value="">
                                Sound Formats
                            </option>
                            @foreach($sound as $sound)
                                <option value="{{ $sound->id }}"> {{ $sound->sound_name }}</option>;
                            @endforeach
                        </select>

                        <select name="format_id" class="selectpicker" data-width="100%">
                            <option value="">
                                Formats
                            </option>
                            @foreach($format as $format)
                                <option value="{{ $format->id }}"> {{ $format->format_name }}</option>;
                            @endforeach
                        </select>
                    </span>

                    <button class = "btn btn-default" type = "submit" style = "width:100%" name = "submit">
                        Add DVD
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>

</html>