<?php
class Element
{
    private string $name;
    private array $weakness = [];

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function addWeakness(Element $element): void
    {
        $this->weakness[] = $element;
    }

    public function addWeaknesses(array $elements): void
    {
        foreach ($elements as $element) {

            if (! $element instanceof Element) continue;

            $this->addWeakness($element);
        }
    }
    public function isWeakAgainst(Element  $element):bool
    {
        return in_array($element, $this->weakness);
    }

}

class PLayer
{
    private string $name;
    private Element $selection;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSelection(): Element
    {
        return $this->selection;
    }

    public function setSelection(Element $selection): void
    {
        $this->selection = $selection;
    }
}

class Game
{
    private array $elements = [];

    private array $secondBattle = [];

    public function __construct()
    {
        $this->setup();
    }

    public function setup(): void
    {
        $this->elements = [
            $rock = new Element("Rock"),
            $paper = new Element("paper"),
            $scissors = new Element("Scissors"),
        ];

        $rock->addWeaknesses([$paper]);
        $paper->addWeaknesses([$scissors]);
        $scissors->addWeaknesses([$rock]);
    }

    private function displayElements():void
    {
        foreach ($this->elements as $key => $element) {
            echo "[{$key}] - {$element->getName()}" . PHP_EOL;
        }
    }

    public function start()
    {
        $attacker = new  PLayer(readline("Enter attacker name: "));
        $defender = new  PLayer("cpu1");
        $cpu1 = new  PLayer("cpu2");
        $cpu2 = new  PLayer("cpu3");


        $this->displayElements();

        $attackerSelectedElementIndex = (int)readline("[Attacker({$attacker->getName()})] select element:");
        $defenderSelectedElementIndex = random_int(0,2);
        $cpu1SelectedElementIndex = random_int(0,2);
        $cpu2SelectedElementIndex = random_int(0,2);

        $attacker->setSelection($this->elements[$attackerSelectedElementIndex]);
        $defender->setSelection($this->elements[$defenderSelectedElementIndex]);
        $cpu1->setSelection($this->elements[$cpu1SelectedElementIndex]);
        $cpu2->setSelection($this->elements[$cpu2SelectedElementIndex]);

        if ($attacker->getSelection() === $defender->getSelection()) {
            echo "The game is TIE! cpu1 =>{$defenderSelectedElementIndex}" . PHP_EOL;
        }

        if ($attacker->getSelection()->isWeakAgainst($defender->getSelection())) {
            echo "cpu1 has won! {$defenderSelectedElementIndex}" . PHP_EOL;

        } else {echo "Attacker {$attacker->getName()} has won {$attackerSelectedElementIndex}" . PHP_EOL;}



        if ($cpu1->getSelection() === $cpu2->getSelection()) {
            echo "cpu2:{$cpu1SelectedElementIndex} vs cpu3 {$cpu2SelectedElementIndex}";
            echo PHP_EOL;
            echo "The game of bots is TIE!" . PHP_EOL;
            exit;
        }
        if ($cpu1->getSelection()->isWeakAgainst($cpu2->getSelection())) {
            echo "cpu2:{$cpu1SelectedElementIndex} vs cpu3 {$cpu2SelectedElementIndex}";
            echo PHP_EOL;
            echo "cpu3 {$cpu2SelectedElementIndex} has won!";
        } else {
            echo "cpu2:{$cpu1SelectedElementIndex} vs cpu3 {$cpu2SelectedElementIndex}";
            echo PHP_EOL;
            echo "cpu2 has won" . PHP_EOL;}


    }
}

$game = new Game;
$game->start();


