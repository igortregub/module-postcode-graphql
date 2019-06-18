<?php

declare(strict_types=1);

namespace IgorTregub\PostcodeGraphQL\Api\Data;

/**
 * Postcode interface.
 *
 * @api
 */
interface PostcodeInterface
{
    /**
     * Postcode primary key
     */
    public const POSTCODE_ID = 'postcode_id';

    /**
     * postcode
     */
    public const POSTCODE = 'postcode';

    /**
     * country id (varchar), reference table directory_country_region
     */
    public const COUNTRY_ID = 'country_id';

    /**
     * Get ID
     *
     * @return int|string|null
     */
    public function getId();

    /**
     * Get postcode
     *
     * @return string|null
     */
    public function getPostcode(): ?string;

    /**
     * Get country id
     *
     * @return string|null
     */
    public function getCountryId(): ?string;

    /**
     * Set ID
     *
     * @param int $id
     * @return PostcodeInterface
     */
    public function setId($id): self;

    /**
     * Set identifier
     *
     * @param string $postcode
     * @return PostcodeInterface
     */
    public function setPostcode(string $postcode): self;

    /**
     * Set title
     *
     * @param string $countryId
     * @return PostcodeInterface
     */
    public function setCountryId(string $countryId): self;
}
