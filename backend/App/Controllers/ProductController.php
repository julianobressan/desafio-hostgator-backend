<?php

namespace App\Controllers;

use App\Models\Product;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

/**
 * A Controller to Product objects
 * 
 * @copyright 2020, Juliano Bressan, BRX Digital (http://brxdigital.com)
 */
final class ProductController {

    public function getPrices(Request $request, Response $response, array $args) : Response {
        $data = $this->allProductsToArray();
        $dataWithHeader = array();

        $dataWithHeader["shared"] = $data;   
        $payload = json_encode($dataWithHeader);
        $response->getBody()->write($payload);

        return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(201);
    }

    public function getPrice(Request $request, Response $response, array $args) : Response {
        $data = $this->productPricesToArray($args["id"]);
        if($data) {
            $payload = json_encode($data);
            $response->getBody()->write($payload);

            return $response
                    ->withHeader('Content-Type', 'application/json')
                    ->withStatus(201);
        }
        else {
            return $response
            ->withStatus(404);
        }
    }

    private function allProductsToArray()
    {
        $productsArray = array();
        foreach(Product::all() as $product)
        {
            $productsArray["product_".$product->id] = $this->productPricesToArray($product->id);
        }
      
        $shared = array();
        $shared["products"] = $productsArray;

        return $shared;
    }

    private function productPricesToArray($id)
    {
        $product = Product::find($id);

        if(!$product) return null;
        $array = array();
        
        $array["name"] = iconv('UTF-8', 'UTF-8//IGNORE', utf8_encode($product->name));;
        $array["id"] = (int)$product->id;

        $cycles = array();
        foreach($product->cycles() as $cycle)
        {
            $cycleArray = array();
            $cycleArray["priceRenew"] = (double)$cycle->priceRenew;
            $cycleArray["priceOrder"] = (double)$cycle->priceOrder;
            $cycleArray["months"] = (int)$cycle->cycleType()->months;
            $cycleArray["name"] = (int)$cycle->cycleType()->name;
            $cycles[$cycle->cycleType()->name] = $cycleArray;
        }

        $array["cycles"] = $cycles;

        return $array;
    }
}