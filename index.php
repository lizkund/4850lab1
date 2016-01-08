<!DOCTYPE HTML>
<html>  
    <head>
        <meta http-equiv="Conent-Type" content="text/html; charset=UTF-8">
    </head>
    <body>
        <?php
        // code here
        echo 'Hello world, welcome to this Tic-Tac-Toe game.</br></br>';

        if (isset($_GET['board'])) {

            // get board creadentials from the URL
            $position = $_GET['board'];

            if (strlen($position) == 9) {
                $squares = str_split($position);
                if (winner('x', $squares)) {
                    echo 'X win. Lucky!';
                } else if (winner('o', $squares)) {
                    echo "O win. Yay";
                } else
                    echo 'No winner yet, sadly.';
            } else {
                echo 'You do not have the correct amount of X and O and - ';
            }
        } else {
            echo 'Nothing has been entered in. Please put in variables in the URL in the following format</br>' .
            '?board=--------- </br> where the dash is a variable on the board ' .
            'going up left to down right. ';
        }
        ?>
    </body>
</html>

<?php

// this checks the table for winning combinations
function winner($token, $position) {
    
    $won = false;
    // checks all rows for winning cobinations
    for ($row = 0; $row < 3; $row++) {
        $won = true;
        for ($col = 0; $col < 3; $col++) {
            
            if ($position[3 * $row + $col] != $token)
                $won = false;
        }
        if ($won) {
            break;
        }
    }

    // checks all collumns for winning cobinations
    if (!$won) {
        for ($col = 0; $col < 3; $col++) {
            $won = true;
            for ($row = 0; $row < 3; $row++) {
                if ($position[3 * $row + $row] != $token)
                    $won = false;
            }
            if ($won) {
                break;
            }
        }
    }

    // checks both diagonals for winning cobinations
    if (!$won) {
        if (($position[0] == $token) &&
                ($position[4] == $token) &&
                ($position[8] == $token)) {
            $won = true;
        } else if (($position[2] == $token) &&
                ($position[4] == $token) &&
                ($position[6] == $token)) {
            $won = true;
        }
    }
    return $won;
}
?>



