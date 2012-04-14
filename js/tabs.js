$(document).ready(function() {

    //When page loads...
    $(".tab_content").hide(); //Hide all content
    $("ul.tabs li:first").addClass("active").show(); //Activate first tab
    $(".tab_content:first").show(); //Show first tab content
	
    $(document).ready(function() {

        //When page loads...
        $(".tab_content").hide(); //Hide all content
        $("ul.tabs li:first").addClass("active").show(); //Activate first tab
        $(".tab_content:first").show(); //Show first tab content

        //On Click Event
        $("ul.tabs li").click(function() {

            $("ul.tabs li").removeClass("active"); //Remove any "active" class
            $(this).addClass("active"); //Add "active" class to selected tab
            $(".tab_content").hide(); //Hide all tab content

            var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
           // $(activeTab).fadeIn(); //Fade in the active ID content
           $(activeTab).show();
            return false;
        });

    });
	
    var guessCount = 5;
    $('#suburbGuessBtn').click(function() {
	
        if(guessCount > 0) {
            guessCount--;
			
        }
        if(guessCount == 0) {

            suburbData = $("#suburbSelect option:selected").val().split(',');
            correctSuburb = $("#correctSuburb").val();

            if (suburbData[3].toLowerCase() != correctSuburb.toLowerCase()) {
                window.location = 'answer.php?suburb='+correctSuburb+'&pcode='+suburbData[2];
            } else {
                window.location = 'winner.php?suburb='+correctSuburb+'&pcode='+suburbData[2];
            }
        }
        if(guessCount == 4) {
            $('#two').show();
        }
        if(guessCount == 3) {
            $('#three').show();
        }
        if(guessCount == 2) {
            $('#four').show();
        }
        if(guessCount == 1) {
            $('#five').show();
        }
		
    });
	

});