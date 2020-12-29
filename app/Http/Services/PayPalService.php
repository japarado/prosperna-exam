<?php
namespace App\Http\Services;

use GuzzleHttp\Client;

class PayPalService {
	private Client $client;
	private String $accessToken;

	public function __construct()
	{
		$this->client = $this->createClient();
		$this->accessToken = ($this->requestToken())->access_token;
	}

    /**
     * @return Client
     */
    public function getClient(): Client
    {
        return $this->client;
    }

    /**
     * @param Client $client
     */
    public function setClient(Client $client): void
    {
        $this->client = $client;
    }

    /**
     * @return String
     */
    public function getAccessToken(): string
    {
        return $this->accessToken;
    }

    /**
     * @param String $accessToken
     */
    public function setAccessToken(string $accessToken): void
    {
        $this->accessToken = $accessToken;
    }


	public function requestToken()
	{
		$response = $this->client->request('POST', config('constants.PAYPAL_SANDBOX_URL') . '/oauth2/token', [
			'headers' => [
				'Accept' => 'application/json',
				'Content-Type' => 'application/x-www-form-urlencoded'
			],
			'auth' => [env('PAYPAL_SANDBOX_CLIENT_ID'), env('PAYPAL_SANDBOX_CLIENT_SECRET')],
			'form_params' => [
				'grant_type' => 'client_credentials'
			]
		]);
		return json_decode($response->getBody());
	}

	public function getProducts()
	{
		$response = $this->client->get('catalogs/products', [
			'headers' => [
				'Authorization' => "Bearer {$this->accessToken}"
			]
		]);
		return json_decode($response->getBody());
	}


	// Helper functions
	private function createClient(): Client
   	{
		return new Client([
			'base_uri' => config('constants.PAYPAL_SANDBOX_URL') . "/"
		]);
	}
}
?>
