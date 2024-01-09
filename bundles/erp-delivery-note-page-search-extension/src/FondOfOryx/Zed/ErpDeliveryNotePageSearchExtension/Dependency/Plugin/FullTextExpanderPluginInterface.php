<?php

namespace FondOfOryx\Zed\ErpDeliveryNotePageSearchExtension\Dependency\Plugin;

interface FullTextExpanderPluginInterface
{
    /**
     * @param array $data
     * @param array<scalar> $fullText
     *
     * @return array<scalar>
     */
    public function expand(array $data, array $fullText): array;
}
