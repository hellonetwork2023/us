<?php
require 'vendor/autoload.php';

// MongoDB connection string
$connectionString = "mongodb+srv://infomednetwork:NxSY7PwMU6sJQ2C4ZqbD9n@cluster0.mongodb.net/amazonurls";

try {
    // Create a MongoDB client
    $client = new MongoDB\Client($connectionString);

    // Select the 'amz' collection
    $amzCollection = $client->selectCollection('amazonurls', 'amz');

    // Fetch all documents from the 'amz' collection
    $documents = $amzCollection->find();

    // Create an array to store the data
    $data = [];

    foreach ($documents as $document) {
        // Add each document's data to the array
        $data[] = [
            'name' => $document['name'],
            'url' => $document['url'],
            'image' => $document['image'],
        ];
    }

    // Output the data as JSON
    header('Content-Type: application/json');
    echo json_encode(['urls' => $data]);
} catch (MongoDB\Driver\Exception\Exception $e) {
    // Handle any MongoDB errors
    echo json_encode(['error' => $e->getMessage()]);
}
?>
