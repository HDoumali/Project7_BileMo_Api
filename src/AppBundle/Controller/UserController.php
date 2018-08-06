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
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Nelmio\ApiDocBundle\Annotation as Doc;

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
	 *
	 * @Doc\ApiDoc(
	 *			resource=true,
	 *			description="Consulter le détail d’un utilisateur inscrit lié à un client.",
	 *			requirements={
	 *					{
	 *						"name"="id",
	 *						"dataType"="integer",
	 *						"requirements"="\d+",
	 *						"description"="Identifiant unique de l'utilisateur."
	 * 					}
	 * 			},
	 *			headers={
	 *				{
     *						"name"="Authorization",
     *						"description"="Clé d'autorisation permettant l'authentification et l'accès aux ressources (Bearer YourAccessToken)",
	 *						"required"=true
     *	 			}
	 *          },
	 *			section="Users",
	 *			statusCodes={
	 *					200="StatusCode retourné lorsque tout s'est bien passé lors de l'affichage d'un utilisateur lié à un client"
	 * 			},
	 *			tags={
	 *				"users"
	 * 			}
	 * )
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
     *
     * @Doc\ApiDoc(
	 *			resource=true,
	 *			description="Consulter la liste des utilisateurs inscrits liés à un client.",
	 *			headers={
	 *				{
     *						"name"="Authorization",
     *						"description"="Clé d'autorisation permettant l'authentification et l'accès aux ressources (Bearer YourAccessToken)",
	 *						"required"=true
     *	 			}
	 *          },
	 *			section="Users",
	 *			statusCodes={
	 *					200="StatusCode retourné lorsque tout s'est bien passé lors de l'affichage de la liste des utilisateurs liés à un client"
	 * 			},
	 *			tags={
	 *				"users"
	 * 			}
	 * )
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
	 *		 options={
	 *			  "validator"={ "groups"="Create_User" }
	 *       }
	 * )
	 * @Doc\ApiDoc(
	 *			resource=true,
	 *			description="Création d’un utilisateur lié à un client.",
	 *			headers={
	 *				{
     *						"name"="Authorization",
     *						"description"="Clé d'autorisation permettant l'authentification et l'accès aux ressources (Bearer YourAccessToken)",
	 *						"required"=true
     *	 			}
	 *          },
	 *			section="Users",
	 *			statusCodes={
	 *					201="StatusCode retourné lorsque tout s'est bien passé lors de la création d'un utilisateur lié à un client",
	 *					400="Code retourné lorsque qu'une violation est créee par la validation."
	 * 			},
	 *			parameters={
	 *				{"name"="username", "dataType"="string", "required"=true},
	 *				{"name"="firstname", "dataType"="string", "required"=true},
	 *				{"name"="lastname", "dataType"="string", "required"=true},
	 *				{"name"="email", "dataType"="string", "required"=true},
	 *				{"name"="password", "dataType"="string", "required"=true},
	 *				{"name"="roles", "dataType"="array", "required"=false}
	 *          },
	 *			tags={
	 *				"users"
	 * 			}
	 * )
	 */
	public function CreateAction(User $user, ConstraintViolationList $violations, UserPasswordEncoderInterface $passwordEncoder)
	{
		if (count($violations)) {
            	$message = 'Le fichier JSON contient des données non valides. Voici les erreurs que vous devez corriger : ';

	            foreach ($violations as $violation) {
	                $message .= sprintf("Field %s: %s ", $violation->getPropertyPath(), $violation->getMessage());
	            }

	            throw new ResourceValidationException($message);
        }

        $customer = $this->getUser();

        $em = $this->getDoctrine()->getManager();
        $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
        $user->setPassword($password);
        $user->setCustomer($customer);
        $em->persist($user);
        $em->flush();

        return $this->view(
			$user, 
			Response::HTTP_CREATED, 
			[
				'Location' => $this->generateUrl('app_user_show', ['id' => $user->getId()], UrlGeneratorInterface::ABSOLUTE_URL) 
			]
		);
	}

	/**
	 * @Rest\Delete(
	 *		 path = "api/users/{id}",
	 *	     name = "app_user_delete",
	 *       requirements = {"id" = "\d+"}
	 * )
	 *
	 * @Rest\View(StatusCode=204)
	 * @Doc\ApiDoc(
	 *			resource=true,
	 *			description="Supprimer un utilisateur inscrit lié à un client.",
	 *			requirements={
	 *					{
	 *						"name"="id",
	 *						"dataType"="integer",
	 *						"requirements"="\d+",
	 *						"description"="Identifiant unique de l'utilisateur."
	 * 					}
	 * 			},
	 *			headers={
	 *				{
     *						"name"="Authorization",
     *						"description"="Clé d'autorisation permettant l'authentification et l'accès aux ressources (Bearer YourAccessToken)",
	 *						"required"=true
     *	 			}
	 *          },
	 *			section="Users",
	 *			statusCodes={
	 *					204="StatusCode retourné lorsque tout s'est bien passé lors de la suppression d'un utilisateur lié à un client"
	 * 			},
	 *			tags={
	 *				"users"
	 * 			}
	 * )
	 */
	public function DeleteAction(User $user)
	{
		$em = $this->getDoctrine()->getManager();
		$em->remove($user);
		$em->flush();

		return;
	}

}