<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link
            rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"
        />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <title>Document</title>
    </head>
    <body>
        <div class="container">
            <header class="p-3 mb-3 border-bottom">
                <div class="container">
                    <div
                        class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start"
                    >
                        <a
                            href="/"
                            class="d-flex align-items-center mb-2 mb-lg-0 text-dark text-decoration-none"
                        >
                            <svg
                                class="bi me-2"
                                width="40"
                                height="32"
                                role="img"
                                aria-label="Bootstrap"
                            >
                                <use xlink:href="#bootstrap"></use>
                            </svg>
                        </a>

                        <ul
                            class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0"
                        >
                            <li>
                                <a href="#" class="nav-link px-2 link-secondary"
                                    >Dashboard</a
                                >
                            </li>
                            <li>
                                <a href="#" class="nav-link px-2 link-dark"
                                    >Brands</a
                                >
                            </li>
                            <li class="nav-item dropdown">
                                <a
                                    class="nav-link dropdown-toggle"
                                    href="#"
                                    id="navbarDropdownMenuLink"
                                    role="button"
                                    data-bs-toggle="dropdown"
                                    aria-expanded="false"
                                >
                                    Category
                                </a>
                                <ul
                                    class="dropdown-menu"
                                    aria-labelledby="navbarDropdownMenuLink"
                                >
                                    <li>
                                        <a
                                            href="#"
                                            class="nav-link px-2 link-dark"
                                            >Products</a
                                        >
                                    </li>

                                    <li>
                                        <a class="dropdown-item" href="#"
                                            >Action</a
                                        >
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#"
                                            >Another action</a
                                        >
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#"
                                            >Something else here</a
                                        >
                                    </li>
                                </ul>
                            </li>
                        </ul>

                        <form
                            class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3"
                            role="search"
                        ></form>
                        <div class="text-end" id="name"></div>
                        <div class="dropdown text-end">
                            <a
                                href="#"
                                class="d-block link-dark text-decoration-none dropdown-toggle"
                                id="dropdownUser1"
                                data-bs-toggle="dropdown"
                                aria-expanded="false"
                            >
                                <img
                                    src="{{$response['user']->profile_photo_path}}"
                                    alt="mdo"
                                    width="32"
                                    height="32"
                                    class="rounded-circle"
                                />
                            </a>
                            <ul
                                class="dropdown-menu text-small"
                                aria-labelledby="dropdownUser1"
                                style=""
                            >
                                <li>
                                    <a
                                        class="dropdown-item"
                                        href="http://127.0.0.1:8000/api/admin/profile"
                                        >Profile</a
                                    >
                                </li>
                                <li><hr class="dropdown-divider" /></li>
                                <li>
                                    <a class="dropdown-item" href="#"
                                        >Name:  {{ $response['user']->name }}Sign out</a
                                    >
                                </li>
                                <li><hr class="dropdown-divider" /></li>
                                <li>
                                    <a class="dropdown-item" href="#"
                                        >Change Password</a
                                    >
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </header>
            <section class="content" id="content"></section>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="http://127.0.0.1:8000/js/app.js">
   
        </script>
    </body>
</html>

<style>
    body {
        /* background-image: url("/resources/views/Backend/pictures/1039437.jpg");
        background-position: center;
        background-size: cover;
        display: flex;
        flex-direction: column;
         justify-content: center; 
        min-height: 100vh; */
    }
    .text-end#name {
        padding-right: 10px;
    }
</style>
