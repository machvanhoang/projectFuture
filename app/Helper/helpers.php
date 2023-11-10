<?php

if (!function_exists("response_error")) {
    /**
     * Summary of response_error
     * @param array|object|string $error
     * @param int $code
     * @return Illuminate\Http\JsonResponse|mixed
     */
    function response_error(array | object | string $error, int $code = 404)
    {
        $response = [
            'success' => false,
        ];

        if (!empty($error)) {
            $response['errors'] = $error;
        }

        return response()->json($response, $code);
    }
}

if (!function_exists("response_non_data")) {
    /**
     * Handle non-data response.
     *
     * @return Illuminate\Http\JsonResponse|mixed
     */
    function response_non_data()
    {
        return response()->json(204);
    }
}

if (!function_exists("response_success")) {
    /**
     * Summary of response_success
     * @param array|object|string $data
     * @param string $message
     * @param int $code
     * @return Illuminate\Http\JsonResponse|mixed
     */
    function response_success(array | object | string $data, string $message, int $code = 200)
    {
        $response = [
            'success' => true,
            'data' => $data,
            'message' => $message,
        ];

        return response()->json($response, $code);
    }
}

if (!function_exists('content_quality')) {
    function content_quality(string $content, array $keywords)
    {
        $content = strtolower($content);
        foreach ($keywords as $keyword) {
            if (strpos($content, strtolower($keyword)) === false) {
                return false;
            }
        }
        return true;
    }
}

if (!function_exists('calculate_readability')) {
    function calculate_readability($content)
    {
        $wordCount = str_word_count($content);
        $sentenceCount = preg_match_all('/[.!?]/u', $content);
        $syllableCount = count_syllables($content);

        $readability = 206.835 - 1.015 * ($wordCount / $sentenceCount) - 84.6 * ($syllableCount / $wordCount);

        return $readability;
    }
}
if (!function_exists('count_syllables')) {
    function count_syllables($word)
    {
        $word = preg_replace('/[^aeiouy]+/i', '', $word);
        return max(1, count(preg_split('/[aeiouy]+/i', $word)));
    }

}function calculateGunningFogIndex($content) {
    $wordCount = str_word_count($content);
    $sentenceCount = preg_match_all('/[.!?]/u', $content);
    $complexWordCount = countComplexWords($content);

    $gunningFogIndex = 0.4 * (($wordCount / $sentenceCount) + 100 * ($complexWordCount / $wordCount));

    return $gunningFogIndex;
}

function countComplexWords($content) {
    preg_match_all('/\b\w{3,}\b/', $content, $matches);
    return count($matches[0]);
}

// Sử dụng hàm tính toán Gunning Fog Index cho một đoạn văn bản
$paragraph = "Lorem Ipsum chỉ đơn giản là một đoạn văn bản giả, được dùng vào việc trình bày và dàn trang phục vụ cho in ấn. Lorem Ipsum đã được sử dụng như một văn bản chuẩn cho ngành công nghiệp in ấn từ những năm 1500, khi một họa sĩ vô danh ghép nhiều đoạn văn bản với nhau để tạo thành một bản mẫu văn bản. Đoạn văn bản này không những đã tồn tại năm thế kỉ, mà khi được áp dụng vào tin học văn phòng, nội dung của nó vẫn không hề bị thay đổi. Nó đã được phổ biến trong những năm 1960 nhờ việc bán những bản giấy Letraset in những đoạn Lorem Ipsum, và gần đây hơn, được sử dụng trong các ứng dụng dàn trang, như Aldus PageMaker.";
$gunningFogIndex = calculateGunningFogIndex($paragraph);

echo "Chỉ số Gunning Fog: " . round($gunningFogIndex, 2);
die;
