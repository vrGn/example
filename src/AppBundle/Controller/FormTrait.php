<?php
namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Common features needed in controllers.
 */
trait FormTrait
{
    /**
     * @param $form
     * @param Request $request
     * @param $entityClass
     * @return bool|JsonResponse
     */
    public function isSubmittedForm($form, Request $request, $entityClass)
    {
        $form->handleRequest($request);
            //return new JsonResponse($request->getSession()->all());           // session have values
        if ( $form->isSubmitted() ) {
            //return new JsonResponse($request->getSession()->all());           // session values term and amount = null

            if( $form->isValid() ) {

                $params = $this->getParams($form, $entityClass, $request);

                $result = $this->applyParams($params, $entityClass);

                $return = $this->response($result, $entityClass, $request, $form);

            } else {
                $return = ['success' => 0, 'errors' => $this->getErrorMessages($form)];
            }
            return new JsonResponse($return);
        }
        return false;
    }

    /**
     * @param $form
     * @param $entityClass
     * @param $request
     * @return array
     */
    protected function getParams($form, $entityClass, $request)
    {
        $params = array();
        switch ($entityClass) {
            case 'AppBundle\Entity\ExampleForm':
                $params = $this->getRegistrationFormParams($form, $request);
                break;
        }
        return $params;
    }

    /**
     * @param $form
     * @param $request
     * @return array
     */
    protected function getRegistrationFormParams($form, $request)
    {
        $params = [
            'last_name' => mb_strtoupper( $form->get('last_name')->getData() ),
            'first_name' => mb_strtoupper( $form->get('first_name')->getData() ),
            'middle_name' => mb_strtoupper( $form->get('middle_name')->getData() ),
            'email_address' => $form->get('email_address')->getData(),
            'amount' => $this->getAmount($request),
            'term' => $this->getTerm($request),
        ];

        return $params;
    }



    /**
     * @param $request
     * @return mixed
     */
    protected function getAmount($request)
    {
        $session = $request->getSession();
        $amount = $session->get('amount');
        $session->remove('amount');
        $session->save();
        return $amount ? $amount : 15000;
    }

    /**
     * @param $request
     * @return mixed
     */
    protected function getTerm($request)
    {
        $session = $request->getSession();
        $term = $session->get('term') ?? 30;
        $session->remove('amount');
        $session->save();
        return $term > 30 ? 30 : $term;
    }
}
