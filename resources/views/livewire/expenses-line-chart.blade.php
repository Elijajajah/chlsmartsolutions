<div id="chart" wire:ignore x-data x-init="() => {
    const chartData = {{ Js::from($chartData) }};
    const now = new Date();
    const startOfMonth = new Date(now.getFullYear(), now.getMonth(), 1).getTime();
    const endOfMonth = new Date(now.getTime() + 24 * 60 * 60 * 1000).getTime();

    const options = {
        series: chartData,
        chart: {
            type: 'area',
            stacked: false,
            height: '100%',
            zoom: {
                type: 'x',
                enabled: true,
                autoScaleYaxis: true
            },
            toolbar: { show: false },
            fontFamily: 'poppins',
        },
        dataLabels: { enabled: false },
        markers: { size: 0 },
        title: {
            text: 'Expenses Over Time',
            align: 'left',
            style: {
                fontSize: '18px',
                fontWeight: 'bold',
                fontFamily: 'poppins'
            }
        },
        legend: { fontFamily: 'poppins' },
        fill: {
            type: 'gradient',
            gradient: {
                shadeIntensity: 1,
                inverseColors: false,
                opacityFrom: 0.5,
                opacityTo: 0,
                stops: [0, 90, 100]
            },
        },
        yaxis: {
            labels: {
                style: { fontFamily: 'poppins' },
                formatter: val => '₱' + val.toLocaleString('en-PH', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                }),
            },
        },
        xaxis: {
            type: 'datetime',
            min: startOfMonth,
            max: endOfMonth,
            labels: {
                style: { fontFamily: 'poppins' }
            }
        },
        tooltip: {
            shared: true,
            style: { fontFamily: 'poppins' },
            y: {
                formatter: val => '₱' + val.toLocaleString('en-PH', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                }),
            }
        }
    };

    const chart = new ApexCharts($el, options);
    chart.render();
}" class="bg-white font-poppins p-6 rounded-lg">
</div>
