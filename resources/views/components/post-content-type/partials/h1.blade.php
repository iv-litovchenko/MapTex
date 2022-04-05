<h1>
    @component('components.icon')
        @slot('asset', $post->logo_image)
        @slot('height', 40)
        @slot('valign', 'top')
    @endcomponent
    @yield('LayoutSectionPageHeader')
</h1>
