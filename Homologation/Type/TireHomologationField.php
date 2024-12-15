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

namespace BaksDev\Field\Tire\Homologation\Type;

use BaksDev\Field\Tire\Homologation\Type\Choice\Collection\TireHomologationInterface;

final class TireHomologationField
{
    public const string TYPE = 'tire_homologation_field';

    private ?TireHomologationInterface $homologation = null;

    public function __construct(TireHomologationInterface|self|int|string $homologation)
    {
        if(is_string($homologation) && class_exists($homologation))
        {
            $instance = new $homologation();

            if($instance instanceof TireHomologationInterface)
            {
                $this->homologation = $instance;
                return;
            }
        }

        if($homologation instanceof TireHomologationInterface)
        {
            $this->homologation = $homologation;
            return;
        }

        if($homologation instanceof self)
        {
            $this->homologation = $homologation->getTireHomologation();
            return;
        }

        /** @var TireHomologationInterface $declare */
        foreach(self::getDeclared() as $declare)
        {
            if($declare::equals($homologation))
            {
                $this->homologation = new $declare;
                return;
            }
        }

        //throw new InvalidArgumentException(sprintf('Not found TireHomologationField %s', $homologation));

    }

    public function __toString(): string
    {
        return $this->homologation?->getValue() ?: '';
    }

    public function getTireHomologation(): ?TireHomologationInterface
    {
        return $this->homologation;
    }

    public function getTireHomologationValue(): ?string
    {
        return $this->homologation?->getValue();
    }

    public static function cases(): array
    {
        $case = [];

        foreach(self::getDeclared() as $homologation)
        {
            /** @var TireHomologationInterface $homologation */
            $class = new $homologation;
            $case[$class::HOMOLOGATION] = new self($class);
        }

        ksort($case);

        return $case;
    }

    public static function getDeclared(): array
    {
        return array_filter(
            get_declared_classes(),
            static function($className) {
                return in_array(TireHomologationInterface::class, class_implements($className), true);
            }
        );
    }

    public function equals(mixed $homologation): bool
    {
        $homologation = new self($homologation);
        return $this->getTireHomologationValue() === $homologation->getTireHomologationValue();
    }

}