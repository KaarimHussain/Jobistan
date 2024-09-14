$(document).ready(function () {
    var job_id = $('#responseApplied').data('job-id');
    var experienceRange = $('#experience');
    var job_title = $('#title');
    console.log(job_id);

    fetchAppliedUser();
    function fetchAppliedUser(exp, title) {
        console.log("Called");

        $.ajax({
            type: "POST",
            url: "appliedUserAJAX.php",
            data: {
                job_id: job_id,
                experience: exp,
                job_title: title
            },
            dataType: "html",
            success: function (response) {
                $('#responseApplied').html(response);
            },
            catch: function (jqXHR, textStatus, errorThrown) {
                console.log('Error:', errorThrown);
                console.log('Error:', textStatus);
                console.log('Error:', jqXHR);
            }
        });
    }
    $(job_title).on('input', function () {
        var exp_input = $('.exp_input')
        fetchAppliedUser($(exp_input).val(), $(job_title).val());
    })
    $(experienceRange).on('input', function () {
        var exp_input = $('.exp_input')
        fetchAppliedUser($(exp_input).val(), $(job_title).val());
    })
});