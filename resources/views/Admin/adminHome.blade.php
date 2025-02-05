

@extends('kerangka.master')

@section('content')
    <div class="page-content"> 
    <section class="row">
        <div class="col-12 col-lg-9">
    
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Pendaftaran Alumni (7 Hari Terakhir)</h4>
                        </div>
                        <div class="card-body">
                            <div id="chart-profile-visit"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-3">
            <div class="card">
                <div class="card-body py-4 px-4">
                    <div class="d-flex align-items-center">
                        <div class="avatar avatar-xl">
                        <img class="rounded-circle" 
                                 src="{{ Auth::user()->avatar ? '/avatars/'.Auth::user()->avatar : asset('/images/images.png') }}"
                                 style="width: 40px; height: 40px; object-fit: cover;">
                        </div>
                        <div class="ms-3 name">
                            <h5 class="font-bold">{{ Auth::user()->name }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection

@push('scripts')
<script>
    var optionsProfileVisit = {
        annotations: {
            position: 'back'
        },
        dataLabels: {
            enabled: false
        },
        chart: {
            type: 'bar',
            height: 300
        },
        fill: {
            opacity: 1
        },
        plotOptions: {},
        series: [{
            name: 'Pendaftaran',
            data: @json($lastSevenDays->pluck('count'))
        }],
        colors: '#435ebe',
        xaxis: {
            categories: @json($lastSevenDays->pluck('label')),
            labels: {
                style: {
                    colors: '#9aa0ac',
                }
            }
        },
        yaxis: {
            labels: {
                style: {
                    colors: '#9aa0ac',
                }
            }
        }
    }

    var chartProfileVisit = new ApexCharts(document.querySelector("#chart-profile-visit"), optionsProfileVisit);
    chartProfileVisit.render();
</script>
@endpush