<?php

namespace Deck;


interface DeckInterface
{
    public function count();

    /**
     * @return array
     */
    public function getCards();

    /**
     * @param array $cards
     * @return mixed
     */
    public function setCards(array $cards);
}