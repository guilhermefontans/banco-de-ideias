<?php
namespace BancoIdeias\model;
use BancoIdeias\model\Dao;

class PremioDao extends Dao
{
	public function __construct() {
		parent::__construct("premio");
	}
}
