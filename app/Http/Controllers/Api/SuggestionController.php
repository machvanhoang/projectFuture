<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SuggestionController extends Controller
{
    /**
     * @var string
     */
    const SUGGESTION_URL = "https://www.google.com/complete/search?output=toolbar&json=true&q=";
    public function index(Request $request)
    {
        $originalString = "google ads";
        $encodedString = str_replace(" ", "%20", $originalString);
        $url = self::SUGGESTION_URL . $encodedString;
        $suggestions = $this->getSuggestions($url);
        return response_success([
            "suggestions" => $suggestions,
        ], __('suggestion.success'));
    }

    /**
     * Summary of getSuggestions
     * @param string $url
     * @return array
     */
    private function getSuggestions(string $url)
    {
        $html = file_get_contents($url);
        $html = mb_convert_encoding($html, 'UTF-8', mb_detect_encoding($html, 'UTF-8, ISO-8859-1', true));
        $xml = new \SimpleXMLElement($html);
        $suggestions = [];

        foreach ($xml->CompleteSuggestion as $suggestion) {
            $data = (string) $suggestion->suggestion['data'];
            $suggestions[] = $data;
        }
        return $suggestions;
    }
}
