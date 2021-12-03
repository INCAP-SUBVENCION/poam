$(document).ready(function () {
    /**
     * Metodo que permite sumar las columnas indicadas del periodo 3
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
    $('#poa_periodo_3').DataTable({

        initComplete: function () {
            this.api().columns([1, 2]).every(function () {
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
            $('#tnuevos3').html(api.column(3, { "filter": "applied" }).data().sumar());
            $('#trecurrentes3').html(api.column(4, { "filter": "applied" }).data().sumar());
            $('#total3').html(api.column(5, { "filter": "applied" }).data().sumar());
            $('#tnatural3').html(api.column(6, { "filter": "applied" }).data().sumar());
            $('#tsabor3').html(api.column(7, { "filter": "applied" }).data().sumar());
            $('#tfemenino3').html(api.column(8, { "filter": "applied" }).data().sumar());
            $('#tlubricantes3').html(api.column(9, { "filter": "applied" }).data().sumar());
            $('#tpruebavih3').html(api.column(10, { "filter": "applied" }).data().sumar());
            $('#tautoprueba3').html(api.column(11, { "filter": "applied" }).data().sumar());
            $('#treactivos3').html(api.column(12, { "filter": "applied" }).data().sumar());
            $('#tsifilis3').html(api.column(13, { "filter": "applied" }).data().sumar());
        }
    });
    /**
     * Metodo que permite filtrar poa del periodo 4
     */
     $('#poa_periodo_4').DataTable({

        initComplete: function () {
            this.api().columns([1, 2]).every(function () {
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
            $('#tnuevos4').html(api.column(3, { "filter": "applied" }).data().sumar());
            $('#trecurrentes4').html(api.column(4, { "filter": "applied" }).data().sumar());
            $('#totals4').html(api.column(5, { "filter": "applied" }).data().sumar());
            $('#tnatural4').html(api.column(6, { "filter": "applied" }).data().sumar());
            $('#tsabor4').html(api.column(7, { "filter": "applied" }).data().sumar());
            $('#tfemenino4').html(api.column(8, { "filter": "applied" }).data().sumar());
            $('#tlubricantes4').html(api.column(9, { "filter": "applied" }).data().sumar());
            $('#tpruebavih4').html(api.column(10, { "filter": "applied" }).data().sumar());
            $('#tautoprueba4').html(api.column(11, { "filter": "applied" }).data().sumar());
            $('#treactivos4').html(api.column(12, { "filter": "applied" }).data().sumar());
            $('#tsifilis4').html(api.column(13, { "filter": "applied" }).data().sumar());
        }
    });


    /**
     * Metodo que permite filtrar pom del periodo 3
     */
     $('#pom_periodo_3').DataTable({

        initComplete: function () {
            this.api().columns([2, 3]).every(function () {
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
            $('#tnuevo3').html(api.column(10, { "filter": "applied" }).data().sumar());
            $('#trecurrente3').html(api.column(11, { "filter": "applied" }).data().sumar());
            $('#ttotal3').html(api.column(12, { "filter": "applied" }).data().sumar());
        }
    });

        /**
     * Metodo que permite filtrar pom del periodo 4
     */
         $('#pom_periodo_4').DataTable({
 
            initComplete: function () {
                this.api().columns([2, 3]).every(function () {
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
                $('#tnuevo4').html(api.column(10, { "filter": "applied" }).data().sumar());
                $('#trecurrente4').html(api.column(11, { "filter": "applied" }).data().sumar());
                $('#ttotal4').html(api.column(12, { "filter": "applied" }).data().sumar());
            }
        });


});