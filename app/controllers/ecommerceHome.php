<?php
declare(strict_types = 1); 

Class EcommerceHome extends Controller
{
    function index($a, $b)
    {
        $data['title_page'] = 'Pomoro - Home';

        $cart = $this->loadModel("cart");
        $cartTime = new Cart;
        $cartTime->addToCart($_POST);
        //echo 'alert(test);';
        

        try {
        //very sketchy url rewriting attempt before any database calls are made
        if (!is_numeric($a) OR is_null($a)) {
            $a = 0;
            header("Refresh:0, url=../0/1");
        }
        if (!is_numeric($b) OR ($b < 1) OR (is_null($b))) {
            $b = 1;
            header("Refresh:0, url=1");
        }

        $product = $this->loadModel("product");
        $productTime = new Product;

        //list all categories
        $categories = $productTime->getAllCategories();
        $data['categories'] = $categories;

        $numOfProducts = $productTime->getCountOfProducts($a);
        $data['numOfProducts'] = $numOfProducts;

        $numOfCategories = $productTime->getCountOfCategories();
        $data['numOfCategories'] = $numOfCategories;

        if ($a == 0) {
            $products = $productTime->getAllProducts($b);
            $data['products'] = $products;
        } else
        {
            $products = $productTime->getCategoryProducts($a, $b);
            $data['products'] = $products;
        }

        //testing # of products per page and page # for pagination... manually changed from constant to 4 in product.php because of errors
        $data['productsPerPage'] = 4;
        $data['pageNumber'] = $b;
        
        //attempting to catch missing arguments in url... still no luck
        } catch (ArgumentCountError $e){
            $a = 0;
            $b = 1;
            if (func_num_args() == 0) {
                header("Refresh:0, url=../0/1");
            }
            if (func_num_args() == 1) {
                header("Refresh:0, url=1");
            }
        }

        $this->view("ecommerceHome", $data);
    }

}