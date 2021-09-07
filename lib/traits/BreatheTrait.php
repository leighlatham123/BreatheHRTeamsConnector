<?php

namespace lib\traits;

trait BreatheTrait {

    private function filterAbsences($absences_json)
    {
        $absences_array = $this->decodeAbsences($absences_json);

        return array_map(array($this, 'matchValues'), $absences_array['absences']);
    }

    private function decodeAbsences($absences_json)
    {
        return json_decode($absences_json, true);
    }

    private function matchValues($array)
    {
        foreach ($array as $value)
        {
            return $array['employee']['first_name'] . " " . $array['employee']['last_name']
            . " - " . $array['type']
            . ": " . date('d/m/Y', strtotime($array['start_date']))
            . " - " . date('d/m/Y', strtotime($array['end_date']))
            . "<br>";
        }
    }
}