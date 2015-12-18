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

            /*var list = new WinJS.Binding.List(items);
            var listview = document.getElementById("listView");
            WinJS.UI.processAll().done(function () {
            listview.winControl.itemDataSource = list.dataSource;
            */

            WinJS.Namespace.define("Sample.ListView", {
                modes: {
                    single: {
                        name: 'single',
                        selectionMode: WinJS.UI.SelectionMode.single,
                        tapBehavior: WinJS.UI.TapBehavior.directSelect
                    }
                },
                
                listView: null,
                changeSelectionMode: WinJS.UI.eventHandler(function (ev) {
                    var listView = Sample.ListView.listView;
                    if (listView) {
                        var command = ev.target;
                        if (command.textContent) {
                            var mode = command.textContent.toLowerCase();
                            listView.selection.clear();

                            Sample.ListView.context.currentMode = Sample.ListView.modes[mode];

                            listView.selectionMode = Sample.ListView.context.currentMode.selectionMode;
                            listView.tapBehavior = Sample.ListView.context.currentMode.tapBehavior;
                        }
                    }
                }),
                data: new WinJS.Binding.List(items),
                context: {
                }
            });

            Sample.ListView.context = WinJS.Binding.as({ currentMode: Sample.ListView.modes.single });
            var header = document.querySelector('.headerFooterPlaceholder');
            WinJS.Binding.processAll(header, Sample.ListView).then(function () {
                return WinJS.UI.processAll();
            }).then(function () {
                Sample.ListView.listView = document.querySelector('.listView').winControl;
            });
            
        },
    function (error) { console.log(error); },
    function (progress) { }
    );
}
})();