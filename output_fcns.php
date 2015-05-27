<!--filename: output.php-->
<!--author:   thanray-->

<?php

function display_register_form() {

?>  
    <form action="register.php" method="post">
    <table border="0">
    <tr>
        <td>username:</td>
        <td align="center"><input type="text" name="username" size="3"
            maxlength="16" style="width:200px;"/></td>
    </tr>
    <tr>
        <td>password:</td>
        <td align="center"><input type="password" name="passwd1" size="3"
            maxlength="16" style="width:200px;"/></td>
    </tr>
    <tr>
        <td>password again:</td>
        <td align="center"><input type="password" name="passwd2" size="3"
            maxlength="16" style="width:200px;"/></td>
    </tr>
    <tr>
        <td>email:</td>
        <td align="center"><input type="email" name="email" size="3"
            maxlength="50" style="width:200px;"/></td>
    </tr>
    <tr>
        <td colspan="2" align="center"><input type="submit" value="Submit"/></td>
    </tr>

<?php

}

function do_html_header($text) {
    echo "<h2>".$text."</h2>";
}

function do_html_footer() {
    ;
}

function do_html_url($url,$value) {
    echo "<a href=\"".$url."\">".$value."</a>";
}

?>



