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

namespace BaksDev\Field\Tire\Profile\Type\Tests;

use BaksDev\Field\Tire\Profile\Type\Profile\Collection\TireProfileCollection;
use BaksDev\Field\Tire\Profile\Type\Profile\P30;
use BaksDev\Field\Tire\Profile\Type\TireProfileField;
use BaksDev\Field\Tire\Profile\Type\TireProfileFieldType;
use BaksDev\Field\Tire\Radius\Type\Radius\Collection\TireRadiusInterface;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\DependencyInjection\Attribute\When;

/**
 * @group field-tire
 */
#[When(env: 'test')]
final class TireProfileTest extends KernelTestCase
{
    public function testUseCase(): void
    {
        /** @var TireProfileCollection $TireProfileCollection */
        $TireProfileCollection = self::getContainer()->get(TireProfileCollection::class);

        /** @var TireRadiusInterface $case */
        foreach($TireProfileCollection->cases() as $case)
        {
            $TireProfileField = new TireProfileField($case->getValue());

            self::assertTrue($TireProfileField->equals($case::class)); // немспейс интерфейса
            self::assertTrue($TireProfileField->equals($case)); // объект интерфейса
            self::assertTrue($TireProfileField->equals($case->getValue())); // срока
            self::assertTrue($TireProfileField->equals($TireProfileField)); // объект класса

            $TireProfileFieldType = new TireProfileFieldType();
            $platform = $this->getMockForAbstractClass(AbstractPlatform::class);

            $convertToDatabase = $TireProfileFieldType->convertToDatabaseValue($TireProfileField, $platform);
            self::assertEquals($TireProfileField->getTireProfileValue(), $convertToDatabase);

            $convertToPHP = $TireProfileFieldType->convertToPHPValue($convertToDatabase, $platform);
            self::assertInstanceOf(TireProfileField::class, $convertToPHP);
            self::assertEquals($case, $convertToPHP->getTireProfile());

        }

        self::assertTrue(P30::equals(30));
        self::assertTrue(P30::equals('30'));
        self::assertTrue(P30::equals('P30'));
        self::assertTrue(P30::equals('p30'));

        self::assertFalse(P30::equals(35));
        self::assertFalse(P30::equals('35'));
        self::assertFalse(P30::equals('p35'));
        self::assertFalse(P30::equals('p35'));
    }
}