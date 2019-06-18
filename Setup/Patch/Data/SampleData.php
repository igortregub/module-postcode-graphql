<?php

declare(strict_types=1);

namespace IgorTregub\PostcodeGraphQL\Setup\Patch\Data;

use IgorTregub\PostcodeGraphQL\Api\Data\PostcodeInterface;
use IgorTregub\PostcodeGraphQL\Api\PostcodeRepositoryInterface;
use IgorTregub\PostcodeGraphQL\Model\Postcode;
use IgorTregub\PostcodeGraphQL\Model\PostcodeFactory;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Setup\Patch\DataPatchInterface;

/**
 * Class SampleData
 */
class SampleData implements DataPatchInterface
{
    /**
     * @var PostcodeRepositoryInterface
     */
    private $postcodeRepository;
    /**
     * @var PostcodeFactory
     */
    private $postcodeFactory;

    /**
     * SampleData constructor.
     *
     * @param PostcodeRepositoryInterface $postcodeRepository
     * @param PostcodeFactory             $postcodeFactory
     */
    public function __construct(PostcodeRepositoryInterface $postcodeRepository, PostcodeFactory $postcodeFactory)
    {
        $this->postcodeRepository = $postcodeRepository;
        $this->postcodeFactory    = $postcodeFactory;
    }

    /**
     * Get array of patches that have to be executed prior to this.
     *
     * example of implementation:
     *
     * [
     *      \Vendor_Name\Module_Name\Setup\Patch\Patch1::class,
     *      \Vendor_Name\Module_Name\Setup\Patch\Patch2::class
     * ]
     *
     * @return string[]
     */
    public static function getDependencies(): array
    {
        return [];
    }

    /**
     * Get aliases (previous names) for the patch.
     *
     * @return string[]
     */
    public function getAliases(): array
    {
        return [];
    }

    /**
     * Run code inside patch
     * If code fails, patch must be reverted, in case when we are speaking about schema - than under revert
     * means run PatchInterface::revert()
     *
     * If we speak about data, under revert means: $transaction->rollback()
     *
     * @return $this
     * @throws LocalizedException
     */
    public function apply(): self
    {
        for ($i = 1000; $i <= 1010; $i++) {
            /**
             * @var PostcodeInterface|AbstractModel $postcode
             */
            $postcode = $this->postcodeFactory->create();
            $postcode->setPostcode((string)$i)->setCountryId('US');
            $this->postcodeRepository->save($postcode);
            echo "Save {$postcode->getId()} {$postcode->getPostcode()} {$postcode->getCountryId()}\n";
        }

        return $this;
    }
}
