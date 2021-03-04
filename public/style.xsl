<?xml version="1.0" encoding="utf-8"?>
<xsl:stylesheet version="2.0" xmlns:itunes="http://www.itunes.com/dtds/podcast-1.0.dtd" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output method="html" version="1.0" encoding="UTF-8" indent="yes"/>
    <xsl:template match="/">
        <html xmlns="http://www.w3.org/1999/xhtml">
            <head>
                <title><xsl:value-of select="/rss/channel/title"/> RSS Feed</title>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                <link href="https://fonts.googleapis.com/css2?family=Poppins:300;400;700" rel="stylesheet"/>
                <style type="text/css">

                    html {
                    width: 100%;
                    margin: 0;
                    padding: 0;
                    overflow-x: hidden;
                    }

                    body {
                    font-size: 10pt;
                    font-family: 'Poppins', sans-serif;
                    color: #282828;
                    line-height: 22px;
                    background: #f9f9f9;
                    padding: 10px;
                    margin: 0px;
                    }

                    a, a:link, a:visited {
                    text-decoration: none;
                    color: #2669a7;
                    }

                    a:hover {
                    color: #003e82;
                    text-decoration: underline;
                    }

                    h1 {
                    line-height: 1.25em;
                    font-size: 1.45em;
                    }

                    h1, h2, h3, p {
                    margin-top: 0;
                    margin-bottom: 15px;
                    }

                    h2 {
                    line-height: 1.25em;
                    margin-bottom: 5px;
                    }

                    h3 {
                    font-style: italic;
                    }

                    /**
                    Main
                    **/

                    .container {
                    max-width: 850px;
                    margin: 25px auto;
                    background: #fff;
                    padding: 30px;
                    }

                    .rss-info {
                    font-size: 12px;
                    color: #545d67;
                    margin-bottom: 30px;
                    }

                    /**
                    Show information
                    **/

                    .show-header {
                    margin-bottom: 20px;
                    }

                    .show-title {
                    font-size: 2em;
                    margin-left: 170px;
                    }

                    .show-description {
                    margin-left: 170px;
                    }

                    .show-image {
                    width: 150px;
                    float: left;
                    margin: 6px 20px 20px 0px;
                    }

                    .show-image img {
                    width: 150px;
                    height: auto;
                    }


                    /**
                    Episode information
                    **/

                    .item {
                    clear: both;
                    border-top: 1px solid #e0e4e8;
                    padding: 20px 0;
                    }

                    .published-date {
                    margin-top: -10px;
                    }

                    audio {
                    width: 100%;
                    border-radius: 4px;
                    }

                    audio:focus {
                    outline: none;
                    }


                </style>
            </head>

            <body>

                <div class="container">

                    <p class="rss-info">This is the RSS feed for <xsl:value-of select="/rss/channel/title"/>. Paste this RSS feed's URL from your address bar in to your podcast app or search for the podcast in Apple Podcasts, Spotify, Google Podcasts or the podcast app that you prefer.</p>

                    <div class="show-header">
                        <div class="show-image">
                            <xsl:attribute name="href">
                                <xsl:value-of select="/rss/channel/image/link"/>
                            </xsl:attribute>
                            <img>
                                <xsl:attribute name="src">
                                    <xsl:value-of select="/rss/channel/image/url"/>
                                </xsl:attribute>
                                <xsl:attribute name="title">
                                    <xsl:value-of select="/rss/channel/image/title"/>
                                </xsl:attribute>
                            </img>
                        </div>
                        <h1 class="show-title">
                            <xsl:if test="/rss/channel/image">
                                <xsl:value-of select="/rss/channel/title"/>
                            </xsl:if>
                        </h1>
                        <p class="show-description"><xsl:value-of select="/rss/channel/description"/></p>
                    </div>



                    <xsl:for-each select="/rss/channel/item">

                        <article class="item">

                            <h1>
                                <a target="_blank">
                                    <xsl:attribute name="href">
                                        <xsl:value-of select="link"/>
                                    </xsl:attribute>
                                    <xsl:apply-templates select="title"/>
                                </a>
                            </h1>

                            <h4 class="published-date"><xsl:apply-templates select="pubDate"/></h4>

                            <p><xsl:value-of select="description"  disable-output-escaping="yes" /></p>

                            <xsl:for-each select="enclosure">
                                <audio preload="none">
                                    <xsl:attribute name="src">
                                        <xsl:value-of select="@url"/>
                                    </xsl:attribute>
                                    <xsl:attribute name="controls"></xsl:attribute>
                                </audio>
                            </xsl:for-each>

                        </article>

                    </xsl:for-each>
                </div>
            </body>
        </html>
    </xsl:template>
</xsl:stylesheet>
