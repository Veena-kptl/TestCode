<?php

namespace ApiExample\CustomModule\Model\Api;

use Psr\Log\LoggerInterface;

class Custom{

	/**
	 * {@inheritdoc}
	 */
	public function getPost($param)
	{
		return 'api GET return the $param ' . $param;
	}
}
