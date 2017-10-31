/* Pie Chart display */
function showPieChart (id, data_list) {
    var data = [],
    series = data_list.length;

    for (var i = 0; i < series; i++) {
        data[i] = {
            label: data_list[i].d_label,
            data: data_list[i].d_rate,
        }
    }

    $.plot(id, data, {
        series: {
            pie: {
                show: true,
                radius: 1,
                label: {
                    show: true,
                    radius: 3/4,
                    formatter: labelFormatter,
                    background: {
                        opacity: 0.5,
                        color: '#000'
                    }
                }
            }
        },
        legend: {
            show: false
        }
    });
}

function labelFormatter(label, series) {
    return "<div style='font-size:8pt; text-align:center; padding:2px; color:white;'>" + label + "<br/>" + Math.round(series.percent) + "%</div>";
}
