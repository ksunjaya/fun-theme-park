<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="view/css/style_admin.css">
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
    <style type="text/css">
        /*Rules for sizing the icon*/
        
        .material-icons.md-18 {
            font-size: 18px;
        }
        
        .material-icons.md-24 {
            font-size: 24px;
        }
        
        .material-icons.md-36 {
            font-size: 36px;
        }
        
        .material-icons.md-48 {
            font-size: 48px;
        }
    </style>
</head>
<body>
    <?php
        $url = $_SERVER['REDIRECT_URL'];
        $baseURL = $_SERVER['REQUEST_URI']; 
	    $baseURL = dirname($baseURL);
        session_start();
        //kalau mo ke login, langsung dibolehin aja.
        if($url == $baseURL.'/login' || (isset($_SESSION["role"]) && $_SESSION["role"] == "admin")){
            echo $content;
        }else{
            header("Location: forbidden");
        }
    ?>
    
</body>
</html>