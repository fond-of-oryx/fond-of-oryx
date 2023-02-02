<?php

namespace FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Dependency\Client;

interface ErpDeliveryNotePageSearchRestApiToGlossaryStorageClientInterface
{
    /**
     * @param string $id
     * @param string $localeName
     * @param array $parameters
     *
     * @return string
     */
    public function translate(string $id, string $localeName, array $parameters = []): string;
}
