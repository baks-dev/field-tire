<?php

declare(strict_types=1);

namespace BaksDev\Field\Tire\Euro\Type;

final class TireEuroField
{
	public const TYPE = 'tire_euro_field';
	
	private $value;

	public function __construct(?string $value = null)
	{
		if(!empty($value) && !preg_match('{^[\d]+\|[\d]+\|[\d]$}Di', $value))
		{
			throw new \InvalidArgumentException('Incorrect Tire Euro Label.');
		}
		
		$this->value = $value;
	}

	public function __toString() : string
	{
		return $this->value ? : '';
	}
	
	public function getValue() : string
	{
		return $this->value ? : '';
	}


	
	
}