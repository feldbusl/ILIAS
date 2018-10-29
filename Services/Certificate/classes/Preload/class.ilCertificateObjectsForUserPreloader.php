<?php
/* Copyright (c) 1998-2018 ILIAS open source, Extended GPL, see docs/LICENSE */

/**
 * @author  Niels Theen <ntheen@databay.de>
 */
class ilCertificateObjectsForUserPreloader
{
	/** @var array */
	private static $certificates = [];

	/** @var ilUserCertificateRepository */
	private $userCertificateRepository;

	/**
	 * ilCertificateObjectsForUserPreloader constructor.
	 * @param ilUserCertificateRepository $userCertificateRepository
	 */
	public function __construct(ilUserCertificateRepository $userCertificateRepository)
	{
		$this->userCertificateRepository = $userCertificateRepository;
	}

	/**
	 * @param int $userId
	 * @param int[] $objIds
	 */
	public function preLoad(int $userId, array $objIds)
	{
		$objectIdsWithUserCertificate = $this->userCertificateRepository->fetchObjectWithCertificateForUser(
			$userId, $objIds
		);
		self::$certificates[$userId] = $objectIdsWithUserCertificate;
	}

	/**
	 * @param int $userId
	 * @param int $objId
	 * @return bool
	 */
	public function isPreloaded(int $userId, int $objId): bool
	{
		if (false === array_key_exists($userId, self::$certificates)) {
			return false;
		}

		if (true === in_array($objId, self::$certificates[$userId])) {
			return true;
		}

		return false;
	}
}
