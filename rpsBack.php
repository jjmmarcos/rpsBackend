<?php
    header("Content-Type: application/json");
    // Only accept GET and a numberRpsSelected param between 1 and 3 (included)
    if(isset($_GET['numberRpsSelected']) && 
             $_GET['numberRpsSelected'] > 0 && $_GET['numberRpsSelected'] < 4) {
        $numberRpsSelectedByServer = rand(1, 3);
        $jsonResponse = array(
            'serverSelection' => isRockPaperOrScissors($numberRpsSelectedByServer),
            'gameResult' => gameResult($_GET['numberRpsSelected'], $numberRpsSelectedByServer)
        );
        echo json_encode($jsonResponse);
    }

    function gameResult($userSelection, $serverSelection) {
        if($userSelection == $serverSelection) return "Tie!";
        /* Logic used
        1 = Rock, 2 = Paper, 3 = Scissors
        1 y 2 = lose    2 y 1 = win    3 y 1 = lose        
        1 y 3 = win     2 y 3 = lose   3 y 2 = win */        
        if( $userSelection == 1 && $serverSelection == 3 ||
            $userSelection == 2 && $serverSelection == 1 ||
            $userSelection == 3 && $serverSelection == 2 ) 
            return 'You win!';
        else if( $userSelection == 1 && $serverSelection == 2 ||
                 $userSelection == 2 && $serverSelection == 3 ||
                 $userSelection == 3 && $serverSelection == 1 ) 
            return 'You lose!';
    }

    // Translate number into his corresponding type
    function isRockPaperOrScissors($numberOfSelection) {        
        switch ($numberOfSelection) {
            case 1:
                return 'rock';
                break;
            case 2:
                return 'paper';
                break;
            case 3:
                return 'scissors';
                break;
            default:
                return '';
                break;
        } 
    }
?>