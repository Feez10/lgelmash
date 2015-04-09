<?php
// src/LGELmashBundle/Entity/Joueur.php
namespace LGELmashBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="joueur")
 * @ORM\Entity(repositoryClass="LGELmashBundle\Entity\JoueurRepository")
 */
class Joueur {

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=100, unique=true)
     */
    protected $pseudo;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $can_be_voted = true;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set pseudo
     *
     * @param string $pseudo
     * @return Joueur
     */
    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    /**
     * Get pseudo
     *
     * @return string
     */
    public function getPseudo()
    {
        return $this->pseudo;
    }

    /**
     * Set can_be_voted
     *
     * @return Joueur
     */
    public function setCan_be_voted($can_be_voted)
    {
        $this->can_be_voted = $can_be_voted;
        return $this;
    }

    /**
     * Get can_be_voted
     *
     * @return boolean
     */
    public function getCan_be_voted()
    {
        return $this->can_be_voted;
    }

    /**
     * Set can_be_voted
     *
     * @param boolean $canBeVoted
     * @return Joueur
     */
    public function setCanBeVoted($canBeVoted)
    {
        $this->can_be_voted = $canBeVoted;

        return $this;
    }

    /**
     * Get can_be_voted
     *
     * @return boolean 
     */
    public function getCanBeVoted()
    {
        return $this->can_be_voted;
    }
}
