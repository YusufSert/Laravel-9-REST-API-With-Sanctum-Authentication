var edit = () => {
    $(function () {
        $.ajax({
            type: "GET",
            url: "http://127.0.0.1:8000/html_template/admin_edit.html",
            timeout: 2000,
            beforeSend: function () {},
            complete: function () {},
            success: function (data) {
                $("#content").html(data);
            },
        });
        $.getJSON("http://127.0.0.1:8000/api/admin/edit").done(function (data) {
            $("#content img").attr("src", data.user.profile_photo_path);
        });
    });
};
$("#content a").on("click", function (e) {
    e.preventDefault();
    edit();
});

var profile = (url) => {
    var adminData;
    $(function () {
        $.ajax({
            type: "GET",
            url: "http://127.0.0.1:8000/html_template/admin_profile.html",
            success: function (data) {
                $("#content").html(data);
            },
        });
    });
    $(function () {
        $.getJSON(url).done(function (data) {
            $("#content img").attr("src", data.user.profile_photo_path);
            $("#content li").eq(0).text(data.user.name);
            $("#content li").eq(1).text(data.user.email);
        });
    });
};
//profile();
$(".dropdown-item").on("click", function (e) {
    e.preventDefault();
    var url = this.href;
    if (this.text == "Profile") {
        profile(url);
    }
});
