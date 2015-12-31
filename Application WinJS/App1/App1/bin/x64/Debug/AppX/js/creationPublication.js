(function () {

    categorie();

    function categorie() {
        var token = 'WU8nb/rCD6JgtiyxTW3ZP+s4n9Vg9liUllh5bZLoLQhAMMoCaHE72nYLQSsw12uhkgWJLDmgMmZVD+aIk6BsZw==';
        var beginAdress = "http://localhost/rest/web/index.php/";
        var options = {
            url: beginAdress + "categories",
            type: "get",
            headers: { "Content-Type": "application/json;charset=utf-8" }
        };
        return WinJS.xhr(options).then(
            function (request) {
                var items = JSON.parse(request.response);
                var selectCategories = document.getElementById("select_categories");
                for (var i = 0; i < items.length; i++) {
                    var option = document.createElement("option");
                    option.setAttribute('value', items[i].ID);
                    option.text = items[i].name_fr;
                    selectCategories.add(option);
                }
            },
        function (error) { console.log(error); },
        function (progress) { }
        );
    }

})();