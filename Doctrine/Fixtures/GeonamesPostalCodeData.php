<?php

namespace Craue\GeoBundle\Doctrine\Fixtures;

use Craue\GeoBundle\Entity\GeoPostalCode;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * @author Christian Raue <christian.raue@gmail.com>
 * @copyright 2011-2013 Christian Raue
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 */
abstract class GeonamesPostalCodeData implements FixtureInterface {

	protected $batchSize = 1000;

	protected function getRepository(ObjectManager $manager) {
		return $manager->getRepository(get_class(new GeoPostalCode()));
	}

	protected function clearPostalCodesTable(ObjectManager $manager) {
		foreach ($this->getRepository($manager)->findAll() as $entity) {
			$manager->remove($entity);
		}
		$manager->flush();
	}

	/**
	 * @param ObjectManager $manager
	 * @param string $filename
	 * @return integer Number of entries actually added.
	 */
	protected function addEntries(ObjectManager $manager, $filename) {
		$repo = $this->getRepository($manager);

		$entriesAdded = 0;
		$currentBatchEntries = array();

		$fcontents = file($filename);
		for ($i = 0, $numLines = count($fcontents); $i < $numLines; ++$i) {
			$line = trim($fcontents[$i]);
			$arr = explode("\t", $line);

			// skip if no lat/lng values
			if (!array_key_exists(9, $arr) || !array_key_exists(10, $arr)) {
				continue;
			}

			$country = $arr[0];
			$postalCode = $arr[1];
			$name = $arr[2];
			$region = $arr[3];
			$regionCode = $arr[4];
			$departement = $arr[5];
			$departementCode = $arr[6];
			$district = $arr[7];
			$districtCode = $arr[8];
			$lat = $arr[9];
			$lon = $arr[10];


			// skip duplicate entries in current batch
			if (in_array($country.'-'.$postalCode, $currentBatchEntries)) {
				continue;
			}

			// skip duplicate entries already persisted
			if ($repo->findOneBy(array('country' => $country, 'postalCode' => $postalCode, 'name' => $name)) !== null) {
				continue;
			}

			$entity = new GeoPostalCode();
			$entity->setCountry($country);
			$entity->setName($name);
			$entity->setPostalCode($postalCode);
			$entity->setRegion($region);
			$entity->setRegionCode($regionCode);
			$entity->setDepartement($departement);
			$entity->setDepartementCode($departementCode);
			$entity->setDistrict($district);
			$entity->setDistrictCode($districtCode);
			$entity->setLat((float) $lat);
			$entity->setLng((float) $lon);
			$manager->persist($entity);

			++$entriesAdded;
			$currentBatchEntries[] = $country.'-'.$postalCode;

			if ((($i + 1) % $this->batchSize) === 0) {
				$manager->flush();
				$manager->clear();
				$currentBatchEntries = array();
				echo '.'; // progress indicator
			}
		}

		$manager->flush(); // Flush for the last batch, which doesn't reach the batch size in most cases. (fixes #2)

		echo ' ', $entriesAdded, "\n";

		return $entriesAdded;
	}

}
