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

namespace BaksDev\Field\Tire\Radius\Type;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\SmallIntType;

final class TireRadiusFieldType extends SmallIntType
{

	public function convertToDatabaseValue($value, AbstractPlatform $platform): mixed
	{
		return (int) filter_var($value, FILTER_SANITIZE_NUMBER_INT);
	}
	
	public function convertToPHPValue($value, AbstractPlatform $platform): mixed
	{
		return new TireRadiusField($value);
	}
	
	public function getName(): string
	{
		return TireRadiusField::TYPE;
	}
	
	public function requiresSQLCommentHint(AbstractPlatform $platform) : bool
	{
		return true;
	}
	
}