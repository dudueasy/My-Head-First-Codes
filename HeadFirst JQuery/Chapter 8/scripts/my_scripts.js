$(document).ready(function() {

    var repeat;

    $("#btnStop").click(function() {
        repeat = false;
        $("#freq").html("Update paused");
    });
    $("#btnStart").click(function() {
        repeat = true;
        startAJAXcalls();
        showFrequency();
    });



    /* 
        getXMLRacers();

        function getTime() {
            var a_p = "";
            var d = new Date();
            var curr_hour = d.getHours();

            (curr_hour < 12) ? a_p = "AM": a_p = "PM";
            (curr_hour == 0) ? curr_hour = 12: curr_hour = curr_hour;
            (curr_hour > 12) ? curr_hour = curr_hour - 12: curr_hour = curr_hour;

            var curr_min = d.getMinutes().toString();
            var curr_sec = d.getSeconds().toString();

            if (curr_min.length == 1) { curr_min = "0" + curr_min; }
            if (curr_sec.length == 1) { curr_sec = "0" + curr_sec; }

            $('#updatedTime').html(curr_hour + ":" + curr_min + ":" + curr_sec + " " + a_p);
        }
    */
    // jQuery AJAX starts


    var FREQ = 10000;

    function startAJAXcalls() {
        if (repeat) {
            setTimeout(
                function() {
                    getXMLRacers();
                    startAJAXcalls();

                }, FREQ
            );
        }
    }

    getXMLRacers();
    startAJAXcalls();



    function getXMLRacers() {
        $.ajax({
            url: "finishers.xml",
            cache: false,
            dateType: "xml",
            success: function(xml) {
                $("#finishers_m").empty();
                $("#finishers_f").empty();
                $("#finishers_all").empty();
                $(xml).find("runner").each(function() {
                    var info = "<li>Name: " + $(this).find("fname").text() + " " +
                        $(this).find("lname").text() +
                        ".time: " + $(this).find("time").text() + "</li>";

                    if ($(this).find("gender").text() == "m") {
                        $("#finishers_m").append(info);
                    } else if ($(this).find("gender").text() == "f") {
                        $("#finishers_f").append(info);
                    }
                    $("#finishers_all").append(info);
                });
                getTimeAjax();
                showFrequency();
            }
        });
    }

    function showFrequency() {
        $("#freq").html("Page refreshes every " + FREQ / 1000 + " second.");
    }

    function getTimeAjax() {
        $("#updatedTime").load("time.php");

    }


}); //end document ready