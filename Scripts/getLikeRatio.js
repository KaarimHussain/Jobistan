$(document).ready(function () {
    // Like Button
    $(document).on('click', '.likeBtn', function () {
        var post_id = $(this).data('post-id');
        var likeBtnWrapper = "#likeBtnWrapper" + post_id;

        // Optimistically update the UI
        $(likeBtnWrapper).html(
            `<i class="bi bi-hand-thumbs-up-fill text-primary cursor-pointer RemovelikeBtn" data-post-id="${post_id}" id="likeBtn-${post_id}"></i>
        <span>Liked</span>`
        );

        $.ajax({
            url: "./likePost.php",
            type: "POST",
            data: {
                post_id: post_id
            },
            dataType: 'json',
            success: function (response) {
                if (response.status !== 'success') {
                    // Revert UI change if there is an error
                    $(likeBtnWrapper).html(
                        `<i class="bi bi-hand-thumbs-up-fill text-primary cursor-pointer RemovelikeBtn" data-post-id="${post_id}" id="likeBtn-${post_id}"></i>
                    <span>Like</span>`
                    );
                    // alert(response.message);
                }
            },
            error: function () {
                // Revert UI change if there is a request error
                $(likeBtnWrapper).html(
                    `<i class="bi bi-hand-thumbs-up cursor-pointer likeBtn" data-post-id="${post_id}" id="likeBtn-${post_id}"></i>
                <span>Like</span>`
                );
                // alert('An error occurred. Please try again.');
            }
        });
    });

    $(document).on('click', '.RemovelikeBtn', function () {
        var post_id = $(this).data('post-id');
        var likeBtnWrapper = "#likeBtnWrapper" + post_id;

        // Optimistically update the UI
        $(likeBtnWrapper).html(
            `<i class="bi bi-hand-thumbs-up cursor-pointer likeBtn" data-post-id="${post_id}" id="likeBtn-${post_id}"></i>
        <span>Like</span>`
        );

        $.ajax({
            url: "./removeLikePost.php",
            type: "POST",
            data: {
                post_id: post_id
            },
            dataType: 'json',
            success: function (response) {
                if (response.status !== 'success') {
                    // Revert UI change if there is an error
                    $(likeBtnWrapper).html(
                        `<i class="bi bi-hand-thumbs-up text-primary cursor-pointer likeBtn" data-post-id="${post_id}" id="likeBtn-${post_id}"></i>
                    <span>Liked</span>`
                    );
                    // alert(response.message);
                }
            },
            error: function () {
                // Revert UI change if there is a request error
                $(likeBtnWrapper).html(
                    `<i class="bi bi-hand-thumbs-up text-primary cursor-pointer RemovelikeBtn" data-post-id="${post_id}" id="likeBtn-${post_id}"></i>
                <span>Liked</span>`
                );
                alert('An error occurred. Please try again.');
            }
        });
    });
});