<?php
namespace Extention\CustomModule\Model;

use Extention\CustomModule\Api\Data\ExampleInterface;

class Example implements  ExampleInterface
{

    protected $value;

    /**
     * Return value.
     *
     * @return string|null
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set value.
     *
     * @param string|null $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }
}
