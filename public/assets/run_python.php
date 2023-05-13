<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the text input from the form data
    $text = $_POST['comment'];

    // Call the analyze_sentiment function in your Python script
    $command = "python myscript.py \"$text\"";
    $output = shell_exec($command);

    // Return the sentiment rating from the output
    preg_match("/(\d) star/", $output, $matches);

    $rating = $matches[1];

    // Create a string of stars based on the rating
    $filled_stars = '<span style="font-size: 40px; color: gold; text-shadow: 1px 1px 2px rgba(0,0,0,0.5);">' . str_repeat("&#9733;", $rating) . '</span>';
    $empty_stars = '<span style="font-size: 40px; color: #ccc;">' . str_repeat("&#9733;", 5-$rating) . '</span>';
    $stars = $filled_stars . $empty_stars;

    // Return the stars
    echo $stars;

    // Update the rating dropdown
    echo "<script>";
    echo "$('select[name=rating]').val('$rating');";
    echo "</script>";

    exit;
}
?>
