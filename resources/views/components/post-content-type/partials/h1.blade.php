<h1>
    @component('components.icon')
        @slot('data', $post)
        @slot('height', 40)
        @slot('valign', 'top')
    @endcomponent
    @yield('LayoutSectionPageHeader')
</h1>
