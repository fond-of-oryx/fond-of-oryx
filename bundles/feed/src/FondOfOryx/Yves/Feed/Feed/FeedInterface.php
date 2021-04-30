<?php

namespace FondOfOryx\Yves\Feed\Feed;

use FondOfOryx\Yves\Feed\CSV\CsvContentInterface;

interface FeedInterface
{
    /**
     * @return \FondOfOryx\Yves\Feed\CSV\CsvContentInterface
     */
    public function create(): CsvContentInterface;
}
