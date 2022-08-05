<?php

namespace App\Entity;

use App\Repository\CountryRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CountryRepository::class)]
class Country
{

    const CREATED_SUCCESS = "Country created!";

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ? int $id = null;

    #[ORM\Column(length : 255)]
    private ?string  $name = null;

    #[ORM\Column(length : 2000)]
     private ?string  $full_name = null;

    #[ORM\Column(length : 5)]
     private ?string  $code = null;

    #[ORM\Column(length : 255)]
     private ?string  $currency = null;

    #[ORM\Column(length : 255)]
     private ?string  $language = null;

    #[ORM\Column(length : 255)]
     private ?string  $capital_city = null;

     #[ORM\Column(length: 255, nullable: true)]
     private ?string $flag = null;

     #[ORM\Column(length: 255, nullable: true)]
     private ?string $map = null;

     #[ORM\Column(length: 255, nullable: true)]
     private ?string $population = null;

     #[ORM\Column]
     private ?int $area = null;

     #[ORM\Column(length: 255, nullable: true)]
     private ?string $region = null;
     
     #[ORM\Column(length : 255)]
     private ?string  $sub_region = null;
    public function getId() : ?int
        {
        return $this->id;
    }

    function getName(): ?string
        {
        return $this->name;
    }

    function setName(string $name): self
        {
        $this->name = $name;

        return $this;
    }

    function getFullName(): ?string
        {
        return $this->full_name;
    }

    function setFullName(string $full_name): self
        {
        $this->full_name = $full_name;

        return $this;
    }

    function getCode(): ?string
        {
        return $this->code;
    }

    function setCode(string $code): self
        {
        $this->code = $code;

        return $this;
    }

    function getCurrency(): ?string
        {
        return $this->currency;
    }

    function setCurrency(string $currency): self
        {
        $this->currency = $currency;

        return $this;
    }

    function getLanguage(): ?string
        {
        return $this->language;
    }

    function setLanguage(string $language): self
        {
        $this->language = $language;

        return $this;
    }

    function getCapitalCity(): ?string
        {
        return $this->capital_city;
    }

    function setCapitalCity(string $capital_city): self
        {
        $this->capital_city = $capital_city;

        return $this;
    }


  

    public function getFlag(): ?string
    {
        return $this->flag;
    }

    public function setFlag(?string $flag): self
    {
        $this->flag = $flag;

        return $this;
    }

    public function getMap(): ?string
    {
        return $this->map;
    }

    public function setMap(?string $map): self
    {
        $this->map = $map;

        return $this;
    }

    public function getPopulation(): ?string
    {
        return $this->population;
    }

    public function setPopulation(?string $population): self
    {
        $this->population = $population;

        return $this;
    }

    public function getArea(): ?int
    {
        return $this->area;
    }

    public function setArea(int $area): self
    {
        $this->area = $area;
        return $this;
    }

    public function getRegion(): ?string
    {
        return $this->region;
    }

    public function setRegion(?string $region): self
    {
        $this->region = $region;

        return $this;
    }
    function getSubRegion(): ?string
    {
    return $this->sub_region;
}

function setSubRegion(string $sub_region): self
    {
    $this->sub_region = $sub_region;

    return $this;
}
}
