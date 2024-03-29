/*global $, document, LINECHARTEXMPLE*/
$(document).ready(function () {
    'use strict';

    var accepted_color = 'rgba(51, 179, 90, 1)';
    var waited_color = 'rgb(240, 173, 78, 1)';
    var inaccepted_color = 'rgba(204, 51, 0, 1)';

    var PIECHARTEXMPLE    = $('#pieChartExample');


    var pieChartExample = new Chart(PIECHARTEXMPLE, {
        type: 'doughnut',
        data: {
            labels: [
                "Accepté",
                "En attente",
                "Non accepté"
            ],
            datasets: [
                {
                    data: [accepted, waited, rejected],
                    borderWidth: [1, 1, 1],
                    backgroundColor: [
                        accepted_color,
                        waited_color,
                        inaccepted_color
                    ],
                    hoverBackgroundColor: [
                        accepted_color,
                        waited_color,
                        inaccepted_color
                    ]
                }]
            }
    });

    var pieChartExample = {
        responsive: true
    };

});
