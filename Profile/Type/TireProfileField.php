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

final class TireProfileField
{
	public const TYPE = 'tire_profile_field';
	
	private TireProfileEnum $value;
	
	
	public function __construct(int|TireProfileEnum $value)
	{
		if($value instanceof TireProfileEnum)
		{
			$this->value = $value;
		}
		else
		{
			$this->value = TireProfileEnum::from($value);
		}
	}
	
	public function __toString(): string
	{
		return $this->value->value;
	}
	
	/** Возвращает числовое значение   */
	public function getValue() : int
	{
		return $this->value->value;
	}
	
	/** Возвращает ключ значения */
	public function getName(): string
	{
		return $this->value->name;
	}
	
	/** Возвращает значение Enum   */
	public function getTireProfileField() : TireProfileEnum
	{
		return $this->value;
	}
	
	/** Возвращает массив из значнией TireProfileEnum */
	public static function cases() : array
	{
		$case = null;
		
		foreach(TireProfileEnum::cases() as $color)
		{
			$case[] = new self($color);
		}
		
		return $case;
	}
}