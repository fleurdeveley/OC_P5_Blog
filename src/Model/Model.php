<?php

namespace Blog\Model;

use DateTime;

class Model
{
    public function __construct(array $data)
    {
        $this->hydrate($data);
    }

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

    protected function validateDate($date, $format = 'Y-m-d H:i:s')
    {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }
}