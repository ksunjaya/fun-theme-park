<?php

class View {

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

    //bedanya yang ini ga pake cek credentials dulu
    public static function createLoginView ($view, $err)
    {
        //credentials
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

    public static function createAdminView ($view, $param)
    {
        foreach ($param as $key => $value)
        {
            $$key = $value;
        }

        //credentials
        require_once "controller/credentialController.php";
        $role = CredentialController::get_credential();
        if($role == "none" || $role == "staff") header("Location: forbidden");
        else $nama_user = CredentialController::get_nama();

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

        //credentials
        require_once "controller/credentialController.php";
        $role = CredentialController::get_credential();
        if($role == "none") header("Location: forbidden");
        else $nama_user = CredentialController::get_nama();

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