<?php
require_once('src/crawling-api.php');
require_once('src/scraper-api.php');
require_once('src/leads-api.php');

$normalToken = '';
$javascriptToken = '';

function processResponse($response) {
  if ($response->statusCode === 200) {
    echo "Test passed\n";
  } else {
    echo "Test failed, expected statusCode 200 but got: " . $response->statusCode;
    exit(0);
  }
}

$normalAPI = new Crawlbase\CrawlingAPI(['token' => $normalToken]);

processResponse($normalAPI->get('http://httpbin.org/anything?hello=world'));

processResponse($normalAPI->get('http://httpbin.org/anything?useragent=test', ['user_agent' => 'Mozilla/5.0 (Windows NT 6.2; rv:20.0) Gecko/20121202 Firefox/20.0']));

processResponse($normalAPI->get('http://httpbin.org/anything', ['format' => 'json']));

processResponse($normalAPI->post('http://httpbin.org/post', ['hello' => 'post']));

processResponse($normalAPI->post('http://httpbin.org/post', json_encode(['hello' => 'json']), ['post_content_type' => 'application/json']));

processResponse($normalAPI->put('http://httpbin.org/put', ['hello' => 'put']));

$javascriptAPI = new Crawlbase\CrawlingAPI(['token' => $javascriptToken]);

processResponse($javascriptAPI->get('http://httpbin.org/anything?hello=world'));

$scraperAPI = new Crawlbase\ScraperAPI(['token' => $normalToken]);

processResponse($scraperAPI->get('https://www.amazon.com/DualSense-Wireless-Controller-PlayStation-5/dp/B08FC6C75Y/'));

$leadsAPI = new Crawlbase\LeadsAPI(['token' => $normalToken]);

processResponse($leadsAPI->getFromDomain('amazon.com'));
