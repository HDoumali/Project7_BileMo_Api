<?php 

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\Validator\ConstraintViolationList;
use AppBundle\Exception\ResourceValidationException;
use AppBundle\Exception\ResourceNotExistException;

class UserController extends FOSRestController
{   
	/**
	 * @Rest\Get(
	 *		path = "api/users/{id}",
	 *		name = "app_user_show",
	 *		requirements = {"id" = "\d+"}
	 * )
	 *
	 * @Rest\View(StatusCode=200)
	 */
	public function ShowAction(User $user)
	{   
		return $user;
	}
    
    /**
     * @Rest\Get(
     *		path = "api/users",
     *		name = "app_user_list",
     * )
     *
     * @Rest\View(StatusCode=200)
     */
	Public function ListAction()
	{
		$em = $this->getDoctrine()->getManager();

		$customer = $this->getUser();

		$users = $em->getRepository('AppBundle:User')->getUsers($customer);

		return $users;
	}

}