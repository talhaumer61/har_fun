@include("admin.components.header",['title' => 'Categories - HARFUN'])

    @if($action == 'add')
        @include('admin.headoffice.categories.add')
    @elseif($action == 'edit' && isset($href))
        @include('admin.headoffice.categories.edit', ['href' => $href])
    @else
        @include('admin.headoffice.categories.list')
    @endif

@include("admin.components.footer")