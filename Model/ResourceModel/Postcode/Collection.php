<?php

declare(strict_types=1);

namespace IgorTregub\PostcodeGraphQL\Model\ResourceModel\Postcode;

use IgorTregub\PostcodeGraphQL\Model\Postcode as PostcodeModel;
use IgorTregub\PostcodeGraphQL\Model\ResourceModel\Postcode as PostcodeResourceModel;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Class Collection
 */
class Collection extends AbstractCollection
{
    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(PostcodeModel::class, PostcodeResourceModel::class);
    }
}
