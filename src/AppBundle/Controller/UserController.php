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

	/**
	 * @Rest\Post(
	 *		path = "api/users",
	 *		name = "app_user_create",
	 * )
	 *
	 * @Rest\View(StatusCode=201)
	 *
	 * @ParamConverter(
	 *		 "user",
	 *       converter="fos_rest.request_body",
	 * )
	 */
	public function CreateAction(User $user, ConstraintViolationList $violation)
	{
		if (count($violations)) {
            	$message = 'Le fichier JSON contient des données non valides. Voici les erreurs que vous devez corriger : ';

	            foreach ($violations as $violation) {
	                $message .= sprintf("Field %s: %s ", $violation->getPropertyPath(), $violation->getMessage());
	            }

	            throw new ResourceValidationException($message);
        }

        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        return $this->view(
			$article, 
			Response::HTTP_CREATED, 
			[
				'Location' => $this->generateUrl('app_user_show', ['id' => $user->getId()], UrlGeneratorInterface::ABSOLUTE_URL) 
			]
		);
	}

	public function DeleteAction()
	{

	}

}