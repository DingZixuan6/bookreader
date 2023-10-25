<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the user-submitted search string
    $searchString = isset($_POST['str']) ? $_POST['str'] : '';

    // Perform keyword search here
    // For example, you can open a text file or query content from a database to find matching keywords

    // Example: Searching for keywords in a text file
    $content = file_get_contents('book.html'); // Replace with the actual file path
    list($searchResults, $keywordCount) = searchKeyword($content, $searchString);

    // Display search results and keyword count
    echo "Search Results for '$searchString':<br>";
    echo "Number of keywords found: $keywordCount<br>";
    echo $searchResults;
}

function searchKeyword($content, $keyword) {
    // Perform keyword search operation
    $matches = [];
    preg_match_all("/[^.!?]*\b$keyword\b[^.!?]*[.!?]/i", $content, $matches);

    if (empty($matches[0])) {
        return ["No results found for '$keyword'.", 0];
    }

    // Count the number of keywords
    $keywordCount = count($matches[0]);

    // Display matched sentences and highlight the keywords in green
    $results = '';
    foreach ($matches[0] as $match) {
        // Use <span> tags to highlight the keywords in green
        $highlightedMatch = preg_replace("/\b$keyword\b/i", '<span style="color: green;">$0</span>', $match);
        $results .= $highlightedMatch . "<br>";
    }

    return [$results, $keywordCount];
}
?>
