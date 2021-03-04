<?php

namespace Parfaitement\Podcast;

use Parfaitement\Podcast\Modifiers\EntitiesDecode;
use Parfaitement\Podcast\Modifiers\MimeContentType;
use Parfaitement\Podcast\Modifiers\Stripslashes;
use Parfaitement\Podcast\Modifiers\StripTagsWithSpaces;
use Parfaitement\Podcast\Tags\ItunesCategory;
use Parfaitement\Podcast\Tags\XmlStylesheet;
use Statamic\Facades\Collection;
use Statamic\Facades\CP\Nav;
use Statamic\Facades\Entry;
use Statamic\Facades\Site;
use Statamic\Providers\AddonServiceProvider;
use Statamic\Statamic;

class ServiceProvider extends AddonServiceProvider
{
    protected $routes = [
        'cp' => __DIR__ . '/../routes/cp.php',
    ];

    protected $tags = [
        XmlStylesheet::class,
        ItunesCategory::class,
    ];

    protected $modifiers = [
        EntitiesDecode::class,
        MimeContentType::class,
        Stripslashes::class,
        StripTagsWithSpaces::class,
    ];

    public function boot()
    {
        parent::boot();

        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'statamic-podcast-publisher');

        if ($this->app->runningInConsole()) {
            // Blueprints
            $this->publishes([
                __DIR__ . '/../resources/blueprints' => resource_path('blueprints'),
            ], 'statamic-podcast-publisher');

            // Collections
            $this->publishes([
                __DIR__ . '/../resources/collections' => base_path('content/collections'),
            ], 'statamic-podcast-publisher');

            // Assets
            $this->publishes([
                __DIR__ . '/../resources/content/assets' => base_path('content/assets'),
            ], 'statamic-podcast-publisher');

            // Globals
            $this->publishes([
                __DIR__ . '/../resources/content/globals' => base_path('content/globals'),
            ], 'statamic-podcast-publisher');

            // Views
            $this->publishes([
                __DIR__ . '/../resources/views/web' => resource_path('views/podcast'),
            ], 'statamic-podcast-publisher');

            // Styles
            $this->publishes([
                __DIR__ . '/../public' => public_path('vendor/statamic-podcast-publisher/'),
            ], 'statamic-podcast-publisher');

        };

        $this->createNavigation();

        Statamic::afterInstalled(function ($command) {

            $feed_page = Entry::findBySlug('feed', 'pages');

            if (! $feed_page) {
                Entry::make()
                    ->collection('pages')
                    ->slug('feed')
                    ->published(true)
                    ->data([
                        'title' => 'Podcast Feed',
                        'content_type' => 'xml',
                        'layout' => 'podcast/xml',
                        'template' => 'podcast\feed',
                    ])
                    ->save();
            }

        });
    }

    public function createNavigation()
    {
        Nav::extend(function ($nav) {

            // Dashboard
            $nav->content(ucfirst(__('statamic-podcast-publisher::cp.dashboard')))
                ->section('Podcast')
                ->route('statamic-podcast-publisher.index')
                ->icon('<svg aria-hidden="true" focusable="false" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="currentColor" d="M541 229.16l-61-49.83v-77.4a6 6 0 0 0-6-6h-20a6 6 0 0 0-6 6v51.33L308.19 39.14a32.16 32.16 0 0 0-40.38 0L35 229.16a8 8 0 0 0-1.16 11.24l10.1 12.41a8 8 0 0 0 11.2 1.19L96 220.62v243a16 16 0 0 0 16 16h128a16 16 0 0 0 16-16v-128l64 .3V464a16 16 0 0 0 16 16l128-.33a16 16 0 0 0 16-16V220.62L520.86 254a8 8 0 0 0 11.25-1.16l10.1-12.41a8 8 0 0 0-1.21-11.27zm-93.11 218.59h.1l-96 .3V319.88a16.05 16.05 0 0 0-15.95-16l-96-.27a16 16 0 0 0-16.05 16v128.14H128V194.51L288 63.94l160 130.57z"></path></svg>');

            // Episodes
            $empty = Collection::findByHandle('episodes')->queryEntries()->count() == 0;
            $url = ($empty) ? cp_route('collections.entries.create', ['collection' => 'episodes', 'site' => Site::current()]) : cp_route('collections.show', ['collection' => 'episodes', 'site' => Site::current()]);
            $nav->content(ucfirst(__('statamic-podcast-publisher::cp.episodes')))
                ->section('Podcast')
                ->url($url)
                ->icon('<svg aria-hidden="true" focusable="false" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M61.77 401l17.5-20.15a19.92 19.92 0 0 0 5.07-14.19v-3.31C84.34 356 80.5 352 73 352H16a8 8 0 0 0-8 8v16a8 8 0 0 0 8 8h22.84a154.82 154.82 0 0 0-11 12.31l-5.61 7c-4 5.07-5.25 10.13-2.8 14.88l1.05 1.93c3 5.76 6.3 7.88 12.25 7.88h4.73c10.33 0 15.94 2.44 15.94 9.09 0 4.72-4.2 8.22-14.36 8.22a41.54 41.54 0 0 1-15.47-3.12c-6.49-3.88-11.74-3.5-15.6 3.12l-5.59 9.31c-3.73 6.13-3.2 11.72 2.62 15.94 7.71 4.69 20.39 9.44 37 9.44 34.16 0 48.5-22.75 48.5-44.12-.03-14.38-9.12-29.76-28.73-34.88zM12.1 320H80a8 8 0 0 0 8-8v-16a8 8 0 0 0-8-8H41.33c3.28-10.29 48.33-18.68 48.33-56.44 0-29.06-25-39.56-44.47-39.56-21.36 0-33.8 10-40.45 18.75-4.38 5.59-3 10.84 2.79 15.37l8.58 6.88c5.61 4.56 11 2.47 16.13-2.44a13.4 13.4 0 0 1 9.45-3.84c3.33 0 9.28 1.56 9.28 8.75C51 248.19 0 257.31 0 304.59v4C0 316 5.08 320 12.1 320zM16 160h64a8 8 0 0 0 8-8v-16a8 8 0 0 0-8-8H64V40a8 8 0 0 0-8-8H32a8 8 0 0 0-7.14 4.42l-8 16A8 8 0 0 0 24 64h8v64H16a8 8 0 0 0-8 8v16a8 8 0 0 0 8 8zm488-80H168a8 8 0 0 0-8 8v16a8 8 0 0 0 8 8h336a8 8 0 0 0 8-8V88a8 8 0 0 0-8-8zm0 320H168a8 8 0 0 0-8 8v16a8 8 0 0 0 8 8h336a8 8 0 0 0 8-8v-16a8 8 0 0 0-8-8zm0-160H168a8 8 0 0 0-8 8v16a8 8 0 0 0 8 8h336a8 8 0 0 0 8-8v-16a8 8 0 0 0-8-8z"></path></svg>');

            // Settings
            $nav->content(ucfirst(__('statamic-podcast-publisher::cp.settings')))
                ->section('Podcast')
                ->route('globals.update', 'podcast')
                ->icon('<svg aria-hidden="true" focusable="false" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M326.011 313.366a81.658 81.658 0 0 0-11.127-16.147c-1.855-2.1-1.913-5.215-.264-7.481C328.06 271.264 336 248.543 336 224c0-63.221-52.653-114.375-116.41-111.915-57.732 2.228-104.69 48.724-107.458 106.433-1.278 26.636 6.812 51.377 21.248 71.22 1.648 2.266 1.592 5.381-.263 7.481a81.609 81.609 0 0 0-11.126 16.145c-2.003 3.816-7.25 4.422-9.961 1.072C92.009 289.7 80 258.228 80 224c0-79.795 65.238-144.638 145.178-143.995 77.583.624 141.19 63.4 142.79 140.969.73 35.358-11.362 67.926-31.928 93.377-2.738 3.388-8.004 2.873-10.029-.985zM224 0C100.206 0 0 100.185 0 224c0 82.003 43.765 152.553 107.599 191.485 4.324 2.637 9.775-.93 9.078-5.945-1.244-8.944-2.312-17.741-3.111-26.038a6.025 6.025 0 0 0-2.461-4.291c-48.212-35.164-79.495-92.212-79.101-156.409.636-103.637 84.348-188.625 187.964-190.76C327.674 29.822 416 116.79 416 224c0 63.708-31.192 120.265-79.104 155.21a6.027 6.027 0 0 0-2.462 4.292c-.799 8.297-1.866 17.092-3.11 26.035-.698 5.015 4.753 8.584 9.075 5.947C403.607 376.922 448 306.75 448 224 448 100.204 347.814 0 224 0zm64 355.75c0 32.949-12.871 104.179-20.571 132.813C262.286 507.573 242.858 512 224 512c-18.857 0-38.286-4.427-43.428-23.438C172.927 460.134 160 388.898 160 355.75c0-35.156 31.142-43.75 64-43.75 32.858 0 64 8.594 64 43.75zm-32 0c0-16.317-64-16.3-64 0 0 27.677 11.48 93.805 19.01 122.747 6.038 2.017 19.948 2.016 25.981 0C244.513 449.601 256 383.437 256 355.75zM288 224c0 35.346-28.654 64-64 64s-64-28.654-64-64 28.654-64 64-64 64 28.654 64 64zm-32 0c0-17.645-14.355-32-32-32s-32 14.355-32 32 14.355 32 32 32 32-14.355 32-32z"></path></svg>');

        });
    }
}
