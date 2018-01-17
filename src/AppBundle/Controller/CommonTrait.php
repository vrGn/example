<?php

namespace AppBundle\Controller;

use Symfony\Component\Form\Form;

/**
 * Trait CommonTrait
 * @package AppBundle\Controller
 */
trait CommonTrait
{
    /**
     * @param Form $form
     * @return array
     */
    public function getErrorMessages(Form $form)
    {
        $errors = array();

        foreach ($form->getErrors() as $key => $error) {
            $errors[] = $error->getMessage();
        }

        foreach ($form->all() as $child) {
            if (!$child->isValid()) {
                $errors[$child->getName()] = $this->getErrorMessages($child);
            }
        }

        return $errors;
    }
}
