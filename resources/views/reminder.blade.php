<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat datang di Sharein</title>
    <style>
        /* Styling untuk email */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .logo {
            display: flex;
            flex-direction: row;
            align-items: center;
            gap: 5px;
        }

        .logo img {
            margin-bottom: 6px;
        }

        .logo h1 {
            font-size: 50px;
            font-weight: 700;

            /* color: #2652FF; */
        }

        h3 {
            color: #333;
            font-size: 24px;
        }

        p {
            color: #555;
            font-size: 16px;
            line-height: 1.5;
        }

        .box {
            border-style: solid;
            border-width: 2px;
            border-color: #C2C2C2;
            width: 500px;
            height: full;
            border-radius: 10px;
            padding-left: 50px;
            padding-top: 25px;
            padding-bottom: 25px;
            padding-right: 50px;
        }

        .box h3 {
            font-size: 30px;
        }

        .box h5 {
            font-size: 20px;
        }

        .box .button-box {
            display: flex;
            justify-content: center;
            width: full;
            margin-top: 20px;
        }

        .box .button-box a {
            background-color: #2652FF;
            padding: 10px 20px;
            border-radius: 10px;
            cursor: pointer;
            border: none;
            color: #FFF;
            text-decoration: none;
        }

        .copyright {
            display: flex;
            justify-content: center;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="logo">
            <div>
                <img src="/images/logo.png" alt="logo" width="50px" height="50px">
            </div>
            <h1>Sharein</h1>
        </div>
        <div class="box">
            <h3>Halo, {{ $nama }}</h3>
            <h5>Selamat datang di Sharein.</h5>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Cumque, culpa, eligendi necessitatibus aperiam
                voluptate fuga numquam aspernatur sit pariatur blanditiis, ex totam. Quasi ut asperiores delectus
                aperiam accusamus corrupti modi veniam nostrum, facilis esse ullam aliquam amet, unde excepturi, impedit
                velit beatae quae optio consectetur. Inventore dignissimos quis minus molestias.</p>
            <br>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis tenetur quia sunt repellendus. Odio,
                hic? Optio quibusdam beatae tenetur ea odit impedit dignissimos culpa assumenda nobis, asperiores
                quisquam reprehenderit illum ullam molestiae quam rem velit? Animi facere nulla ullam error aliquid
                cupiditate accusantium architecto fugit modi, suscipit non possimus incidunt. Non iusto quod, totam
                iste, ratione reiciendis eaque eius possimus odit sunt iure ut quasi consequatur dolorem cumque qui in
                enim sint maxime. Voluptate est eveniet, quisquam voluptatum animi maiores?</p>
            <div class="button-box">
                <a href="https://sharein.adslink.id/" target="_blank">View Our Website</a>
            </div>
        </div>
        <div class="copyright">
            <p>&copy; 2023 Sharein | Surabaya, Jawa Timur</p>
        </div>
</body>

</html>
