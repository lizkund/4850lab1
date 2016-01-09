<!-- Liz Kundilivskaya 
    ACIT 4850 - Lab 1
-->
<!DOCTYPE HTML>
<html>  
    <head>
        <meta http-equiv="Conent-Type" content="text/html; charset=UTF-8">
    </head>
    <body>
        <?php
        echo 'Hello world, welcome to this Tic-Tac-Toe game.</br></br>';
        $position;
        // checks whether board is the URL
        if (isset($_GET['board'])) {
            $position = $_GET['board']; // load board creadentials into position
        } else {
            // board variable not found, load blank
            $position = '---------';
        }
        // checks that length of string is 9 characters
        if (strlen($position) == 9) {
            $game = new Game($position); // load new game, take in characters
            $game->pick_move();          // load AI
            $game->display();            // load the board to display
            //if X won then display the following message
            if ($game->winner('x')) {
                echo 'X wins. Lucky!';
                // if O won then display the following message
            } else if ($game->winner('o')) {
                echo "O wins. Yay";
                // otherwise this message
            } else
                echo 'No winner yet, sadly.';
        } else {
            echo 'You do not have the correct amount of X and O and - ';
        }
        echo '<br/> If you want to retry press <a href=http://localhost/4850lab1/?board=---------> here</a>';
        ?>
    </body>
</html>

<?php

// game class holds functions: winner, show_cell and pick_move
// responsible for the game process
class Game {

    var $position;

    // construcor takes in squares
    function __construct($squares) {
        $this->position = str_split($squares); //position array converts into square strings
    }

    // this checks the table for winning combinations
    function winner($token) {
        $won = false;
        // itirates throught rows
        for ($row = 0; $row < 3; $row++) {
            $won = true;
            // itirates throught columns
            for ($col = 0; $col < 3; $col++) {
                // checks if cell contains token
                if ($this->position[3 * $row + $col] != $token)
                    $won = false;
            }
            if ($won) {
                break; // stop itiration if found a winning combination
            }
        }

        // checks all collumns for winning cobinations
        if (!$won) {
            // itirates throught columns
            for ($col = 0; $col < 3; $col++) {
                $won = true;
                // itirates throught rows
                for ($row = 0; $row < 3; $row++) {
                    // checks if cell contains token
                    if ($this->position[3 * $row + $col] != $token)
                        $won = false;
                }
                if ($won) {
                    break; // stop itiration if found a winning combination
                }
            }
        }

        // checks both diagonals for winning cobinations
        if (!$won) {
            if (($this->position[0] == $token) &&
                    ($this->position[4] == $token) &&
                    ($this->position[8] == $token)) {
                $won = true;
            } else if (($this->position[2] == $token) &&
                    ($this->position[4] == $token) &&
                    ($this->position[6] == $token)) {
                $won = true;
            }
        }
        return $won;
    }

    // displays the X/O board
    function display() {
        echo '<table cols="3" style="font-size:large font-weight:bold">';
        echo '<tr>'; //opens the first row
        for ($pos = 0; $pos < 9; $pos++) {
            echo $this->show_cell($pos);
            if ($pos % 3 == 2)
                echo '</tr><tr>'; //start a new row for the next square
        }
        echo '</tr>'; //close last row
        echo '</table><br/>';
    }

    // display players moves (O's), update the array, and update URL
    function show_cell($which) {
        $token = $this->position[$which];
        // if it has an X or an O then leave it be.
        if ($token <> '-')
            return '<td>' . $token . '</token>';
        // all tokens stay in their places
        $this->new_position = $this->position; //copy the original
        $this->new_position[$which] = 'o'; // this is the persons move
        $move = implode($this->new_position); //make a string from the board array 
        $link = '?board=' . $move; // this is what we want the link to be
        //so return a cell containg an anchor and showing a hyphen
        return '<td><a href="' . $link . '">-</a></td>';
    }

    //AI magic will happen here... pick X's moves
    function pick_move() {
        // itirating though the entire table. 
        for ($pos = 0; $pos < 8; $pos++) {
            // if we find a dash then place an X in the board
            if ($this->position[$pos] == '-') {
                $this->position[$pos] = 'x'; // place an x in the empty cell
                // break out of itiration once one X has been placed.
                break;
            }
        }
    }

}
?>



