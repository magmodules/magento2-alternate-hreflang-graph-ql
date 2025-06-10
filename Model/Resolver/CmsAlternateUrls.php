<?php
/**
 * Copyright © Magmodules.eu. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Magmodules\AlternateHreflangGraphQl\Model\Resolver;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magmodules\AlternateHreflang\Api\Cms\RepositoryInterface as AlternateCmsRepository;

class CmsAlternateUrls extends BaseHreflangResolver implements ResolverInterface
{
    private int $storeId;
    private AlternateCmsRepository $alternateCmsRepository;

    public function __construct(
        AlternateCmsRepository $alternateCmsRepository,
    ) {
        $this->alternateCmsRepository = $alternateCmsRepository;
    }

    public function resolve(
        Field $field,
        $context,
        ResolveInfo $info,
        array $value = null,
        array $args = null
    ) {
        $this->storeId = (int)$context->getExtensionAttributes()->getStore()->getId();
        return $this->getAlternateCmsPageData($value);
    }

    /**
     * @throws LocalizedException
     */
    private function getAlternateCmsPageData(?array $value = null): array
    {
        if (!isset($value['identifier'])) {
            throw new LocalizedException(__('"identifier" value should be specified'));
        }

        $alternateData = $this->alternateCmsRepository->getAlternateData($value['identifier'], $this->storeId);
        return $this->formatHreflangLinks($alternateData);
    }
}
