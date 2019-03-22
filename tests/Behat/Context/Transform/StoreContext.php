<?php
namespace Tests\Locastic\SyliusStoreLocatorPlugin\Behat\Context\Transform;

use Behat\Behat\Context\Context;
use Liip\ImagineBundle\Exception\Config\Filter\NotFoundException;
use Locastic\SyliusStoreLocatorPlugin\Repository\StoreRepositoryInterface;
use Sylius\Component\Core\Formatter\StringInflector;

final class StoreContext implements Context
{
    /**
     * @var StoreRepositoryInterface
     */
    private $storeRepository;

    /**
     * @param StoreRepositoryInterface $storeRepository
     */
    public function __construct(StoreRepositoryInterface $storeRepository)
    {
        $this->storeRepository = $storeRepository;
    }

    /**
     * @Transform /^store "([^"]+)"$/
     * @Transform /^"([^"]+)" store/
     * @Transform /^store to "([^"]+)"$/
     * @Transform :store
     */
    public function getStoreByName($storeName)
    {
        $store = $this->storeRepository->findOneByCode(StringInflector::nameToCode(strtolower($storeName)));

        if($store === null){
            throw new NotFoundException('Store with name '.$storeName.' not found"');
        }

        return $store;
    }
}