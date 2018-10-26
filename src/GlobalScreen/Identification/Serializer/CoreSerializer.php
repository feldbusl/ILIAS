<?php namespace ILIAS\GlobalScreen\Identification\Serializer;

use ILIAS\GlobalScreen\Identification\CoreIdentification;
use ILIAS\GlobalScreen\Identification\IdentificationInterface;

/**
 * Class CoreSerializer
 *
 * @author Fabian Schmid <fs@studer-raimann.ch>
 */
class CoreSerializer implements SerializerInterface {

	const DIVIDER = '|';


	/**
	 * @inheritdoc
	 */
	public function serialize(IdentificationInterface $identification): string {
		$divider = self::DIVIDER;

		return "{$identification->getClassName()}{$divider}{$identification->getInternalIdentifier()}";
	}


	/**
	 * @inheritdoc
	 */
	public function unserialize(string $serialized_string): IdentificationInterface {
		list ($class_name, $internal_identifier) = explode(self::DIVIDER, $serialized_string);

		return new CoreIdentification($internal_identifier, $class_name, $this);
	}


	/**
	 * @inheritDoc
	 */
	public function canHandle(string $serialized_identification): bool {
		return preg_match('/(.*?)\|(.*)/m', $serialized_identification) > 0;
	}
}
