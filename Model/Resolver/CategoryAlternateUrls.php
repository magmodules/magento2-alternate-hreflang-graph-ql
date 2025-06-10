<?php
/**
 * Copyright © Magmodules.eu. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Magmodules\AlternateHreflangGraphQl\Model\Resolver;

use Magento\Catalog\Api\Data\CategoryInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magmodules\AlternateHreflang\Api\Category\RepositoryInterface as AlternateCategoryRepository;

class CategoryAlternateUrls extends BaseHreflangResolver implements ResolverInterface
{
    private AlternateCategoryRepository $alternateCategoryRepository;

    public function __construct(
        AlternateCategoryRepository $alternateCategoryRepository,
    ) {
        $this->alternateCategoryRepository = $alternateCategoryRepository;
    }

    public function resolve(
        Field $field,
        $context,
        ResolveInfo $info,
        array $value = null,
        array $args = null
    ) {
        return $this->getAlternateCategoryData($value);
    }

    /**
     * @throws LocalizedException
     */
    private function getAlternateCategoryData(?array $value = null): array
    {
        if (!isset($value['model']) || !$value['model'] instanceof CategoryInterface) {
            throw new LocalizedException(__('"model" value should be specified'));
        }

        $alternateData = $this->alternateCategoryRepository->getAlternateData($value['model']);
        return $this->formatHreflangLinks($alternateData);
    }
}
