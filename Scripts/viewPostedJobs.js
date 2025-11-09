$(document).ready(function () {
    var searchBarVal = $('#searchJobsBar');

    callTheAJAX(searchBarVal.val());

    $(searchBarVal).on('input', function () {
        callTheAJAX(searchBarVal.val());
    })

    function callTheAJAX(searchBarVal) {
        $.ajax({
            type: "POST",
            url: "./filterPostedJobs.php",
            data: {
                searchBarVal: searchBarVal
            },
            dataType: "html",
            success: function (response) {
                $('#responseBoxJobs').html(response);
            }
        });
    }
});