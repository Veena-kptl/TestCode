<?php
namespace CountdownTimer\TaskModule\Ui\DataProvider\Product\Form\Modifier;

use Magento\Catalog\Model\Locator\LocatorInterface;
use Magento\Catalog\Ui\DataProvider\Product\Form\Modifier\AbstractModifier;
use Magento\Framework\Stdlib\ArrayManager;
use Magento\Framework\UrlInterface;
use Magento\Ui\Component\Container;
use Magento\Ui\Component\Form\Fieldset;

class DailyDeals extends AbstractModifier
{

    const SAMPLE_FIELDSET_NAME = 'custom_fieldset';
    const SAMPLE_FIELD_NAME = 'sample_field';

    /**
     * @var \Magento\Catalog\Model\Locator\LocatorInterface
     */
    protected $locator;

    /**
     * @var ArrayManager
     */
    protected $arrayManager;

    /**
     * @var UrlInterface
     */
    protected $urlBuilder;

    /**
     * @var array
     */
    protected $meta = [];

    /**
     * @param LocatorInterface $locator
     * @param ArrayManager $arrayManager
     * @param UrlInterface $urlBuilder
     */
    public function __construct(
        LocatorInterface $locator,
        ArrayManager $arrayManager,
        UrlInterface $urlBuilder
    ) {
        $this->locator = $locator;
        $this->arrayManager = $arrayManager;
        $this->urlBuilder = $urlBuilder;
    }

    public function modifyData(array $data)
    {
        return array_replace_recursive(
            $data,
            [
                $this->locator->getProduct()->getId() => [
                    static::DATA_SOURCE_DEFAULT => [
                        static::SAMPLE_FIELD_NAME => $this->locator->getProduct()->getData(static::SAMPLE_FIELD_NAME),
                    ]
                ]
            ]
        );
    }

    public function modifyMeta(array $meta)
    {
        $this->meta = $meta;
        $this->addFieldset();

        return $this->meta;
    }

    protected function addFieldset()
    {
        $this->meta = array_replace_recursive(
            $this->meta,
            [
                static::SAMPLE_FIELDSET_NAME => [
                    'arguments' => [
                        'data' => [
                            'config' => [
                                'label' => __('Sample Fieldset'),
                                'componentType' => Fieldset::NAME,
                                'dataScope' => 'data.product',
                                'collapsible' => true,
                                'sortOrder' => 10,
                            ],
                        ],
                    ],
                    'children' => [
                        'header_container' => $this->getHeaderContainerConfig(10),
                        // Add children here
                    ],
                ],
            ]
        );

        return $this;
    }

    /**
     * Get config for header container
     *
     * @param int $sortOrder
     * @return array
     */
    protected function getHeaderContainerConfig($sortOrder)
    {
        return [
            'arguments' => [
                'data' => [
                    'config' => [
                        'label' => null,
                        'formElement' => Container::NAME,
                        'componentType' => Container::NAME,
                        'sortOrder' => $sortOrder,
                        'content' => __('Sample content.'),
                    ],
                ],
            ],
            'children' => [
                'sample_container' => $this->getSampleContainer(10),
            ],
        ];
    }

    protected function getSampleContainer($sortOrder)
    {
        return [
            'arguments' => [
                'data' => [
                    'config' => [
                        'label' => null,
                        'formElement' => Fieldset::NAME,
                        'componentType' => Fieldset::NAME,
                        'sortOrder' => $sortOrder,
                        'additionalClasses' => 'admin__field-wide',
                    ],
                ],
            ],
            'children' => [
                static::SAMPLE_FIELD_NAME => $this->getSampleFieldConfig(10)
            ],
        ];
    }

    protected function getSampleFieldConfig($sortOrder)
    {
        return [
            'arguments' => [
                'data' => [
                    'config' => [
                        'label' => __('Sample Field'),
                        'componentType' => \Magento\Ui\Component\Form\Field::NAME,
                        'formElement' => \Magento\Ui\Component\Form\Element\Input::NAME,
                        'dataScope' => static::SAMPLE_FIELD_NAME,
                        'dataType' => \Magento\Ui\Component\Form\Element\DataType\Text::NAME,
                        'sortOrder' => $sortOrder,
                        'validation' => [
                            'letters-with-basic-punc' => true,
                        ],
                        'required' => true,
                    ],
                ],
            ],
            'children' => [],
        ];
    }
}
