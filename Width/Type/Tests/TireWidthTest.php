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

namespace BaksDev\Field\Tire\Width\Type\Tests;

use BaksDev\Field\Tire\Width\Type\TireWidthField;
use BaksDev\Field\Tire\Width\Type\TireWidthFieldType;
use BaksDev\Field\Tire\Width\Type\Width\Collection\TireWidthCollection;
use BaksDev\Field\Tire\Width\Type\Width\Collection\TireWidthInterface;
use BaksDev\Field\Tire\Width\Type\Width\W145;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use PHPUnit\Framework\Attributes\Group;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\DependencyInjection\Attribute\When;

#[When(env: 'test')]
#[Group('field-tire')]
final class TireWidthTest extends KernelTestCase
{
    public function testUseCase(): void
    {
        /** @var TireWidthCollection $TireWidthCollection */
        $TireWidthCollection = self::getContainer()->get(TireWidthCollection::class);

        /** @var TireWidthInterface $case */
        foreach($TireWidthCollection->cases() as $case)
        {
            $TireRadiusField = new TireWidthField($case->getValue());

            self::assertTrue($TireRadiusField->equals($case::class)); // немспейс интерфейса
            self::assertTrue($TireRadiusField->equals($case)); // объект интерфейса
            self::assertTrue($TireRadiusField->equals($case->getValue())); // срока
            self::assertTrue($TireRadiusField->equals($TireRadiusField)); // объект класса

            $TireWidthFieldType = new TireWidthFieldType();
            $platform = $this
                ->getMockBuilder(AbstractPlatform::class)
                ->getMock();

            $convertToDatabase = $TireWidthFieldType->convertToDatabaseValue($TireRadiusField, $platform);
            self::assertEquals($TireRadiusField->getTireWidthValue(), $convertToDatabase);

            $convertToPHP = $TireWidthFieldType->convertToPHPValue($convertToDatabase, $platform);
            self::assertInstanceOf(TireWidthField::class, $convertToPHP);
            self::assertEquals($case, $convertToPHP->getTireWidth());

        }

        self::assertTrue(W145::equals(145));
        self::assertTrue(W145::equals('145'));
        self::assertTrue(W145::equals('W145'));
        self::assertTrue(W145::equals('w145'));

        self::assertFalse(W145::equals(146));
        self::assertFalse(W145::equals('146'));
        self::assertFalse(W145::equals('W146'));
        self::assertFalse(W145::equals('w146'));
    }
}