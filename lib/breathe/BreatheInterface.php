<?php declare(strict_types=1);

namespace lib\breathe;

interface BreatheInterface
{
    /**
     * @return array
     */
    public function getEmployees();

    /**
     * @param string $start_date
     * @param string $end_date
     * @return array
     */
    public function getAbsences();

    /**
     * @return string
     */
    public function getHost();

    /**
     * @return string
     */
    public function getKey();
}

