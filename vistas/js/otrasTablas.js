
$(document).ready(function () {

    /**
     * Metodo que permite sumar las columnas de la tabla
     */
    jQuery.fn.dataTable.Api.register('sumar()', function () {
        return this.flatten().reduce(function (a, b) {
            if (typeof a === 'string') { a = a.replace(/[^\d.-]/g, '') * 1; }
            if (typeof b === 'string') { b = b.replace(/[^\d.-]/g, '') * 1; }
            var r = a + b;
            return r.toFixed(2);
        }, 0);
    });

    /**
     * Metodo que permite filtrar poa del periodo 3
     */
    $('#super_3').DataTable({

        initComplete: function () {
            this.api().columns([1, 2, 9]).every(function () {
                var column = this;
                var select = $('<select><option value="">Filtar</option></select>')
                    .appendTo($(column.footer()).empty())
                    .on('change', function () {
                        var val = $.fn.dataTable.util.escapeRegex($(this).val());
                        column.search(val ? '^' + val + '$' : '', true, false).draw();
                    });
                column.data().unique().sort().each(function (d, j) {
                    select.append('<option value="' + d + '">' + d + '</option>')
                });
            });
        },

        drawCallback: function () {
            var api = this.api();
            $('#nuevo3').html(api.column(6, { "filter": "applied" }).data().sumar());
            $('#recurrente3').html(api.column(7, { "filter": "applied" }).data().sumar());
            $('#total3').html(api.column(8, { "filter": "applied" }).data().sumar());
        }
    });

    $('#superenlacerp_3').DataTable({

        initComplete: function () {
            this.api().columns([2, 3, 4, 10]).every(function () {
                var column = this;
                var select = $('<select><option value="">Filtar</option></select>')
                    .appendTo($(column.footer()).empty())
                    .on('change', function () {
                        var val = $.fn.dataTable.util.escapeRegex($(this).val());
                        column.search(val ? '^' + val + '$' : '', true, false).draw();
                    });
                column.data().unique().sort().each(function (d, j) {
                    select.append('<option value="' + d + '">' + d + '</option>')
                });
            });
        },

        drawCallback: function () {
            var api = this.api();
            $('#nuevo3').html(api.column(7, { "filter": "applied" }).data().sumar());
            $('#recurrente3').html(api.column(8, { "filter": "applied" }).data().sumar());
            $('#total3').html(api.column(9, { "filter": "applied" }).data().sumar());
        }
    });

    $('#superp_3').DataTable({

        initComplete: function () {
            this.api().columns([]).every(function () {
                var column = this;
                var select = $('<select><option value="">Filtar</option></select>')
                    .appendTo($(column.footer()).empty())
                    .on('change', function () {
                        var val = $.fn.dataTable.util.escapeRegex($(this).val());
                        column.search(val ? '^' + val + '$' : '', true, false).draw();
                    });
                column.data().unique().sort().each(function (d, j) {
                    select.append('<option value="' + d + '">' + d + '</option>')
                });
            });
        },

        drawCallback: function () {
            var api = this.api();
            $('#nuevo3').html(api.column(7, { "filter": "applied" }).data().sumar());
            $('#recurrente3').html(api.column(8, { "filter": "applied" }).data().sumar());
            $('#total3').html(api.column(9, { "filter": "applied" }).data().sumar());
        }
    });
});