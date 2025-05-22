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

namespace BaksDev\Field\Tire\Profile\Type;

use BaksDev\Field\Tire\Profile\Type\Profile\Collection\TireProfileInterface;

final class TireProfileField
{
    public const string TYPE = 'tire_profile_field';
	
	private ?TireProfileInterface $profile = null;
	
	public function __construct(TireProfileInterface|self|int|string $profile)
	{
        if(is_string($profile) && class_exists($profile))
        {
            $instance = new $profile();

            if($instance instanceof TireProfileInterface)
            {
                $this->profile = $instance;
                return;
            }
        }

        if($profile instanceof TireProfileInterface)
        {
            $this->profile = $profile;
            return;
        }

        if($profile instanceof self)
        {
            $this->profile = $profile->getTireProfile();
            return;
        }

        /** @var TireProfileInterface $declare */
        foreach(self::getDeclared() as $declare)
        {
            if($declare::equals($profile))
            {
                $this->profile = new $declare;
                return;
            }
        }

        //throw new InvalidArgumentException(sprintf('Not found TireProfileField %s', $profile));
	}
	
	public function __toString(): string
	{
        return (string) $this->profile ? $this->profile->getValue() : '';
	}

    public function getTireProfileValue(): null|int|float
	{
		return $this->profile?->getValue();
	}

	public function getTireProfile() : ?TireProfileInterface
	{
		return $this->profile;
	}


    public static function cases(): array
    {
        $case = [];

        foreach(self::getDeclared() as $profile)
        {
            /** @var TireProfileInterface $profile */
            $class = new $profile;
            $case[$class::PROFILE] = new self($class);
        }

        ksort($case);

        return $case;
    }

    public static function getDeclared(): array
    {
        return array_filter(
            get_declared_classes(),
            static function($className) {
                return in_array(TireProfileInterface::class, class_implements($className), true);
            }
        );
    }

    public function equals(mixed $profile): bool
    {
        $profile = new self($profile);

        return $this->getTireProfileValue() === $profile->getTireProfileValue();
    }
}