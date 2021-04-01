<?php

namespace Blog;

/**
 * Trait
 */

trait Hydrator
{
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
}