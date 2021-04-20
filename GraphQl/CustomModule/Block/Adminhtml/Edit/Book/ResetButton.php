<?php

namespace GraphQl\CustomModule\Block\Adminhtml\Edit\Book;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * Class ResetButton
 * @package GraphQl\CustomModule\Block\Adminhtml\Edit\Book
 */
class ResetButton implements ButtonProviderInterface
{

    /**
     * @return array
     */
    public function getButtonData()
    {
        return [
            'label' => __('Reset'),
            'class' => 'reset',
            'on_click' => 'location.reload();',
            'sort_order' => 30
        ];
    }
}

