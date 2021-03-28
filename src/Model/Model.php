<?php

namespace Blog\Model;

use Blog\Hydrator;
use DateTime;

/**
 * Class Model
 */

abstract class Model
{
    use Hydrator;

    /**
     * Model constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        $this->hydrate($data);
    }

    /**
     * @param $date
     * @param string $format
     * @return bool
     */
    protected function validateDate($date, $format = 'Y-m-d H:i:s'): bool
    {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }
}