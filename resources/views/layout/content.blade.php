<div class="main-content">
    @if(!empty($action))
        @if($action=='add')
            @include('page.' . $module . '.add')
        @elseif($action=='edit')
            @include('page.' . $module . '.edit')
        @elseif($action=='delete')
            @include('page.' . $module . '.delete')
        @elseif($action=='view')
            @include('page.' . $module . '.view')
        @elseif($action=='set_payment')
            @include('page.' . $module . '.set_payment')
        @endif
    @elseif(View::exists('page.' . $module . '.content'))
        @include('_partial.flash_message')
        @include('page.' . $module . '.content')
    @endif
    <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
        <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
    </a>
</div>
    
