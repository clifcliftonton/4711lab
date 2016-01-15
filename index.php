<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        class Game {
            var $position;      
            var $newposition;
            function _construct($squares) {
                $this->position = str_split($squares);
            }         
            function winner($token) {
                for($row=0; $row<3; $row++) {
                    $result = true;
                    for($col=0;$col<3;$col++) {
                        if($this->position[3*$row+$col] != $token) {
                            $result = false;
                        }
                    }
                }
                return $result;
            }         
            function display() {
                echo '<table cols="3" style="font-size=large"; font-weight="bold">';
                echo '<tr>'; // open the first row
                for($pos=0; $pos<9;$pos++) {
                    echo $this->show_cell($pos);
                    if($pos %3 ==2) {
                        echo '</tr><tr>';
                    }
                }
                echo '</tr>';
                echo '</table>';
            }
            function show_cell($which) {
                $token = $this->position[$which];
                //deal with the easy case
                if($token != '-') {
                    return '<td>'.$token.'</td>';
                }
                $this->newposition = $this->position;
                $this->newposition[$which] = 'o';
                $move = implode($this->newposition);
                $link ='/?board='.$move;
                return '<td><a href="'.$link.'">-</a></td>';
            }
        }
        
        //main
        $squares = filter_input(INPUT_GET, 'board');
        var_dump($squares);
        $game = new Game($squares);
        $game->display();

        if($game->winner('x')) {
            echo 'You win. Lucky guesses!';
        } else if ($game->winner('o')) {
            echo 'I win. Muahahaha';
        } else {
            echo 'No winner yet.';
        }
        ?>
    </body>
</html>
