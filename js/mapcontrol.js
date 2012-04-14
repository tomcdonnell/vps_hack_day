/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
var guessCount = 5;
$(document).ready(init);

function init() {
    $("#guess_map").attr("src", "http://maps.google.com/maps/api/staticmap?center=3000,VIC&zoom=6&size=400x400&sensor=false");


    $("#suburbGuessBtn").click(changeMap);
}

function changeMap(ev) {

    suburbData = $("#suburbSelect option:selected").val().split(',');
    correctSuburb = $("#correctSuburb").val();

    mapUrl  = "http://maps.google.com/maps/api/staticmap?";
    mapUrl += "center="+suburbData[0]+","+suburbData[1];
    mapUrl += "&size=400x400";
    mapUrl += "&visible="+correctSuburb+",VIC";
    mapUrl += "&markers=icon:http://email.dpi.vic.gov.au/hack/wazza_icon.png|"+suburbData[0]+","+suburbData[1];
    mapUrl += "&style=feature:landscape|element:geometry|lightness:-15";
    mapUrl += "&sensor=true";


    $('#suburbGuessBtn').click(function() {

        if(guessCount > 0) {
            guessCount--;

        }
        if(guessCount == 0) {

            suburbData = $("#suburbSelect option:selected").val().split(',');
            correctSuburb = $("#correctSuburb").val();

            if (suburbData[3].toLowerCase() != correctSuburb.toLowerCase()) {
                window.location = 'answer.php?suburb='+correctSuburb+'&pcode='+suburbData[2]+'&gcount='+guessCount;
            } else {
                window.location = 'winner.php?suburb='+correctSuburb+'&pcode='+suburbData[2]+'&gcount='+guessCount;
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

    $("#guess_map").attr("src", mapUrl);
    
    if (suburbData[3].toLowerCase() != correctSuburb.toLowerCase()) {
        $("#suburbSelect option:selected").attr("disabled", true);
        $("#incorrect_guess_list").append("<li>"+ suburbData[3]+ "</li>");
    } else {
        $("#suburbSelect").effect("pulsate", {}, 500, function() {
            window.location = 'winner.php?suburb='+correctSuburb+'&pcode='+suburbData[2]+'&gcount='+guessCount;
        });
    }

}