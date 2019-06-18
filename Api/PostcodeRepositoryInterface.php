<?php

declare(strict_types=1);

namespace IgorTregub\PostcodeGraphQL\Api;

use IgorTregub\PostcodeGraphQL\Api\Data\PostcodeInterface;
use IgorTregub\PostcodeGraphQL\Api\Data\PostcodeSearchResultsInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Interface PostcodeRepositoryInterface
 *
 * @api
 */
interface PostcodeRepositoryInterface
{
    /**
     * Save page.
     *
     * @param PostcodeInterface $postcode
     * @return PostcodeInterface
     * @throws LocalizedException
     */
    public function save(PostcodeInterface $postcode): PostcodeInterface;

    /**
     * Retrieve page.
     *
     * @param int $pageId
     * @return PostcodeInterface
     * @throws LocalizedException
     */
    public function getById(int $pageId): PostcodeInterface;

    /**
     * Retrieve pages matching the specified criteria.
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return PostcodeSearchResultsInterface
     * @throws LocalizedException
     */
    public function getList(SearchCriteriaInterface $searchCriteria): PostcodeSearchResultsInterface;

    /**
     * Delete postcode.
     *
     * @param PostcodeInterface $postcode
     * @return bool true on success
     * @throws LocalizedException
     */
    public function delete(PostcodeInterface $postcode): bool;

    /**
     * Delete postcode ID.
     *
     * @param int $postcodeId
     * @return bool true on success
     * @throws NoSuchEntityException
     * @throws LocalizedException
     */
    public function deleteById(int $postcodeId): bool;
}
