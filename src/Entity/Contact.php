<?php

//class Contact correspond directement à une ligne de la table SQL contact
class Contact
{
    //Attributs correspondant aux colonnes de la table SQL contact
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

    //Convertit l'objet en chaîne de caractères pour affichage CLI (avec echo)
    //utilise la méthode magique __toString()
    public function __toString(): string
    {
        return $this->id . " - " . $this->name . " - " . $this->email . " - " . $this->phoneNumber;
    }
}