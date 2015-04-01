<?php

namespace LGELmashBundle\Controller;

use LGELmashBundle\Entity\Categorie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use LGELmashBundle\Entity\Joueur;
use LGELmashBundle\Entity\Classer;
use LGELmashBundle\Form\JoueurType;

/**
 * Joueur controller.
 *
 * @Route("/joueurs")
 */
class JoueurController extends Controller
{

    /**
     * Lists all Joueur entities.
     *
     * @Route("/", name="joueurs")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('LGELmashBundle:Joueur')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Joueur entity.
     *
     * @Route("/", name="joueurs_create")
     * @Method("POST")
     * @Template("LGELmashBundle:Joueur:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Joueur();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);

            $categories = $em->getRepository('LGELmashBundle:Categorie')->findAll();
            foreach($categories as $categorie)
            {
                $classer = new Classer();
                $classer->setCategorie($categorie);
                $classer->setJoueurs($entity);
                $classer->setElo(1200);
                $em->persist($classer);
            }
            $em->flush();

            return $this->redirect($this->generateUrl('joueurs_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Joueur entity.
     *
     * @param Joueur $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Joueur $entity)
    {
        $form = $this->createForm(new JoueurType(), $entity, array(
            'action' => $this->generateUrl('joueurs_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Joueur entity.
     *
     * @Route("/new", name="joueurs_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Joueur();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Joueur entity.
     *
     * @Route("/{id}", name="joueurs_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('LGELmashBundle:Joueur')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Joueur entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Joueur entity.
     *
     * @Route("/{id}/edit", name="joueurs_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('LGELmashBundle:Joueur')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Joueur entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Joueur entity.
    *
    * @param Joueur $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Joueur $entity)
    {
        $form = $this->createForm(new JoueurType(), $entity, array(
            'action' => $this->generateUrl('joueurs_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Joueur entity.
     *
     * @Route("/{id}", name="joueurs_update")
     * @Method("PUT")
     * @Template("LGELmashBundle:Joueur:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('LGELmashBundle:Joueur')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Joueur entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('joueurs_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    // TODO Créer un formulaire de modification pour mettre à jour le champs "can_be_deleted"
    /**
     * Deletes a Joueur entity.
     *
     * @Route("/{id}", name="joueurs_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('LGELmashBundle:Joueur')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Joueur entity.');
            }

            $em->setCan_be_voted(false);
            //$em->remove($entity);

            $em->flush();
        }

        return $this->redirect($this->generateUrl('joueurs'));
    }

    /**
     * Creates a form to delete a Joueur entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('joueurs_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
