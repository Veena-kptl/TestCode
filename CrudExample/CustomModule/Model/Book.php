<?php

namespace CrudExample\CustomModule\Model;

use Magento\Framework\Model\AbstractModel;
use CrudExample\CustomModule\Api\Data\BookInterface;
use CrudExample\CustomModule\Model\ResourceModel\Book as ResourceModel;

class Book extends AbstractModel implements BookInterface
{
    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'sc_book';

    /**
     * Parameter name in event
     * In observe method you can use $observer->getEvent()->getRule() in this case
     *
     * @var string
     */
    protected $_eventObject = 'book';

    /**
     * @return int
     */
    public function getProductId()
    {
        return $this->getData(self::KEY_PRODUCT_ID);
    }
    
    /**
     * @return string
     */
    public function getName()
    {
        return $this->getData(self::KEY_NAME);
    }
    /**
     * @return string
     */
    public function getContent()
    {
        return $this->getData(self::KEY_CONTENT);
    }
    /**
     * @return string
     */
    public function getType()
    {
        return $this->getData(self::KEY_TYPE);
    }
    /**
     * @return string
     */
    public function getLanguage()
    {
        return $this->getData(self::KEY_LANG);
    }
    /**
     * @return string
     */
    public function getColor()
    {
        return $this->getData(self::KEY_COLOR);
    }

    /**
     * @return int
     */
    public function getStatus()
    {
        return $this->getData(self::KEY_STATUS);
    }

    /**
     * @return string
     */
    public function getUpdatedAt()
    {
        return $this->getData(self::KEY_UPDATED_AT);
    }

    /**
     * @return string
     */
    public function getCreatedAt()
    {
        return $this->getData(self::KEY_CREATED_AT);
    }

    /**
     * @param int $productId
     * @return void
     */
    public function setProductId($productId)
    {
        $this->setData(self::KEY_PRODUCT_ID, $productId);
    }

    /**
     * @param string $content
     * @return void
     */
    public function setContent($content)
    {
        $this->setData(self::KEY_CONTENT, $content);
    }
      /**
     * @param string $content
     * @return void
     */
    public function setType($type)
    {
        $this->setData(self::KEY_TYPE, $type);
    }
     /**
     * @param string $content
     * @return void
     */
    public function setName($name)
    {
        $this->setData(self::KEY_NAME, $name);
    }
     /**
     * @param string $content
     * @return void
     */
    public function setLanguage($lang)
    {
        $this->setData(self::KEY_LANG, $lang);
    }
     /**
     * @param string $content
     * @return void
     */
    public function setColor($color)
    {
        $this->setData(self::KEY_COLOR, $color);
    }

    /**
     * @param int $status
     * @return void
     */
    public function setStatus($status)
    {
        $this->setData(self::KEY_STATUS, $status);
    }

    /**
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->_init(ResourceModel::class);
    }

    /**
     * @return int
     */
    public function getRating()
    {
        return $this->getData(self::KEY_RATING);
    }

    /**
     * @return string
     */
    public function getAuthor()
    {
        return $this->getData(self::KEY_AUTHOR);
    }

    /**
     * @param string $rating
     */
    public function setRating($rating)
    {
        $this->setData(self::KEY_RATING, $rating);
    }

    /**
     * @param int $author
     */
    public function setAuthor($author)
    {
        $this->setData(self::KEY_AUTHOR, $author);
    }

    public function getId()
    {
        return $this->getData(self::KEY_ID);
    }

    /**
     * {@inheritdoc}
     */
    public function setId($id)
    {
        return $this->setData(self::KEY_ID, $id);
    }
}
