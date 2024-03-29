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

namespace BaksDev\Field\Tire\Season\Type;

final class TireSeasonField
{
	public const TYPE = 'tire_season_field';
	
	private ?TireSeasonEnum $value = null;
	
	public function __construct(null|string|TireSeasonEnum $value)
	{
		if($value instanceof TireSeasonEnum)
		{
			$this->value = $value;
			return;
		}
		
		if(is_string($value))
		{
			$this->value = TireSeasonEnum::from($value);
		}
		
	}
	
	public function __toString(): string
	{
		return $this->value?->value ?: '';
	}
	
	/** Возвращает числовое значение   */
	public function getValue() : ?string
	{
		return $this->value?->value;
	}
	
	/** Возвращает ключ значения */
	public function getName(): string
	{
		return $this->value->name;
	}
	
	/** Возвращает значение Enum   */
	public function getTireProfileField() : TireSeasonEnum
	{
		return $this->value;
	}
	
	/** Возвращает массив из значнией TireProfileEnum */
	public static function cases() : array
	{
		$case = null;
		
		foreach(TireSeasonEnum::cases() as $color)
		{
			$case[] = new self($color);
		}
		
		return $case;
	}
}