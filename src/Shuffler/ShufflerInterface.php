<?php

namespace Shuffler;

use Deck\DeckInterface;

interface ShufflerInterface
{
    public function __construct(DeckInterface $deck);

    public function shuffle($times);
}