<?php

declare(strict_types=1);

namespace IgorTregub\PostcodeGraphQL\Model\Resolver;

use IgorTregub\PostcodeGraphQL\Api\PostcodeRepositoryInterface;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Exception\GraphQlInputException;
use Magento\Framework\GraphQl\Query\Resolver\ContextInterface;
use Magento\Framework\GraphQl\Query\Resolver\Value;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;

/**
 * Class Postcodes
 */
class Postcodes implements ResolverInterface
{
    /**
     * @var PostcodeRepositoryInterface
     */
    private $postcodeRepository;

    /**
     * Postcodes constructor.
     *
     * @param PostcodeRepositoryInterface $postcodeRepository
     */
    public function __construct(PostcodeRepositoryInterface $postcodeRepository)
    {
        $this->postcodeRepository = $postcodeRepository;
    }

    /**
     * Fetches the data from persistence models and format it according to the GraphQL schema.
     *
     * @param Field            $field
     * @param ContextInterface $context
     * @param ResolveInfo      $info
     * @param array|null       $value
     * @param array|null       $args
     * @return mixed|Value
     * @throws \Exception
     */
    public function resolve(
        Field $field,
        $context,
        ResolveInfo $info,
        array $value = null,
        array $args = null
    ) {
        if (!isset($args['postcode_id'])) {
            throw new GraphQlInputException(__('"postcode_id" argument should be specified and not empty'));
        }

        $postcode = $this->postcodeRepository->getById($args['postcode_id']);

        return [
            'postcode_id' => $postcode->getId(),
            'postcode'    => $postcode->getPostcode(),
            'country_id'  => $postcode->getCountryId()
        ];
    }
}
