<?php

class View {
    //yang ini khusus buat pengunjung aja, ntar bikin function baru buat admin
    public static function createAdminView ($view, $param)
    {
        foreach ($param as $key => $value)
        {
            $$key = $value;
        }
        ob_start();
        include 'view/'.$view;
        $content = ob_get_contents();
        ob_end_clean();

        ob_start();
        include 'view/layout/layout_admin.php';
        $include = ob_get_contents();
        ob_end_clean();
        return $include;
    }
}
?>