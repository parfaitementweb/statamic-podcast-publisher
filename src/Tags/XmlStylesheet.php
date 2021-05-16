<?php

namespace Parfaitementweb\StatamicPodcastPublisher\Tags;

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
        return '<?xml-stylesheet href="' . url($this->params->get('href')) .'" type="text/xsl"?>';
    }
}
