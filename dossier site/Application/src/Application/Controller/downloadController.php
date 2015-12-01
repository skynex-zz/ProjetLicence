<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;

class RubriqueController extends AbstractActionController{
	
	public function downloadAction() {
		//$file = $this->getEvent()->getRouteMatch()->getParam('file');
		$file = 'useruploads/files/Cours1PDF.pdf';
		$response = new \Zend\Http\Response\Stream();
		$response->setStream(fopen($file, 'r'));
		$response->setStatusCode(200);
		$response->setStreamName(basename($file));
		echo basename($file);
		$headers = new \Zend\Http\Headers();
		$headers->addHeaders(array(
			'Content-Disposition' => 'attachment; filename="' . basename($file) .'"',
			'Content-Type' => 'application/octet-stream',
			'Content-Length' => filesize($file),
			'Expires' => '@0', // @0, because zf2 parses date as string to \DateTime() object
			'Cache-Control' => 'must-revalidate',
			'Pragma' => 'public'
		));
		$response->setHeaders($headers);
		return $response;
	}
}