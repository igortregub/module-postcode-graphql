<?php

declare(strict_types=1);

namespace IgorTregub\PostcodeGraphQL\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * Interface for postcode search results.
 *
 * @api
 */
interface PostcodeSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get pages list.
     *
     * @return PostcodeInterface[]
     */
    public function getItems(): array;

    /**
     * Set pages list.
     *
     * @param PostcodeInterface[] $items
     * @return $this
     */
    public function setItems(array $items): self;
}
