<?php 
include 'session.php';
define('PROPERTY_IMG','\immoavril\uploads\\');
define('IMG_PATH','\immoavril\assets\images\icon\\');
?>
<header>
    <img src="" alt="">
    <ul class="navigation">
        <li><a href="/immoavril/customer/compte/propriete">Propriétés</a></li>
        <li><a href="/immoavril/customer/compte/messages">Messages</a></li>
        <li><a href="/immoavril/customer/compte/profil">Profil</a></li>
        <li><a href="/immoavril/customer/compte/securite">Securité</a></li>
    </ul>
    <a href="/immoavril/customer" class="back">Accueil</a>
</header>
<style>
    *{
        padding: 0;
        margin: 0;
        box-sizing: border-box;
    }
    body{
        width: 100%;
        min-height:100vh;
        background-color: rgba(245, 245, 245, 1);
        padding-bottom: 10px;
    }
    .container{
        width: 100%;
        display: flex;
        flex-direction: column;
        gap: 2em;
        margin-top: 2em;
    }

    a{
        text-decoration: none;
    }

    header{
        position: sticky;
        top: 0;
        z-index: 1000;
        background-color: white;
        display: flex;
        justify-content:space-around;
        padding: 15px 25px;
        align-items: center;
        border-bottom: 1px solid rgba(0, 0, 0, 0.08);
        box-shadow: 0px 10px 5px rgba(0, 0, 0, 0.08);
        width: 100%;
    }

    .navigation{
        position:relative;
        display: grid;
        grid-template-columns: repeat(4,1fr);
        grid-gap: 10px;
        list-style: none;
    }

    .navigation a{
        color: #999;
    }

    .navigation a:hover{
        color: #287bff;
    }

    .back{
        color: #fff;
        background-color: #287bff;
        padding: 5px 10px;
        border-radius: 6px;
        text-decoration: none;
    }

    #msg,#msgs{
        border-radius: 6px;
    }

    #msg{
        display: flex;
        flex-direction: column;
        position: absolute;
        left: 40%;
        top: 40%;
        width: 300px;
        height: 100px;
        padding: 10px;
        justify-content: center;
        align-items: center;
        background-color: white;
        border: 1px solid #999;
        font-weight: 600;
        gap: 1.2em;
    }

    .error{
        color: red;
    }

    .success{
        color: #287bff;
    }

    #ok{
        width: fit-content;
        text-decoration: none;
        color: #fff;
        padding: 5px;
        background-color:#287bff;
        border-radius: 5px;
    }

</style>
