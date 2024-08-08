<?php
// check_gd.php
if (extension_loaded('gd') && function_exists('gd_info')) {
    echo "GD extension is loaded";
} else {
    echo "GD extension is NOT loaded";
}
