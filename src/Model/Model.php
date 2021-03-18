<?php

namespace Blog\Model;

use DateTime;

/**
 * Class Model
 */

abstract class Model
{
    /**
     * Model constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->hydrate($data);
    }

    /**
     * @param array $data
     */
    protected function hydrate(array $data)
    {
        foreach ($data as $key => $value)
        {
            $key = str_replace('_', '', ucwords($key, '_'));
            $method = 'set' . ucfirst($key);

            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
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