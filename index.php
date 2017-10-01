<?php

include "vendor/autoload.php";

class Deck implements \Deck\DeckInterface
{
    protected $cards;

    public function __construct()
    {
        $this->cards = [];

        for ($i = 0; $i < 52; $i++) {
            $this->cards[$i] = $i+1;
        }
    }

    /**
     * @return int
     */
    public function count()
    {
        return count($this->cards);
    }

    /**
     * @return array
     */
    public function getCards()
    {
        return $this->cards;
    }

    /**
     * @param array $cards
     * @return mixed
     */
    public function setCards(array $cards)
    {
        $this->cards = $cards;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        $result = '';

        foreach ($this->cards as $card) {
            $result .= $card.'; ';
        }

        return $result;
    }
}

$deck = new Deck();
var_dump((string)$deck);
//$shuffler = new \Shuffler\StandardShuffler($deck);
$shuffler = new Shuffler\PileShuffler($deck);

$newDeck = $shuffler->shuffle(7);

var_dump((string)$newDeck);
