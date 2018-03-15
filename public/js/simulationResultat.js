/**
 * Created by jaysonkaced on 07/02/2018.
 */

$('document').ready(function() {

    var ctx = document.getElementById("myChart");
    var myChart = new Chart(ctx, {
        type: 'bubble',
        data: {
            datasets: [
                {
                    label: '0-0',
                    data: [
                        {
                            x: 0,
                            y: 0,
                            r: 10
                        },
                        {
                            x: 0,
                            y: 1,
                            r: 10
                        },
                        {
                            x: 0,
                            y: 2,
                            r: 10
                        },
                        {
                            x: 0,
                            y: 3,
                            r: 10
                        },
                        {
                            x: 0,
                            y: 4,
                            r: 10
                        },
                        {
                            x: 0,
                            y: 5,
                            r: 10
                        }
                    ],
                    backgroundColor:"#00ffff"
                }
            ]
        },
        options : {
            legend: {
                display: false
            }
        }
    });
});