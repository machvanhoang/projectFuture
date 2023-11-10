<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SuggestionController extends Controller
{
    const SUGGESTION_URL = "https://www.google.com/complete/search?output=toolbar&json=true&q=";
    public function index(Request $request)
    {
        $originalString = "google ads";
        $encodedString = urlencode($originalString);
        $url = self::SUGGESTION_URL . $encodedString;
        $response = Http::get($url);
        $xmlData = $response->body();

        // Clean the XML content and ensure proper encoding
        $cleanedXmlData = $this->cleanXmlString($xmlData);

        // Parse XML using SimpleXML
        $xml = simplexml_load_string($cleanedXmlData);

        // Convert SimpleXML object to an array
        $suggestions = json_decode(json_encode($xml), true);

        return response_success([
            "suggestions" => $suggestions,
        ], __('suggestion.success'));
    }
    /**
     * Summary of cleanXmlString
     * @param mixed $xmlString
     * @return array|string|null
     */
    private function cleanXmlString($xmlString)
    {
        // Remove invalid UTF-8 characters
        $cleanedXmlString = iconv('UTF-8', 'UTF-8//IGNORE', $xmlString);

        // Replace invalid characters with the Unicode replacement character
        $cleanedXmlString = preg_replace('/[^\x{0009}\x{000a}\x{000d}\x{0020}-\x{D7FF}\x{E000}-\x{FFFD}]/u', "\xEF\xBF\xBD", $cleanedXmlString);

        return $cleanedXmlString;
    }
}
