<?php

// Read users.csv file and display data in a table
$file = fopen('users.csv', 'r');
echo '<table border="1">';
echo '<tr><th>Name</th><th>Email</th><th>Profile Picture</th><th>Date and Time</th></tr>';
while (($data = fgetcsv($file)) !== false) {
    echo '<tr>';
    foreach ($data as $value) {
        echo '<td>' . $value . '</td>';
    }
    echo '</tr>';
}
echo '</table>';
fclose($file);

?>
