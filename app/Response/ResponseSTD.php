<?php

/**
 * 
 */

namespace App\Response;

use Illuminate\Http\Request;

class ResponseSTD
{

    function error($info, $code = "")
    {
        $response = array(
            'status' => false,
            'data' => "",
            'message' => $info,
            "code" => "$code"
        );
        return $response;
    }

    function success($data, $info = "OK", $code = 200)
    {
        $response = array(
            'status' => true,
            'data' => $data,
            'message' => $info,
            "code" => $code
        );
        return $response;
    }

    function validateRequiredHeader($required, Request $request)
    {
        $data = $request->headers->all();
        foreach ($required as $key => $value) {
            $value = strtolower($value);
            if (!isset($data["$value"])) {
                return response()->json($this->error("Header $value Not Found", 511));
            } else {
                if (empty($data["$value"][0])) {
                    return response()->json($this->error("Header $value Not Found", 511));
                }
            }
        }
    }

    public function validateRequiredContent($validate, Request $request)
    {
        $data = json_decode($request->getContent(), true);
        foreach ($validate as $key => $value) {
            if (!isset($data["$value"])) {
                return $this->error("$value Field Cannot Be Empty.");
            } elseif (empty($data["$value"])) {
                return $this->error("$value Field Cannot Be Empty.");
            }
        }
    }

    public function validateRequiredContentError($validate, Request $request)
    {
        $data = json_decode($request->getContent(), true);
        foreach ($validate as $key => $value) {
            if (!isset($data["$value"])) {
                throw new \Exception("$value Field Cannot Be Empty.");
            } elseif (empty($data["$value"])) {
                throw new \Exception("$value Field Cannot Be Empty.");
            }
        }
    }
    public function showError($message, $code = 600)
    {
        throw new \Exception("$message", $code);
    }

    public function validateDate($date, $label)
    {
        if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $date)) {
            throw new \Exception("Date Format $label Is Incorrect.");
        }
    }

    public function validateEmail($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return $this->error("Email Format Is Incorrect.");
        }
    }

    public function validateMinChar($word, $length, $tag = "")
    {
        $count = strlen($word);
        if ($count < $length) {
            return $this->error("$tag minimum $length character.");
        }
    }

    public function decodeContentArray(Request $request, $isObject = true)
    {
        $data = json_decode($request->getContent(), $isObject);
        return $data;
    }

    public function encodeContentArray($ArrayData)
    {
        $data = json_encode($ArrayData);
        return $data;
    }

    public function convertStdToArray($value)
    {
        return json_decode(json_encode($value), true);
    }

    public function convertArrayToStd($value)
    {
        return json_decode(json_encode($value), false);
    }
}
