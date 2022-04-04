<h1>
    @component('components.icon')
        @slot('src', asset('storage/site/post/logo/'.$post->logo_image))
        @slot('height', 40)
        @slot('valign', 'top')
    @endcomponent
    @yield('LayoutSectionPageHeader')
</h1>
