<?php
namespace OrderProcessing\TaskModule\Model;

use Magento\Checkout\Model\ConfigProviderInterface;

class ExtrafeeConfigProvider implements ConfigProviderInterface
{
    /**
     * @var \OrderProcessing\TaskModule\Helper\Data
     */
    protected $dataHelper;

    /**
     * @var \Magento\Checkout\Model\Session
     */
    protected $checkoutSession;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;

    /**
     * @param \OrderProcessing\TaskModule\Helper\Data $dataHelper
     * @param \Magento\Checkout\Model\Session $checkoutSession
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function __construct(
        \OrderProcessing\TaskModule\Helper\Data $dataHelper,
        \Magento\Checkout\Model\Session $checkoutSession,
        \Psr\Log\LoggerInterface $logger

    )
    {
        $this->dataHelper = $dataHelper;
        $this->checkoutSession = $checkoutSession;
        $this->logger = $logger;
    }

    /**
     * @return array
     */
    public function getConfig()
    {
        $TaskModuleConfig = [];
        $enabled = $this->dataHelper->isModuleEnabled();
        $minimumOrderAmount = $this->dataHelper->getMinimumOrderAmount();
        $TaskModuleConfig['fee_label'] = $this->dataHelper->getFeeLabel();
        $quote = $this->checkoutSession->getQuote();
        $subtotal = $quote->getSubtotal();
        $fee =($subtotal*$this->dataHelper->getExtraFee())/100;
        $TaskModuleConfig['custom_fee_amount'] = round($fee);
        $TaskModuleConfig['show_hide_TaskModule_block'] = ($enabled && ($minimumOrderAmount <= $subtotal) && $quote->getFee()) ? true : false;
        $TaskModuleConfig['show_hide_TaskModule_shipblock'] = ($enabled && ($minimumOrderAmount <= $subtotal)) ? true : false;
        return $TaskModuleConfig;
    }
}
