<?php

declare(strict_types=1);

namespace Locastic\SyliusStoreLocatorPlugin;

use Sylius\Bundle\CoreBundle\Application\SyliusPluginTrait;
use Symfony\Component\HttpKernel\Bundle\Bundle;

final class LocasticSyliusStoreLocatorPlugin extends Bundle
{
    use SyliusPluginTrait;
}
