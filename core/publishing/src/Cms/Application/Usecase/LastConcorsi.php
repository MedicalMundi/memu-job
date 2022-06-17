<?php declare(strict_types=1);

namespace Publishing\Cms\Application\Usecase;

interface LastConcorsi
{
    public function lastConcorsi(int $max = 10): array;
}
