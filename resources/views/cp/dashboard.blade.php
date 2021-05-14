@extends('statamic::layout')

@section('content')
    <breadcrumbs :crumbs='@json($crumbs)'></breadcrumbs>

    <h1 class="mt-1 mb-2">{{ __('statamic-podcast-publisher::cp.dashboard') }}</h1>

    <div class="bg-white p-2 rounded shadow-sm">
        <p>{!! __('statamic-podcast-publisher::cp.introduction') !!}</p>
    </div>

    <div class="flex flex-col lg:flex-row justify-between my-3 lg:space-x-2 mb-6">
        <div>
            <h2 class="mb-1">{{ __('statamic-podcast-publisher::cp.episodes') }}</h2>

            @if($first_episode)
                <a href="{{ cp_route('collections.entries.create', ['collection' => 'episodes', 'site' => \Statamic\Facades\Site::current()]) }}" class="btn">{{ __('statamic-podcast-publisher::cp.create_first_episode') }}</a>
            @endif

            @if(! $first_episode)
                <a href="{{ cp_route('collections.show', ['collection' => 'episodes', 'site' => \Statamic\Facades\Site::current()]) }}" class="btn">{{ __('statamic-podcast-publisher::cp.view_episodes') }}</a>
                <a href="{{ cp_route('collections.entries.create', ['collection' => 'episodes', 'site' => \Statamic\Facades\Site::current()]) }}" class="btn">{{ __('statamic-podcast-publisher::cp.add_episode') }}</a>
            @endif

            <h2 class="mt-3 mb-1">{{ __('statamic-podcast-publisher::cp.settings') }}</h2>
            <a href="{{ cp_route('globals.update', ['global_set' => 'podcast', 'site' => \Statamic\Facades\Site::current()]) }}" class="btn">{{ __('statamic-podcast-publisher::cp.edit_settings') }}</a>

            <h2 class="mt-3 mb-1">{{ __('statamic-podcast-publisher::cp.feed') }}</h2>
            <a target="_blank" href="{{ url('feed') }}" class="btn btn-primary">{{ __('statamic-podcast-publisher::cp.view_feed') }}</a>
        </div>

        <div class="flex flex-col space-y-1 mt-3 lg:mt-0">

            <h2 class="mb-1">{{ __('statamic-podcast-publisher::cp.distributors') }}</h2>

            <div class="flex justify-start items-center space-x-2">
                <a href="https://podcastsconnect.apple.com/my-podcasts" target="_blank" class="btn">{{ __('statamic-podcast-publisher::cp.visit') }} <strong>Apple Connect</strong></a>
                <a href="https://itunespartner.apple.com/podcasts/" target="_blank" class="text-xs text-blue-500">Apple {{ __('statamic-podcast-publisher::cp.guide') }}</a>
            </div>
            <div class="flex justify-start items-center space-x-2">
                <a href="https://podcastsmanager.google.com" target="_blank" class="btn">{{ __('statamic-podcast-publisher::cp.visit') }} <strong>Google Podcasts</strong></a>
                <a href="https://support.google.com/podcast-publishers/answer/9482981" target="_blank" class="text-xs text-blue-500">Google {{ __('statamic-podcast-publisher::cp.guide') }}</a>
            </div>
            <div class="flex justify-start items-center space-x-2">
                <a href="https://podcasters.spotify.com/" target="_blank" class="btn">{{ __('statamic-podcast-publisher::cp.visit') }} <strong>Spotify for Podcasters</strong></a>
                <a href="https://support.spotifyforpodcasters.com/hc/en-us/articles/360043487932-Getting-your-podcast-on-Spotify" target="_blank" class="text-xs text-blue-500">Spotify {{ __('statamic-podcast-publisher::cp.guide') }}</a>
            </div>
            <div class="flex justify-start items-center space-x-2">
                <a href="https://overcast.fm/podcasterinfo/" target="_blank" class="btn">{{ __('statamic-podcast-publisher::cp.visit') }} <strong>Overcast</strong></a>
                <a href="https://overcast.fm/podcasterinfo" target="_blank" class="text-xs text-blue-500">Overcast {{ __('statamic-podcast-publisher::cp.guide') }}</a>
            </div>
        </div>
    </div>

    @include('statamic-podcast-publisher::cp.partials.footer')

@stop
