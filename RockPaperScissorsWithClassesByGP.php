<?php

class Player
{
    private string $name;
    public array $choices = ["rock", "paper", "scissors", "spock", "lizard"];
    private ?string $chosenHand;
    private int $score = 0;

    public function __construct (string $name, $chosenHand = null)
    {
        $this->name = $name;
        if ($this->getName() === "Gatis") {
            $this->chosenHand = readline("Choose your element, $this->name [". implode("/", $this->choices) ."]");
        } else
        $this->chosenHand = $this->choices[random_int(0,4)];
        /*$this->chosenHand = readline("Play with cpu generated hand? y/n: ");
        if ($this->chosenHand == "y")
        {
            $this->chosenHand = $this->choices[random_int(0,4)];
        } else
            $this->chosenHand = readline("Choose your element: [". implode("/", $this->choices) ."]");*/
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getChoices(): string
    {
        return "Possible choices [".implode("/", $this->choices)."]";
    }

    public function getChosenHand (): string
    {
        return $this->chosenHand;
    }

    public function getScore(): int
    {
        return $this->score;
    }

    public function addScore(): void
    {
        $this->score += 1;
    }
    public function reNewHands() : void
    {
        if ($this->getName() === "Gatis") {
            $this->chosenHand = readline("Choose your element, $this->name [". implode("/", $this->choices) ."]");
        } else
        $this->chosenHand = $this->choices[random_int(0,4)];
    }

}

class Hands {

    private Player $player1;
    private Player $player2;
    private array $handcombinations =
        [
            'rock' => ['scissors', 'lizard'],
            'paper' => ['rock', 'spock'],
            'scissors' => ['paper', 'lizard'],
            'spock' => ['rock', 'scissors'],
            'lizard' => ['spock', 'paper']
        ];

//    public function __construct(Player $player1 , Player $player2)
//    {
//        $this->player1 = $player1;
//        $this->player2 = $player2;
//    }

    public function getWinner(Player $player1, Player $player2): string
    {
        if($player1->getChosenHand() == $player2->getChosenHand()) {
            return "It's a tie!";
        }

        (in_array($player2->getChosenHand(), $this->handcombinations[$player1->getChosenHand()])) ? $player1->addScore() : $player2->addScore();

        return (in_array($player2->getChosenHand(), $this->handcombinations[$player1->getChosenHand()])) ? $player1->getName() : $player2->getName();
    }
}

$allPlayers =
    [
        $cpu1 = new Player("Gatis"),
        $cpu2 = new Player("cpu2"),
        $cpu3 = new Player("cpu3"),
        $cpu4 = new Player("cpu4"),
        $cpu5 = new Player("cpu5"),
        $cpu6 = new Player("cpu6"),
        $cpu7 = new Player("cpu7"),
        $cpu8 = new Player("cpu8")
    ];

$semiFinalPlayers = [];

$finalPLayers = [];

$firstRound = new Hands();

while (!($cpu1->getScore()==2 xor $cpu2->getScore()==2))
{
    echo "{$cpu1->getName()}: {$cpu1->getChosenHand()}" . PHP_EOL;
    echo "{$cpu2->getName()}: {$cpu2->getChosenHand()}" . PHP_EOL;

    echo "Game winner is: " . ($firstRound->getWinner($cpu1, $cpu2)) . PHP_EOL;

    $cpu1->reNewHands();
    $cpu2->reNewHands();

};

while (!($cpu3->getScore()==2 xor $cpu4->getScore()==2)) {

    echo "{$cpu3->getName()}: {$cpu3->getChosenHand()}" . PHP_EOL;
    echo "{$cpu4->getName()}: {$cpu4->getChosenHand()}" . PHP_EOL;

    echo "Game winner is: " . ($firstRound->getWinner($cpu3, $cpu4)) . PHP_EOL;

    $cpu3->reNewHands();
    $cpu4->reNewHands();
};

while (!($cpu5->getScore()==2 xor $cpu6->getScore()==2)) {

    echo "{$cpu5->getName()}: {$cpu5->getChosenHand()}" . PHP_EOL;
    echo "{$cpu6->getName()}: {$cpu6->getChosenHand()}" . PHP_EOL;

    echo "Game winner is: " . ($firstRound->getWinner($cpu5, $cpu6)) . PHP_EOL;

    $cpu5->reNewHands();
    $cpu6->reNewHands();
};

while (!($cpu7->getScore()==2 xor $cpu8->getScore()==2)) {

    echo "{$cpu7->getName()}: {$cpu7->getChosenHand()}" . PHP_EOL;
    echo "{$cpu8->getName()}: {$cpu8->getChosenHand()}" . PHP_EOL;

    echo "Game winner is: " . ($firstRound->getWinner($cpu7, $cpu8)) . PHP_EOL;

    $cpu7->reNewHands();
    $cpu8->reNewHands();
};

echo "================= results after 1st set ====================".PHP_EOL;
echo $cpu1->getName() . " score:" . $cpu1->getScore() . PHP_EOL;
echo $cpu2->getName() . " score:" . $cpu2->getScore() . PHP_EOL;
echo $cpu3->getName() . " score:" . $cpu3->getScore() . PHP_EOL;
echo $cpu4->getName() . " score:" . $cpu4->getScore() . PHP_EOL;
echo $cpu5->getName() . " score:" . $cpu5->getScore() . PHP_EOL;
echo $cpu6->getName() . " score:" . $cpu6->getScore() . PHP_EOL;
echo $cpu7->getName() . " score:" . $cpu7->getScore() . PHP_EOL;
echo $cpu8->getName() . " score:" . $cpu8->getScore() . PHP_EOL;

echo "========================= Semi Final games ============================".PHP_EOL;

/** @var $player */
foreach ($allPlayers as $player) {
    if ($player->getScore() == 2) {
        $semiFinalPlayers[]=$player;
    }
}

while (!($semiFinalPlayers[0]->getScore()==4 xor $semiFinalPlayers[1]->getScore()==4)) {

    echo "{$semiFinalPlayers[0]->getName()}: {$semiFinalPlayers[0]->getChosenHand()}" . PHP_EOL;
    echo "{$semiFinalPlayers[1]->getName()}: {$semiFinalPlayers[1]->getChosenHand()}" . PHP_EOL;

    echo "Game winner is: " . ($firstRound->getWinner($semiFinalPlayers[0], $semiFinalPlayers[1])) . PHP_EOL;

    $semiFinalPlayers[0]->reNewHands();
    $semiFinalPlayers[1]->reNewHands();
};

while (!($semiFinalPlayers[2]->getScore()==4 xor $semiFinalPlayers[3]->getScore()==4)) {

    echo "{$semiFinalPlayers[2]->getName()}: {$semiFinalPlayers[2]->getChosenHand()}" . PHP_EOL;
    echo "{$semiFinalPlayers[3]->getName()}: {$semiFinalPlayers[3]->getChosenHand()}" . PHP_EOL;

    echo "Game winner is: " . ($firstRound->getWinner($semiFinalPlayers[2], $semiFinalPlayers[3])) . PHP_EOL;

    $semiFinalPlayers[2]->reNewHands();
    $semiFinalPlayers[3]->reNewHands();
};

echo "===================== Semi Final results ========================".PHP_EOL;
echo $semiFinalPlayers[0]->getName() . " score:" . $semiFinalPlayers[0]->getScore() . PHP_EOL;
echo $semiFinalPlayers[1]->getName() . " score:" . $semiFinalPlayers[1]->getScore() . PHP_EOL;
echo $semiFinalPlayers[2]->getName() . " score:" . $semiFinalPlayers[2]->getScore() . PHP_EOL;
echo $semiFinalPlayers[3]->getName() . " score:" . $semiFinalPlayers[3]->getScore() . PHP_EOL;

/** @var $player */
foreach ($semiFinalPlayers as $player) {
    if ($player->getScore() == 4) {
        $finalPlayers[]=$player;
    }
}

echo "========================= Final games ============================".PHP_EOL;
while (!($finalPlayers[0]->getScore()==6 xor $finalPlayers[1]->getScore()==6)) {

    echo "{$finalPlayers[0]->getName()}: {$finalPlayers[0]->getChosenHand()}" . PHP_EOL;
    echo "{$finalPlayers[1]->getName()}: {$finalPlayers[1]->getChosenHand()}" . PHP_EOL;

    echo "Game winner is: " . ($firstRound->getWinner($finalPlayers[0], $finalPlayers[1])) . PHP_EOL;

    $finalPlayers[0]->reNewHands();
    $finalPlayers[1]->reNewHands();
};
echo "===================== Final results ========================".PHP_EOL;
echo $finalPlayers[0]->getName() . " score:" . $finalPlayers[0]->getScore() . PHP_EOL;
echo $finalPlayers[1]->getName() . " score:" . $finalPlayers[1]->getScore() . PHP_EOL;


$finalPlayers[0]->getScore()>$finalPlayers[1]->getScore() ? $winner=$finalPlayers[0]->getName() : $winner = $finalPlayers[1]->getName();
echo PHP_EOL;
echo "Tournament WINNER: $winner !!! ".PHP_EOL;
echo PHP_EOL;

