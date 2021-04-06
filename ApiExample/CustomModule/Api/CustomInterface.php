<?php

namespace ApiExample\CustomModule\Api;

interface CustomInterface {


	/**
	 * GET for Post api
	 * @param string $param
	 * @return string
	 */
	
	public function getPost($param);
}