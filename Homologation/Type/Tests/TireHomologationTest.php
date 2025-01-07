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

namespace BaksDev\Field\Tire\Homologation\Type\Tests;

use BaksDev\Field\Tire\Homologation\Type\Choice\A6A;
use BaksDev\Field\Tire\Homologation\Type\Choice\Collection\TireHomologationCollection;
use BaksDev\Field\Tire\Homologation\Type\Choice\Collection\TireHomologationInterface;
use BaksDev\Field\Tire\Homologation\Type\TireHomologationField;
use BaksDev\Field\Tire\Homologation\Type\TireHomologationFieldType;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\DependencyInjection\Attribute\When;

/**
 * @group field-tire
 */
#[When(env: 'test')]
final class TireHomologationTest extends KernelTestCase
{
    public function testUseCase(): void
    {
        /** @var TireHomologationCollection $TireHomologationCollection */
        $TireHomologationCollection = self::getContainer()->get(TireHomologationCollection::class);

        /** @var TireHomologationInterface $case */
        foreach($TireHomologationCollection->cases() as $case)
        {
            $TireHomologationField = new TireHomologationField($case->getValue());

            if(!$TireHomologationField->equals($case::class))
            {
                //dump($case::class);
            }

            self::assertTrue($TireHomologationField->equals($case::class)); // немспейс интерфейса
            self::assertTrue($TireHomologationField->equals($case)); // объект интерфейса
            self::assertTrue($TireHomologationField->equals($case->getValue())); // срока
            self::assertTrue($TireHomologationField->equals($TireHomologationField)); // объект класса

            $TireHomologationFieldType = new TireHomologationFieldType();
            $platform = $this->getMockForAbstractClass(AbstractPlatform::class);

            $convertToDatabase = $TireHomologationFieldType->convertToDatabaseValue($TireHomologationField, $platform);
            self::assertEquals($TireHomologationField->getTireHomologationValue(), $convertToDatabase);

            $convertToPHP = $TireHomologationFieldType->convertToPHPValue($convertToDatabase, $platform);
            self::assertInstanceOf(TireHomologationField::class, $convertToPHP);
            self::assertEquals($case, $convertToPHP->getTireHomologation());

        }

        self::assertTrue(A6A::equals('A6A'));
    }
}