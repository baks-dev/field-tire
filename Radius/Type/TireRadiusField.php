<?php
/*
 *  Copyright 2026.  Baks.dev <admin@baks.dev>
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

namespace BaksDev\Field\Tire\Radius\Type;

use BaksDev\Field\Tire\Radius\Type\Radius\Collection\TireRadiusInterface;

final class TireRadiusField
{
    public const string TYPE = 'tire_radius_field';

    private ?TireRadiusInterface $radius = null;

    public function __construct(TireRadiusInterface|self|int|string $radius)
    {
        if(is_string($radius) && class_exists($radius))
        {
            $instance = new $radius();

            if($instance instanceof TireRadiusInterface)
            {
                $this->radius = $instance;
                return;
            }
        }

        if($radius instanceof TireRadiusInterface)
        {
            $this->radius = $radius;
            return;
        }

        if($radius instanceof self)
        {
            $this->radius = $radius->getTireRadius();
            return;
        }


        /** @var TireRadiusInterface $declare */
        foreach(self::getDeclared() as $declare)
        {
            if($declare::equals($radius))
            {
                $this->radius = new $declare;
                return;
            }
        }


        //throw new InvalidArgumentException(sprintf('Not found TireRadiusField %s', $radius));

    }

    public function __toString(): string
    {
        return $this->radius?->getValue() ?: '';
    }

    public function getTireRadius(): ?TireRadiusInterface
    {
        return $this->radius;
    }

    public function getTireRadiusValue(): ?string
    {
        return $this->radius?->getValue();
    }

    public static function cases(): array
    {
        $case = [];

        foreach(self::getDeclared() as $radius)
        {
            /** @var TireRadiusInterface $radius */
            $class = new $radius;
            $case[$class::RADIUS] = new self($class);
        }

        ksort($case);

        return $case;
    }

    public static function getDeclared(): array
    {
        return array_filter(
            get_declared_classes(),
            static function($className) {
                return in_array(TireRadiusInterface::class, class_implements($className), true);
            }
        );
    }

    public function equals(mixed $radius): bool
    {
        $radius = new self($radius);

        return $this->getTireRadiusValue() === $radius->getTireRadiusValue();
    }

}