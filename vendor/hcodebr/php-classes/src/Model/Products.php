<?php
namespace Hcode\Model;
use \Hcode\DB\Sql;
use \Hcode\Model;
use \Hcode\Mailer;
class Products extends Model{

	
	public static function listAll()
	{
		$sql = new Sql();
		return $sql->select ("SELECT * FROM tb_products ORDER BY desproduct");
	}
	public function save()
	{
		$sql = new Sql();
		
		$results = $sql->select("CALL sp_products_save(:idproduct, :desproduct, :vlprice, :vlwidth, :vlheight, :vllength, :vlweight, :desurl)", array(
				":idproduct"=>$this->getidproduct(),
				":desproduct"=>$this->getdesproduct(),
				":vlprice"=>$this->getvlprice(),
				":vlwidth"=>$this->getvlwidth(),
				":vlheight"=>$this->getvlheight(),
				":vllength"=>$this->getvllength(),
				":vlweight"=>$this->getvlweight(),
				":desurl"=>$this->getdesurl()
			));
			$this->setData($results[0]);
			
	}
	public function get ($idcategory)
	{

		$sql = new Sql();
		$results = $sql->select("SELECT * FROM tb_products WHERE idproduct = :idproduct", [
				':idproduct'=>$idproducts
			]);
			$this->setData($results[0]);
	}
	public function delete()
	{

		$sql = new Sql();
		$sql->query("DELETE FROM tb_products WHERE idproduct = :idproduct", [
				':idproduct'=>$this->getidproduct()
			]);
		
	}
	public function checkPhoto()
	{

		if (file_exists(
			$_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.
			"res".DIRECTORY_SEPARATOR.
			"site".DIRECTORY_SEPARATOR.
			"img". DIRECTORY_SEPARATOR.
			"products".DIRECTORY_SEPARATOR.
			$this->getidproduct().".jpg"
			)){
			$url = "/res/site/img/products/".$this->getidproduct().".jpg";
		}else{
			$url =  "/res/site/img/product.jpg";
		}
		return $this->setdesphoto($url);
	}




	public function getValues()
	{
		$this->checkPhoto();

		$values = parent::getValues();
		return $values;
	}
	
}


?>