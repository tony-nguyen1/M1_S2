<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    #[ORM\OneToMany(targetEntity: Evenement::class, mappedBy: 'user')]
    private Collection $evenements;

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }


// Assurez-vous d'initialiser la collection dans le constructeur de votre classe
public function __construct()
{
    $this->evenements = new ArrayCollection();
}

// Getter pour evenements
public function getEvenements(): Collection
{
    return $this->evenements;
}

// Ajoute un evenement à la collection
public function addEvenement(Evenement $evenement): self
{
    if (!$this->evenements->contains($evenement)) {
        $this->evenements[] = $evenement;
        $evenement->setUser($this); // Assurez-vous que l'entité Evenement a une méthode setUser
    }

    return $this;
}

// Supprime un evenement de la collection
public function removeEvenement(Evenement $evenement): self
{
    if ($this->evenements->removeElement($evenement)) {
        // Définit la propriété 'user' de l'entité Evenement à null
        // (à condition que l'entité Evenement possède une méthode setUser qui accepte null)
        if ($evenement->getUser() === $this) {
            $evenement->setUser(null);
        }
    }

    return $this;
}

}
