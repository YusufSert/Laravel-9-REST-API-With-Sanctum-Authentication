fetch("http://127.0.0.1:8000/api/products")
    .then((res) => res.json())
    .then((data) => console.log(data));

fetch("http://127.0.0.1:8000/api/register", {
    method: "POST",
    body: JSON.stringify({
        name: "Kyle2",
        email: "kyle2@gmail.com",
        phone: "1",
        password: "1234",
        password_confirmation: "1234",
    }),
    headers: { "Content-Type": "application/json" },
})
    .then((res) => res.json())
    .then((data) => console.log(data));

fetch("http://127.0.0.1:8000/api/register", {
    method: "POST",
    headers: {
        "Content-Type": "application/json",
        Authorization: "Bearer 17|VA1yKjfh50NveEU1PWxFOVjkH6OuIXNwSyGVuJFq",
    },
})
    .then((res) => res.json())
    .then((data) => console.log(data));

fetch("http://127.0.0.1:8000/api/logout", {
    method: "POST",
    headers: {
        "Content-Type": "application/json",
        Authorization: "Bearer 17|VA1yKjfh50NveEU1PWxFOVjkH6OuIXNwSyGVuJFq",
    },
})
    .then((res) => res.json())
    .then((data) => console.log(data));

fetch("http://127.0.0.1:8000/api/login", {
    method: "POST",
    body: JSON.stringify({
        email: "yusufcansert123@gmail.com",
        password: "1234",
    }),
});
