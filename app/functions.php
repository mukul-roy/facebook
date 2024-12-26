<?php


/**
 * Create a alert for any validation 
 * @param $msg 
 * @param $type  
 */
function createAlert($msg, $type = "danger")
{
    return "<p class=\"alert alert-{$type} d-flex justify-content-between\">{$msg}<button class=\"btn-close\" data-bs-dismiss=\"alert\"></button></p>";
}

/**
 * Get old form values after submit a form 
 */
function old($field_name)
{
    return $_POST[$field_name] ?? '';
}


/**
 * Reset  form old data after a successful submit
 */
function reset_form()
{
    return $_POST = [];
}

function fileupload($files, $path = "media/")
{
    // file manage 
    $tmp_name = $files['tmp_name'];
    $file_name = $files['name'];
    // $file_size = $files['size'] / (1024 *1024);



    //get file extention

    $file_arr = explode('.', $file_name);
    $file_ext = strtolower(end($file_arr));

    $uniq_filename =  time() . '_' . rand(1000000, 121000000) . '_' .  str_shuffle('123456789') . '.' . $file_ext;

    //upload file
    move_uploaded_file($tmp_name, $path . $uniq_filename);

    //return file name
    return $uniq_filename;
}

function createId()
{
    // Get the current timestamp in microseconds
    $timestamp = microtime(true);

    // Generate a random number
    $randomNumber = random_int(1000, 9999);

    // Combine the timestamp and random number, then hash it for uniqueness
    $uniqueId = hash('sha256', $timestamp . $randomNumber);

    // Optionally, you can limit the length of the ID if needed
    return substr($uniqueId, 0, 16); // 16 characters long
}




function timeAgoFromTimestamp($timestamp)
{
    // Get the current time
    $now = new DateTime();
    // Set the timestamp to a DateTime object
    $postedTime = new DateTime();
    $postedTime->setTimestamp($timestamp);

    // Calculate the difference in seconds
    $secondsAgo = $now->getTimestamp() - $postedTime->getTimestamp();

    // Define time intervals
    $minutesAgo = floor($secondsAgo / 60);
    $hoursAgo = floor($secondsAgo / 3600);
    $daysAgo = floor($secondsAgo / 86400);
    $weeksAgo = floor($secondsAgo / 604800);
    $monthsAgo = floor($secondsAgo / 2629440); // Average month length
    $yearsAgo = floor($secondsAgo / 31536000); // Average year length

    // Create a human-readable output
    if ($secondsAgo < 60) {
        return "{$secondsAgo} seconds ago";
    } elseif ($minutesAgo < 60) {
        return "{$minutesAgo} minutes ago";
    } elseif ($hoursAgo < 24) {
        return "{$hoursAgo} hours ago";
    } elseif ($daysAgo < 30) {
        return "{$daysAgo} days ago";
    } elseif ($monthsAgo < 12) {
        return "{$monthsAgo} months ago";
    } else {
        return "{$yearsAgo} years ago";
    }
}



// }
function setMassage($key, $msg)
{
    // Set a cookie with the given key and message, lasting for 2 seconds
    setcookie($key, $msg, time() + 2);
}

function getMassage($key, $type = 'danger')
{
    // Check if the cookie exists before trying to access it
    if (isset($_COOKIE[$key])) {
        $msg = $_COOKIE[$key];
        echo "<p class=\"alert alert-{$type} d-flex justify-content-between\">{$msg}<button class=\"btn-close\" data-bs-dismiss=\"alert\"></button></p>";

        // Delete the cookie after displaying the message
        setcookie($key, '', time() - 3600);
    } else {
        echo "";
    }
}
