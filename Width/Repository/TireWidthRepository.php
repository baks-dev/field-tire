<?php
/*
 *  Copyright 2024.  Baks.dev <admin@baks.dev>
 *
 *  Permission is hereby granted, free of charge, to any person obtaining a copy
 *  of this software and associated documentation files (the "Software"), to deal
 *  in the Software without restriction, including without limitation the rights
 *  to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 *  copies of the Software, and to permit persons to whom the Software is furnished
 *  to do so, subject to the following conditions:
 *
 *  The above copyright notice and this permission notice shall be included in all
 *  copies or substantial portions of the Software.
 *
 *  THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 *  IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 *  FITNESS FOR A PARTICULAR PURPOSE AND NON INFRINGEMENT. IN NO EVENT SHALL THE
 *  AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 *  LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 *  OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 *  THE SOFTWARE.
 */

declare(strict_types=1);

namespace BaksDev\Field\Tire\Width\Repository;

use BaksDev\Core\Doctrine\DBALQueryBuilder;
use BaksDev\Field\Tire\Profile\Type\TireProfileField;
use BaksDev\Field\Tire\Radius\Type\TireRadiusField;
use BaksDev\Field\Tire\Width\Type\TireWidthField;
use BaksDev\Products\Category\Entity\Offers\CategoryProductOffers;
use BaksDev\Products\Category\Entity\Offers\Variation\CategoryProductVariation;
use BaksDev\Products\Category\Entity\Offers\Variation\Modification\CategoryProductModification;
use BaksDev\Products\Product\BaksDevProductsProductBundle;
use BaksDev\Products\Product\Entity\Offers\ProductOffer;
use BaksDev\Products\Product\Entity\Offers\Quantity\ProductOfferQuantity;
use BaksDev\Products\Product\Entity\Offers\Variation\Modification\ProductModification;
use BaksDev\Products\Product\Entity\Offers\Variation\Modification\Quantity\ProductModificationQuantity;
use BaksDev\Products\Product\Entity\Offers\Variation\ProductVariation;
use BaksDev\Products\Product\Entity\Offers\Variation\Quantity\ProductVariationQuantity;
use BaksDev\Products\Product\Entity\Product;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\Cache\Adapter\PhpArrayAdapter;
use Symfony\Component\DependencyInjection\Attribute\Autowire;

final class TireWidthRepository implements TireWidthInterface
{
    private DBALQueryBuilder $DBALQueryBuilder;
    private string $project_dir;

    public function __construct(
        #[Autowire('%kernel.project_dir%')] string $project_dir,
        DBALQueryBuilder $DBALQueryBuilder,
    ) {
        $this->DBALQueryBuilder = $DBALQueryBuilder;
        $this->project_dir = $project_dir;
    }

    private function builder(): DBALQueryBuilder
    {
        $dbal = $this->DBALQueryBuilder->createQueryBuilder('field-tire');

        $dbal->from(Product::class, 'product');

        $dbal
            ->addSelect('offer.value AS offer')
            ->leftJoin(
                'product',
                ProductOffer::class,
                'offer',
                'offer.event = product.event'
            );


        $dbal
            ->addSelect('variation.value AS variation')
            ->leftJoin(
                'offer',
                ProductVariation::class,
                'variation',
                'variation.offer = offer.id'
            );


        $dbal
            ->addSelect('modification.value AS modification')
            ->leftJoin(
                'variation',
                ProductModification::class,
                'modification',
                'modification.variation = variation.id'
            );


        $dbal
            ->addSelect('category_offers.reference AS offer_reference')
            ->leftJoin(
                'offer',
                CategoryProductOffers::class,
                'category_offers',
                'category_offers.id = offer.category_offer'
            );

        $dbal
            ->addSelect('category_variation.reference AS variation_reference')
            ->leftJoin(
                'variation',
                CategoryProductVariation::class,
                'category_variation',
                'category_variation.id = variation.category_variation'
            );

        $dbal
            ->addSelect('category_modification.reference AS modification_reference')
            ->leftJoin(
                'modification',
                CategoryProductModification::class,
                'category_modification',
                'category_modification.id = modification.category_modification'
            );

        $dbal
            ->where('
                            category_offers.reference = :reference OR
                            category_variation.reference = :reference OR
                            category_modification.reference = :reference
                        ')
            ->setParameter(
                'reference',
                TireWidthField::TYPE
            );

        return $dbal;
    }

    private function filter(?array $cases, string $key): array
    {

        if($cases)
        {
            $key = TireWidthField::TYPE.'_'.$key;
            $type = TireWidthField::TYPE;
            $class = TireWidthField::class;

            $cache = new PhpArrayAdapter(
                $this->project_dir.'/var/cache/prod/'.$key.'.cache',
                new FilesystemAdapter()
            );

            if($cache->hasItem($key))
            {
                return $cache->getItem($key)->get();
            }

            $case = [];

            foreach($cases as $data)
            {
                if(isset($case[$data['offer']], $case[$data['variation']], $case[$data['modification']]))
                {
                    continue;
                }

                if($data['offer_reference'] === $type)
                {
                    $case[$data['offer']] = new $class($data['offer']);
                }

                if($data['variation_reference'] === $type)
                {
                    $case[$data['variation']] = new $class($data['variation']);
                }

                if($data['modification_reference'] === $type)
                {
                    $case[$data['modification']] = new $class($data['modification']);
                }

            }

            ksort($case);

            $cache->warmUp([$key => $case]);

        }


        return TireWidthField::cases();
    }


    /** Метод возвращает только имеющие в карточках параметры */
    public function cases(): array|bool
    {
        if(!class_exists(BaksDevProductsProductBundle::class))
        {
            return TireWidthField::cases();
        }

        $dbal = $this->builder();

        $cases = $dbal->enableCache('products-product')->fetchAllAssociative();

        return $this->filter($cases, 'cases');

    }

    /** Метод возвращает только имеющие в карточках параметры */
    public function available(): array|bool
    {
        if(!class_exists(BaksDevProductsProductBundle::class))
        {
            return TireWidthField::cases();
        }

        $dbal = $this->builder();

        $dbal
            ->leftJoin(
                'offer',
                ProductOfferQuantity::class,
                'offer_quantity',
                'offer_quantity.offer = offer.id'
            );

        $dbal
            ->leftJoin(
                'variation',
                ProductVariationQuantity::class,
                'variation_quantity',
                'variation_quantity.variation = variation.id'
            );


        $dbal
            ->leftJoin(
                'modification',
                ProductModificationQuantity::class,
                'modification_quantity',
                'modification_quantity.modification = modification.id'
            );

        $dbal->where('category_offers.reference = :reference AND modification_quantity.quantity > 0');
        $dbal->orWhere('category_variation.reference = :reference AND variation_quantity.quantity > 0');
        $dbal->orWhere('category_modification.reference = :reference AND offer_quantity.quantity > 0');

        $cases = $dbal->enableCache('products-product')->fetchAllAssociative();

        return $this->filter($cases, 'available');

    }

}
