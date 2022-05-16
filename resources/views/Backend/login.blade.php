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
        <title>Document</title>
    </head>
    <body>
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-4 col-md-auto">
                    <form action="http://127.0.0.1:8000/api/admin/login" method="post">
                        <h1>Login</h1>
                        <hr />
                        <div class="form-group">
                            <label for="email">Email: </label><br />
                            <input type="email" name="email"  /><br />
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label><br />
                            <input type="password" name="password"  />
                        </div>
                        <button type="submit" class="btn btn-outline-primary">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="16"
                                height="16"
                                fill="currentColor"
                                class="bi bi-box-arrow-in-right"
                                viewBox="0 0 16 16"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0v-2z"
                                />
                                <path
                                    fill-rule="evenodd"
                                    d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"
                                />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    </body>

</html>


<style>
    body {
        
        background-image: url("http://127.0.0.1:8000/public/upload/admin_images/1039437.jpg"); 
        background-position: center;
        background-size: cover;
        display: flex;
        flex-direction: column;
        justify-content: center;
        min-height: 100vh;
    }
    form {
        border: 4px solid black;
        border-radius: 5px;
        padding: 30px;
        opacity: 1;
        margin: 30px;
        background-color: #ffffff;
        border: 2px solid black;
        opacity: 0.8;
    }
    input {
        margin-bottom: 10px;
        resize: vertical;
        width: 100%;
        border: 1px solid black;
        border-radius: 4px;
    }
</style>
