<?php

class View {
    //yang ini khusus buat pengunjung aja, ntar bikin function baru buat admin
    public static function createPengunjungView ($view, $param)
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
        include 'view/layout/layout_pengunjung.php';
        $include = ob_get_contents();
        ob_end_clean();
        return $include;
    }

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

    public static function createStaffView ($view, $param)
    {
        foreach ($param as $key => $value)
        {
            $$key = $value;
        }

        //==cek valid user==
        session_start();
        if(!isset($_SESSION["name"])){
            header("Location: forbidden");
        }

        ob_start();
        include 'view/'.$view;
        $content = ob_get_contents();
        ob_end_clean();

        ob_start();
        include 'view/layout/layout_staff.php';
        $include = ob_get_contents();
        ob_end_clean();
        return $include;
    }
}
?>