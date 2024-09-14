$(document).ready(function () {
    FetchPost();

    function FetchPost() {
        console.log("Fetched the Post");
        $.ajax({
            type: "POST",
            url: "./communityAddPostAJAX.php",
            dataType: "html",
            success: function (response) {
                $('#postResponseBox').html(response);
                var inputElement = $('.comment_input');
                var postId = $(inputElement).data('post-id');
                fetchCommentsAJAX(postId)
                $('#sendCommentBtn').each(function () {
                    $(this).click(function () {
                        console.log("Send Comment Button Clicked");
                        handleCommentPost($(this).siblings('.comment_input'));
                    });
                });
                inputElement.each(function () {
                    var postId = $(this).data('post-id');
                    // console.log(postId);
                    fetchCommentsAJAX(postId);
                    $(this).on('keypress', function (e) {
                        // console.log("Press");
                        if (e.which === 13) {
                            // console.log("Enter Press");
                            handleCommentPost($(this));
                        }
                    });
                });
            }
        });
    }

    function fetchCommentsAJAX(commID) {
        console.log("Fetch Comments AJAX Called");
        var commData = {
            comm_id: commID
        }
        $.ajax({
            type: "POST",
            url: "./communityGetCommentAJAX.php",
            data: commData,
            dataType: "html",
            success: function (response) {
                // console.log(response);
                $('#responseComment' + commID).html(response);
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
                console.log(status);
                console.log(error);
            }
        });
    }

    function handleCommentPost(element) {
        const commentInput = element.val();
        const postId = element.data('post-id');

        var dataComment = {
            post_id: postId,
            comment_text: commentInput
        }

        element.val('');
        console.log(dataComment);
        $.ajax({
            type: "POST",
            url: "./communityAddComments.php",
            data: dataComment,
            dataType: "json",
            success: function (response) {
                console.log(response.message);
                fetchCommentsAJAX(postId);
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
                console.log(status);
                console.log(error);
            }
        });
    }

    function checkLikeType(likeType) {
        if ($(likeType).hasClass('active')) {
            $(likeType).removeClass('active');
        } else {
            $(likeType).addClass('active');
        }
    }
    // Preview the provided picture in the modal
    document.getElementById('imageFile').addEventListener('change', function (event) {
        const file = event.target.files[0];
        if (file.type !== "image/jpeg" && file.type !== "image/png" && file.type !== "image/jpg") {
            alert("Please select a valid image file (JPEG, PNG, JPG)");
            return;
        }
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                const imagePreview = document.querySelector('.image-preview');
                imagePreview.src = e.target.result;
                imagePreview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    });
});
