<?php

namespace lib\traits;

trait TeamsTrait {

    private function encodePayload($payload_array)
    {
        return json_encode($payload_array);
    }
}