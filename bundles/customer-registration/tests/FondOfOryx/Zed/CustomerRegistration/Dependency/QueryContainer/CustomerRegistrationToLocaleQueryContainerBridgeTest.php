<?php

namespace FondOfOryx\Zed\CustomerRegistration\Dependency\QueryContainer;

use Codeception\Test\Unit;
use Orm\Zed\Locale\Persistence\SpyLocaleQuery;
use Spryker\Zed\Locale\Persistence\LocaleQueryContainerInterface;

class CustomerRegistrationToLocaleQueryContainerBridgeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CustomerRegistration\Dependency\QueryContainer\CustomerRegistrationToLocaleQueryContainerInterface
     */
    protected $queryContainer;

    /**
     * @var \Spryker\Zed\Locale\Persistence\LocaleQueryContainerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $localeQueryContainerMock;

    /**
     * @var \Orm\Zed\Locale\Persistence\SpyLocaleQuery|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $spyLocaleQueryMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->localeQueryContainerMock = $this->getMockBuilder(LocaleQueryContainerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->spyLocaleQueryMock = $this->getMockBuilder(SpyLocaleQuery::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->queryContainer = new CustomerRegistrationToLocaleQueryContainerBridge(
            $this->localeQueryContainerMock,
        );
    }

    /**
     * @return void
     */
    public function testQueryLocaleByName(): void
    {
        $this->localeQueryContainerMock->expects(static::atLeastOnce())->method('queryLocaleByName')->willReturn($this->spyLocaleQueryMock);

        $this->queryContainer->queryLocaleByName('locale');
    }
}
