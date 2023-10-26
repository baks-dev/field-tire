<?php
/*
*  Copyright Baks.dev <admin@baks.dev>
*
*  Licensed under the Apache License, Version 2.0 (the "License");
*  you may not use this file except in compliance with the License.
*  You may obtain a copy of the License at
*
*  http://www.apache.org/licenses/LICENSE-2.0
*
*  Unless required by applicable law or agreed to in writing, software
*  distributed under the License is distributed on an "AS IS" BASIS,
*  WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
*  See the License for the specific language governing permissions and
*   limitations under the License.
*
*/

namespace BaksDev\Field\Tire\Profile\Type;

use BaksDev\Field\Tire\Profile\Type\Profile\Collection\TireProfileInterface;
use InvalidArgumentException;

final class TireProfileField
{
	public const TYPE = 'tire_profile_field';
	
	private TireProfileInterface $profile;
	
	
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

        throw new InvalidArgumentException(sprintf('Not found TireProfileField %s', $profile));
	}
	
	public function __toString(): string
	{
		return (string) $this->profile->getValue();
	}
	

	/** Возвращает ключ значения */
	public function getTireProfileValue(): int
	{
		return $this->profile->getValue();
	}
	
	/** Возвращает значение Enum   */
	public function getTireProfile() : TireProfileInterface
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