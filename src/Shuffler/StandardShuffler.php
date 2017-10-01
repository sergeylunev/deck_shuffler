<?php

namespace Shuffler;

use Deck\DeckInterface;

class StandardShuffler implements ShufflerInterface
{
    /**
     * @var DeckInterface
     */
    private $deck;

    public function __construct(DeckInterface $deck)
    {
        $this->deck = $deck;
    }

    public function shuffle($times = 3)
    {
        for ($i = 0; $i < $times; $i++) {
            $cards = $this->deck->getCards();
            $this->shuffling($cards);
        }

        return $this->deck;
    }

    public function shuffling(array $cards)
    {
        $numberOfPiles = mt_rand(3, 5);
        $cardsCount = count($cards);
        $cardsCountLeft = $cardsCount;
        $cardsInPiles = [];

        for ($i = 0; $i < $numberOfPiles; $i++) {
            // If we have last cards just put them in
            if (($i + 1) === $numberOfPiles) {
                $cardsInPiles[] = $cardsCountLeft;

                continue;
            }

            $cardsSliceGapSign = mt_rand(0, 1) ? '+1' : '-1';
            $cardsSliceGap = $cardsSliceGapSign * mt_rand(0, 5);
            $cardsSliceCount = (int)($cardsCountLeft / $numberOfPiles) + $cardsSliceGap;

            $cardsInPiles[] = $cardsSliceCount;
            $cardsCountLeft -= $cardsSliceCount;
        }

        $slices = new \SplStack();

        $offset = 0;
        foreach ($cardsInPiles as $cardsInPile) {
            $slices->push(array_slice($cards, $offset, $cardsInPile));
            $offset += $cardsInPile;
        }

        $result = [];
        foreach ($slices as $slice) {
            $result = array_merge($result, $slice);
        }

        $this->deck->setCards($result);
    }
}