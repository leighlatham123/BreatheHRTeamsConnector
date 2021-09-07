<?php declare(strict_types=1);

namespace lib\breathe;

use lib\traits\BreatheTrait;
use lib\breathe\abstracts\Absences;
use lib\breathe\abstracts\Employees;

class Breathe implements BreatheInterface 
{
    use BreatheTrait;

    /**
     * @var string
     */
    protected $breath_api_key;

    /**
     * @var string
     */
    protected $breath_api_host;

    public function __construct()
    {
        $this->breath_api_host = getenv('BREATHE_API_HOST') ?: null;
        $this->breath_api_key = getenv('BREATHE_API_KEY') ?: null;
    }

    public function getEmployees()
    {
        $employees = new Employees;
        
        return $employees->get();  
    }

    public function getAbsences($start_date = null, $end_date = null)
    {
        $absences = new Absences;

        $results = $absences->get($this->setBodyArray($start_date, $end_date));

        return $this->filterAbsences($results);
    }

    public function getHost()
    {
        return $this->breath_api_host;
    }

    public function getKey()
    {
        return $this->breath_api_key;
    }

    private function setBodyArray($start_date, $end_date)
    {
        $start_date = $start_date ?: date('Y-m-d');
        $end_date = $end_date ?: date('Y-m-d');

        return array(
            'start_date' => $start_date, 
            'end_date' => $end_date
        );
    }
}

