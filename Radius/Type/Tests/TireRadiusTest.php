<?php
/*
 *  Copyright 2023.  Baks.dev <admin@baks.dev>
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

namespace BaksDev\Field\Tire\Radius\Type\Tests;

use BaksDev\Field\Tire\Radius\Type\Radius\Collection\TireRadiusCollection;
use BaksDev\Field\Tire\Radius\Type\Radius\Collection\TireRadiusInterface;
use BaksDev\Field\Tire\Radius\Type\Radius\R12;
use BaksDev\Field\Tire\Radius\Type\TireRadiusField;
use BaksDev\Field\Tire\Radius\Type\TireRadiusFieldType;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\DependencyInjection\Attribute\When;

/**
 * @group field-tire
 */
#[When(env: 'test')]
final class TireRadiusTest extends KernelTestCase
{
    public function testUseCase(): void
    {
        /** @var TireRadiusCollection $TireRadiusCollection */
        $TireRadiusCollection = self::getContainer()->get(TireRadiusCollection::class);

        /** @var TireRadiusInterface $case */
        foreach($TireRadiusCollection->cases() as $case)
        {
            $TireRadiusField = new TireRadiusField($case->getValue());

            self::assertTrue($TireRadiusField->equals($case::class)); // немспейс интерфейса
            self::assertTrue($TireRadiusField->equals($case)); // объект интерфейса
            self::assertTrue($TireRadiusField->equals($case->getValue())); // срока
            self::assertTrue($TireRadiusField->equals($TireRadiusField)); // объект класса

            $TireRadiusFieldType = new TireRadiusFieldType();
            $platform = $this->getMockForAbstractClass(AbstractPlatform::class);

            $convertToDatabase = $TireRadiusFieldType->convertToDatabaseValue($TireRadiusField, $platform);
            dump($TireRadiusField->getTireRadiusValue(), $convertToDatabase);


            self::assertEquals($TireRadiusField->getTireRadiusValue(), $convertToDatabase);




            $convertToPHP = $TireRadiusFieldType->convertToPHPValue($convertToDatabase, $platform);
            self::assertInstanceOf(TireRadiusField::class, $convertToPHP);
            self::assertEquals($case, $convertToPHP->getTireRadius());

        }

        self::assertTrue(R12::equals(12));
        self::assertTrue(R12::equals('12'));
        self::assertTrue(R12::equals('R12'));
        self::assertTrue(R12::equals('r12'));

        self::assertFalse(R12::equals(13));
        self::assertFalse(R12::equals('13'));
        self::assertFalse(R12::equals('R13'));
        self::assertFalse(R12::equals('r13'));
    }
}