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

namespace BaksDev\Field\Tire\Width\Type;

use BaksDev\Field\Tire\Width\Type\Width\Collection\TireWidthInterface;

final class TireWidthField
{
    public const string TYPE = 'tire_width_field';

    private ?TireWidthInterface $width = null;

    public function __construct(TireWidthInterface|self|int|string $width)
    {
        if(is_string($width) && class_exists($width))
        {
            $instance = new $width();

            if($instance instanceof TireWidthInterface)
            {
                $this->width = $instance;
                return;
            }
        }

        if($width instanceof TireWidthInterface)
        {
            $this->width = $width;
            return;
        }

        if($width instanceof self)
        {
            $this->width = $width->getTireWidth();
            return;
        }

        /** @var TireWidthInterface $declare */
        foreach(self::getDeclared() as $declare)
        {
            if($declare::equals($width))
            {
                $this->width = new $declare();
                return;
            }
        }
    }

    public function __toString(): string
    {
        return $this->width ? $this->width->getValue() : '';
    }

    public function getTireWidth(): ?TireWidthInterface
    {
        return $this->width;
    }

    public function getTireWidthValue(): ?int
    {
        return $this->width?->getValue();
    }

    public static function cases(): array
    {
        $case = [];

        foreach(self::getDeclared() as $width)
        {
            /** @var TireWidthInterface $width */
            $class = new $width();
            $case[$class::WIDTH] = new self($class);
        }

        ksort($case);

        return $case;
    }

    public static function getDeclared(): array
    {
        return array_filter(
            get_declared_classes(),
            static function ($className) {
                return in_array(TireWidthInterface::class, class_implements($className), true);
            }
        );
    }

    public function equals(mixed $width): bool
    {
        $width = new self($width);

        return $this->getTireWidthValue() === $width->getTireWidthValue();
    }

}
