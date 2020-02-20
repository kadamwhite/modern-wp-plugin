## Testing Suite

All PHP tests for this plugin should be placed in this directory. Tests should be written and passing for all new code submitted into the plugin.

## WP_Mock

This test suite uses `WP_Mock` to mock WordPress functions and functionality for more pure unit tests. You can find out more about `WP_Mock` at https://github.com/10up/wp_mock.

At the lowest level, this means that each test class must extend `WP_Mock\Tools\TestCase` instead of `PHPUnit\Framework\TestCase`. A basic class will look like:

```php
class TestMyFunctionality extends WPMockTools\TestCase {
    public function setUp() : void {
        WP_Mock::setUp();
    }

    public function tearDown() : void {
        WP_Mock::tearDown();
    }

    ...test cases
}
```

From there, functionality can be mocked as such:

```php
global $post;

$post = new \stdClass;
$post->ID = 42;
$post->special_meta = '<p>I am on the end</p>';

\WP_Mock::userFunction( 'get_post', array(
    'times' => 1,
    'args' => array( $post->ID ),
    'return' => $post,
) );
```
