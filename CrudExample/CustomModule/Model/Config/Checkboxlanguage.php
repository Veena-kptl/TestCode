<?php

namespace CrudExample\CustomModule\Model\Config;

class Checkboxlanguage extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource
{
    /**
     * Get all options
     * @return array
     */
    public function getAllOptions()
    {
        if (!$this->_options) {
            $this->_options = [
                ['label' => __('Hindi'), 'value' => 'Hindi'],
                ['label' => __('English'), 'value' => 'English'],
                ['label' => __('Gujarati'), 'value' => 'Gujarati'],
                ['label' => __('Marathi'), 'value' => 'Marathi'],
                ['label' => __('French'), 'value' => 'French'],
            ];
        }
        return $this->_options;
    }
}
