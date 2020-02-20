<?php
declare(strict_types=1);

namespace Testbed\Tests\Inc\API;

use Mockery;
use WP_Mock\Tools as WPMockTools;
use WP_Mock;

class EndpointTestCase extends WPMockTools\TestCase {
	public function setUp() : void
	{
		WP_Mock::setUp();
	}

	public function tearDown() : void
	{
		WP_Mock::tearDown();
	}

	protected $endpointArgs = [];

	/**
	 * Callback to use with WP_Mock::userFunction to persist arguments assigned
	 * to a given route on the class's $endpointArgs for later inspection.
	 *
	 * @param string $namespace Expected namespace.
	 * @param string $path      The expected route path.
	 * @param array  $args      Registered route arguments.
	 * @return void
	 */
	public function persistEndpointArgs(string $namespace, string $path, array $args) : void
	{
		$this->endpointArgs["$namespace$path"] = $args;
	}

	/**
	 * Get the stored arguments for a particular registered endpoint.
	 *
	 * @param string $namespace Expected namespace.
	 * @param string $path      The expected route path.
	 * @return array The endpoint args array for the specified route.
	 */
	public function getEndpointArgs(string $namespace, string $path) : array
	{
		return $this->endpointArgs["$namespace$path"];
	}

	/**
	 * Helper function to assert a namespace is registered, and store its
	 * arguments array on a class method for later inspection/assertion.
	 *
	 * @param string $namespace Expected namespace.
	 * @param string $path      The expected route path.
	 * @return void
	 */
	protected function expectRoute( string $namespace, string $path ) : void
	{
		WP_Mock::userFunction('register_rest_route')
			->times(1)
			->withSomeOfArgs($namespace, $path)
			->andReturnUsing([$this, 'persistEndpointArgs']);
	}

	/**
	 * Create a mock WP_REST_Request object with the specified parameters.
	 *
	 * @param array $params Array of query parameters and their values.
	 * @return Mockery\MockInterface
	 */
	public function createMockRequest(array $params) : Mockery\MockInterface
	{
		$request = Mockery::mock('\WP_REST_Request');
		foreach ($params as $param => $value) {
			$request->shouldReceive('get_param')->with($param)->andReturn($value);
		}
		return $request;
	}

	/**
	 * Create a mock WP_REST_Response object expecting the specified headers.
	 *
	 * @param array $headers Array of headers to expect to be set on this response.
	 * @return Mockery\MockInterface
	 */
	public function createMockResponse(array $headers = []) : Mockery\MockInterface
	{
		$request = Mockery::mock('\WP_REST_Response');
		foreach ($headers as $header => $value) {
			$request->shouldReceive('header')->with($header, $value);
		}
		return $request;
	}

	/**
	 * Expect rest_ensure_response to be called with a particular payload.
	 *
	 * @param mixed $response     The object to being sent as the REST response.
	 * @param mixed $mockResponse (optional) A mock WP_REST_Response object to return.
	 * @return void
	 */
	public function expectRestResponse($response, $mockResponse = null) : void
	{
		WP_Mock::userFunction('rest_ensure_response')
			->once()
			->with($response)
			->andReturn($mockResponse ?? $this->createMockResponse());
	}
}
