<?php

namespace AppBundle\Controller;

use AppBundle\Form\UserType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $form = $this->buildForm()->getForm()->createView();

        return $this->render('AppBundle::index.html.twig', [
            'form' => $form
        ]);
    }

    /**
     * @Route("/view", name="view")
     * @param Request $request
     *
     * @return Response
     */
    public function viewAction(Request $request)
    {
        // if you want the internal structure of $request, but you don't have XDebug available
        // die($request)

        return $this->render('AppBundle::view.html.twig',[
           'user' => $request->get('user')
        ]);
    }

    private function buildForm()
    {
        $form = $this->get('form.factory')->createBuilder(UserType::class);
        $form->add('submit', SubmitType::class);

        $form->setAction($this->get('router')->generate('view'));

        return $form;
    }
}
