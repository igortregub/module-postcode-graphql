<?php

declare(strict_types=1);

namespace IgorTregub\PostcodeGraphQL\Model;

use IgorTregub\PostcodeGraphQL\Api\Data\PostcodeInterface;
use Magento\Framework\Model\AbstractModel;

/**
 * Class Postcode
 */
class Postcode extends AbstractModel implements PostcodeInterface
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(ResourceModel\Postcode::class);
    }

    /**
     * Get ID
     *
     * @return int|string
     */
    public function getId()
    {
        return $this->getData(self::POSTCODE_ID);
    }

    /**
     * Get postcode
     *
     * @return string
     */
    public function getPostcode(): ?string
    {
        return $this->getData(self::POSTCODE);
    }

    /**
     * Get country id
     *
     * @return string
     */
    public function getCountryId(): ?string
    {
        return $this->getData(self::COUNTRY_ID);
    }

    /**
     * Set ID
     *
     * @param int $id
     * @return $this
     */
    public function setId($id): PostcodeInterface
    {
        return $this->setData(self::POSTCODE_ID, $id);
    }

    /**
     * Set identifier
     *
     * @param string $postcode
     * @return $this
     */
    public function setPostcode(string $postcode): PostcodeInterface
    {
        return $this->setData(self::POSTCODE, $postcode);
    }

    /**
     * Set title
     *
     * @param string $countryId
     * @return $this
     */
    public function setCountryId(string $countryId): PostcodeInterface
    {
        return $this->setData(self::COUNTRY_ID, $countryId);
    }
}
