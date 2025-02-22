<?php
// Load the CSV file
$filename = "PHP Quiz Question #2 - out.csv";
$data = array();

if (($handle = fopen($filename, "r")) !== FALSE) {
    while (($row = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $data[] = $row;
    }
    fclose($handle);
}else{
    die('file not found');
}

// Extract headers and numerical data
$headers = array_shift($data); // Remove first row (headers)
$x_values = array();
$y_values = array();

// The CSV has two numerical columns for plotting
foreach ($data as $row) {
    $x_values[] = floatval($row[0]); // First column as X
    $y_values[] = floatval($row[1]); // Second column as Y
}

// Set image dimensions
$width = 800;
$height = 600;

// Create the image
$image = imagecreatetruecolor($width, $height);
$white = imagecolorallocate($image, 255, 255, 255);
$black = imagecolorallocate($image, 0, 0, 0);
$blue = imagecolorallocate($image, 0, 0, 255);

// Fill background
imagefilledrectangle($image, 0, 0, $width, $height, $white);

// Define plot area margins
$margin = 50;
$plot_width = $width - 2 * $margin;
$plot_height = $height - 2 * $margin;

// Determine scaling factors
$min_x = min($x_values);
$max_x = max($x_values);
$min_y = min($y_values);
$max_y = max($y_values);

$x_scale = $plot_width / ($max_x - $min_x);
$y_scale = $plot_height / ($max_y - $min_y);

// Draw points
foreach ($x_values as $index => $x) {
    $scaled_x = $margin + ($x - $min_x) * $x_scale;
    $scaled_y = $height - $margin - ($y_values[$index] - $min_y) * $y_scale;
    imagefilledellipse($image, $scaled_x, $scaled_y, 5, 5, $blue);
}

// Output the image
header("Content-Type: image/png");
imagepng($image);
imagedestroy($image);
?>
