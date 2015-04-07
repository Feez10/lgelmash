<?php

namespace LGELmashBundle\Controller;

use Proxies\__CG__\LGELmashBundle\Entity\Joueur;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }

    /**
     * @Route("/versus")
     * @Template()
     */
    public function versusAction()
    {

        $retour = array();
        $retour["joueurs"] = array();

        $em = $this->getDoctrine()->getManager();
        $retour["joueurs"] = $em->getRepository('LGELmashBundle:Joueur')->findRandomEligibleJoueurs(2);

        print_r($retour["joueurs"]);

        $categorie = $em->getRepository('LGELmashBundle:Categorie')->findAll();
        shuffle($categorie);
        $retour["categorie"] = $categorie[0];

        print_r($retour["categorie"]);
        return $retour;
    }

    /**
     * @Route("/classement")
     * @Template()
     */
    public function classementAction()
    {
        $infos = array();

        $em = $this->getDoctrine()->getManager();
        $infos["categories"] = $em->getRepository('LGELmashBundle:Categorie')->findAll();

        $infos["classements"] = array();
        foreach($infos["categories"] as $categorie){
            $infos["classements"][] =
                $em->getRepository('LGELmashBundle:Classer')->findTopNCategorie(5, $categorie->getId());
        }

        return $infos;
    }

    /**
     * @Route("/suggestion")
     * @Template()
     */
    public function suggestionAction()
    {
        return array();
    }

    /**
     * @Route("/admin")
     * @Template()
     */
    public function adminAction()
    {
        return array();
    }

    private function getTopN($n, $categorie)
    {
        $repository = $this->getDoctrine()->getRepository('LGELmashBundle:Classer');

        $topN = $repository->findBy(array('categorie' => $categorie),
            array('elo' => 'DESC')
        );
        return $topN;
    }
}
