<?php
 
namespace PluginOverride\TemplateOverride\Block\Cart;
 
class AbstractCart
{
 
	public function afterGetItemRenderer(\Magento\Checkout\Block\Cart\AbstractCart $subject, $result)
	{
        $result->setTemplate('PluginOverride_TemplateOverride::cart/item/default.phtml');
    	return $result;
	}
}
