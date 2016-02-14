<?php
namespace Fdbc\Resto\ApiV1Bundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use FOS\RestBundle\Request\ParamFetcher;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class RestaurantController extends FOSRestController
{
    /**
     * @ApiDoc(
     *  resource=true,
     *  description="Search restaurant"
     * )
     *
     * @QueryParam(name="name", description="Name")
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
        
        $restaurants = [];
        $count = 0;

        $restaurantsCursor = $this->get('doctrine_mongodb')
            ->getRepository('FdbcRestoCoreBundle:Restaurant')
            ->getRestaurants($parameters, $parameters['per_page'], ($parameters['page'] * $parameters['per_page'] - $parameters['per_page']));

        foreach ($restaurantsCursor as $restaurant) {
            $restaurants[] = $restaurant;
            $count++;
        }

        return [
            'total' => $count,
            'data' => $restaurants,
        ];
    }
}
