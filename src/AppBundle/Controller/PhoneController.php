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

class PhoneController extends FOSRestController
{
	public function ShowAction(Phone $phone)
	{

	}

	Public function ListAction()
	{
		
	}

}