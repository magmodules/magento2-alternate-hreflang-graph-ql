<?php
/**
 * Copyright © Magmodules.eu. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Magmodules\AlternateHreflangGraphQl\Model\Resolver;

abstract class BaseHreflangResolver
{
    /**
     * Formats alternate URLs into a standardized HreflangLink structure.
     *
     * @param array $alternateData
     * @return array[] Each item contains 'code' and 'url' keys
     */
    protected function formatHreflangLinks(array $alternateData): array
    {
        $hreflangLinks = [];
        $urls = $alternateData['urls'] ?? [];
        foreach ($urls as $code => $url) {
            if (!empty($code) && !empty($url)) {
                $hreflangLinks[] = [
                    'code' => $code,
                    'url' => $url,
                ];
            }
        }

        return $hreflangLinks;
    }
}
