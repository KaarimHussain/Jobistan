<?php
include ('./Includes/db.php');
include ('./Includes/sessionStart.php');
// include('./Classes/Base.php');

class Community
{
    private $conn;
    public function __construct($conn)
    {
        $this->conn = $conn;
    }
    public function fetchAllCommunityPosts()
    {
        $SQL = "SELECT * FROM community_post ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($SQL);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return null;
        }
    }
    public function fetchLikeCount($post_id)
    {
        $SQL = "SELECT COUNT(*) as total_likes FROM community_post_likes WHERE post_id = ?";
        $stmt = $this->conn->prepare($SQL);
        $stmt->bind_param("i", $post_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['total_likes'];
        } else {
            return 0;
        }
    }
    public function fetchCommentCount($post_id)
    {
        $SQL = "SELECT COUNT(*) as total_comments FROM community_post_comments WHERE post_id = ?";
        $stmt = $this->conn->prepare($SQL);
        $stmt->bind_param("i", $post_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['total_comments'];
        } else {
            return 0;
        }
    }
    public function fetchCommentsForPost($post_id)
    {
        $SQL = "SELECT * FROM community_post_comments WHERE post_id = ? ORDER BY id DESC";
        $stmt = $this->conn->prepare($SQL);
        $stmt->bind_param("i", $post_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return null;
        }
    }
    public function fetchCommentsWithUserDataForPostWithID($post_id)
    {
        // Adding joins from the table(users, profiles, community_post_comments, employer_profiles)
        $SQL = "SELECT community_post_comments.id, community_post_comments.post_id, community_post_comments.comment_text, community_post_comments.created_at, users.username, profiles.profile_picture, employer_profiles.company_name,employer_profiles.company_logo
            FROM community_post_comments
            INNER JOIN users ON community_post_comments.user_id = users.id
            LEFT JOIN profiles ON users.id = profiles.user_id
            LEFT JOIN employer_profiles ON users.id = employer_profiles.user_id
            WHERE community_post_comments.post_id = ?
            ORDER BY community_post_comments.id DESC";
        $stmt = $this->conn->prepare($SQL);
        $stmt->bind_param("i", $post_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return null;
        }
    }
    public function InsertIntoCommunityPost($user_id, $post_content, $post_image = null)
    {
        $SQL = "INSERT INTO community_post(post_content, post_image, user_id, created_at) VALUES ( ?, ?, ?, NOW())";
        $stmt = $this->conn->prepare($SQL);
        $stmt->bind_param("ssi", $post_content, $post_image, $user_id);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function InsertIntoCommunityComments($post_id, $user_id, $comment_text)
    {
        $SQL = "INSERT INTO community_post_comments(post_id,user_id,comment_text,created_at) VALUES(?,?,?,NOW())";
        $stmt = $this->conn->prepare($SQL);
        $stmt->bind_param("iis", $post_id, $user_id, $comment_text);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function likePost($user_id, $post_id)
    {
        $SQL = "INSERT INTO community_post_likes(user_id, post_id, like_type, created_at) VALUES(?,?,TRUE,NOW())";
        $stmt = $this->conn->prepare($SQL);
        $stmt->bind_param("ii", $user_id, $post_id);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function deleteLike($user_id, $post_id)
    {
        $SQL = "DELETE FROM community_post_likes WHERE user_id = ? AND post_id = ?";
        $stmt = $this->conn->prepare($SQL);
        $stmt->bind_param("ii", $user_id, $post_id);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function getLikeState($user_id, $post_id)
    {
        $SQL = "SELECT like_type FROM community_post_likes WHERE user_id = ? AND post_id = ?";
        $stmt = $this->conn->prepare($SQL);
        $stmt->bind_param("ii", $user_id, $post_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['like_type'];
        }
        return false;
    }
}
