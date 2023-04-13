<?php


class view
{
    function generate($content_view,  $data = null, $template_view = 'template_view.php')
    {
        /*
        if(is_array($data)) {
        // преобразуем элементы массива в переменные
        extract($data);
        }
        */
        include 'app/views/'.$template_view;
    }

}