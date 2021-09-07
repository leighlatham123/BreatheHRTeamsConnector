<?php

namespace lib\teams\abstracts;

use lib\teams\Teams;
use lib\teams\abstracts\Absences;
use lib\teams\abstracts\UpcomingAbsences;

class Connectors extends Teams
{
    private $absences_webhook;

    public function __construct()
    {
        parent::__construct();

        $this->absences_webhook = getenv('TEAMS_ABSENCES_WEBHOOK') ?: null;;
    }

    public function sendAbsencesPayload($json_payload)
    {
        $absences = new Absences;

        return $absences->send($json_payload);
    }

    public function sendUpcomingAbsencesPayload($json_payload)
    {
        $absences = new UpcomingAbsences;

        return $absences->send($json_payload);
    }

    public function getAbsencesHook()
    {
        return $this->absences_webhook;
    }
}