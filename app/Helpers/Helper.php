<?php

namespace App\Helpers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;

class Helper
{

    /**
     * back with error message
     *
     * @param array $errorMessages
     * @return RedirectResponse
     */
    public static function backError(array $errorMessages)
    {
        $validator = Validator::make([], []);
        foreach ($errorMessages as $key => $value) {
            $validator->getMessageBag()->add($key, $value);
        }
        return redirect()->back()->withInput()->withErrors($validator);
    }

    function customRequestCaptcha()
    {
        return new \ReCaptcha\RequestMethod\Post();
    }

    /**
     * redirectWithSuccess
     *
     * @param string $route
     * @param string $message
     * @return RedirectResponse
     */
    public static function redirectSuccess(string $route, string $message)
    {
        return redirect($route)->with('successMessage', $message);
    }
    /**
     * Extract YouTube ID from URL
     *
     * @param string $url
     * @return string|null
     */
    public static function getYoutubeId(string $url): ?string
    {
        preg_match(
            '/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/',
            $url,
            $matches
        );

        return $matches[1] ?? null;
    }
}
