<?php

declare(strict_types=1);

namespace BaksDev\Field\Tire\Euro\Type;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

final class TireEuroFieldType extends StringType
{
	
	public function convertToDatabaseValue($value, AbstractPlatform $platform): mixed
	{
		return $value instanceof TireEuroField ? $value->getValue() : $value;
	}
	
	
	public function convertToPHPValue($value, AbstractPlatform $platform): mixed
	{
		return !empty($value) ? new TireEuroField($value) : null;
	}
	
	
	public function getName(): string
	{
		return TireEuroField::TYPE;
	}
	
	
	public function requiresSQLCommentHint(AbstractPlatform $platform) : bool
	{
		return true;
	}
	
}