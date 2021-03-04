@extends('statamic::layout')

@section('content')
    <breadcrumbs :crumbs='@json($crumbs)'></breadcrumbs>

    <h1 class="mt-1 mb-2">{{ __('statamic-podcast-publisher::cp.dashboard') }}</h1>

    @if($first_episode)
        <a href="{{ cp_route('collections.entries.create', ['collection' => 'episodes', 'site' => \Statamic\Facades\Site::current()]) }}" class="btn">Create your first episode</a>
    @endif

    @if(! $first_episode)
        <a href="{{ cp_route('collections.show', ['collection' => 'episodes', 'site' => \Statamic\Facades\Site::current()]) }}" class="btn">View your episodes</a>
        <a href="{{ cp_route('collections.entries.create', ['collection' => 'episodes', 'site' => \Statamic\Facades\Site::current()]) }}" class="btn">Add an episode</a>
    @endif

    <a href="{{ cp_route('globals.update', ['global_set' => 'podcast', 'site' => \Statamic\Facades\Site::current()]) }}" class="btn btn-primary">Edit Settings</a>
@stop
