<?php
namespace Fdbc\Resto\ApiV1Bundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use FOS\RestBundle\Controller\Annotations\RequestParam;
use FOS\RestBundle\Request\ParamFetcher;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

use Fdbc\Resto\CoreBundle\Document\Restaurant;

class RestaurantController extends FOSRestController
{
    /**
     * @ApiDoc(
     *  resource=true,
     *  description="Search restaurant"
     * )
     *
     * @QueryParam(name="name", description="Name")
     * @QueryParam(name="full_address", description="Full address (including zip code and city).")
     * @QueryParam(name="address", description="Address.")
     * @QueryParam(name="zip_code", description="Zip code.")
     * @QueryParam(name="city", description="City.")
     *
     * @QueryParam(name="page", requirements="\d+", default="1", description="Set current page")
     * @QueryParam(name="per_page", requirements="\d+", default="10", description="Number of restaurants returned per page")
     *
     * @View()
     *
     * @param ParamFetcher $paramFetcher Paramfetcher
     */
    public function getRestaurantsAction(ParamFetcher $paramFetcher)
    {
        $parameters = $paramFetcher->all();

        //var_dump($parameters);

        return [
            'total'       => 0,
            'restaurants' => [],
        ];
    }
}