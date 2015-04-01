<?php
// src/LGELBundle/Entity/Classer.php
namespace LGELmashBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="classer")
 */
class Classer {

    /**
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Id
     **/
    protected $id;

    /**
     * @ORM\OneToOne(targetEntity="Joueur")
     * @ORM\JoinColumn(name="joueur_id", referencedColumnName="id")
     **/
    protected $joueurs;

    /**
     * @ORM\OneToOne(targetEntity="Categorie")
     * @ORM\JoinColumn(name="categorie_id", referencedColumnName="id")
     **/
    protected $categorie;

    /**
     * @ORM\Column(type="integer")
     */
    protected $elo;

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
     * Set elo
     *
     * @param integer $elo
     * @return Classer
     */
    public function setElo($elo)
    {
        $this->elo = $elo;

        return $this;
    }

    /**
     * Get elo
     *
     * @return integer 
     */
    public function getElo()
    {
        return $this->elo;
    }

    /**
     * Set joueurs
     *
     * @param \LGELmashBundle\Entity\Joueur $joueurs
     * @return Classer
     */
    public function setJoueurs(\LGELmashBundle\Entity\Joueur $joueurs = null)
    {
        $this->joueurs = $joueurs;

        return $this;
    }

    /**
     * Get joueurs
     *
     * @return \LGELmashBundle\Entity\Joueur 
     */
    public function getJoueurs()
    {
        return $this->joueurs;
    }

    /**
     * Set categorie
     *
     * @param \LGELmashBundle\Entity\Categorie $categorie
     * @return Classer
     */
    public function setCategorie(\LGELmashBundle\Entity\Categorie $categorie = null)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return \LGELmashBundle\Entity\Categorie 
     */
    public function getCategorie()
    {
        return $this->categorie;
    }
}
