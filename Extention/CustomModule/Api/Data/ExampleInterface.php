<?php

namespace Extention\CustomModule\Api\Data;


interface ExampleInterface
{
    /**
     * Return value.
     *
     * @return string|null
     */
    public function getValue();

    /**
     * Set value.
     *
     * @param string|null $value
     * @return $this
     */
    public function setValue($value);
}

