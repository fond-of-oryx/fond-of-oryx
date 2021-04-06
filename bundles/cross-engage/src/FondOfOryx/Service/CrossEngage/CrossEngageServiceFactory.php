<?php

namespace FondOfOryx\Service\CrossEngage;

use FondOfOryx\Service\CrossEngage\Model\Generator\HashGenerator;
use FondOfOryx\Service\CrossEngage\Model\Generator\HashGeneratorInterface;
use FondOfOryx\Service\CrossEngage\Model\Resolver\LanguagePrefixResolver;
use FondOfOryx\Service\CrossEngage\Model\Resolver\ResolverInterface;
use FondOfOryx\Service\CrossEngage\Model\Url\CrossEngageUrlBuilder;
use FondOfOryx\Service\CrossEngage\Model\Url\CrossEngageUrlBuilderInterface;
use FondOfOryx\Service\CrossEngage\Model\Validator\FormValidatorCollection;
use FondOfOryx\Service\CrossEngage\Model\Validator\FormValidatorCollectionInterface;
use Spryker\Service\Kernel\AbstractServiceFactory;
use Spryker\Shared\Kernel\Store;

/**
 * @method \FondOfOryx\Service\CrossEngage\CrossEngageConfig getConfig()
 */
class CrossEngageServiceFactory extends AbstractServiceFactory
{
    /**
     * @return \FondOfOryx\Service\CrossEngage\Model\Url\CrossEngageUrlBuilder
     */
    public function createCrossEngageUrlBuilder(): CrossEngageUrlBuilderInterface
    {
        return new CrossEngageUrlBuilder($this->getConfig());
    }

    /**
     * @return \FondOfOryx\Service\CrossEngage\Model\Generator\HashGeneratorInterface
     */
    public function createHashGenerator(): HashGeneratorInterface
    {
        return new HashGenerator($this->getConfig());
    }

    /**
     * @return \FondOfOryx\Service\CrossEngage\Model\Resolver\ResolverInterface
     */
    public function createLanguagePrefixResolver(): ResolverInterface
    {
        return new LanguagePrefixResolver($this->getStoreInstance());
    }

    /**
     * @return \FondOfOryx\Service\CrossEngage\Model\Validator\FormValidatorCollectionInterface
     */
    public function createFormValidatorCollection(): FormValidatorCollectionInterface
    {
        return new FormValidatorCollection($this->getProvidedDependency(CrossEngageDependencyProvider::CROSSENGAGE_FORM_VALIDATOR));
    }

    /**
     * @return \Spryker\Shared\Kernel\Store
     */
    public function getStoreInstance(): Store
    {
        return $this->getProvidedDependency(CrossEngageDependencyProvider::INSTANCE_STORE);
    }
}
