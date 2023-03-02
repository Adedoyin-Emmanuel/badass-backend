<?php

require __DIR__ . '/vendor/autoload.php';
require_once "base.controller.php";


class Bluk_Image_Downloader
{
	private $public_key;
	private $private_key;


	public function __construct()
	{
		parent::__construct();

		$this->public_key = "Ytr6xLjnSn0TkyZ9nooZc7HoyudKvEc5OSukQoKxnKo";
		$this->private_key = "iPDLA8GHARcfk9hMf9CZZdOEcpfYLKVVOfwzhAaYNaQ";

		Unsplash\HttpClient::init([
			'applicationId'	=> $this->public_key,
			'secret'	=> $this->private_key,
			'callbackUrl'	=> 'https://your-application.com/oauth/callback',
			'utmSource' => 'Badass'
		]);
	}

	public function search_images($search_prompt, $page = 1, $per_page = 20, $orientation = "landscape")
	{
		$result = Unsplash\Search::photos($search_prompt, $page, $per_page, $orientation);

		return $result;
	}
}