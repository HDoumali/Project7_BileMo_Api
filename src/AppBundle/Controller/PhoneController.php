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
use Nelmio\ApiDocBundle\Annotation as Doc;

class PhoneController extends FOSRestController
{   
	/**
	 * @Rest\Get(
	 *		path = "api/phones/{id}",
	 *		name = "app_phone_show",
	 *		requirements = {"id" = "\d+"}
	 * )
	 *
	 * @Rest\View(StatusCode=200)
	 * @Doc\ApiDoc(
	 *			resource=true,
	 *			description="Consulter le détail d’un mobile.",
	 *			requirements={
	 *					{
	 *						"name"="id",
	 *						"dataType"="integer",
	 *						"requirements"="\d+",
	 *						"description"="Identifiant unique du mobile."
	 * 					}
	 * 			},
	 *			headers={
	 *				{
     *						"name"="Authorization",
     *						"description"="Clé d'autorisation permettant l'authentification et l'accès aux ressources (Bearer YourAccessToken)",
	 *						"required"=true
     *	 			}
	 *          },
	 *			section="Phones",
	 *			statusCodes={
	 *					200="StatusCode retourné lorsque tout s'est bien passé lors de l'affichage d'un mobile"
	 * 			},
	 *			tags={
	 *				"phones"
	 * 			}
	 * )
	 */
	public function ShowAction(Phone $phone)
	{   
		return $phone;
	}
    
    /**
     * @Rest\Get(
     *		path = "api/phones",
     *		name = "app_phone_list",
     * )
     *
     * @Rest\View(StatusCode=200)
     * @Doc\ApiDoc(
	 *			resource=true,
	 *			description="Consulter la liste des mobiles.",
	 *			headers={
	 *				{
     *						"name"="Authorization",
     *						"description"="Clé d'autorisation permettant l'authentification et l'accès aux ressources (Bearer YourAccessToken)",
	 *						"required"=true
     *	 			}
	 *          },
	 *			section="Phones",
	 *			statusCodes={
	 *					200="StatusCode retourné lorsque tout s'est bien passé lors de l'affichage de la liste des mobiles."
	 * 			},
	 *			tags={
	 *				"phones"
	 * 			}
	 * )
     */
	Public function ListAction()
	{
		$em = $this->getDoctrine()->getManager();

		$phones = $em->getRepository('AppBundle:Phone')->findAll();

		return $phones;
	}

}