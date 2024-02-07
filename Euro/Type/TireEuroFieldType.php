<?php

declare(strict_types=1);

namespace BaksDev\Field\Tire\Euro\Type;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;
use Doctrine\DBAL\Types\Type;

final class TireEuroFieldType extends Type
{
	
	public function convertToDatabaseValue($value, AbstractPlatform $platform): string
	{
		return (string) $value;
	}
	
	
	public function convertToPHPValue($value, AbstractPlatform $platform): ?TireEuroField
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

    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        return $platform->getStringTypeDeclarationSQL($column);
    }
	
}