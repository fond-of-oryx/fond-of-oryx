<?php

namespace FondOfOryx\Glue\GlueApplicationAcl;

use FondOfOryx\Shared\GlueApplicationAcl\GlueApplicationAclConstants;
use Spryker\Glue\Kernel\AbstractBundleConfig;

/**
 * @codeCoverageIgnore
 */
class GlueApplicationAclConfig extends AbstractBundleConfig
{
    /**
     * @return array<mixed>
     */
    public function getUnprotectedResourceTypes(): array
    {
        return $this->get(
            GlueApplicationAclConstants::UNPROTECTED_RESOURCE_TYPES,
            GlueApplicationAclConstants::UNPROTECTED_RESOURCE_TYPES_DEFAULT,
        );
    }
}
