<?php 

namespace AppBundle\Controller;

use AppBundle\Entity\Phone;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\Validator\ConstraintViolationList;
use AppBundle\Exception\ResourceValidationException;
use AppBundle\Exception\ResourceNotExistException;

class PhoneController extends FOSRestController
{   
	/**
	 * @Rest\Get(
	 *		path = "/phones/{id}",
	 *		name = "app_phone_show",
	 *		requirements = {"id" = "\d+"}
	 * )
	 *
	 * @Rest\View(StatusCode=200)
	 */
	public function ShowAction(Phone $phone)
	{   
		return $phone;
	}
    
    /**
     * @Rest\Get(
     *		path = "/phones",
     *		name = "app_phone_list",
     * )
     *
     * @Rest\View(StatusCode=200)
     */
	Public function ListAction()
	{
		$em = $this->getDoctrine()->getManager();

		$phones = $em->getRepository('AppBundle:Phone')->findAll();

		return $phones;
	}

}