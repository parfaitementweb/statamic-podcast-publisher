<?php

namespace Parfaitement\Podcast\Tags;

use Statamic\Tags\Tags;

class ItunesCategory extends Tags
{
    /**
     * The {{ itunes_category }} tag.
     *
     * @return string|array
     */
    public function index()
    {
        $value = $this->params->get('value');
        $parts = explode(' > ', $value);

        if (count($parts) > 1) {
            return '<itunes:category text="' . htmlentities($parts[0]) . '">
                <itunes:category text="' . htmlentities($parts[1]) . '"/>
            </itunes:category>';
        }

        return '<itunes:category text="' . htmlentities($parts[0]) . '"/>';
    }
}
