<?php
namespace OrderProcessing\TaskModule\Model;

use Magento\Checkout\Model\ConfigProviderInterface;
use Magento\Quote\Model\Quote;

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

    protected $taxHelper;

    /**
     * @param \OrderProcessing\TaskModule\Helper\Data $dataHelper
     * @param \Magento\Checkout\Model\Session $checkoutSession
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function __construct(
        \OrderProcessing\TaskModule\Helper\Data $dataHelper,
        \Magento\Checkout\Model\Session $checkoutSession,
        \Psr\Log\LoggerInterface $logger,
        \OrderProcessing\TaskModule\Helper\Tax $helperTax

    )
    {
        $this->dataHelper = $dataHelper;
        $this->checkoutSession = $checkoutSession;
        $this->logger = $logger;
        $this->taxHelper = $helperTax;
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
        $fee = $this->dataHelper->getExtraFee();
        $fee= ($subtotal*$fee)/100;
        $TaskModuleConfig['custom_fee_amount'] = round($fee);
        if ($this->taxHelper->isTaxEnabled() && $this->taxHelper->displayInclTax()) {
            $address = $this->_getAddressFromQuote($quote);
            $TaskModuleConfig['custom_fee_amount'] = $this->dataHelper->getExtraFee() + $address->getFeeTax();
        }
        if ($this->taxHelper->isTaxEnabled() && $this->taxHelper->displayBothTax()) {

            $address = $this->_getAddressFromQuote($quote);
            $TaskModuleConfig['custom_fee_amount'] = $fee;
            $TaskModuleConfig['custom_fee_amount_inc'] = $this->dataHelper->getExtraFee() + $address->getFeeTax();

        }
        $TaskModuleConfig['displayInclTax'] = $this->taxHelper->displayInclTax();
        $TaskModuleConfig['displayExclTax'] = $this->taxHelper->displayExclTax();
        $TaskModuleConfig['displayBoth'] = $this->taxHelper->displayBothTax();
        $TaskModuleConfig['exclTaxPostfix'] = __('Excl. Tax');
        $TaskModuleConfig['inclTaxPostfix'] = __('Incl. Tax');
        $TaskModuleConfig['TaxEnabled'] = $this->taxHelper->isTaxEnabled();
        $TaskModuleConfig['show_hide_TaskModule_block'] = ($enabled && ($minimumOrderAmount <= $subtotal) && $quote->getFee()) ? true : false;
        $TaskModuleConfig['show_hide_TaskModule_shipblock'] = ($enabled && ($minimumOrderAmount <= $subtotal)) ? true : false;
        return $TaskModuleConfig;
    }

    protected function _getAddressFromQuote(Quote $quote)
    {
        return $quote->isVirtual() ? $quote->getBillingAddress() : $quote->getShippingAddress();
    }
}
