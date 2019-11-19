
//Generating new gifs based on the button that was clicked
$(document).ready(function() {

    //Empties out the gifs div from any previous content it might've had
    $("#gifs").empty();

    //Cancel out Load More Gifs function click event from any previous movie that may have been loaded
    $(document).off("click", ".load-more");

    //Gets the value of the movie-name attribute that we set up earlier from the specific button that was clicked
    var movieName = document.getElementById("judul").innerHTML;

    //Sets up the url that the ajax call will use
    var queryURL = "https://api.giphy.com/v1/gifs/search?q=" +
        movieName + "&api_key=KjGKCBE3CHHFMp0PAbWal01ui7fGSnN3&limit=9";

    //Ajax call
    $.ajax({
        url: queryURL,
        method: "GET"
    }).then(function (response) {

        //Stores the actual image array that is returned within a results variable for easier access down below
        var results = response.data;





        //Loops through all the images in the image array that is returned...
        for (var i = 0; i < results.length; i++) {

            //Creates a new span for each gif within the array, & also a new paragraph to store that gif's rating
            var movieSpan = $("<div class='col-md-6 movie-span'>");

            //Sets up variable to hold the code for downloading a gif
            var downloadLink = $("<a>").attr("href", results[i].images.original.url).attr("target","_blank");

            //Creates a new image tag and sets its src attribute to the url of the gif that's in question, as well as setting its dimensions
            var movieImage = $("<img class='img-fluid' style='width:100%'>");
            movieImage.attr("src", results[i].images.original_still.url);
           

            //Sets up code so that the gifs can be played or paused
            movieImage.attr("data-state", "still");
            movieImage.attr("data-still", results[i].images.original_still.url);
            movieImage.attr("data-animate", results[i].images.original.url);



            //Appends the movie image & its corresponding paragraph to the movie div, as well as the gif download link, and then prepends that movie div to the main gifs div in the page
            downloadLink.append(movieImage);
            movieSpan.append(downloadLink);
            $("#gifs").prepend(movieSpan);

        }


        //Displays instructions in the DOM, as well as the title of the selected movie
        
        //If one of the gifs is clicked...
        $(document).on("click", ".movie-image", function () {

            //Creates a variable that gets the value of the "data-state" attribute we assigned to each image in the loop above
            var state = $(this).attr("data-state");

            // If the clicked image's state is still, update its src attribute to what its data-animate value is.
            // Then, set the image's data-state to animate
            // Else set src to the data-still value
            if (state === "still") {
                $(this).attr("src", $(this).attr("data-animate"));
                $(this).attr("data-state", "animate");
            } else {
                $(this).attr("src", $(this).attr("data-still"));
                $(this).attr("data-state", "still");
            }
        });


    });

});




//Adds a button that the user can click to display the next set of gifs for the movie that's selected

    //Sets up what happens when you click the "more gifs" button
$(document).on("click", "#loadmore", function () {
    	var resultCount = 0;

	    $('.movie-span').each(function () {
	        resultCount++;
	    });

        resultCount = resultCount + 9;

        //Makes sure the value of movieName variable is set to the current movie that has been selected
        movieName = document.getElementById("judul").innerHTML;

        //Constructs new query to access GIPHY database 
        var queryURL3 = "https://api.giphy.com/v1/gifs/search?q=" +
            movieName + "&api_key=KjGKCBE3CHHFMp0PAbWal01ui7fGSnN3&offset=" + resultCount + "&limit=9";



        //Ajax call to GIPHY API
        $.ajax({
            url: queryURL3,
            method: "GET"
        }).then(function (response) {


            var results = response.data;

            //Loops through all the images in the image array that is returned...
            for (var i = 0; i < results.length; i++) {

                var movieSpan = $("<div class='col-md-6 movie-span'>");

            //Sets up variable to hold the code for downloading a gif
            var downloadLink = $("<a>").attr("href", results[i].images.original.url).attr("target","_blank");

            //Creates a new image tag and sets its src attribute to the url of the gif that's in question, as well as setting its dimensions
            var movieImage = $("<img class='img-fluid' style='width:100%'>");
            movieImage.attr("src", results[i].images.original_still.url);
           

            //Sets up code so that the gifs can be played or paused
            movieImage.attr("data-state", "still");
            movieImage.attr("data-still", results[i].images.original_still.url);
            movieImage.attr("data-animate", results[i].images.original.url);



            //Appends the movie image & its corresponding paragraph to the movie div, as well as the gif download link, and then prepends that movie div to the main gifs div in the page
            downloadLink.append(movieImage);
            movieSpan.append(downloadLink);
            $("#gifs").prepend(movieSpan);

            }
        });

    });





