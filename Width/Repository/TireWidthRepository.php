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
use BaksDev\Field\Tire\Radius\Type\TireRadiusField;
use BaksDev\Field\Tire\Width\Type\TireWidthField;
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
    )
    {
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


        return $dbal;
    }


    private function filter(?array $cases, string $key): array
    {
        if($cases)
        {

            $cache = new PhpArrayAdapter(
                $this->project_dir.'/var/cache/prod/field-tire-width-'.$key.'.cache',
                new FilesystemAdapter()
            );

            if($cache->hasItem('field-tire-width-'.$key))
            {
                return $cache->getItem('field-tire-width-'.$key)->get();
            }

            $case = [];

            foreach($cases as $data)
            {
                if(isset($case[$data['offer']], $case[$data['variation']], $case[$data['modification']],))
                {
                    continue;
                }

                $radius = new TireWidthField($data['offer']);

                if($radius->getTireWidthValue())
                {
                    $case[$data['offer']] = $radius;
                    continue;
                }

                $radius = new TireWidthField($data['variation']);

                if($radius->getTireWidthValue())
                {
                    $case[$data['variation']] = $radius;
                    continue;
                }

                $radius = new TireWidthField($data['modification']);

                if($radius->getTireWidthValue())
                {
                    $case[$data['modification']] = $radius;
                }
            }

            ksort($case);

            $cache->warmUp(['field-tire-width-'.$key => $case]);

            return $case;

        }

        return TireWidthField::cases();
    }


    /** Метод возвращает только имеющие в карточках радиусы */
    public function cases(): array|bool
    {
        if(!class_exists(BaksDevProductsProductBundle::class))
        {
            return TireWidthField::cases();
        }

        $dbal = $this->builder();

        $cases = $dbal->enableCache('field-tire')->fetchAllAssociative();

        return $this->filter($cases, 'cases');

    }

    /** Метод возвращает только имеющие в карточках радиусы */
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
                'modification_quantity.modification = modification.id')
        ;

        $dbal->where('modification_quantity.quantity > 0');
        $dbal->orWhere('variation_quantity.quantity > 0');
        $dbal->orWhere('offer_quantity.quantity > 0');

        $cases = $dbal->enableCache('field-tire')->fetchAllAssociative();

        return $this->filter($cases, 'available');

    }

}