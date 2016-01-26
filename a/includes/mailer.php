<?PHP

require($_SERVER['DOCUMENT_ROOT'].'/config.php');

function sendEmail($to, $from, $subject, $message){
    global $baseurl, $title;
    
    $headers = "From: ".$from." \r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

    $message = '
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>'.$subject.'</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>
    <body style="margin: 0; padding: 0;">
        <table border="0" cellpadding="0" cellspacing="0" width="100%">	
            <tr>
                <td style="padding: 10px 0 30px 0;">
                    <table align="center" border="0" cellpadding="0" cellspacing="0" width="500" style="border: 1px solid #cccccc; border-collapse: collapse;">
                        <tr>
                            <td align="center" bgcolor="#EB796D" style="padding: 40px 0 30px 0; color: #153643; font-size: 28px; font-weight: bold; font-family: Arial, sans-serif;">
                                <a style="color:#fff;text-decoration:none;" href="'.$baseurl.'">'.$title.'</a>
                            </td>
                        </tr>
                        <tr>
                            <td bgcolor="#ffffff">
                                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                    <tr>
                                        <td style="padding: 30px; color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;">'.$message.'</td>
                                    </tr>
                                    <tr>
                                        <td style="color: lightgrey; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px; padding: 20px 30px 40px 30px;text-align:left;"><small>'.date("F j, Y, g:i a [T]").'</small><img src="'.$baseurl.'a/assets/img/logo.png" width="150" style="float:right"/></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>
    </html>
    ';

    return mail($to, $subject, $message, $headers);
}
?>