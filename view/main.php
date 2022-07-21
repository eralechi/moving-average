<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Простое скользящее среднее</title>
    </head>
    <body>

        <h2>Простое скользящее среднее <?=isset($actions[$action]) ? $actions[$action] : ''?></h2>
        <div class="actions">
            <?php
            foreach ($actions as $actionKey => $name) {?>
                <div><<?=$action == $actionKey ? 'span' : 'a'?> href="?action=<?=$actionKey?>"><?=$name?></<?=$action == $actionKey ? 'span' : 'a'?>></div>
            <?php
            }?>
        </div>

        <?php 
        if (!empty($chartValues)) {?>

            <form action="#myChart">
                <h4>Настройка ннтервала сглаживания</h4> 
                <input type="hidden" name="action" value="<?=$action?>">
                <label>
                    <input type="text" name="n" min="1" value="<?=$n?>">
                    <button>Применить</button>
                </label>
            </form>

            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>   
                var chart_colors=['red','blue'];
            </script>

            <div>
                <canvas id="myChart" style="width: 100%;"></canvas>
            </div>
            <script>
                myChartPlot(); 
                function myChartPlot(){
                    var defaultCanvasOptions = {
                        responsive: false,
                        fontFamily: "'OHelveticaNeueCyr', sans-serif",
                        title: {
                            display: true,
                            text: 'test',
                            fontFamily: "'HelveticaNeueCyr', sans-serif"
                        },
                        labels:{
                            fontFamily: "'HelveticaNeueCyr', sans-serif"
                        },
                        legend: {
                            labels: {
                                fontFamily: "'HelveticaNeueCyr', sans-serif",
                            },
                            layout:{
                                fontFamily: "'HelveticaNeueCyr', sans-serif",
                            }
                        }
                    };
                    
                    var labelsArray, dataSets;
                    try {
                        labelsArray = JSON.parse('<?=json_encode(array_values(array_map('strval', $labels)))?>');
                        console.log(labelsArray);
                    } catch (error) {
                        labelsArray = [];
                    }
                    try {
                        dataSets = JSON.parse('<?=json_encode($chartValues)?>');
                        console.log(dataSets);
                    } catch (error) {
                        dataSets = [];
                    }
                    
                    var ctx = document.getElementById('myChart').getContext('2d');
                    var datasets = [];
                    var iter = 0;
                    for (const [label, value] of Object.entries(dataSets)) {
                        var currentDataset = {
                            label: label,
                            fontFamily: "'HelveticaNeueCyr', sans-serif",
                            borderColor: chart_colors[iter]||'blue',
                            backgroundColor: chart_colors[iter]||'blue',
                            data: value,
                        };
                        iter++;
                        datasets.push(currentDataset);
                    }
                    var chart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: labelsArray,
                            datasets: datasets,
                        },
                        options: defaultCanvasOptions,
                    });
                }
            </script>
        <?php
        }?>

    </body>
</html>