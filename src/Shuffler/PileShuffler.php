<?php

namespace Shuffler;

use Deck\DeckInterface;

class PileShuffler implements ShufflerInterface
{
    const DEFAULT_NUMBER_OF_PILES = 6;

    /**
     * @var DeckInterface
     */
    protected $deck;

    /**
     * PileShuffler constructor.
     * @param DeckInterface $deck
     */
    public function __construct(DeckInterface $deck)
    {
        $this->deck = $deck;
    }

    /**
     * @param int $times
     * @return DeckInterface
     */
    public function shuffle($times = 3)
    {
        for ($i = 0; $i < $times; $i++) {
            $cards = $this->deck->getCards();
            $this->shuffling($cards);
        }

        return $this->deck;
    }

    /**
     * @param $cards
     */
    protected function shuffling(array $cards)
    {
        $tempPiles = [];

        $pileIndex = 0;
        foreach ($cards as $card) {
            $tempPiles[$pileIndex][] = $card;
            $pileIndex++;

            if ($pileIndex === self::DEFAULT_NUMBER_OF_PILES) {
                $pileIndex = 0;
            }
        }

        $result = [];

        foreach ($tempPiles as $pile) {
            $result = array_merge($result, $pile);
        }

        $this->deck->setCards($result);
    }
}