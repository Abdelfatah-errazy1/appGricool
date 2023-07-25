
    <div class="card card-bordered">
        <div class="card-body">

            <div class="row">
                <x-form.select name="qualification"  label="qualification" col="col-12 col-md-4"
                               :bind-with="[
                \App\Models\Qualifications::all(),
                [
                    'idQT' ,  'titre'
                ]
            ]"
                />
                <x-form.select name="mode"  label="Mode" col="col-12 col-md-4"
                              :options="[
                        'DAY' => 'Jour',
                        'DECADES' => 'Decade',
                        'MONTH' => 'mois',

                ]"
                />

                <x-form.input-date :picker-type="\App\View\Components\Form\InputDate::DATE" col="col-12 col-md-4"  name="dateS" label="date de debut" />
            </div>



            <div id="kt_apexcharts_3" style="height: 350px;"></div>
        </div>
    </div>


    @push('scripts')

    <script>
        var element = document.getElementById('kt_apexcharts_3');

        var height = parseInt(KTUtil.css(element, 'height'));
        var labelColor = KTUtil.getCssVariableValue('--kt-gray-500');
        var borderColor = KTUtil.getCssVariableValue('--kt-gray-200');
        var baseColor = KTUtil.getCssVariableValue('--kt-info');
        var lightColor ="#5EC267";



        var options = {
            noData: {
                text: "No data text",
                align: "center",
                verticalAlign: "middle",
            },
            series: [{
                name: 'Net Profit',
                data: []
            }],
            chart: {
                id: 'realtime',
                height: 500,
                type: 'line',
                dropShadow: {
                    enabled: true,
                    color: baseColor,
                    top: 18,
                    left: 7,
                    blur: 10,
                    opacity: 0.2
                },
                animations: {
                    enabled: false,
                    easing: 'linear',
                    dynamicAnimation: {
                        speed: 1000
                    }
                },
                zoom: {
                    enabled: true
                }
            },
            plotOptions: {

            },
            legend: {
                show: false
            },
            dataLabels: {
                enabled: false
            },
            fill: {
                type: 'solid',
                opacity: 1
            },
            stroke: {
                curve: 'smooth',
                show: true,
                width: 3,
                colors: [lightColor]
            },

            xaxis: {
                categories: [],
                axisBorder: {
                    show: false,
                },
                axisTicks: {
                    show: false
                },
                labels: {
                    style: {
                        colors: labelColor,
                        fontSize: '12px'
                    }
                },
                crosshairs: {
                    position: 'front',
                    stroke: {
                        color: baseColor,
                        width: 1,
                        dashArray: 3
                    }
                },
                tooltip: {
                    enabled: true,
                    formatter: undefined,
                    offsetY: 0,
                    style: {
                        fontSize: '12px'
                    }
                }
            },
            yaxis: {
                labels: {
                    style: {
                        colors: labelColor,
                        fontSize: '12px'
                    }
                }
            },
            states: {
                normal: {
                    filter: {
                        type: 'none',
                        value: 0
                    }
                },
                hover: {
                    filter: {
                        type: 'none',
                        value: 0
                    }
                },
                active: {
                    allowMultipleDataPointsSelection: false,
                    filter: {
                        type: 'none',
                        value: 0
                    }
                }
            },
            tooltip: {
                style: {
                    fontSize: '12px'
                },
                y: {
                    formatter: function (val) {
                        return 'le moyen(μ) : ' + val;
                    }
                }
            },
            colors: [lightColor],
            grid: {
                borderColor: borderColor,
                strokeDashArray: 4,
                yaxis: {
                    lines: {
                        show: true
                    }
                }
            },
            markers: {
                size: 5,
            },
        };

        var apexCharts = new ApexCharts(element, options);
        apexCharts.render();

        let qualificationInput = $('[name=qualification]');
        let modeInput = $('[name=mode]');
        let dateSInput = $('[name=dateS]');

        qualificationInput.add(modeInput).add(dateSInput).on('change' , function () {
            let data = {
                'qualification' : qualificationInput.val(),
                'mode' : modeInput.val(),
                'dateS' : dateSInput.val(),
                '_token' : "{{ csrf_token() }}"
            };



            $.ajax({
                url: '{{ route('chart.filter') }}',
                type: 'post',
                data: data,
                success: function ({
                                       errors,
                                       data
                                   }) {



                    console.log(data);





                    if (errors) {



                    } else {



                        if (data !== undefined && Array.isArray(data)) {
                            const [xValues, yValues] = splitArray(data);




                            apexCharts.updateOptions({
                                xaxis: {
                                    categories: xValues
                                }
                            });
                            apexCharts.updateOptions({
                                title: {
                                    text: `Graphe de Moyennes de Mesures `,
                                }
                            });
                            apexCharts.updateSeries([
                                {
                                name: "La Moyennes des mesures",
                                data: yValues
                                 }
                            ])

                        }


                    }
                },
                error: function ({
                                     responseText
                                 }) {

                    console.log(responseText)

                }
            });
        });





        function splitArray(array) {
            data = Object.entries(array);
            let xValues = [];
            let yValues = [];



            data.forEach(function (e) {
                xValues.push(e[1].time );
                yValues.push(e[1].mesure ?? 0);
            });
            return [xValues, yValues];
        }



    </script>
@endpush

