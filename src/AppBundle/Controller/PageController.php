<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ExampleForm;

use AppBundle\Form\ExampleFormType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class PageController extends Controller
{
    use FormTrait;
    use CommonTrait;

    public function indexAction(Request $request)
    {
        return $this->render('AppBundle:pages:index.html.twig');
    }

    public function registrationAction(Request $request)
    {
        $session = $this->container->get('session');
        $session->set('amount', strval($request->request->get('amount')));
        $session->set('term', $request->request->get('term'));
        $session->save();

        $contentRegistrationForm = new ExampleForm();
        $registrationForm = $this->createForm(ExampleFormType::class, $contentRegistrationForm);
        $result = $this->isSubmittedForm($registrationForm, $request, ExampleForm::class);
          if($result){
              return $result;
          }

        return $this->render('AppBundle:pages:registration.html.twig', [
            'exampleForm' => $registrationForm->createView()
        ]);
    }
}
