@extends('layouts.main')

@section('content')
    <div class="container">
        <div id="product-chart"></div>
    </div>
@endsection

@section('additional-js')
    <script>
        (function () {
            let chartElem = document.querySelector('#product-chart')
            let chartSeries = { label: 'Product', data: [] }
            let chartLabels = []

            @foreach ($products as $product)
                chartSeries.data.push({{ $product->price }})
                chartLabels.push('{{ $product->name }}')
            @endforeach

            let options = {
                chart: { type: 'line' },
                series: [chartSeries],
                xaxis: {
                    categories: chartLabels
                }
            }

            const chart = new ApexCharts(chartElem, options)
            chart.render()
        })()
    </script>
@endsection
