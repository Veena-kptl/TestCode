<?php

namespace CrudExample\CustomModule\Api\Data;

interface BookInterface
{
    const KEY_ID         = 'id';
    const KEY_NAME     = 'name';
    const KEY_PRODUCT_ID = 'product_id';
    const KEY_CONTENT    = 'content';
    const KEY_TYPE    = 'book_type';
    const KEY_STATUS     = 'status';
    const KEY_LANG     = 'language';
    const KEY_COLOR     = 'color';
    const KEY_RATING     = 'rating';
    const KEY_AUTHOR     = 'author';
    const KEY_CREATED_AT = 'created_at';
    const KEY_UPDATED_AT = 'updated_at';

    /**
     * @return string
     */
    public function getName();
    /**
     * @return int
     */
    public function getProductId();

    /**
     * @return string
     */
    public function getContent();
    
    /**
     * @return string
     */
    public function getType();
    
    /**
     * @return string
     */
    public function getLanguage();

    /**
     * @return string
     */
    public function getColor();
    /**
     * @return int
     */
    public function getStatus();

    /**
     * @return string
     */
    public function getUpdatedAt();

    /**
     * @return string
     */
    public function getCreatedAt();

    /**
     * @return int
     */
    public function getRating();

    /**
     * @return string
     */
    public function getAuthor();

    /**
     * @param string $name
     * @return void
     */
    public function setName($name);
    /**
     * @param int $productId
     * @return void
     */
    public function setProductId($productId);

    /**
     * @param string $content
     * @return void
     */
    public function setContent($content);
    
     /**
     * @param string $content
     * @return void
     */
    public function setType($type);
    
    /**
     * @param int $status
     * @return void
     */
    public function setStatus($status);

    /**
     * @param string $rating
     */
    public function setRating($rating);

    /**
     * @param int $author
     */
    public function setAuthor($author);

   /**
     * @param int $author
     */
    public function setLanguage($language);
}
