# Statamic Podcast Publisher

![Statamic 3.0+](https://img.shields.io/badge/Statamic-3.0+-FF269E?style=for-the-badge&link=https://statamic.com)
> The complete suite for managing and publishing your own podcast RSS feed 🤘

## Features
- **Automatic XML Podcast feed**, ready to be submitted.  
  ✨ Implementation follows _Apple Podcast guildines_.
- Complete Podcast information **customization**.
- Custom **episodes management** with media support.
- Automatic **page** for every published **episode**.
- Everything using built-in Statamic **Blueprints**, **Tags**, **Collection** & **Globals**.
- **Ready to be used** as is ...
- ... but **easily customizable** to fit your possible custom needs.

## Getting Started

We have made things easy for you start. Here is a quick summary of all things you need to know.

1. **Install the addon**  
   Simply run `composer require parfaitementweb/statamic-podcast-publisher`  
   You also can follow the [official Statamic help guide](https://statamic.dev/addons#installing-addons)


2. **Publish the assets**
Using the following command: `php artisan vendor:publish --tag=statamic-podcast-publisher`


3. Set the **APP_URL** value accordingly in your `.env` file.
   This value is used to generate absolute path in your XML feed.


4. **Edit your podcast information.**  
Choose your name, description, language and a beautiful image.  
   Podcast settings is a customizable Statamic Global set.
   

5. **Add an episode.**  
Choose the audio file, add show notes and select the publishing date.  
Episodes are stored in a customizable Statamic Collection within it's dedicated blueprint.
  

6. **Submit your feed.**  
Submit your feed URL to any podcast distributors (Apple, Gooogle, Spotify). You have complete control and are not limited here.  
We've automatically created a Feed page and linked to the correct layout.

## Before you buy

#### Can I list the latest episodes on my homepage?
We rely on default Stamatic Collection Tags to manage your episodes. Is easy has calling the folling antlers tag:
```
{{ collection:episodes }}
    <h1>{{ title }}</h1>
    <p>Episode {{ episode_number }}</p>
    <p><a href="{{ permalink }}">View episode</a></p>
{{ /collection:episodes }}
```

#### Can I get the list of every Tag to use?
We use a default Stamatic Blueprint to manage every field and value. Simply open the `Episode Blueprint` and select the field you cant. You can even customize its handle if you prefer.

#### Can I have an embeddable audio player ?
You can use any web audio player such as [Green Audio Player](https://github.com/greghub/green-audio-player).  
First, include their CDN in a script tag.
```
https://cdn.jsdelivr.net/gh/greghub/green-audio-player/dist/js/green-audio-player.min.js
```
Then, add this code in your `<head>` `<script>` section of your layout:
```
GreenAudioPlayer.init({
    selector: '.player',
    stopOthersOnPlay: true
});
```

And where you want to include the player:
```
<div class="player">
    <audio>
        <source src="{{ episode_file | get:permalink }}" type="{{ episode_file | mime_content_type }}">
    </audio>
</div>
```

## What does your addon look like?

![Statamic Podcast Settings](https://parfaitementweb.com/statamic/statamic-podcast-publisher/podcast-publisher-settings.png)
![Statamic Podcast Episode](https://parfaitementweb.com/statamic/statamic-podcast-publisher/podcast-publisher-episode.png)
![Statamic Podcast Episode Second](https://parfaitementweb.com/statamic/statamic-podcast-publisher/podcast-publisher-episode-second.png)
![Statamic Podcast Dashboard](https://parfaitementweb.com/statamic/statamic-podcast-publisher/podcast-publisher-dashboard.png)
![Statamic Podcast XML](https://parfaitementweb.com/statamic/statamic-podcast-publisher/podcast-publisher-xml-output.png)

## Can I see it running?

I manage my own podcast feed and website using Podcast Publisher.  
👉 Have a look at  [onpourrait.com](https://onpourrait.com/) to see what the end-result could be.

## Changelog

**V1.0.1**  
Updating the documentation to reference assets publishing and url generation.

**V1.0.0**  
🚀 Would you like to read the initial commit in another language?
