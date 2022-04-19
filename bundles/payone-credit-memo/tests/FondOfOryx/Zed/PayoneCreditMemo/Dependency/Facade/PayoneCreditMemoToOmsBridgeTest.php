<?php

namespace FondOfOryx\Zed\PayoneCreditMemo\Dependency\Facade;

use Codeception\Test\Unit;
use Propel\Runtime\Collection\ObjectCollection;
use Spryker\Zed\Oms\Business\OmsFacade;

class PayoneCreditMemoToOmsBridgeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Oms\Business\OmsFacadeInterface
     */
    protected $omsFacadeMock;

    /**
     * @var \FondOfOryx\Zed\PayoneCreditMemo\Dependency\Facade\PayoneCreditMemoToOmsBridge
     */
    protected $bridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->omsFacadeMock = $this->getMockBuilder(OmsFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bridge = new PayoneCreditMemoToOmsBridge($this->omsFacadeMock);
    }

    /**
     * @return void
     */
    public function testTriggerEvent(): void
    {
        static::assertNull($this->bridge->triggerEvent('1', new ObjectCollection(), [], []));
    }
}
