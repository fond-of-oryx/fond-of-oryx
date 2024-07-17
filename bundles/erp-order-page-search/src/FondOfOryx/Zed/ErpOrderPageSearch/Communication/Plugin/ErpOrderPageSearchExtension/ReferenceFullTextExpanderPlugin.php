<?php

namespace FondOfOryx\Zed\ErpOrderPageSearch\Communication\Plugin\ErpOrderPageSearchExtension;

use FondOfOryx\Zed\ErpOrderPageSearchExtension\Dependency\Plugin\FullTextExpanderPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

class ReferenceFullTextExpanderPlugin extends AbstractPlugin implements FullTextExpanderPluginInterface
{
    /**
     * @var string
     */
    public const KEY_REFERENCE = 'reference';

    /**
     * @param array $data
     * @param array<scalar> $fullText
     *
     * @return array<scalar>
     */
    public function expand(array $data, array $fullText): array
    {
        if (!isset($data[static::KEY_REFERENCE]) && $data[static::KEY_REFERENCE] !== null && $data[static::KEY_REFERENCE] !== '') {
            return $fullText;
        }

        $fullText[] = $data[static::KEY_REFERENCE];

        return $fullText;
    }
}
