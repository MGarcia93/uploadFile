<header>
    <h1 class="title bg-gray text-center p-3 mt-2">Login</h1>
</header>

<form action="./api/auth/login" id="Login" method="post" class="border border-1 rounded-2 p-3 col-12 col-md-4 m-auto ">
    <input class="form-control" type="text" id="user" placeholder="Usuario">
    <input type="password" name="" id="password" class="form-control mt-1" placeholder="password">
    <button id="btnLogin" class="btn btn-success d-block col-12 mt-2">Login</button>
</form>