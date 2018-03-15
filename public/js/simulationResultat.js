/**
 * Created by jaysonkaced on 07/02/2018.
 */

$('document').ready(function() {

    $XEx = [0,1,2,3,4,5];
    $YEx = [0,1,2,3,4,5];
    $REx = tab;
    $BackgrEx = ["#ffffff", "#000000", "#ff5555", "#000000", "#ffffff" ];
    $labelEx = [];
    indice = 0;

    for(i = 0; i <= 5; i++) {
        for(j = 0; j <= 5; j++) {
            $labelEx.push(i+'-'+j);
        }
    }

    var options = {
        type: 'bubble',
        data: {
            datasets: [
            ]
        },
        options: {
            legend : { display: false },
            scales: {
                yAxes: [{
                    ticks: {
                        max: 5,
                        min: 0,
                        stepSize: 1
                    }
                }],
                xAxes: [{
                    ticks: {
                        max: 5,
                        min: 0,
                        stepSize: 1
                    }
                }]
            }
        }
    };

    while(indice <= 35) {
        for (y = 0; y <= 5; y++) {
            for (x = 0; x <= 5; x++) {
                $data = {
                    label: '',
                    data: [
                        {
                            x: 0,
                            y: 0,
                            r: 0
                        }
                    ],
                    backgroundColor: "",
                    hoverBackgroundColor: "#00ffff",
                    borderColor: "#00ffff"
                };

                $data.label = $labelEx[indice];
                $data.data[0].x = $XEx[x];
                $data.data[0].y = $YEx[y];
                $data.data[0].r = $REx[indice];

                indice++;
                options.data.datasets.push($data);
            }
        }
    }

    //console.log(options);

    var ctx = document.getElementById("myChart");
    var myChart = new Chart(ctx, options);
});