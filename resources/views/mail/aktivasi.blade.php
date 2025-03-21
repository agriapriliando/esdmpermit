<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<!--begin::Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>ESDM Kalteng</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="title" content="DESDM Provinsi Kalimantan Tengah">
    <meta name="author" content="ditaria.com">
    <meta name="description" content="ESDM Kalteng">
    <meta name="keywords" content="esdm kalteng">
    <link rel="icon" type="image/x-icon" href="{{ asset('') }}assets/img/logo_kalteng_small.jpg">
</head> <!--end::Head--> <!--begin::Body-->

<body style="background-color: #f4f4f4; margin: 0 !important; padding: 0 !important;"> <!-- HIDDEN PREHEADER TEXT -->
    <table border="0" cellpadding="0" cellspacing="0" width="100%"> <!-- LOGO -->
        <tr>
            <td bgcolor="#0479ff" align="center">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                    <tr>
                        <td align="center" valign="top" style="padding: 40px 10px 40px 10px;"> </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td bgcolor="#0479ff" align="center" style="padding: 0px 10px 0px 10px;">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                    <tr>
                        <td bgcolor="#ffffff" align="center" valign="top"
                            style="padding: 40px 20px 20px 20px; border-radius: 4px 4px 0px 0px; color: #111111; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 48px; font-weight: 400; line-height: 48px;">
                            <img src="{{ asset('assets/img/newlogo_miners_putih.png') }}" height="120" style="display: block; border: 0px; margin : 30px 20px 20px 20px" />
                            <h1 style="font-size: 48px; font-weight: 400; margin: 2;">Hai, {{ $name }}</h1>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                    <tr>
                        <td bgcolor="#ffffff" align="left"
                            style="padding: 20px 30px 40px 30px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                            <p style="margin: 0;">Terima Kasih Telah Mendaftar di Miners Kalteng. Silahkan aktivasi akun anda.</p>
                        </td>
                    </tr>
                    <tr>
                        <td bgcolor="#ffffff" align="left">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td bgcolor="#ffffff" align="center" style="padding: 20px 30px 60px 30px;">
                                        <table border="0" cellspacing="0" cellpadding="0">
                                            <tr style="padding: 20px 30px 60px 30px; margin:20px;">
                                                <td>
                                                    <span style="font-weight: bold; font-size: 20px">Informasi Akun Anda</span><br>
                                                    Username : {{ $username }}<br>
                                                    Password : {{ $password }}<br>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="center" style="border-radius: 20px; margin-top: 10px" bgcolor="#0479ff">
                                                    <a href="{{ $url }}" target="_blank"
                                                        style="font-size: 20px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; color: #ffffff; text-decoration: none; padding: 15px 25px; border-radius: 20px; border: 1px solid #4d4d4d; display: inline-block;">
                                                        Aktivasi Akun</a>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td bgcolor="#ffffff" align="left"
                            style="padding: 0px 30px 20px 30px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                            <p style="margin: 0;">Email ini dikirim secara otomatis. Mohon <b>tidak membalas</b> email ini.</p>
                        </td>
                    </tr>
                    <tr>
                        <td bgcolor="#ffffff" align="left"
                            style="padding: 0px 30px 40px 30px; border-radius: 0px 0px 4px 4px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                            <p style="margin: 0;">Bidang Pertambangan,<br>DESDM Provinsi Kalteng</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td bgcolor="#f4f4f4" align="center" style="padding: 30px 10px 0px 10px;">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                    <tr>
                        <td bgcolor="#0084ff" align="center"
                            style="padding: 30px 30px 30px 30px; border-radius: 4px 4px 4px 4px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                            <h2 style="font-size: 20px; font-weight: 400; color: #e9e9e9; margin: 0;">Perlu Bantuan?</h2>
                            <p style="margin: 0;"><a href="https://drive.google.com/drive/folders/11zsrgFtlBtxcELpzHRMSTsaMCluQvdDt?usp=drive_link" target="_blank" style="color: #e9e9e9;">Klik
                                    Disini</a></p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
