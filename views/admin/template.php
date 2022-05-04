<?php

    if(!isset($_SESSION['xadmin_id'])){
        header('Location:/immoavril/');
    }
    define('IMG_PATH','\immoavril\assets\images\icon\\');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'link.php';?>
    <title><?= $title;?></title>

    <style>
        *{ margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
        }
        :root{
            --white: #fff;
            --grey: #f5f5f5;
            --blue: #287bff;
            --black1: #222;
            --black2: #999;
        }
        body{
            min-height: 100vh;
            overflow-x: hidden;
        }
        .container{
            position: relative;
            width: 100%;
        }
        .navigation{
            position: fixed;
            width: 300px;
            height: 100%;
            background: var(--blue);
            border-left: 10px solid var(--blue);
            overflow: hidden;
        }
        .navigation.active{
            width: 70px;
            transition:0.5s;
        }
        .navigation ul{
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
        }
        .navigation ul li{
            position: relative;
            width: 100%;
            list-style: none;
            border-radius: 30px 0 0 30px;
            margin: 2px 0px;
        }
        .navigation ul li:hover,
        .navigation ul li.hovered{
            background: var(--white);
        }
        .navigation ul li:nth-child(1){
            margin-bottom: 40px;
            pointer-events: none;
        }
        .navigation ul li a{
            position: relative;
            width: 100%;
            display: flex;
            text-decoration: none;
            color: var(--white);
        }
        .navigation ul li:hover a,
        .navigation ul li.hovered a{
            color: var(--blue);
            transition:0.2s;
        }
        .navigation ul li a .icon{
            position: relative;
            display: block;
            width: 50px;
            height:50px;
            padding:10px;
        }
        .navigation ul li:hover .icon,.navigation ul li.hovered .icon{
            filter: invert(1);
            transition:0.2s;
        }
        .navigation ul li a .title{
            position: relative;
            display: block;
            padding: 0 10px;
            height: 60px;
            line-height: 60px;
            text-align:start;
            white-space: nowrap;
        }

        /* curve outside */

        .navigation ul li:hover a::before,
        .navigation ul li.hovered a::before{
            content: "";
            position: absolute;
            right: 0;
            top: -50px;
            width: 50px;
            height: 50px;
            background-color: transparent;
            border-radius:50%;
            box-shadow:35px 35px 0 10px var(--white);
        }
        .navigation ul li:hover a::after,
        .navigation ul li.hovered a::after{
            content: "";
            position: absolute;
            right: 0;
            bottom: -50px;
            width: 50px;
            height: 50px;
            background-color: transparent;
            border-radius:50%;
            box-shadow:35px -35px 0 10px var(--white);
        }

        /* main */
        .main{
            position:absolute;
            width: calc(100% - 300px);
            left: 300px;
            min-height:100vh;
            background: var(--white);
            transition:0.5s;
        }

        .main.active{
            width: calc(100% - 70px);
            left: 70px;
            transition:0.5s;
        }

        .topbar{
            width: 100%;
            height: 60px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 10px;
        }

        .toggle{
            position:relative;
            top: 0;
            width: 60px;
            height: 60px;
            display: flex;
            justify-content: center;
            align-items:center;
            cursor: pointer;
        }

        .menu_icon{
            width: 40px;
            height: 40px;
        }

        .search{
            position: relative;
            width: 400px;
            margin: 0 10px;
        }

        .search label{
            position: relative;
            width: 100%;
        }

        .search label input{
            width: 100%;
            height:40px;
            border-radius: 40px;
            padding: 5px 20px;
            outline: none;
            border: 1px solid var(--black2);
            padding-left: 35px;
        }

        .search_icon{
            width: 20px;
            position:absolute;
            top: 0;
            left: 10px;
        }

        .user{
            position:relative;
            width: 40px;
            height:40px;
            border-radius: 50%;
            overflow: hidden;
        }

        .user img{
            position:absolute;
            top:0;
            left:0;
            width: 100%;
            height: 100%;
            object-fit:cover;
        }

        .cardBox{
            position: relative;
            width: 100%;
            padding: 20px;
            display: grid;
            grid-template-columns: repeat(4,1fr);
            grid-gap: 30px;
        }

        .cardBox .card{
            position: relative;
            background:var(--white);
            padding: 30px;
            border-radius:20px;
            display: flex;
            justify-content: space-between;
            cursor: pointer;
            box-shadow: 0 7px 25px rgba(0,0,0,0.08);
        }

        .cardBox .card .numbers{
            position: relative;
            font-weight: 300;
            font-size:2.1em;
            color: var(--blue);
        }

        .cardBox .card .cardName{
            color: var(--black2);
            font-size:1.1em;
            margin-top:5px;
        }

        .cardBox .card:hover{
            background-color:var(--blue);
        }
        
        .cardBox .card:hover .numbers,
        .cardBox .card:hover .cardName,
        .cardBox .card:hover .iconBox img{
            filter: invert(0);
            color: var(--white);
        }

        .iconBox img{
            padding: 10px;
            width:40px;
            filter: invert(1);
        }

        .details{
            position: relative;
            width: 100%;
            padding: 20px;
            display: grid;
            grid-template-columns: 2fr 1fr;
            grid-gap: 30px;
            margin-top:15px;
        }

        .details .recentProperty{
            position: relative;
            display: grid;
            min-height:400px;
            background:var(--white);
            padding:20px;
            box-shadow:0 7px 25px rgba(0,0,0,0.08);
            border-radius:20px;
        }

        .cardHeader{
            display: flex;
            justify-content:space-between;
            align-items:flex-start;
        }

        .cardHeader h2{
            font-weight: 600;
            color: var(--blue);
        }

        .btn{
            position: relative;
            padding:5px 10px;
            background-color: var(--blue);
            color: var(--white);
            text-decoration: none;
            border-radius: 6px;
        }

        .details table{
            width: 100%;
            border-collapse: collapse;
            margin-top:10px;
        }

        .details table thead td{
            font-weight: 600;
        }

        .details .recentProperty table tr{
            color: var(--black1);
            border-bottom: 1px solid rgba(0,0,0,0.1);
        }

        .details .recentProperty table tbody tr:hover{
            background: var(--blue);
            color: var(--white);
        }

        .details .recentProperty table tr td{
            padding:10px;
        }

        .details .recentProperty table tr td:last-child{
            text-align:end;
        }

        .details .recentProperty table tr td:nth-child(2){
            text-align:end;
        }

        .details .recentProperty table tr td:nth-child(3){
            text-align:center;
        }

        .recentCustomers{
            position:relative;
            display: flex;
            flex-direction: column;
            min-height: 150px;
            padding: 20px;
            background: var(--white);
            box-shadow:0 7px 25px rgba(0,0,0,0.08);
            border-radius:20px;
        }

        .imgBox{
        width: 60px;
        overflow: hidden;
        height: 60px;
        border-radius: 50%;
        margin: 0 auto;
        }

        .userImg{
            width: 100%;
            height: 100%;
            object-fit:cover;
        }

        .recentCustomers table tr:hover{
            background-color: var(--blue);
            color: var(--white);
            cursor: pointer;
        }

        .recentCustomers table tr td{
            padding: 12px 10px;
        }

        .recentCustomers table tr td h4{
            font-size:16px;
            font-weight: 500;
            line-height: 1.2em;
        }

        .recentCustomers table tr td h4 span{
            font-size:14px;
            color:var(--black2);
        }

        .recentCustomers table tr:hover td h4 span{
            color: var(--white);
        }

        /* responsive design */
        @media (max-width: 991px){
            .navigation{
                left: -300px;
            }

            .navigation.active{
                width: 300px;
                left: 0;
            }

            .main{
                width: 100%;
                left: 0;
            }

            .main.active{
                left: 300px;
            }

            .cardBox{
                grid-template-columns: repeat(2,1fr);
            }
        }

        @media (max-width: 768px){
            .details{
                grid-template-columns: repeat(1,1fr)
            }

            .recentProperty{
                overflow-x: auto;
            }
        }

        @media (max-width: 480px){
            .cardBox{
                grid-template-columns: repeat(1,1fr)
            }

            .cardHeader h2{
                font-size: 20px;
            }

            .user{
                min-width: 40px;
            }

            .navigation.active{
                width: 100%;
                left: 0;
                z-index: 1000;
            }

            .toggle{
                z-index: 1001;
            }

            .main.active .toggle{
                position: fixed;
                right: 0;
                left: initial;
                filter: invert(1);
                transition:0.5s;
            }

        }

    </style>

</head>

<body>
    <div class="container">

        <div class="navigation">

            <ul>

                <li>
                    <a href="#">
                        <img src="<?= IMG_PATH.'apple_logo.png'; ?>" alt="apple" class="icon">
                        <span class="title">X-mobilier</span>
                    </a>
                </li>

                <li>
                    <a href="/immoavril/admin">
                        <img src="<?= IMG_PATH.'home.png'; ?>" alt="home" class="icon">
                        <span class="title">Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="/immoavril/admin/propriete">
                        <img src="<?= IMG_PATH.'city.png'; ?>" alt="city" class="icon">
                        <span class="title">Propriétés</span>
                    </a>
                </li>

                <li>
                    <a href="/immoavril/admin/utilisateur">
                        <img src="<?= IMG_PATH.'customer.png'; ?>" alt="customer" class="icon">
                        <span class="title">Utilisateurs</span>
                    </a>
                </li>

                <li>
                    <a href="/immoavril/admin/messages">
                        <img src="<?= IMG_PATH.'letter.png'; ?>" alt="customer" class="icon">
                        <span class="title">Messages</span>
                    </a>
                </li>

                <li>
                    <a href="/immoavril/admin/interest">
                        <img src="<?= IMG_PATH.'Us.png'; ?>" alt="customer" class="icon">
                        <span class="title">Interest</span>
                    </a>
                </li>

                <li>
                    <a href="/immoavril/admin/parametre">
                        <img src="<?= IMG_PATH.'settings.png'; ?>" alt="cogs" class="icon">
                        <span class="title">Paramètres</span>
                    </a>
                </li>

                <li>
                    <a href="/immoavril/">
                        <img src="<?= IMG_PATH.'Logout.png'; ?>" alt="logout" class="icon">
                        <span class="title">Déconnexion</span>
                    </a>
                </li>

            </ul>

        </div>

        <!-- main -->
        <div class="main">

            <div class="topbar">

                <div class="toggle">
                    <img src="<?= IMG_PATH.'menu.png'; ?>" alt="menu" class="menu_icon">
                </div>

                <!-- Search -->
                <?= isset($search) ? $search : ''; ?>

                <!-- userImg -->
                <div class="user">
                    <img src="<?= IMG_PATH.'user.png'; ?>" alt="user" class="user_icon">
                </div>

            </div>

            <?= $content;?>

        </div>

    </div>
</body>
<script>
    // MenuToggle
    let toggle = document.querySelector('.toggle');
    let navigation = document.querySelector('.navigation');
    let main = document.querySelector('.main');

    toggle.onclick = function(){
        navigation.classList.toggle('active');
        main.classList.toggle('active');
    }

    // add hovered class in selected list
    let list = document.querySelectorAll('.navigation li');

    function activeLink(){
        list.forEach((item) => item.classList.remove('hovered'));
    }

    list.forEach((item) => item.addEventListener('click',function(){
        activeLink();
        item.classList.add('hovered')
    }));
    
</script>
<script>
    let autocomplete;
    function initAutocomplete() {
        autocomplete = new google.maps.places.Autocomplete(
            document.getElementById('locationSearch'), 
            {
             types: ['establishment'],
             componentRestrictions: {country: ['CI']},
             fields: ['place_id','address_components', 'geometry', 'icon', 'name']
            });

    }
</script>
</html>