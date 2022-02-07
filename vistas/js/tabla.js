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
    $('#poa_omes_3').DataTable({

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
            $('#omesnuevos3').html(api.column(3, { "filter": "applied" }).data().sumar());
            $('#omesrecurrentes3').html(api.column(4, { "filter": "applied" }).data().sumar());
            $('#omestotal3').html(api.column(5, { "filter": "applied" }).data().sumar());
            $('#omesnatural3').html(api.column(6, { "filter": "applied" }).data().sumar());
            $('#omessabor3').html(api.column(7, { "filter": "applied" }).data().sumar());
            $('#omesfemenino3').html(api.column(8, { "filter": "applied" }).data().sumar());
            $('#omeslubricantes3').html(api.column(9, { "filter": "applied" }).data().sumar());
            $('#omesautoprueba3').html(api.column(10, { "filter": "applied" }).data().sumar());
        }
    });
    /**
   * Metodo que permite filtrar poa del periodo 3
   */
    $('#poa_hsh_3').DataTable({

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
            $('#hshnuevos3').html(api.column(3, { "filter": "applied" }).data().sumar());
            $('#hshrecurrentes3').html(api.column(4, { "filter": "applied" }).data().sumar());
            $('#hshtotal3').html(api.column(5, { "filter": "applied" }).data().sumar());
            $('#hshnatural3').html(api.column(6, { "filter": "applied" }).data().sumar());
            $('#hshlubricantes3').html(api.column(7, { "filter": "applied" }).data().sumar());
            $('#hshpruebavih3').html(api.column(8, { "filter": "applied" }).data().sumar());
            $('#hshautoprueba3').html(api.column(9, { "filter": "applied" }).data().sumar());
            $('#hshreactivos3').html(api.column(10, { "filter": "applied" }).data().sumar());
            $('#hshsifilis3').html(api.column(11, { "filter": "applied" }).data().sumar());
        }
    });
    /**
   * Metodo que permite filtrar poa del periodo 3
   */
    $('#poa_otrans_3').DataTable({

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
            $('#otransnuevos3').html(api.column(3, { "filter": "applied" }).data().sumar());
            $('#otransrecurrentes3').html(api.column(4, { "filter": "applied" }).data().sumar());
            $('#otranstotal3').html(api.column(5, { "filter": "applied" }).data().sumar());
            $('#otransnatural3').html(api.column(6, { "filter": "applied" }).data().sumar());
            $('#otranssabor3').html(api.column(7, { "filter": "applied" }).data().sumar());
            $('#otranslubricantes3').html(api.column(8, { "filter": "applied" }).data().sumar());
            $('#otranspruebavih3').html(api.column(9, { "filter": "applied" }).data().sumar());
            $('#otransautoprueba3').html(api.column(10, { "filter": "applied" }).data().sumar());
            $('#otransreactivos3').html(api.column(11, { "filter": "applied" }).data().sumar());
            $('#otranssifilis3').html(api.column(12, { "filter": "applied" }).data().sumar());
        }
    });
    /**
     * Metodo que permite filtrar poa del periodo 3
     */
     $('#poa_omes_4').DataTable({

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
            $('#omesnuevos4').html(api.column(3, { "filter": "applied" }).data().sumar());
            $('#omesrecurrentes4').html(api.column(4, { "filter": "applied" }).data().sumar());
            $('#omestotal4').html(api.column(5, { "filter": "applied" }).data().sumar());
            $('#omesnatural4').html(api.column(6, { "filter": "applied" }).data().sumar());
            $('#omessabor4').html(api.column(7, { "filter": "applied" }).data().sumar());
            $('#omesfemenino4').html(api.column(8, { "filter": "applied" }).data().sumar());
            $('#omeslubricantes4').html(api.column(9, { "filter": "applied" }).data().sumar());
            $('#omesautoprueba4').html(api.column(10, { "filter": "applied" }).data().sumar());
        }
    });
    /**
   * Metodo que permite filtrar poa del periodo 4
   */
    $('#poa_hsh_4').DataTable({

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
            $('#hshnuevos4').html(api.column(3, { "filter": "applied" }).data().sumar());
            $('#hshrecurrentes4').html(api.column(4, { "filter": "applied" }).data().sumar());
            $('#hshtotal4').html(api.column(5, { "filter": "applied" }).data().sumar());
            $('#hshnatural4').html(api.column(6, { "filter": "applied" }).data().sumar());
            $('#hshlubricantes4').html(api.column(7, { "filter": "applied" }).data().sumar());
            $('#hshpruebavih4').html(api.column(8, { "filter": "applied" }).data().sumar());
            $('#hshautoprueba4').html(api.column(9, { "filter": "applied" }).data().sumar());
            $('#hshreactivos4').html(api.column(10, { "filter": "applied" }).data().sumar());
            $('#hshsifilis4').html(api.column(11, { "filter": "applied" }).data().sumar());
        }
    });
    /**
   * Metodo que permite filtrar poa del periodo 4
   */
    $('#poa_otrans_4').DataTable({

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
            $('#otransnuevos4').html(api.column(3, { "filter": "applied" }).data().sumar());
            $('#otransrecurrentes4').html(api.column(4, { "filter": "applied" }).data().sumar());
            $('#otranstotal4').html(api.column(5, { "filter": "applied" }).data().sumar());
            $('#otransnatural4').html(api.column(6, { "filter": "applied" }).data().sumar());
            $('#otranssabor4').html(api.column(7, { "filter": "applied" }).data().sumar());
            $('#otranslubricantes4').html(api.column(8, { "filter": "applied" }).data().sumar());
            $('#otranspruebavih4').html(api.column(9, { "filter": "applied" }).data().sumar());
            $('#otransautoprueba4').html(api.column(10, { "filter": "applied" }).data().sumar());
            $('#otransreactivos4').html(api.column(11, { "filter": "applied" }).data().sumar());
            $('#otranssifilis4').html(api.column(12, { "filter": "applied" }).data().sumar());
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