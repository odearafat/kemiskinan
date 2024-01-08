@extends('layout.main')
@section('container')


<script src="https://code.highcharts.com/maps/highmaps.js"></script>
<script src="https://code.highcharts.com/maps/modules/data.js"></script>
<script src="https://code.highcharts.com/maps/modules/data.js"></script>
<script src="https://code.highcharts.com/maps/modules/exporting.js"></script>
<script src="https://code.highcharts.com/maps/modules/offline-exporting.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script src="https://code.highcharts.com/highcharts-3d.js"></script>


<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<div class="alert alert-danger d-flex align-items-center" role="alert">
    {{-- <svg class="bi flex-shrink-0 me-2" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg> --}}
    <div>
        <h3>Selamat Datang di <b><i>Poverty Geographic Information System</b> </i></h3>
        <hr>
        <p class="mb-0">Pada laman ini disajikan informasi berupa data spasial/kewilayahan khususnya berkaitan dengan kemiskinan di 
            Provinsi Jawa Timur dari semua level wilayah mulai Kabupaten/Kota, Kecamatan, Desa. Data bersumber dari hasil Regsosek 2022.
        </p>

    </div>
  </div>
    <div class="row">
        <div class="col-sm-3 mb-3 mb-sm-0">
            <div class="card text-center">
                <h5 class="card-header">Pilih Wilayah</h5>
                <div class="card-body">
                    <form action="pilihWilayah" method="POST">
                        @csrf
                        <div class="form-floating">
                            <select name="kabkot" id="kabkot" class="form-select form-select-md mb-3" aria-label=".form-select-lg example">
                                <option selected value="0">Semua Kabupaten/Kota</option>
                                @if(@isset($kabkotselected))
                                    @foreach($kabkots as $kabkot)
                                        @if($kabkot->idkabkot==$kabkotselected)
                                            <option value="{{$kabkot->idkabkot }}" selected>{{$kabkot->namakabkot }}</option>
                                        @else
                                            <option value="{{$kabkot->idkabkot }}">{{$kabkot->namakabkot }}</option>
                                        @endif
                                    @endforeach
                                @else
                                    @foreach($kabkots as $kabkot)
                                        <option value="{{ $kabkot->idkabkot }}">{{$kabkot->namakabkot }}</option>
                                    @endforeach
                                @endif
                                
                                
                            </select>
                            <label for="floatingselect">Pilih Kabupaten/Kota</label>
                        </div>
                        <div class="form-floating">
                                @if(@isset($kecamatans))
                                    <select  id="kecamatan" name="kecamatan" class="form-select form-select-md mb-3" aria-label=".form-select-lg example">
                                        <option value="0">Semua Kecamatan</option>
                                    @foreach($kecamatans as $kecamatan)
                                        @if ($kecamatan->idkecamatan==$kecselected)
                                            <option selected value="{{ $kecamatan->idkecamatan  }}">{{$kecamatan->namakecamatan }}</option>
                                        @else
                                            <option value="{{ $kecamatan->idkecamatan  }}">{{$kecamatan->namakecamatan }}</option>
                                        @endif
                                    @endforeach
                                @else
                                    <select  disabled id="kecamatan" name="kecamatan" class="form-select form-select-md mb-3" aria-label=".form-select-lg example">
                                        <option selected value="0">Semua Kecamatan</option>
                                @endif
                            </select>
                            <label for="floatingselect">Pilih Kecamatan</label>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-danger btn-md">Pilih</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-sm-9" >
            <div class="card" >
                <div class="card-body">
                    {{-- <p class="card-text">With supporting text below as a natural lead-in to additional content.</p> --}}
                    <div id="bb" style="width: 100%;height:600px;"></div>
                    {{-- <div id="tematic_map_pertumbuhan_ekonomi" style="margin-top: 5px;"></div> --}}
                </div>
            </div>
        </div>
        
    <div><p>
        {{-- @foreach ($kabkots as $kabkot)
            <b>{{$kabkot->idkabkot}}</b>        {{$kabkot->namakabkot }}</p>
        @endforeach --}}
    </div>

<script type="text/javascript">
    $(document).ready(function () {
        $('#kabkot').on('change', function () {
            var idKabkot = this.value;
            $('#kecamatan').html('');
            $('#kecamatan').removeAttr('disabled');
            $('#kecamatan').attr('name','kecamatan');
            $.ajax({
                url: '{{ route('kecamatan') }}?idkabkot='+idKabkot,
                type: 'get',
                success: function (res) {
                    $('#kecamatan').html('<option value="0">Semua Kecamatan</option>');
                     $.each(res, function (key, value) {
                         $('#kecamatan').append('<option value="' + value
                             .idkecamatan + '">' + value.namakecamatan + '</option>');
                     });
                     //$('#city').html('<option value="">Select City</option>');
                }
            });
        });
    });
</script>

<script type="text/javascript">

var chartDom = document.getElementById('bb');
var myChart = echarts.init(chartDom);
var option;

myChart.showLoading();
$.get('map/{{ $peta }}.geojson', function (usaJson) {
  myChart.hideLoading();

  //const projection = d3.geoProjection();

  echarts.registerMap('USAS', usaJson, {
    
  });

  option = {
    title: {
      text: 'Sebaran Kemiskinan {{ ucwords($judulPeta) }} Menurut Desa',
      subtext: 'Sumber : Hasil FKP Regsosek 2022',
      sublink: 'http://www.census.gov/popest/data/datasets.html',
      left: 'right'
    },

    tooltip: {
      trigger: 'item',
      showDelay: 0,
      transitionDuration: 0.2,
      formatter: function (params) {
          var tip = `
        <b> ID Desa ${params.name}</b></br>`;
          for (var key of Object.keys(params.data)) {
            if (key != 'name' & key != 'value') {
              tip = tip + `
          ${key} : ${params.data[key]} <br />`
            }
          }
          return tip
        }
    },

    visualMap: {
      left: 'right',
      min: {{ $min }},
      max: {{ $max }},
      inRange: {
        color: [
          '#313695',
          '#4575b4',
          '#74add1',
          '#abd9e9',
          '#e0f3f8',
          '#ffffbf',
          '#fee090',
          '#fdae61',
          '#f46d43',
          '#d73027',
          '#a50026'
        ]
      },
      text: ['Tinggi', 'Rendah'],
      calculable: true
    },

    toolbox: {
      show: true,
      //orient: 'vertical',
      left: 'left',
      top: 'top',
      feature: {
        dataView: { readOnly: false },
        restore: {},
        saveAsImage: {}
      }
    },

    series: [
      {
        name: 'Jumlah Penduduk Miskin',
        type: 'map',
        roam: true,
        map: 'USAS',
        //projection: {
            // We still need project and unproject when stream is provided.
            //project: (point) => projection(point),
            //unproject: (point) => projection.invert(point)
            // We can directly use the stream method in d3 projection.
        //stream: projection.stream
        //},
        emphasis: {
          label: {
            show: true
          }
        },
        data: @json($data)

      }
    ]
  };
  myChart.setOption(option);
});    
    
</script>
@endsection