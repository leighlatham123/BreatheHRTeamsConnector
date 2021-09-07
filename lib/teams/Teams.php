<?php declare(strict_types=1);

namespace lib\teams;

use lib\traits\TeamsTrait;
use lib\teams\abstracts\Connectors;

class Teams implements TeamsInterface 
{
    use TeamsTrait;

    private static $connectors;

    public function __construct()
    {
    }

    /**
     * @inheritdoc
     */
    public function sendAbsences($payload)
    {
        $connectors = new Connectors;

        return $connectors->sendAbsencesPayload($payload);
    }
}