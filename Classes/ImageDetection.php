<?php
include("./Includes/sessionStart.php");
include("./Includes/db.php");

class ImageDetection
{
    private $conn;
    public function __construct($conn)
    {
        $this->conn = $conn;
    }
    public function createImageResource($imagePath, $imageType)
    {
        if ($imagePath == "" || $imageType == "") {
            throw new Exception('Invalid image path or type');
        }
        try {

            switch ($imageType) {
                case IMAGETYPE_JPEG:
                    return imagecreatefromjpeg($imagePath);
                case IMAGETYPE_PNG:
                    return imagecreatefrompng($imagePath);
                default:
                    return;
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function compareImages($imagePath1, $imageType1, $imagePath2, $imageType2)
    {
        try {
            $image1 = $this->createImageResource($imagePath1, $imageType1);
            $image2 = $this->createImageResource($imagePath2, $imageType2);
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }

        $width1 = imagesx($image1);
        $height1 = imagesy($image1);
        $width2 = imagesx($image2);
        $height2 = imagesy($image2);

        if ($width1 !== $width2 || $height1 !== $height2) {
            imagedestroy($image1);
            imagedestroy($image2);
            return false;
        }

        $totalPixels = $width1 * $height1;
        $matchingPixels = 0;

        for ($x = 0; $x < $width1; $x++) {
            for ($y = 0; $y < $height1; $y++) {
                if (imagecolorat($image1, $x, $y) === imagecolorat($image2, $x, $y)) {
                    $matchingPixels++;
                }
            }
        }

        imagedestroy($image1);
        imagedestroy($image2);

        $similarity = ($matchingPixels / $totalPixels) * 100;
        return $similarity;
    }

    public function ifUserExistInImageTable($user_id)
    {
        $SQL = "SELECT * FROM usersavedimagesfordetection WHERE user_id = ?";
        $stmt = $this->conn->prepare($SQL);
        $stmt->bind_param("i", $user_id);
        if ($stmt->num_rows > 0) {
            $SQL = "DELETE FROM usersavedimagesfordetection WHERE user_id = ?";
            $stmt = $this->conn->prepare($SQL);
            $stmt->bind_param("i", $user_id);
            if ($stmt->execute()) {
                return true;
            } else {
                $_SESSION['generalError'] = "Failed to Delete Previous Image from the Database";
                return false;
            }
        } else {
            return true;
        }
    }
    public function insertIntoImageDetectTable($user_id, $file)
    {
        if ($this->ifUserExistInImageTable($user_id)) {
            $Dir = "ImageDetection/";
            $target_file = $Dir . basename($file["name"]);
            if (file_exists($target_file)) {
                unlink($target_file);
            }
            $uploadOk = TRUE;
            $SQL = "INSERT INTO usersavedimagesfordetection (user_id,savedImage,enabled) VALUES (?,?,?)";
            $stmt = $this->conn->prepare($SQL);
            $stmt->bind_param("isi", $user_id, $target_file, $uploadOk);
            if (move_uploaded_file($file["tmp_name"], $target_file)) {
                if ($stmt->execute()) {
                    return true;
                } else {
                    $_SESSION['generalError'] = "Failed to Insert Image into the Database";
                    return false;
                }
            } else {
                $_SESSION['generalError'] = "Failed to Upload Image in the Directory";
                return false;
            }
        } else {
            return false;
        }
    }
    public function selectImageFromDetectTable($user_id)
    {
        $sql = "SELECT * FROM usersavedimagesfordetection WHERE user_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row;
    }
    public function getFileType($filePath)
    {
        return mime_content_type($filePath);
    }
}
