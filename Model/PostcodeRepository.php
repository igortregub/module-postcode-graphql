<?php

declare(strict_types=1);

namespace IgorTregub\PostcodeGraphQL\Model;

use IgorTregub\PostcodeGraphQL\Api\Data\PostcodeInterface;
use IgorTregub\PostcodeGraphQL\Api\Data\PostcodeSearchResultsInterface;
use IgorTregub\PostcodeGraphQL\Api\Data\PostcodeSearchResultsInterfaceFactory;
use IgorTregub\PostcodeGraphQL\Api\PostcodeRepositoryInterface;
use IgorTregub\PostcodeGraphQL\Model\ResourceModel\Postcode as PostcodeResource;
use IgorTregub\PostcodeGraphQL\Model\ResourceModel\Postcode\Collection;
use IgorTregub\PostcodeGraphQL\Model\ResourceModel\Postcode\CollectionFactory as PostcodeCollectionFactory;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Model\AbstractModel;

/**
 * Class PostcodeRepository
 */
class PostcodeRepository implements PostcodeRepositoryInterface
{
    /**
     * @var PostcodeResource
     */
    private $resource;
    /**
     * @var PostcodeFactory
     */
    private $postcodeFactory;
    /**
     * @var PostcodeCollectionFactory
     */
    private $postcodeCollectionFactory;
    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;
    /**
     * @var PostcodeSearchResultsInterfaceFactory
     */
    private $searchResultsFactory;

    /**
     * PostcodeRepository constructor.
     *
     * @param PostcodeResource                      $postcodeResource
     * @param PostcodeFactory                       $postcodeFactory
     * @param PostcodeCollectionFactory             $postcodeCollectionFactory
     * @param CollectionProcessorInterface          $collectionProcessor
     * @param PostcodeSearchResultsInterfaceFactory $searchResultsFactory
     */
    public function __construct(
        PostcodeResource $postcodeResource,
        PostcodeFactory $postcodeFactory,
        PostcodeCollectionFactory $postcodeCollectionFactory,
        CollectionProcessorInterface $collectionProcessor,
        PostcodeSearchResultsInterfaceFactory $searchResultsFactory
    ) {
        $this->resource                  = $postcodeResource;
        $this->postcodeFactory           = $postcodeFactory;
        $this->postcodeCollectionFactory = $postcodeCollectionFactory;
        $this->collectionProcessor       = $collectionProcessor;
        $this->searchResultsFactory      = $searchResultsFactory;
    }

    /**
     * Save postcode data
     *
     * @param PostcodeInterface|AbstractModel $postcode
     * @return PostcodeInterface
     * @throws CouldNotSaveException
     */
    public function save(PostcodeInterface $postcode): PostcodeInterface
    {
        try {
            $this->resource->save($postcode);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(
                __('Could not save the postcode: %1', $exception->getMessage()),
                $exception
            );
        }

        return $postcode;
    }

    /**
     * Load postcode data by given postcode id
     *
     * @param int $postcodeId
     * @return PostcodeInterface
     * @throws NoSuchEntityException
     */
    public function getById(int $postcodeId): PostcodeInterface
    {
        /**
         * @var PostcodeInterface $postcode
         */
        $postcode = $this->postcodeFactory->create();
        $postcode->load($postcodeId);
        if (!$postcode->getId()) {
            throw new NoSuchEntityException(__('The postcode with the "%1" ID doesn\'t exist.', $postcodeId));
        }

        return $postcode;
    }

    /**
     * Load postcode data collection by given search criteria
     *
     * @param SearchCriteriaInterface $criteria
     * @return PostcodeSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $criteria): PostcodeSearchResultsInterface
    {
        /**
         * @var Collection $collection
         */
        $collection = $this->postcodeCollectionFactory->create();

        $this->collectionProcessor->process($criteria, $collection);

        /**
         * @var PostcodeSearchResultsInterface $searchResults
         */
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());

        return $searchResults;
    }

    /**
     * Delete postcode
     *
     * @param PostcodeInterface|AbstractModel $postcode
     * @return bool
     * @throws CouldNotDeleteException
     */
    public function delete(PostcodeInterface $postcode): bool
    {
        try {
            $this->resource->delete($postcode);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the postcode: %1',
                $exception->getMessage()
            ));
        }

        return true;
    }

    /**
     * Delete postcode by given postcode id
     *
     * @param int $postcodeId
     * @return bool
     * @throws CouldNotDeleteException
     * @throws NoSuchEntityException
     */
    public function deleteById(int $postcodeId): bool
    {
        return $this->delete($this->getById($postcodeId));
    }
}
