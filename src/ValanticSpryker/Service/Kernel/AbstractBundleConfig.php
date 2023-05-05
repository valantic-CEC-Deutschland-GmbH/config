<?php

declare(strict_types = 1);

namespace ValanticSpryker\Service\Kernel;

use Spryker\Shared\Kernel\SharedConfigResolverAwareTrait;
use ValanticSpryker\Shared\Kernel\AbstractBundleConfig as SharedAbstractBundleConfig;

abstract class AbstractBundleConfig extends SharedAbstractBundleConfig
{
    use SharedConfigResolverAwareTrait;
}
