<?php
if(!function_exists('AdminAssets')){
    function AdminAssets($url=null){
        return url('assets_admin/assets/'.$url);
    }
}
if(!function_exists('AdminUrl')){
    function AdminUrl($url=null){
        return url('admin/'.$url);
    }
}





