@include("admin.components.header",['title' => 'Users'])

    @if($action == 'add')
        @include('admin.headoffice.users.add')
    @elseif($action == 'edit' && isset($href))
        @include('admin.headoffice.users.edit', ['href' => $href])
    @else
        @include('admin.headoffice.users.list')
    @endif

@include("admin.components.footer")