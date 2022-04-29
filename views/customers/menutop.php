<style>
    header{
        position: sticky;
        top: 0;
        z-index: 1000;
        background-color: var(--white);
        display: flex;
        justify-content:space-around;
        padding: 15px 25px;
        align-items: center;
        border-bottom: 1px solid rgba(0, 0, 0, 0.08);
        box-shadow: 0px 10px 5px rgba(0, 0, 0, 0.08);
    }

    .navigation{
        position:relative;
        display: grid;
        grid-template-columns: repeat(5,1fr);
        grid-gap: 10px;
        list-style: none;
    }
</style>
<header>
    <img src="" alt="">
    <ul class="navigation">
        <li><a href="">Accueil</a></li>
        <li><a href="">Propriétés</a></li>
        <li><a href="">Messages</a></li>
        <li><a href="">Profil</a></li>
        <li><a href="">Securité</a></li>
    </ul>
    <a href="/immoavril/customer" class="back">Retour</a>
</header>
<script>
    setInterval(function(){
        window.location.reload();
    },3000)
</script>