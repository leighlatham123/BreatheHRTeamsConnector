<?php declare(strict_types=1);

namespace lib\teams;

interface TeamsInterface
{
    /**
     * @param array
     * @return array
     */
    public function sendAbsences(array $payload);

    /**
     * @param array
     * @return array
     */
    public function sendUpcomingAbsences(array $payload);
}