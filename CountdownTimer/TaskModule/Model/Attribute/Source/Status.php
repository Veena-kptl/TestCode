<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace CountdownTimer\TaskModule\Model\Attribute\Source;

class Status extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource
{
    /**
     * Get all options
     * @return array
     */
    public function getAllOptions()
    {
        if (!$this->_options) {
            $this->_options = [
                ['label' => __('--Select--'), 'value' => ''],
                ['label' => __('Enabled'), 'value' => '0'],
            ];
        }
        return $this->_options;
    }
}
