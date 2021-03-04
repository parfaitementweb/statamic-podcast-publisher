<?php

namespace Parfaitement\Podcast\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Statamic\CP\Breadcrumbs;
use Statamic\Facades\Collection;

class PodcastController extends Controller
{
    public function index()
    {
        $crumbs = Breadcrumbs::make([
            ['text' => 'Dashboard', 'url' => cp_route('statamic-podcast-publisher.index')],
        ]);

        return view('statamic-podcast-publisher::cp.dashboard', [
            'title' => 'Podcast Settings | Podcast Publisher',
            'crumbs' => $crumbs,
            'first_episode' => Collection::findByHandle('episodes')->queryEntries()->count() == 0,
        ]);
    }

    public function install(Request $request)
    {
        // Config
        $this->publishes([
            __DIR__ . '/../config/config.php' => config_path('butik.php'),
        ], 'butik-config');

        // Blueprints
        $this->publishes([
            __DIR__ . '/../resources/blueprints' => resource_path('blueprints'),
        ], 'butik-blueprints');

        // Collections
        $this->publishes([
            __DIR__ . '/../resources/collections' => base_path('content/collections'),
        ], 'butik-collections');
    }
}
