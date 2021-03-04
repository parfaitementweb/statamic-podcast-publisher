<?php

namespace Parfaitement\Podcast\Tags;

use Statamic\Tags\Tags;

class XmlStylesheet extends Tags
{
    /**
     * The {{ xml_stylesheet }} tag.
     *
     * @return string|array
     */
    public function index()
    {
        return '<?xml-stylesheet href="' . $this->params->get('href') .'" type="text/xsl"?>';
    }
}
