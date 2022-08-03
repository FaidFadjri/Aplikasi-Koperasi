@extends('templates/index')


@section('content')
    <br><br>
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-8 mb-2">
                <div class="card border-0 shadow">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Summary</h5>
                        <div class="row">
                            <div class="col-sm-6 col-md-4 col-lg-4 mb-2">
                                <div class="card border-0">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <span class="material-icons">
                                                add_business
                                            </span>
                                        </h5>
                                        <div class="card-text text-poppins">
                                            <?= $business ?> Usaha sedang berjalan
                                        </div>
                                    </div>
                                    <div class="border-0 bg-basic">
                                        <button
                                            class="btn-basic d-flex align-items-center w-100 justify-content-center">Detail
                                            <span class="material-icons">
                                                keyboard_arrow_right
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-4 mb-2">
                                <div class="card border-0">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <span class="material-icons">
                                                groups
                                            </span>
                                        </h5>
                                        <div class="card-text text-poppins">
                                            <?= $member ?> Anggota aktif koperasi
                                        </div>
                                    </div>
                                    <div class="bg-basic">
                                        <button
                                            class="btn-basic d-flex align-items-center w-100 justify-content-center">Detail
                                            <span class="material-icons">
                                                keyboard_arrow_right
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-4 mb-2">
                                <div class="card border-0">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <span class="material-icons">
                                                currency_exchange
                                            </span>
                                        </h5>
                                        <div class="card-text text-poppins">
                                            5 Anggota pinjaman aktif
                                        </div>
                                    </div>
                                    <div class="bg-basic">
                                        <button
                                            class="btn-basic d-flex align-items-center w-100 justify-content-center">Detail
                                            <span class="material-icons">
                                                keyboard_arrow_right
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-4 mb-2">
                <div class="card border-0 shadow">
                    <div class="card-body d-flex align-items-center justify-content-center flex-column">
                        <h6 class="card-title title-profit">Profit <span class="bg-basic rounded-pill">Per January
                                2022</span></h6>
                        <h3 class="text-poppins title-saldo mt-1">Rp. 25.000.000</h3>
                        <div class="button-wrap d-flex gap-2 mt-2">
                            <a class="btn-cancel">Cek Pengeluaran</a>
                            <a class="btn-basic">Cek Pemasukan</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="card border-0 shadow">
                    <div class="card-body">
                        <h5 class="card-title">Overview</h5>
                        <div class="chart-div my-3" id="chartdiv"></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="card border-0 shadow">
                    <div class="card-body">
                        <h5 class="card-title">Business Performance</h5>
                        <div class="chart-div my-3" id="barchart"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        var data = [{
                label: "Air Minum",
                value: 5000000
            },
            {
                label: "Spooring",
                value: 12000000
            },
            {
                label: "Kantin",
                value: 10000000
            },
            {
                label: "Fogging",
                value: 500000
            },
            {
                label: "MOP",
                value: 30000000
            },
            {
                label: "Kebersihan",
                value: 5000000
            },
            {
                label: "Bilyard",
                value: 200000
            },
        ]

        loadPie(data);
        loadBarChart(data)

        function loadPie(arrayData) {
            am5.ready(function() {
                // Create root element
                var root = am5.Root.new("chartdiv");


                // Set themes
                root.setThemes([
                    am5themes_Animated.new(root)
                ]);

                var chart = root.container.children.push(am5percent.PieChart.new(root, {
                    innerRadius: 50,
                    layout: root.verticalLayout
                }));


                // Create series
                var series = chart.series.push(am5percent.PieSeries.new(root, {
                    valueField: "value",
                    categoryField: "label"
                }));

                series.get("colors").set("colors", [
                    am5.color("#e68429"),
                    am5.color("#8ee629"),
                    am5.color("#e65b29"),
                    am5.color("#c4c4c4"),
                ]);

                // Set data
                series.data.setAll(arrayData);


                // Play initial series animation
                series.appear(1000, 100);


                // Add label
                var label = root.tooltipContainer.children.push(am5.Label.new(root, {
                    x: am5.p50,
                    y: am5.p50,
                    centerX: am5.p50,
                    centerY: am5.p50,
                    fill: am5.color(0x000000),
                    fontSize: 50
                }));

            }); // end am5.ready()
        }

        function loadBarChart(arrayData) {
            am5.ready(function() {

                // Create root element
                var root = am5.Root.new("barchart");


                // Set themes
                root.setThemes([
                    am5themes_Animated.new(root)
                ]);


                // Create chart
                var chart = root.container.children.push(am5xy.XYChart.new(root, {
                    panX: true,
                    panY: true,
                    wheelX: "panX",
                    wheelY: "zoomX",
                    pinchZoomX: true
                }));

                // Add cursor
                var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {}));
                cursor.lineY.set("visible", false);


                // Create axes
                var xRenderer = am5xy.AxisRendererX.new(root, {
                    minGridDistance: 30
                });
                xRenderer.labels.template.setAll({
                    rotation: -90,
                    centerY: am5.p50,
                    centerX: am5.p100,
                    paddingRight: 15
                });

                var xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
                    maxDeviation: 0.3,
                    categoryField: "label",
                    renderer: xRenderer,
                    tooltip: am5.Tooltip.new(root, {})
                }));

                var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
                    maxDeviation: 0.3,
                    renderer: am5xy.AxisRendererY.new(root, {})
                }));


                // Create series
                var series = chart.series.push(am5xy.ColumnSeries.new(root, {
                    name: "Series 1",
                    xAxis: xAxis,
                    yAxis: yAxis,
                    valueYField: "value",
                    sequencedInterpolation: true,
                    categoryXField: "label",
                    tooltip: am5.Tooltip.new(root, {
                        labelText: "{valueY}"
                    })
                }));

                series.columns.template.setAll({
                    cornerRadiusTL: 5,
                    cornerRadiusTR: 5
                });
                series.columns.template.adapters.add("fill", function(fill, target) {
                    return chart.get("colors").getIndex(series.columns.indexOf(target));
                });

                series.columns.template.adapters.add("stroke", function(stroke, target) {
                    return chart.get("colors").getIndex(series.columns.indexOf(target));
                });

                xAxis.data.setAll(arrayData);
                series.data.setAll(arrayData);


                // Make stuff animate on load
                series.appear(1000);
                chart.appear(1000, 100);

            });
        }
    </script>
@endsection
