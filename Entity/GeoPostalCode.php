<?php

namespace Craue\GeoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="Craue\GeoBundle\Repository\GeoPostalCodeRepository")
 * @ORM\Table(name="craue_geo_postalcode",
 *	uniqueConstraints={@ORM\UniqueConstraint(name="postal_code_idx", columns={
 *		"country", "postal_code", "name"
 *	})}
 * )
 *
 * @author Christian Raue <christian.raue@gmail.com>
 * @copyright 2011-2013 Christian Raue
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 */
class GeoPostalCode {

	/**
	 * @var integer
	 * @ORM\Column(name="id", type="integer", nullable=false)
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	protected $id;

	/**
	 * @var string
	 * @ORM\Column(name="country", type="string", length=2, nullable=false)
	 * @Assert\NotBlank
	 */
	protected $country;

	/**
	 * @var string
	 * @ORM\Column(name="postal_code", type="string", length=20, nullable=false)
	 * @Assert\NotBlank
	 */
	protected $postalCode;

	/**
	 * @var string
	 * @ORM\Column(name="name", type="string", length=255, nullable=true)
	 */
	protected $name;

	/**
	 * @var string
	 * @ORM\Column(name="region", type="string", length=255, nullable=true)
	 */
	protected $region;

	/**
	 * @var string
	 * @ORM\Column(name="region_code", type="string", length=255, nullable=true)
	 */
	protected $regionCode;

	/**
	 * @var string
	 * @ORM\Column(name="departement", type="string", length=255, nullable=true)
	 */
	protected $departement;

	/**
	 * @var string
	 * @ORM\Column(name="departement_code", type="string", length=255, nullable=true)
	 */
	protected $departementCode;

	/**
	 * @var string
	 * @ORM\Column(name="district", type="string", length=255, nullable=true)
	 */
	protected $district;

	/**
	 * @var string
	 * @ORM\Column(name="district_code", type="string", length=255, nullable=true)
	 */
	protected $districtCode;

	/**
	 * @var double
	 * @ORM\Column(name="lat", type="decimal", precision=9, scale=6, nullable=false)
	 * @Assert\NotBlank
	 */
	protected $lat;

	/**
	 * @var double
	 * @ORM\Column(name="lng", type="decimal", precision=9, scale=6, nullable=false)
	 * @Assert\NotBlank
	 */
	protected $lng;

	/**
	 * Get name
	 *
	 * @return string
	 */
	public function getName()
	{
	    return $this->name;
	}

	/**
	 * Set name
	 *
	 * @param string $name
	 * @return $this
	 */
	public function setName($name)
	{
	    $this->name = $name;
	    return $this;
	}

	/**
	 * Get region
	 *
	 * @return string
	 */
	public function getRegion()
	{
	    return $this->region;
	}

	/**
	 * Set region
	 *
	 * @param string $region
	 * @return $this
	 */
	public function setRegion($region)
	{
	    $this->region = $region;
	    return $this;
	}

	/**
	 * Get regionCode
	 *
	 * @return string
	 */
	public function getRegionCode()
	{
	    return $this->regionCode;
	}

	/**
	 * Set regionCode
	 *
	 * @param string $regionCode
	 * @return $this
	 */
	public function setRegionCode($regionCode)
	{
	    $this->regionCode = $regionCode;
	    return $this;
	}

	/**
	 * Get departement
	 *
	 * @return string
	 */
	public function getDepartement()
	{
	    return $this->departement;
	}

	/**
	 * Set departement
	 *
	 * @param string $departement
	 * @return $this
	 */
	public function setDepartement($departement)
	{
	    $this->departement = $departement;
	    return $this;
	}

	/**
	 * Get departementCode
	 *
	 * @return string
	 */
	public function getDepartementCode()
	{
	    return $this->departementCode;
	}

	/**
	 * Set departementCode
	 *
	 * @param string $departementCode
	 * @return $this
	 */
	public function setDepartementCode($departementCode)
	{
	    $this->departementCode = $departementCode;
	    return $this;
	}

	/**
	 * Get district
	 *
	 * @return string
	 */
	public function getDistrict()
	{
	    return $this->district;
	}

	/**
	 * Set district
	 *
	 * @param string $district
	 * @return $this
	 */
	public function setDistrict($district)
	{
	    $this->district = $district;
	    return $this;
	}

	/**
	 * Get districtCode
	 *
	 * @return string
	 */
	public function getDistrictCode()
	{
	    return $this->districtCode;
	}

	/**
	 * Set districtCode
	 *
	 * @param string $districtCode
	 * @return $this
	 */
	public function setDistrictCode($districtCode)
	{
	    $this->districtCode = $districtCode;
	    return $this;
	}

	public function getId() {
		return $this->id;
	}

	public function setCountry($country) {
		$this->country = $country;
	}

	public function getCountry() {
		return $this->country;
	}

	public function setPostalCode($postalCode) {
		$this->postalCode = $postalCode;
	}

	public function getPostalCode() {
		return $this->postalCode;
	}

	public function setLat($lat) {
		$this->lat = $lat;
	}

	public function getLat() {
		return $this->lat;
	}

	public function setLng($lng) {
		$this->lng = $lng;
	}

	public function getLng() {
		return $this->lng;
	}

}
