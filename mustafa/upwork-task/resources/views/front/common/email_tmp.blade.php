<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" dir="rtl" xmlns:o="urn:schemas-microsoft-com:office:office">
    <head>
        <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width,initial-scale=1">
                <meta name="x-apple-disable-message-reformatting">
                    <title></title>
                    <!--[if mso]>
                    <noscript>
                      <xml>
                        <o:OfficeDocumentSettings>
                          <o:PixelsPerInch>96</o:PixelsPerInch>
                        </o:OfficeDocumentSettings>
                      </xml>
                    </noscript>
                    <![endif]-->
                    <style>
                        table, td, div, h1, p {font-family: Arial, sans-serif;}
                    </style>
                    </head>

                    <body style="margin:0;padding:0;">
                        <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;background:#ffffff;">
                            <tr>
                                <td align="center" style="padding:0;">
                                    <table role="presentation" style="width:602px;border-collapse:collapse;border:1px solid #cccccc;border-spacing:0;text-align:left;">
                                        <tr>
                                            <td align="center" style="padding:40px 0 30px 0;background:#70bbd9;">
                                                <img src="<?= url_image("logo.png") ?>" alt="" width="300" style="height:auto;display:block;" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="padding:36px 30px 42px 30px;">
                                                <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
                                                    <tr>
                                                        <td style="padding:0 0 36px 0;color:#153643;font-size: 20px;text-align: center">
                                                            <?= $content ?>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td style="padding:30px;background:#ee4c50;text-align: center; color: #FFF; font-size: 20px">
                                                جميع الحقوق محفوظة 
                                                <a href="<?= base_url() ?>">
                                                    <?= settings("title" , "ar") ?>
                                                </a>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </body>
                    </html>