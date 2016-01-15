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
            function __construct($squares) {
                $this->position = str_split($squares);
            }         
            function winner($token) {
                $result = false;
                if($this->position[0] == $token && $this->position[1] == $token && $this->position[2] == $token) {
                    $result = true;
                } else if($this->position[3] == $token && $this->position[4] == $token && $this->position[5] == $token) {
                    $result = true;
                } else if($this->position[6] == $token && $this->position[7] == $token && $this->position[8] == $token) {
                    $result = true;
                } else if($this->position[0] == $token && $this->position[3] == $token && $this->position[6] == $token) {
                    $result = true;
                } else if($this->position[1] == $token && $this->position[4] == $token && $this->position[5] == $token) {
                    $result = true;
                } else if($this->position[2] == $token && $this->position[5] == $token && $this->position[8] == $token) {
                    $result = true;
                } else if($this->position[0] == $token && $this->position[4] == $token && $this->position[8] == $token) {
                    $result = true;
                } else if($this->position[2] == $token && $this->position[4] == $token && $this->position[6] == $token) {
                    $result = true;
                } else {
                    $result = false;
                }
                return $result;
            }
            
                //this function is full of lies
//            function winner($token) {   
//                for($row=0; $row<3; $row++) {
//                    $result = true;
//                    for($col=0;$col<3;$col++) {
//                        if($this->position[3*$row+$col] != $token) {
//                            $result = false;
//                        }
//                    }
//                }
//                return $result;
//            }         
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
        $game = new Game($squares);
        $game->display();

        if($game->winner('x')) {
            echo '[x] You win. Lucky guesses!';
        } else if ($game->winner('o')) {
            echo '[o] I win. Muahahaha';
        } else {
            echo 'No winner yet.';
        }
        ?>
    </body>
</html>
