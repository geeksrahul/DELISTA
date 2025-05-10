<style>
    *{
        margin: 0;
        padding: 0;
        box-sizing:border-box;
        text-decoration:none;
        font-family: Arial, sans-serif;
    }
    header {
        position: fixed; /* Fix header to the top */
        top: 0; /* Stick it to the top */
        left: 0;
        width: 100%;
        background-color: #ffffff;
        height: 70px;
        display: flex;
        justify-content: space-between;
        align-items: center !important;
        padding: 0px 30px;
        box-shadow: 0px 1px 0px 0px rgba(0,0,0,0.1);
        z-index: 1000; /* Ensure it's above other elements */
    }
    .logo {
        height: 100%;
        position:relative;
    }

    .logo h1 {
        font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif !important;
        letter-spacing: 2px;
        font-size:2rem;
        position:absolute;
        top:50%;
        left:50%;
        transform: translateY(-50%);
    }

    nav {
        height: 100%;
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    nav a{
        height: 100%;
        color:black;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 0px 30px;
        font-size: 16px;
        font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        text-decoration: none;
        transition: all ease 0.3s;
    }

    nav a:hover {
        background-color: #091f40;
        color:white;
    }

    header .option {
        display: flex;
        justify-content: center; 
        align-items: center;
        gap: 10px;
    }

    .option a{
        height: 40px;
        width: 40px;
        color: black;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 50%;
        text-decoration: none;
        transition: all ease 0.3s;
    }

    .option a:hover{
        background-color: #091f40;
        color: white;
    }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<header>
        <div class="logo">
            <h1 style=''>
                DELISTA 
            </h1>
        </div>
        <nav>
            <a href="/delista/index.php#"> HOME </a> 
            <a href="/delista/index.php#categories"> CATEGORIES </a> 
            <a href="/delista/store/index.php"> STORE </a> 
            <a href="/delista/index.php#about"> ABOUT </a> 
            <a href="/delista/index.php#contact"> CONTACT </a> 
            <a href="/delista/admin/index.php"> ADMIN </a> 
        </nav>
        <div class="option">
            <a href="/delista/profile/index.php">
                <i class="fa-solid fa-user"></i>
            </a>
            <a href="/delista/store/cart.php">
                <i class="fa-solid fa-cart-shopping"></i>
            </a>
        </div>
    </header>