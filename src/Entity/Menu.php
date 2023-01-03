<?php

namespace App\Entity;

use App\Repository\MenuRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MenuRepository::class)]
class Menu
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /* #[ORM\Column(length: 255)]
    private ?string $boisson = null;
 */
    #[ORM\OneToMany(mappedBy: 'menu', cascade:["persist","remove"], targetEntity: Plat::class)]
    private Collection $plat;
    /* 
    #[ORM\Column(length: 255)]
    private ?string $Boisson = null;
 */
    #[ORM\OneToMany(mappedBy: 'menu', cascade:["persist","remove"],targetEntity: Dessert::class)]
    private Collection $dessert;

    #[ORM\OneToMany(mappedBy: 'menu', cascade:["persist","remove"],targetEntity: Entrees::class)]
    private Collection $Entrees;

    #[ORM\OneToMany(mappedBy: 'menu', cascade:["persist","remove"],targetEntity: Boisson::class)]
    private Collection $drink;

    #[ORM\OneToMany(mappedBy: 'menu', cascade:["persist","remove"],targetEntity: Template::class)]
    private Collection $templates;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'menus')]
    private ?User $user;

    public function __construct()
    {
        $this->plat = new ArrayCollection();
        $this->dessert = new ArrayCollection();
        $this->Entrees = new ArrayCollection();
        $this->drink = new ArrayCollection();
        $this->templates = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Plat>
     */
    public function getPlat(): Collection
    {
        return $this->plat;
    }

    public function addPlat(Plat $plat): self
    {
        if (!$this->plat->contains($plat)) {
            $this->plat->add($plat);
            $plat->setMenu($this);
        }

        return $this;
    }

    public function removePlat(Plat $plat): self
    {
        if ($this->plat->removeElement($plat)) {
            // set the owning side to null (unless already changed)
            if ($plat->getMenu() === $this) {
                $plat->setMenu(null);
            }
        }

        return $this;
    }

    /*   public function getBoisson(): ?string
    {
        return $this->Boisson;
    }

    public function setBoisson(string $Boisson): self
    {
        $this->Boisson = $Boisson;

        return $this;
    }
 */
    /**
     * @return Collection<int, Dessert>
     */
    public function getDessert(): Collection
    {
        return $this->dessert;
    }

    public function addDessert(Dessert $dessert): self
    {
        if (!$this->dessert->contains($dessert)) {
            $this->dessert->add($dessert);
            $dessert->setMenu($this);
        }

        return $this;
    }

    public function removeDessert(Dessert $dessert): self
    {
        if ($this->dessert->removeElement($dessert)) {
            // set the owning side to null (unless already changed)
            if ($dessert->getMenu() === $this) {
                $dessert->setMenu(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Entrees>
     */
    public function getEntrees(): Collection
    {
        return $this->Entrees;
    }

    public function addEntree(Entrees $entree): self
    {
        if (!$this->Entrees->contains($entree)) {
            $this->Entrees->add($entree);
            $entree->setMenu($this);
        }

        return $this;
    }

    public function removeEntree(Entrees $entree): self
    {
        if ($this->Entrees->removeElement($entree)) {
            // set the owning side to null (unless already changed)
            if ($entree->getMenu() === $this) {
                $entree->setMenu(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Boisson>
     */
    public function getDrink(): Collection
    {
        return $this->drink;
    }

    public function addDrink(Boisson $drink): self
    {
        if (!$this->drink->contains($drink)) {
            $this->drink->add($drink);
            $drink->setMenu($this);
        }

        return $this;
    }

    public function removeDrink(Boisson $drink): self
    {
        if ($this->drink->removeElement($drink)) {
            // set the owning side to null (unless already changed)
            if ($drink->getMenu() === $this) {
                $drink->setMenu(null);
            }
        }

        return $this;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return Collection<int, Template>
     */
    public function getTemplates(): Collection
    {
        return $this->templates;
    }

    public function addTemplate(Template $template): self
    {
        if (!$this->templates->contains($template)) {
            $this->templates->add($template);
            $template->setMenu($this);
        }

        return $this;
    }

    public function removeTemplate(Template $template): self
    {
        if ($this->templates->removeElement($template)) {
            // set the owning side to null (unless already changed)
            if ($template->getMenu() === $this) {
                $template->setMenu(null);
            }
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
