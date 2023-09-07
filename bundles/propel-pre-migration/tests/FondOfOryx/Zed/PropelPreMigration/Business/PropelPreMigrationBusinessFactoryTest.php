<?php

namespace FondOfOryx\Zed\PropelPreMigration\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\PropelPreMigration\Business\Model\SqlExecutorInterface;
use FondOfOryx\Zed\PropelPreMigration\Persistence\PropelPreMigrationEntityManager;
use FondOfOryx\Zed\PropelPreMigration\Persistence\PropelPreMigrationRepository;
use FondOfOryx\Zed\PropelPreMigration\PropelPreMigrationConfig;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Zed\Kernel\Container;

class PropelPreMigrationBusinessFactoryTest extends Unit
{
    /**
     * @var \Spryker\Zed\Kernel\Container|\PHPUnit\Framework\MockObject\MockObject
     */
    protected Container|MockObject $containerMock;

    /**
     * @var \FondOfOryx\Zed\PropelPreMigration\Persistence\PropelPreMigrationRepository|\PHPUnit\Framework\MockObject\MockObject
     */
    protected PropelPreMigrationRepository|MockObject $repositoryMock;

    /**
     * @var \FondOfOryx\Zed\PropelPreMigration\Persistence\PropelPreMigrationEntityManager|\PHPUnit\Framework\MockObject\MockObject
     */
    protected PropelPreMigrationEntityManager|MockObject $entityManagerMock;

    /**
     * @var \FondOfOryx\Zed\PropelPreMigration\PropelPreMigrationConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected PropelPreMigrationConfig|MockObject $configMock;

    /**
     * @var \FondOfOryx\Zed\PropelPreMigration\Business\PropelPreMigrationBusinessFactory
     */
    protected PropelPreMigrationBusinessFactory $factory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repositoryMock = $this->getMockBuilder(PropelPreMigrationRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->entityManagerMock = $this->getMockBuilder(PropelPreMigrationEntityManager::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->configMock = $this->getMockBuilder(PropelPreMigrationConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factory = new PropelPreMigrationBusinessFactory();

        $this->factory->setContainer($this->containerMock);
        $this->factory->setEntityManager($this->entityManagerMock);
        $this->factory->setRepository($this->repositoryMock);
        $this->factory->setConfig($this->configMock);
    }

    /**
     * @return void
     */
    public function testCreateSqlExecutor(): void
    {
        static::assertInstanceOf(
            SqlExecutorInterface::class,
            $this->factory
                ->createSqlExecutor(),
        );
    }
}
