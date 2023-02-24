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

namespace BaksDev\Field\Tire\Width\Type;

final class TireWidthField
{
	public const TYPE = 'tire_profile_field';
	
	private TireWidthEnum $value;
	
	
	public function __construct(int|TireWidthEnum $value)
	{
		if($value instanceof TireWidthEnum)
		{
			$this->value = $value;
		}
		else
		{
			$this->value = TireWidthEnum::from($value);
		}
	}
	
	public function __toString() : string
	{
		return $this->value->value;
	}
	
	/** Возвращает числовое значение   */
	public function getValue() : int
	{
		return $this->value->value;
	}
	
	/** Возвращает ключ значения */
	public function getName() : string
	{
		return $this->value->name;
	}
	
	/** Возвращает значение Enum   */
	public function getTireWidthField() : TireWidthEnum
	{
		return $this->value;
	}
	
	/** Возвращает массив из значнией TireWidthEnum */
	public static function cases() : array
	{
		$case = null;
		
		foreach(TireWidthEnum::cases() as $color)
		{
			$case[] = new self($color);
		}
		
		return $case;
	}
}