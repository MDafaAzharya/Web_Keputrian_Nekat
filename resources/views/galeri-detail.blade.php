@extends('layouts.navbar')


@section('content')
  <section class="section-dr-py bg-body first-section-pt">
    <div class="container mt-2">
      <div class="row">
        <div class="col-lg-12">
          <div class="card px-3">
            <div class="card-body">
            @php
                // Convert the date string to a Carbon object
                $carbonDate = \Carbon\Carbon::parse($galeri->date);
            @endphp
            <h4 class="mt-3 mb-3 text-black">Dokumentasi {{ $galeri->jenis_kegiatan }} Di {{ $galeri->lokasi }}, {{ $galeri->keterangan }} <br> Tanggal {{  $carbonDate->format('d F Y')  }}</h4>
              <div class="row p-2 ">
                @if($galeri->image)
                @php
                $imagePaths = json_decode($galeri->image);
                @endphp

                @if(!empty($imagePaths))
                    @foreach($imagePaths as $imagePath)
                        <div class="mb-2 col-md-4 me-2">
                                <img src="{{ asset('assets/dataimage/' . $imagePath) }}" height="200" alt="" srcset="" data-bs-toggle="tooltip">
                        </div>
                    @endforeach
                @else
                    No Image
                @endif
                  @else
                      No Image
                  @endif
                   
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection


@section('script')
<script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
<script type="text/javascript">
    const expensesRadialChartEl = document.querySelector('#campaignChart'),
    supportTrackerOptions = {
      series: [85],
      labels: ['Dana Terkumpul'],
      chart: {
        height: 360,
        type: 'radialBar'
      },
      plotOptions: {
        radialBar: {
          offsetY: 10,
          startAngle: -140,
          endAngle: 130,
          hollow: {
            size: '65%'
          },
          track: {
            background: "#fff",
            strokeWidth: '100%'
          },
          dataLabels: {
            name: {
              offsetY: -20,
              color: "#5d596c",
              fontSize: '13px',
              fontWeight: '400',
              fontFamily: 'Public Sans'
            },
            value: {
              offsetY: 10,
              color: "#00a39d",
              fontSize: '38px',
              fontWeight: '500',
              fontFamily: 'Public Sans'
            }
          }
        }
      },
      colors: ["#f6ad3c"],
      fill: {
        type: 'gradient',
        gradient: {
          shade: 'dark',
          shadeIntensity: 0.5,
          gradientToColors: ["#f6ad3c"],
          inverseColors: true,
          opacityFrom: 1,
          opacityTo: 0.6,
          stops: [30, 70, 100]
        }
      },
      stroke: {
        dashArray: 10
      },
      grid: {
        padding: {
          top: -20,
          bottom: 5
        }
      },
      states: {
        hover: {
          filter: {
            type: 'none'
          }
        },
        active: {
          filter: {
            type: 'none'
          }
        }
      },
      responsive: [
        {
          breakpoint: 1025,
          options: {
            chart: {
              height: 330
            }
          }
        },
        {
          breakpoint: 769,
          options: {
            chart: {
              height: 280
            }
          }
        }
      ]
    };

  if (typeof expensesRadialChartEl !== undefined && expensesRadialChartEl !== null) {
    const expensesRadialChart = new ApexCharts(expensesRadialChartEl, supportTrackerOptions);
    expensesRadialChart.render();
  }
</script>
@endsection
