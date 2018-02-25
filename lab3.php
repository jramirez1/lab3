<?php
    $names = array(
        "Plamen",
        "Jose",
        "Jason",
        "Alex");
        
    $players = array();
    $score = array();
    $cards = array();
        
    function getPlayers($numberOfPlayers){
        global $names, $players;
        
        $players = array_rand($names, $numberOfPlayers);
    }
    
    function generateDeck()
    {
        $card = array();
        
        for($i = 0; $i < 52; $i++)
        {
            array_push($card, ($i + 1));
            // echo $i;
        }
        shuffle($card);
        
        return $card;
    }
    
    global $deck;
    $deck = generateDeck();
    
    function getHand() {
        global $deck, $names, $players, $score;
        $player_cards = array();
        for ($i = 0; $i < count($players); $i++) {
            //echo  "<h2>" . $names[$players[$i]] . "<h2/>", "<img src='img/pokemon/" . $names[$players[$i]] . ".png'>";
            
            $score[$i] = 0;
            
            do {
                $crd = ($deck[(count($deck) - 1)] % 13) + 1;
                $cardSuit = rand(0, 3);
                $suitStr = "";
            
                switch($cardSuit) {
                    case 0:
                        $suitStr = "clubs";
                        break;
                    case 1:
                        $suitStr = "diamonds";
                        break;
                    case 2:
                        $suitStr = "hearts";
                        break;
                    case 3:
                        $suitStr = "spades";
                        break;
                }
                
                $temp = $crd.$suitStr;
                
                while (in_array($temp, $player_cards)) {
                    shuffle($deck);
                    $crd = ($deck[(count($deck) - 1)] % 13) + 1;
                    
                    $temp = $crd.$suitStr;
                }
                
                array_push($player_cards, $temp);
                
                echo "<img src = 'img/$suitStr/$crd.png' /> ";
            
                if ($crd >= 1 && $crd <= 13) {
                    $score[$i] = $score[$i] + $crd;
                } elseif ($crd >=14 && $crd <= 26){
                    $score[$i] = $score[$i] + $crd - 13;
                } elseif ($crd >= 27 && $crd <=39){
                    $score[$i] = ($score[$i] + $crd - 26);
                } else {
                    $score[$i] = ($score[$i] + $crd - 39);
                }
            
                array_pop($deck);
            
            } while ($score[$i] < 39);
            
            echo $score[$i] . " ";
        }
            return $score;
    }
    
 function displayWinner()
    {
        global $names,$players,$score, $winnings,$topscore;
        $max=0;
        $winners=0;
        for($i = 0; $i < count($players); $i++)
        {
            if($score[$i]>$max)
            {
               $max=$score[$i];
            }
        }
        for($s=0;$s< count($players); $s++){
                if($score[$s]<=42){
                if($score[$s]>$topscore){
                    $topscore=$score[$s];
                }
            }
        }
       
        for($i=0; $i<count($players); $i++){
            
            if($score[$i]==$topscore){
                echo "<h1>" . $names[$players[$i]]." Wins ".$winnings=+$score[0]+$score[1]+$score[2]+$score[3]." points!" . "<hr/>";
                echo "<br/>";
                $winners++;
                }
           }
           if($winners==0){
                echo "<h1> Nobody wins! <hr/>";
            }
        }
?>
<!DOCTYPE html>

<html>
<head>
     <style>
    @import url(lab3.css);
      
      </style>
       <h1 style="blue; background:#586BA4 "> Silver Jack </h1>
     <meta charset="utf-8">
     <title>Lab 3: Silverjack</title>
</head>

<body>
    <hr> 
    <?php
        
        getPlayers(4);
        getHand();
        displayWinner();
    ?>  
    <hr/>
</body>
    <footer>

    <footer/>