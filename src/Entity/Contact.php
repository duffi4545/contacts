<?php

namespace App\Entity;

use App\Repository\ContactRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ContactRepository::class)]
#[UniqueEntity(
    fields: ['phoneNumber'],
    message: 'Toto telefonní číslo je již používáno.'
)]
#[UniqueEntity(
    fields: ['email'],
    message: 'Tato e-mailová adresa je již používána.'
)]
class Contact
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\Regex(
        pattern: '/\d/',
        match: false,
        message: 'Jméno nesmí obsahovat čísla',
    )]
    private ?string $firstName = null;

    #[ORM\Column(length: 255)]
    #[Assert\Regex(
        pattern: '/\d/',
        match: false,
        message: 'Příjmení nesmí obsahovat čísla',
    )]
    private ?string $lastName = null;

    #[ORM\Column(length: 50, nullable: true)]
    #[Assert\Regex(
        pattern: '/^[0-9]*$/',
        message: 'Telefonní číslo musí být v platném formátu 605605605',
    )]
    #[Assert\Length(
        exactly: 9,
        exactMessage: 'Telefonní číslo musí mít {{ limit }} znaků',
    )]
    private ?string $phoneNumber = null;
    
    #[ORM\Column(length: 255, unique: true)]
    #[Assert\Email(message: 'Toto není validní email')]
    private ?string $email = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $note = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): static
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): static
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(?string $phoneNumber): static
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getNote(): ?string
    {
        return $this->note;
    }

    public function setNote(?string $note): static
    {
        $this->note = $note;

        return $this;
    }
}
