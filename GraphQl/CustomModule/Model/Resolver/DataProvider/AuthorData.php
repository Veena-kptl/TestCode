<?php

declare(strict_types=1);

namespace GraphQl\CustomModule\Model\Resolver\DataProvider;

use GraphQl\CustomModule\Model\Author;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Widget\Model\Template\FilterEmulate;

/**
 * AuthorData data provider
 */
class AuthorData
{
    /**
     * @var FilterEmulate
     */
    private $widgetFilter;

    /**
     * @var Author
     */
    private $author;

    /**
     * @param Author $author
     * @param FilterEmulate $widgetFilter
     */
    public function __construct(
        Author $author,
        FilterEmulate $widgetFilter
    ) {
        $this->author = $author;
        $this->widgetFilter = $widgetFilter;
    }

    /**
     * @param int $authorId
     * @return array
     * @throws NoSuchEntityException
     */
    public function getData(int $authorId): array
    {
        $authorData = $this->author->load($authorId);
		
        if (false === $authorData->getId()) {
            throw new NoSuchEntityException();
        }
        
        $authorLoadedData[] = $authorData->getData();
        
        return $authorLoadedData;
    }
}

