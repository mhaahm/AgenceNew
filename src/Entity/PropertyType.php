<?php
/**
 * Created by PhpStorm.
 * User: mha
 * Date: 19/11/18
 * Time: 22:22
 */


namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

class PropertyType
{

    /**
     * @var int|null
     */
    private $max_price;


    /**
     * @var int|null
     * @Assert\Range(min="4",max="400")
     */
    private $min_surface;

    /**
     * @var ArrayCollection
     */
    private $options;

    public function __construct()
    {
        $this->options = new ArrayCollection();
    }

    /**
     * @return ArrayCollection
     */
    public function getOptions(): ArrayCollection
    {
        return $this->options;
    }

    /**
     * @param ArrayCollection $options
     */
    public function setOptions(ArrayCollection $options): void
    {
        $this->options = $options;
    }

    /**
     * @return int|null
     */
    public function getMaxPrice(): ?int
    {
        return $this->max_price;
    }

    /**
     * @param int|null $max_price
     */
    public function setMaxPrice(?int $max_price): void
    {
        $this->max_price = $max_price;
    }

    /**
     * @return int|null
     */
    public function getMinSurface(): ?int
    {
        return $this->min_surface;
    }

    /**
     * @param int|null $min_surface
     */
    public function setMinSurface(?int $min_surface): void
    {
        $this->min_surface = $min_surface;
    }



}