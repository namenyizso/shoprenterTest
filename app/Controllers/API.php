<?php

/**
 * NAMÉNYI ZSOLT
 * 2021. 08. 24. 21:37 - 23:22
 */

namespace App\Controllers;

use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\IncomingRequest;

class API extends BaseController
{

	protected $response;
	protected $secretsTable;
	protected $db;

	public function __construct()
	{
		$this->response = service('response');
		$this->request = service('request');

		$this->secretsTable = 'secrets';

		$this->db = \Config\Database::connect();
	}

	public function index()
	{
		$acceptHeader = $this->request->getHeader('Accept')->getValue();

		$this->response->setStatusCode(409);

		$data = [
			'success' => false,
			'message' => 'Invalid API endpoint.'
		];

		return $this->outputByAcceptHeader($acceptHeader, $data);
	}

	public function addSecret()
	{
		$acceptHeader = $this->request->getHeader('Accept')->getValue();

		$this->response->setStatusCode(405);

		$data = [
			'success' => false,
			'message' => 'Invalid input.'
		];

		$secret = $this->request->getPost('secret');
		$expireAfterViews = $this->request->getPost('expireAfterViews');
		$expireAfter = $this->request->getPost('expireAfter');

		if (empty($secret)) {
			$data = [
				'success' => false,
				'message' => 'Missing secret parameter.'
			];
			return $this->outputByAcceptHeader($acceptHeader, $data);
		}

		if (empty($expireAfterViews)) {
			$data = [
				'success' => false,
				'message' => 'Missing expireAfterViews parameter.'
			];
			return $this->outputByAcceptHeader($acceptHeader, $data);
		}

		if (empty($expireAfter) && $expireAfter != 0) {
			$data = [
				'success' => false,
				'message' => 'Missing expireAfter parameter.'
			];
			return $this->outputByAcceptHeader($acceptHeader, $data);
		}

		$createdAt = new \DateTime();
		$createdAt = $createdAt->format('Y-m-d H:i:s');

		$expireAfterDateTime = new \DateTime(); // now
		if ($expireAfter > 0) {
			$expireAfterDateTime->modify('+' . $expireAfter . ' minutes'); // hány percet adjunk hozzá az aktuális dátumhoz
			$expireAfterDateTime = $expireAfterDateTime->format('Y-m-d H:i:s');
		} else {
			$expireAfterDateTime = null;
		}

		$randomHash = bin2hex(random_bytes(18));

		$builder = $this->db->table($this->secretsTable);

		$data = [
			'hash' 				=> $randomHash,
			'secretText' 		=> $secret,
			'expiresAt'  		=> $expireAfterDateTime,
			'createdAt'			=> $createdAt,
			'remainingViews'	=> $expireAfterViews,
		];

		if ($builder->insert($data)) {
			$this->response->setStatusCode(200);

			$data = [
				'hash' 				=> $randomHash,
				'secretText'		=> $secret,
				'expiresAt'			=> $expireAfterDateTime,
				'createdAt'			=> $createdAt,
				'remainingViews'	=> $expireAfterViews,
			];
		}

		return $this->outputByAcceptHeader($acceptHeader, $data);
	}

	public function getSecret($hash = null)
	{
		$acceptHeader = $this->request->getHeader('Accept')->getValue();

		$this->response->setStatusCode(404);

		$data = [
			'success' => false,
			'message' => 'Secret not found.'
		];

		$builder = $this->db->table($this->secretsTable);

		$builder->select('*'); // Most ide azért mehet a select *, mert nincs sok oszlop, amúgy ezt nem illik
		$builder->where('hash', $hash);
		$builder->where('(expiresAt >= NOW() OR expiresAt IS NULL)');
		$builder->where('remainingViews > 0');
		$builder->limit(1);
		$query = $builder->get();
		$row = $query->getRow();

		// Találat!
		if (is_object($row)) {
			$data = [
				'hash' 				=> $row->hash,
				'secretText'		=> $row->secretText,
				'expiresAt'			=> $row->expiresAt,
				'createdAt'			=> $row->createdAt,
				'remainingViews'	=> $row->remainingViews,
			];
			// Vonjuk le egyet a megtekinthetőségből
			$remainingViews = intval($row->remainingViews - 1);
			$builder->set('remainingViews', $remainingViews);
			$builder->where('secret_id', $row->secret_id);
			$builder->update();
		}

		return $this->outputByAcceptHeader($acceptHeader, $data);
	}

	// Ez így nem túl extandable, ahogy a feladat kérte, de így késő este most hirtelen ez jutott eszembe. Lehetne más megoldással is megközelíteni, pl. tömbökbe szervezni, stb
	private function outputByAcceptHeader($header, $data)
	{
		if (strpos($header, 'application/xml') != -1) {
			return $this->response->setXML($data);
		} else {
			return $this->response->setJSON($data);
		}
	}
}
