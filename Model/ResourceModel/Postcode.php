<?php

declare(strict_types=1);

namespace IgorTregub\PostcodeGraphQL\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class Postcode
 */
class Postcode extends AbstractDb
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('postcode', 'postcode_id');
    }
}
