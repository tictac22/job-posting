<title>@yield('title')</title>

<meta name="description" content="Find your dream job here" />

<meta property="og:type" content="website" />
<meta property="og:title" content="{{$title}}" />
<meta property="og:description" content="{{$description}}" />

@if($image)
<meta property="og:image" content="{{$image}}" />
<meta property="og:url" content="{{url()->current()}}" />
@endif

<meta name="twitter:card" content="summary_large_image" />
<meta property="twitter:url" content="{{url()->current()}}" />
<meta name="twitter:title" content="{{$title}}" />
<meta name="twitter:description" content="{{$description}}" />

@if($image)
<meta name="twitter:image" content="{{$image}}" />
<meta name="twitter:image:alt" content="{{$imageAlt}}" />
@endif