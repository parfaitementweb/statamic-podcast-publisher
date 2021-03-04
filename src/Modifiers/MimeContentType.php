<?php

namespace Parfaitement\Podcast\Modifiers;

use Statamic\Modifiers\Modifier;

class MimeContentType extends Modifier
{
    /**
     * Modify a value.
     *
     * @param mixed  $value    The value to be modified
     * @param array  $params   Any parameters used in the modifier
     * @param array  $context  Contextual values
     * @return mixed
     */
    public function index($value, $params, $context)
    {
        if (file_exists($value->resolvedPath())) {
             return mime_content_type($value->resolvedPath());
        }

       return null;
    }
}
