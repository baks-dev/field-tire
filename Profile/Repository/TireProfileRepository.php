<?php
/*
 *  Copyright 2025.  Baks.dev <admin@baks.dev>
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

namespace BaksDev\Field\Tire\Profile\Repository;

use BaksDev\Core\Doctrine\DBALQueryBuilder;
use BaksDev\Field\Tire\Profile\Type\Profile\Collection\TireProfileCollection;
use BaksDev\Field\Tire\Profile\Type\TireProfileField;
use BaksDev\Field\Tire\Radius\Type\TireRadiusField;
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
use Doctrine\DBAL\ArrayParameterType;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\Cache\Adapter\PhpArrayAdapter;
use Symfony\Component\DependencyInjection\Attribute\Autowire;

final readonly class TireProfileRepository implements TireProfileInterface
{
    public function __construct(
        private DBALQueryBuilder $DBALQueryBuilder,
        private TireProfileCollection $TireProfileCollection
    ) {}

    private function builder(): DBALQueryBuilder
    {
        $stringArray = array_map(static function($item) {
            return $item->getValue();
        }, $this->TireProfileCollection->cases());

        $dbal = $this->DBALQueryBuilder->createQueryBuilder(self::class);

        $dbal->from(Product::class, 'product');

        $dbal
            ->leftJoin(
                'product',
                ProductOffer::class,
                'offer',
                'offer.event = product.event',
            );


        $dbal
            ->leftJoin(
                'offer',
                ProductVariation::class,
                'variation',
                'variation.offer = offer.id',
            );


        $dbal
            ->leftJoin(
                'variation',
                ProductModification::class,
                'modification',
                'modification.variation = variation.id',
            );


        $dbal
            ->leftJoin(
                'offer',
                CategoryProductOffers::class,
                'category_offers',
                'category_offers.id = offer.category_offer',
            );

        $dbal
            ->leftJoin(
                'variation',
                CategoryProductVariation::class,
                'category_variation',
                'category_variation.id = variation.category_variation',
            );

        $dbal
            ->leftJoin(
                'modification',
                CategoryProductModification::class,
                'category_modification',
                'category_modification.id = modification.category_modification',
            );


        $dbal
            ->where('
                            (category_offers.reference = :reference AND offer.value IN (:values)) OR
                            (category_variation.reference = :reference AND variation.value IN (:values)) OR
                            (category_modification.reference = :reference AND modification.value IN (:values))
                        ')
            ->setParameter(
                'reference',
                TireProfileField::TYPE,
            )
            ->setParameter(
                key: 'values',
                value: $stringArray,
                type: ArrayParameterType::STRING,
            );

        $dbal->addSelect(
            'DISTINCT 
                CASE
                    WHEN category_offers.reference = :reference
                    THEN offer.value  
                         
                    WHEN category_variation.reference = :reference
                    THEN variation.value  
                         
                    WHEN category_modification.reference = :reference
                    THEN modification.value
                     
                    ELSE NULL 
                END AS value
		');

        $dbal->addOrderBy('value');

        return $dbal;
    }

    /** Метод возвращает только имеющие в карточках профили */
    public function cases(): array|bool
    {
        if(!class_exists(BaksDevProductsProductBundle::class))
        {
            TireProfileField::cases();
        }

        $dbal = $this->builder();

        $result = $dbal->enableCache('products-product')->fetchAllAssociative();

        return $result ? array_column($result, 'value') : false;

    }


    /** Метод возвращает только имеющие в карточках параметры в наличии */
    public function available(): array|bool
    {
        if(!class_exists(BaksDevProductsProductBundle::class))
        {
            return TireRadiusField::cases();
        }

        $dbal = $this->builder();

        $dbal
            ->leftJoin(
                'offer',
                ProductOfferQuantity::class,
                'offer_quantity',
                'offer_quantity.offer = offer.id',
            );

        $dbal
            ->leftJoin(
                'variation',
                ProductVariationQuantity::class,
                'variation_quantity',
                'variation_quantity.variation = variation.id',
            );


        $dbal
            ->leftJoin(
                'modification',
                ProductModificationQuantity::class,
                'modification_quantity',
                'modification_quantity.modification = modification.id',
            );


        $dbal->andWhere(
            '(modification_quantity.quantity > 0 
            OR variation_quantity.quantity > 0 
            OR offer_quantity.quantity > 0)',
        );

        $result = $dbal
            ->enableCache('products-product')
            ->fetchAllAssociative();

        return $result ? array_column($result, 'value') : false;

    }
}
