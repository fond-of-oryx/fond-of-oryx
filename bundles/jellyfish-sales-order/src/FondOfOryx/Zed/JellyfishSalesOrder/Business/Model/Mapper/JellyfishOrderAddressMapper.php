<?php

namespace FondOfOryx\Zed\JellyfishSalesOrder\Business\Model\Mapper;

use Generated\Shared\Transfer\JellyfishOrderAddressTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrderAddress;

class JellyfishOrderAddressMapper implements JellyfishOrderAddressMapperInterface
{
    /**
     * @var array<\FondOfOryx\Zed\JellyfishSalesOrderExtension\Dependency\Plugin\JellyfishOrderAddressExpanderPostMapPluginInterface>
     */
    protected $jellyfishOrderAddressExpanderPostMapPlugins;

    /**
     * @param array<\FondOfOryx\Zed\JellyfishSalesOrderExtension\Dependency\Plugin\JellyfishOrderAddressExpanderPostMapPluginInterface> $jellyfishOrderAddressExpanderPostMapPlugins
     */
    public function __construct(array $jellyfishOrderAddressExpanderPostMapPlugins)
    {
        $this->jellyfishOrderAddressExpanderPostMapPlugins = $jellyfishOrderAddressExpanderPostMapPlugins;
    }

    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrderAddress $salesOrderAddress
     *
     * @return \Generated\Shared\Transfer\JellyfishOrderAddressTransfer
     */
    public function fromSalesOrderAddress(SpySalesOrderAddress $salesOrderAddress): JellyfishOrderAddressTransfer
    {
        $jellyfishOrderAddressTransfer = (new JellyfishOrderAddressTransfer())
            ->fromArray($salesOrderAddress->toArray(), true);

        $jellyfishOrderAddressTransfer->setId($salesOrderAddress->getIdSalesOrderAddress())
            ->setName1($salesOrderAddress->getFirstName())
            ->setName2($salesOrderAddress->getLastName())
            ->setCountry($salesOrderAddress->getCountry()->getIso2Code());

        return $this->expandOrderAddressTransfer($jellyfishOrderAddressTransfer, $salesOrderAddress);
    }

    /**
     * @param \Generated\Shared\Transfer\JellyfishOrderAddressTransfer $jellyfishOrderAddressTransfer
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrderAddress $salesOrderAddress
     *
     * @return \Generated\Shared\Transfer\JellyfishOrderAddressTransfer
     */
    protected function expandOrderAddressTransfer(
        JellyfishOrderAddressTransfer $jellyfishOrderAddressTransfer,
        SpySalesOrderAddress $salesOrderAddress
    ): JellyfishOrderAddressTransfer {
        foreach ($this->jellyfishOrderAddressExpanderPostMapPlugins as $jellyfishOrderAddressExpanderPostMapPlugin) {
            $jellyfishOrderAddressTransfer = $jellyfishOrderAddressExpanderPostMapPlugin->expand($jellyfishOrderAddressTransfer, $salesOrderAddress);
        }

        return $jellyfishOrderAddressTransfer;
    }
}
