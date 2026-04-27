<?php

class Contact
{
    //Attributs correspondant à la table SQL
    private ?int $id = null;
    private ?string $name = null;
    private ?string $email = null;
    private ?string $phoneNumber = null;

    //GETTERS and SETTERS
    //ID
    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    //Name
    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    //Email
    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    //Phone
    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(?string $phoneNumber): void
    {
        $this->phoneNumber = $phoneNumber;
    }

    //Affichage propre, permet d'afficher directement l'objet avec echo
    public function __toString(): string
    {
        return $this->id . " - " . $this->name . " - " . $this->email . " - " . $this->phoneNumber;
    }
}