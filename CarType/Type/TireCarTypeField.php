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

namespace BaksDev\Field\Tire\CarType\Type;

final class TireCarTypeField
{
    public const string TYPE = 'tire_cartype_field';
	
	private ?TireCarTypeEnum $value = null;
	
	public function __construct(null|string|TireCarTypeEnum $value)
	{
		if($value instanceof TireCarTypeEnum)
		{
			$this->value = $value;
			return;
		}
		
		if(is_string($value))
		{
			$this->value = TireCarTypeEnum::from($value);
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
	public function getTireProfileField() : TireCarTypeEnum
	{
		return $this->value;
	}
	
	/** Возвращает массив из значнией TireProfileEnum */
	public static function cases() : array
	{
		$case = null;
		
		foreach(TireCarTypeEnum::cases() as $color)
		{
			$case[] = new self($color);
		}
		
		return $case;
	}
}