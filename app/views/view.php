<?php


class view
{
    function generate($content_view,  $data = null, $template_view = 'template_view.php')
    {

        include 'app/views/'.$template_view;
    }

}