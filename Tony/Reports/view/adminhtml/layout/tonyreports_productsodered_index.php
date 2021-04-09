<?xml version="1.0"?>
<!--
/**
 * Copyright � 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
-->
<page xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="urn:magento:framework:View/Layout/etc/page_configuration.xsd">
    <update handle="tonyreports_report_product_sold_grid"/>
    <body>
        <referenceContainer name="content">
            <block class="Tony\Reports\Block\Adminhtml\Product\Sold" name="adminhtml.report.grid.container"/>
        </referenceContainer>
    </body>
</page>
