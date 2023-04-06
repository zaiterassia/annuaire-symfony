$(function() {
    var e = $("#datatable1").DataTable({ "pageLength": 25, "language": { "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/French.json" }, "aaSorting": [],  responsive: { details: !1 } });
    $(document).on("sidebarChanged", function() { e.columns.adjust(), e.responsive.recalc(), e.responsive.rebuild() });

    var e2 = $("#datatable2").DataTable({ "pageLength": 25, "language": { "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/French.json" }, "aaSorting": [],  responsive: { details: !1 } });
    $(document).on("sidebarChanged", function() { e2.columns.adjust(), e2.responsive2.recalc(), e2.responsive2.rebuild() })
});