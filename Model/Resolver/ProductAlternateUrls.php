<?php
/**
 * Copyright © Magmodules.eu. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Magmodules\AlternateHreflangGraphQl\Model\Resolver;

use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magmodules\AlternateHreflang\Api\Product\RepositoryInterface as AlternateProductRepository;

class ProductAlternateUrls extends BaseHreflangResolver implements ResolverInterface
{
    private AlternateProductRepository $alternateProductRepository;

    public function __construct(
        AlternateProductRepository $alternateProductRepository,
    ) {
        $this->alternateProductRepository = $alternateProductRepository;
    }

    public function resolve(
        Field $field,
        $context,
        ResolveInfo $info,
        array $value = null,
        array $args = null
    ) {
        return $this->getAlternateProductData($value);
    }

    /**
     * @throws LocalizedException
     */
    private function getAlternateProductData(?array $value = null): array
    {
        if (!isset($value['model']) || !$value['model'] instanceof ProductInterface) {
            throw new LocalizedException(__('"model" value should be specified'));
        }

        $alternateData = $this->alternateProductRepository->getAlternateData($value['model']);
        return $this->formatHreflangLinks($alternateData);
    }
}
