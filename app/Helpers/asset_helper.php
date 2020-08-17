<?php

function assets_app($path = null)
{
    return $path == "" ? base_url().'assets/js/app/' : base_url().'/assets/js/app/'.preg_replace("/^\//", "", $path);
}

function assets_js($path = null)
{
    return $path == "" ? base_url().'assets/js/' : base_url().'/assets/js/'.preg_replace("/^\//", "", $path);
}

function assets_plugin($path = null)
{
    return $path == "" ? base_url().'assets/plugin/' : base_url().'/assets/plugin/'.preg_replace("/^\//", "", $path);
}




function asset_url($path = null)
{
    return $path == "" ? base_url() : base_url().preg_replace("/^\//", "", $path);
}

function assets_url_fo($path = null)
{
    return $path == "" ? base_url().'assets/fo/' : base_url().'assets/fo/'.preg_replace("/^\//", "", $path);
}

function assets_url_backmin($path = null)
{
    return $path == "" ? base_url().'assets/backmin/' : base_url().'assets/backmin/'.preg_replace("/^\//", "", $path);
}

function js_url($path = '')
{
    return assets_url("js" . (empty($path) ? '' : "/" . preg_replace("/^\//", "", $path)));
}

function css_url($path = '')
{
    return assets_url("css" . (empty($path) ? '' : "/" . preg_replace("/^\//", "", $path)));
}

function image_products($path = '')
{
    return $path == "" ? base_url().'img/product/' : base_url().'img/product/'.preg_replace("/^\//", "", $path);
}

function image_export($path = '')
{
    return $path == "" ? base_url().'assets/img/export_icons/' : base_url().'assets/img/export_icons/'.preg_replace("/^\//", "", $path);
}

?>