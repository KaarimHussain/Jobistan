$(document).ready(function () {
    fetchContacts();
    $('#contactSearchInput').on('input', function () {
        fetchContacts($(this).val());
    })
    function fetchContacts(val = "") {
        $.ajax({
            type: "POST",
            url: "./contactSearching.php",
            data: {
                search: val
            },
            dataType: "html",
            success: function (response) {
                $('#contactResponseBox').html(response);
            }
        });
    }
});