<?php

namespace FondOfOryx\Zed\ReturnLabel\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ReturnLabel\Business\Api\Adapter\ReturnLabelAdapterInterface;
use FondOfOryx\Zed\ReturnLabel\Business\Mapper\ReturnLabelAddressMapperInterface;
use FondOfOryx\Zed\ReturnLabel\Business\Model\CompanyUnitAddressResourceReaderInterface;
use FondOfOryx\Zed\ReturnLabel\Business\Model\ReturnLabelGeneratorInterface;
use FondOfOryx\Zed\ReturnLabel\Dependency\Service\ReturnLabelToUtilEncodingServiceBridge;
use FondOfOryx\Zed\ReturnLabel\Dependency\Service\ReturnLabelToUtilEncodingServiceInterface;
use FondOfOryx\Zed\ReturnLabel\Persistence\ReturnLabelRepository;
use FondOfOryx\Zed\ReturnLabel\ReturnLabelConfig;
use FondOfOryx\Zed\ReturnLabel\ReturnLabelDependencyProvider;
use GuzzleHttp\ClientInterface as HttpClientInterface;
use Spryker\Zed\Kernel\Container;

class ReturnLabelBusinessFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Zed\ReturnLabel\Persistence\ReturnLabelRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \FondOfOryx\Zed\ReturnLabel\ReturnLabelConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $configMock;

    /**
     * @var \FondOfOryx\Zed\ReturnLabel\Dependency\Service\ReturnLabelToUtilEncodingServiceInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $returnLabelToUtilEncodingServiceMock;

    /**
     * @var \FondOfOryx\Zed\ReturnLabel\Business\ReturnLabelBusinessFactory
     */
    protected $factory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repositoryMock = $this->getMockBuilder(ReturnLabelRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->configMock = $this->getMockBuilder(ReturnLabelConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->returnLabelToUtilEncodingServiceMock = $this->getMockBuilder(ReturnLabelToUtilEncodingServiceBridge::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factory = new ReturnLabelBusinessFactory();
        $this->factory->setRepository($this->repositoryMock);
        $this->factory->setContainer($this->containerMock);
        $this->factory->setConfig($this->configMock);
    }

    /**
     * @return void
     */
    public function testCreateReturnLabelGenerator(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->withConsecutive([ReturnLabelDependencyProvider::SERVICE_UTIL_ENCODING])
            ->willReturnOnConsecutiveCalls($this->returnLabelToUtilEncodingServiceMock);

        static::assertInstanceOf(
            ReturnLabelGeneratorInterface::class,
            $this->factory->createReturnLabelGenerator()
        );
    }

    /**
     * @retrun void
     *
     * @return void
     */
    public function testCreateCompanyUnitAddressReader(): void
    {
        static::assertInstanceOf(
            CompanyUnitAddressResourceReaderInterface::class,
            $this->factory->createCompanyUnitAddressResourceReader()
        );
    }

    /**
     * @retrun void
     *
     * @return void
     */
    public function testCreateReturnLabelAdapter(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->withConsecutive([ReturnLabelDependencyProvider::SERVICE_UTIL_ENCODING])
            ->willReturnOnConsecutiveCalls($this->returnLabelToUtilEncodingServiceMock);

        static::assertInstanceOf(
            ReturnLabelAdapterInterface::class,
            $this->factory->createReturnLabelAdapter()
        );
    }

    /**
     * @retrun void
     *
     * @return void
     */
    public function testCreateReturnLabelAddressMapper()
    {
        static::assertInstanceOf(
            ReturnLabelAddressMapperInterface::class,
            $this->factory->createReturnLabelAddressMapper()
        );
    }

    /**
     * @retrun void
     *
     * @return void
     */
    public function testCreateHttpClient(): void
    {
        static::assertInstanceOf(
            HttpClientInterface::class,
            $this->factory->createHttpClient()
        );
    }

    /**
     * @retrun void
     *
     * @return void
     */
    public function testGetUtilEncodingService(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->withConsecutive([ReturnLabelDependencyProvider::SERVICE_UTIL_ENCODING])
            ->willReturnOnConsecutiveCalls($this->returnLabelToUtilEncodingServiceMock);

        $this->assertInstanceOf(
            ReturnLabelToUtilEncodingServiceInterface::class,
            $this->factory->getUtilEncodingService()
        );
    }
}
