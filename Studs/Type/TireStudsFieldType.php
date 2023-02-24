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

namespace BaksDev\Field\Tire\Studs\Type;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\BooleanType;

final class  TireStudsFieldType extends BooleanType
{
	
	public function convertToDatabaseValue($value, AbstractPlatform $platform) : mixed
	{
		return $value instanceof TireStudsField ? $value->getValue() : null;
	}
	
	
	public function convertToPHPValue($value, AbstractPlatform $platform) : mixed
	{
		return !empty($value) ? new TireStudsField($value) : null;
	}
	
	
	public function getName() : string
	{
		return TireStudsField::TYPE;
	}
	
	
	public function requiresSQLCommentHint(AbstractPlatform $platform) : bool
	{
		return true;
	}
	
}