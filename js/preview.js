$(function() {
    graph_options = {},
            options = {},
            chart_type = 1;//parseInt($('#chart-type').val()),
            defaultOptions = {
        id: 0,
        comp_id: 0,
        graph_group_id: 0,
        image: 0,
        graph_name: '',
        type: 1,
        sql_command: '',
        //chart
        background_color: '#FFFFFF',
        border_color: '#4572A7',
        border_radius: 5,
        border_width: 0,
        margin_bottom: null,
        margin_left: null,
        margin_right: null,
        margin_top: null,
        plot_background_color: null,
        plot_border_color: '#C0C0C0',
        plot_border_width: 0,
        show_axes: false,
        spacing_bottom: 15,
        spacing_left: 10,
        spacing_right: 10,
        spacing_top: 10,
        //legend
        legend_align: 'center',
        legend_background_color: null,
        legend_border_color: '#909090',
        legend_border_radius: 5,
        legend_border_width: 1,
        legend_enabled: true,
        legend_floating: false,
        legend_item_distance: 8,
        legend_item_margin_bottom: 0,
        legend_item_margin_top: 0,
        legend_layout: 'horizontal',
        legend_line_height: 16,
        legend_margin: 15,
        legend_padding: 8,
        legend_reversed: false,
        legend_shadow: false,
        legend_title: null,
        legend_vertical_align: 'bottom',
        legend_width: null,
        legend_x: 0,
        legend_y: 0,
        //colors
        colors: [
            '#2f7ed8',
            '#0d233a',
            '#8bbc21',
            '#910000',
            '#1aadce',
            '#492970',
            '#f28f43',
            '#77a1e5',
            '#c42525',
            '#a6c96a'
        ],
        //title.text
        title: '',
        //subtitle.text
        subtitle: '',
        ////////////////////////////////////////////////////////////////////////

        title_align: 'right', //center, left, tight
        title_color: '#0000FF',
        xAxis_lineColor: '#00FF00',
        xAxis_lineWidth: 1,
        xAxis_gridLineColor: '',
        xAxis_gridLineWidth: 1,
        xAxis_title_enabled: true, //always must be true

        xAxis_text: 'sdfsd',
        xAxis_align: 'low', //low, middle, height

        yAxis_lineColor: '#00FF00',
        yAxis_lineWidth: 1,
        yAxis_gridLineColor: '',
        yAxis_gridLineWidth: 1,
        yAxis_title_enabled: true, //always must be true

        yAxis_text: '',
        yAxis_align: 'low', //low, middle, height

        enableMouseTracking: false,
        markerEnabled: false,
        pie_series_name: '',
        table_name: ''
    };

});

function setOptions() {
    for (var item in defaultOptions) {
        var val = $('*[name=' + item + ']').val();
        if ($('*[name=' + item + ']').attr('type') == 'number') {
            val = parseInt(val);
        } else if (item === 'colors' && val) {
            val = val.replace(/\s+/g, '').split(",");
            val = $.grep(val, function(n) {
                return(n)
            });
        }
        if ((!val && val !== 0 && val !== '0') || val === undefined) {
            graph_options[item] = defaultOptions[item];
        } else {
            graph_options[item] = (val === '0') ? 0 : val;
        }
        //if(item)
    }
    options = {};
    options = {
        colors: graph_options.colors,
        title: {
            text: graph_options.title,
            align: graph_options.title_align,
            style: {
                color: graph_options.title_color
            }
        },
        subtitle: {
            text: graph_options.subtitle,
            align: graph_options.title_align,
            style: {
                color: graph_options.title_color
            }
        },
        chart: {
            backgroundColor: graph_options.background_color,
            borderColor: graph_options.border_color,
            borderRadius: graph_options.border_radius,
            borderWidth: graph_options.border_width,
            marginBottom: graph_options.margin_bottom,
            marginLeft: graph_options.margin_left,
            marginRight: graph_options.margin_right,
            marginTop: graph_options.margin_top,
            plotBackgroundColor: graph_options.plot_background_color,
            plotBorderColor: graph_options.plot_border_color,
            plotBorderWidth: graph_options.plot_border_width,
            showAxes: graph_options.show_axes == 0 ? false : true,
            spacingBottom: graph_options.spacing_bottom,
            spacingLeft: graph_options.spacing_left,
            spacingRight: graph_options.spacing_right,
            spacingTop: graph_options.spacing_top
        },
        legend: {
            align: graph_options.legend_align,
            backgroundColor: graph_options.legend_background_color,
            borderColor: graph_options.legend_border_color,
            borderRadius: graph_options.legend_border_radius,
            borderWidth: graph_options.legend_border_width,
            enabled: graph_options.legend_enabled == 0 ? false : true,
            floating: graph_options.legend_floating == 0 ? false : true,
            itemDistance: graph_options.legend_item_distance,
            itemMarginBottom: graph_options.legend_item_margin_bottom,
            itemMarginTop: graph_options.legend_item_margin_top,
            layout: graph_options.legend_layout,
            lineHeight: graph_options.legend_line_height,
            margin: graph_options.legend_margin,
            padding: graph_options.legend_padding,
            reversed: graph_options.legend_reversed == 0 ? false : true,
            shadow: graph_options.legend_shadow == 0 ? false : true,
            title: {
                text: graph_options.legend_title

            },
            verticalAlign: graph_options.legend_vertical_align,
            width: graph_options.legend_width,
            x: graph_options.legend_x,
            y: graph_options.legend_y,
            style: {
                align: 'center'
            }


        },
        xAxis: {
            lineColor: graph_options.xAxis_lineColor,
            lineWidth: graph_options.xAxis_lineWidth,
            gridLineColor: graph_options.xAxis_gridLineColor,
            gridLineWidth: graph_options.xAxis_gridLineWidth,
            title: {
                enabled: true,
                text: graph_options.xAxis_text,
                align: graph_options.xAxis_align
            }
        },
        yAxis: {
            lineColor: graph_options.yAxis_lineColor,
            lineWidth: graph_options.yAxis_lineWidth,
            gridLineColor: graph_options.yAxis_gridLineColor,
            gridLineWidth: graph_options.yAxis_gridLineWidth,
            title: {
                enabled: true,
                text: graph_options.yAxis_text,
                align: graph_options.yAxis_align
            }
        },
        plotOptions: {
            series: {
                enableMouseTracking: graph_options.enableMouseTracking == 0 ? false : true,
                marker: {
                    enabled: graph_options.markerEnabled == 0 ? false : true
                }
            }
        }
    };
    options.legend.width = parseInt(graph_options.legend_width);
    showGraph(options);
}


function showGraph(options) {

    //line chart
    if (chart_type === 1) {


        options.xAxis.categories = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
            'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];


        options.series = [{
                name: 'Tokyo',
                data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
            }, {
                name: 'New York',
                data: [-0.2, 0.8, 5.7, 11.3, 17.0, 22.0, 24.8, 24.1, 20.1, 14.1, 8.6, 2.5]
            }, {
                name: 'Berlin',
                data: [-0.9, 0.6, 3.5, 8.4, 13.5, 17.0, 18.6, 17.9, 14.3, 9.0, 3.9, 1.0]
            }, {
                name: 'London',
                data: [null, null, null, 8.5, 11.9, 15.2, 17.0, 16.6, 14.2, 10.3]
            }];
        //bar chart    
    } else if (chart_type === 2) {

        options.chart.type = 'column';
        options.xAxis.categories = [
            'Jan',
            'Feb',
            'Mar',
            'Apr',
            'May',
            'Jun',
            'Jul',
            'Aug',
            'Sep',
            'Oct',
            'Nov',
            'Dec'
        ];
        /*
         options.yAxis = {
         min: 0,
         title: {
         text: 'Rainfall (mm)'
         }
         };
         
         options.tooltip = {
         headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
         pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
         '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
         footerFormat: '</table>',
         shared: true,
         useHTML: true
         };
         
         
         options.plotOptions = {
         column: {
         pointPadding: 0.2,
         borderWidth: 0
         }
         };
         
         */
        options.series = [{
                name: 'Tokyo',
                data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4]

            }, {
                name: 'New York',
                data: [83.6, 78.8, 98.5, 93.4, 106.0, 84.5, 105.0, 104.3, 91.2, 83.5, 106.6, 92.3]

            }, {
                name: 'London',
                data: [48.9, 38.8, 39.3, 41.4, 47.0, 48.3, 59.0, 59.6, 52.4, 65.2, 59.3, 51.2]

            }, {
                name: 'Berlin',
                data: [42.4, 33.2, 34.5, 39.7, 52.6, 75.5, 57.4, 60.4, 47.6, 39.1, 46.8, 51.1]

            }];
        //pie chart
    } else if (chart_type === 3) {
        /*
         options.chart.plotBackgroundColor = null;
         options.chart.plotBorderWidth = null;
         options.chart.plotShadow = false;
         
         */
        options.tooltip = {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        };

        options.plotOptions = {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: false
                },
                showInLegend: true
            }
        };

        options.series = [{
                type: 'pie',
                name: graph_options.pie_series_name,
                data: [
                    ['Firefox', 45.0],
                    ['IE', 26.8],
                    ['Chrome', 12.8],
                    ['Safari', 8.5],
                    ['Opera', 6.2],
                    ['Others', 0.7]
                ]
            }];
        //mixed chart
    } else {
        options = {
        }
    }

    options.legend.x = (graph_options.legend_x / 100) * $('#graph-iphone').width();
    //options.legend.width = (graph_options.legend_width/100) * $('#graph-iphone').width();
    //options.legend.y = (graph_options.legend_y/100) * $('#graph-iphone').height();
    $('#graph-iphone').highcharts(options);

    options.legend.x = (graph_options.legend_x / 100) * $('#graph-ipad').width();
    //options.legend.width = (graph_options.legend_width/100) * $('#graph-ipad').width();
    //options.legend.y = (graph_options.legend_y/100) * $('#graph-ipad').height();
    $('#graph-ipad').highcharts(options);
}