<?php
use \Hcode\Page;
use \Hcode\Model\Products;



$app->get('/', function() {
    
	$products = Products::listAll();
	$page = new Page();
	$page->setTpl("index", [
			'products'=>Products::checkList($products)
		]);
	
	//echo "OK";
	//$sql = new Hcode\DB\Sql();
	//$results = $sql->select("SELECT * FROM tb_users");
	//echo json_encode($results);

});

$app->get("/categories/:idcategory", function($idcategory){
	$category = new Category();
	$category->get((int)$idcategory);
	$page = new Page();
	$page->SetTpl("category", [
			'category'=>$category->getValues(),
			'products'=>[]
		]);
});

?> 