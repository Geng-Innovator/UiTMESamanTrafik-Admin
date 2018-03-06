<!DOCTYPE html>
    <head>
        <title>Pengesahan pendaftaran</title>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <style>
            body {
                padding: 10px;
            }

            li {
                list-style-type: none;
            }
        </style>
    </head>

    <body>
        <div class="fluid-container">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <h1>UiTM E-Saman Trafik</h1>
                </div>
                <div class="col-md-2"></div>
            </div>

            <br />

            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <h3>Pengesahan pendaftaran</h3>
                    <br />
                    <p>
                        Akaun anda telah didaftarkan dengan informasi seperti berikut:
                        <ul>
                            <li>Nama: {!! $nama !!}</li>
                            <li>No. Pekerja: {!! $no_pekerja !!}</li>
                            <li>Alamat Emel: {!! $emel !!}</li>
                            <li>Katalaluan: {!! $katalaluan !!}</li>
                        </ul>
                    </p>
                    <P>
                        Sila gunakan <b><u>nombor pekerja</u></b> dengan <b><u>katalaluan</u></b> yang diberikan untuk log masuk buat kali pertama.<br />
                        Anda perlu mengubah katalaluan selepas log masuk.
                    </P>
                </div>
                <div class="col-md-1"></div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>