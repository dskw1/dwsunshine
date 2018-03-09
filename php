require __DIR__.'/vendor/autoload.php';

use GraphAware\Neo4j\Client\ClientBuilder;

// change to your hostname, port, username, password
$neo4j_url = "bolt://neo4j:beats-entries-letterheads@54.197.101.26:34372";

// setup connection
$client = ClientBuilder::create()
    ->addConnection('default', $neo4j_url)
    ->build();

$cypher_query = <<<EOQ
MATCH (u:Troll)
RETURN u.screen_name AS screen_name
LIMIT 10
EOQ;

$params = [];
$result = $client->run($cypher_query, $params);

foreach ($result->records() as $record) {
  echo $record->get('screen_name') . PHP_EOL;
}

