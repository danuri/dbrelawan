<?= $this->extend('template') ?>

<?= $this->section('content') ?>
<div class="row">
  <div class="col-12">
    <div class="card rounded-0 bg-danger-subtle mx-n4 mt-n4 border-top">
      <div class="px-4">
        <div class="row">
          <div class="col-xxl-5 align-self-center">
            <div class="py-4">
              <h5 class="display-8 kota-text">Kota Bengkulu</h5>
              <h4 class="display-4 coming-soon-text">Berani Juara</h4>
            </div>
          </div>
          <div class="col-xxl-3 ms-auto">
            <div class="mb-n5 pb-1 faq-img d-xxl-block">
              <img src="assets/images/calon/dedyagi.png" alt="" class="img-fluid">
            </div>
          </div>
        </div>
      </div>
      <!-- end card body -->
    </div>
    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
      <h4 class="mb-sm-0">Dashboard</h4>

      <div class="page-title-right">
        <ol class="breadcrumb m-0">
          <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </div>

    </div>
  </div>
</div>

<div class="row">
  <div class="col-xl-5">
    <div class="card card-animate overflow-hidden">
      <div class="position-absolute start-0" style="z-index: 0;">
        <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 120" width="200" height="120">
          <style>
          .s0 {
            opacity: .05;
            fill: var(--vz-success)
          }
          </style>
          <path id="Shape 8" class="s0" d="m189.5-25.8c0 0 20.1 46.2-26.7 71.4 0 0-60 15.4-62.3 65.3-2.2 49.8-50.6 59.3-57.8 61.5-7.2 2.3-60.8 0-60.8 0l-11.9-199.4z" />
        </svg>
      </div>
      <div class="card-body" style="z-index:1 ;">
        <div class="card-body" style="z-index:1 ;">
            <div class="d-flex align-items-center">
                <div class="flex-grow-1 overflow-hidden">
                    <p class="text-uppercase fw-medium text-muted text-truncate mb-3"> Jumlah Relawan</p>
                    <h4 class="fs-22 fw-semibold ff-secondary mb-0"><span class="counter-value" data-target="<?= $total?>">0</span></h4>
                </div>
                <div class="flex-shrink-0">
                    <div id="progreschart" data-colors='["--vz-danger"]' class="apex-charts" dir="ltr"></div>
                </div>
            </div>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-header align-items-center d-flex">
        <h4 class="card-title mb-0 flex-grow-1">Progres Relawan</h4>
        <div class="flex-shrink-0">
        </div>
      </div><!-- end card header -->
      <div class="card-body">
        <div class="table-responsive table-card">
          <table class="table align-middle table-borderless table-centered table-nowrap mb-0">
            <thead class="text-muted table-light">
              <tr>
                <th scope="col" style="width: 62;">Jenjang</th>
                <th scope="col">Target</th>
                <th scope="col">Data Masuk</th>
                <th scope="col">Progres</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  <a href="javascript:void(0);">Koordinator Kecamatan</a>
                </td>
                <td>9</td>
                <td><?= $jkorcam?></td>
                <td><?= shortdec(($jkorcam/9)*100)?>%</td>
              </tr>
              <tr>
                <td>
                  <a href="javascript:void(0);">Koordinator Kelurahan</a>
                </td>
                <td>67</td>
                <td><?= $jkorkel?></td>
                <td><?= shortdec(($jkorkel/67)*100)?>%</td>
              </tr>
              <tr>
                <td>
                  <a href="javascript:void(0);">Koordinator RT</a>
                </td>
                <td>1.273</td>
                <td><?= $jkorrt?></td>
                <td><?= shortdec(($jkorrt/1273)*100)?>%</td>
              </tr>
              <tr>
                <td>
                  <a href="javascript:void(0);">Relawan RT</a>
                </td>
                <td>20.368</td>
                <td><?= $jrelawan?></td>
                <td><?= shortdec(($jrelawan/20368)*100)?>%</td>
              </tr>
            </tbody>
          </table><!-- end table -->
        </div><!-- end -->
      </div><!-- end cardbody -->
    </div>
  </div>
  <div class="col-xl-7">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title mb-0">Grafik Relawan Berdasarkan Kecamatan</h4>
      </div>

      <div class="card-body">
        <div id="bar_chart" data-colors='["--vz-success"]' class="apex-charts" dir="ltr"></div>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script src="<?= base_url()?>assets/libs/apexcharts/apexcharts.min.js"></script>
<script>
<?php
$progres = ($total/getenv('relawan.total'))*100;
?>
var options = {
  series:[<?= shortdec($progres)?>],
  chart:{
    type:"radialBar",
    width:105,
    sparkline:{enabled:!0}},
    dataLabels:{enabled:!1},
    plotOptions:{
      radialBar:{
        hollow:{
          margin:0,size:"70%"
        },
        track:{
          margin:1
        },
        dataLabels:{
          show:!0,name:{
            show:!1
          },
          value:{
            show:!0,fontSize:"16px",fontWeight:600,offsetY:8
          }
        }
      }
    }
  };

var chart = new ApexCharts(document.querySelector("#progreschart"), options);
chart.render();

var options = {
  series: [{
    name: 'Jaringan',
    data: [<?php foreach ($gkecamatan as $row) {
      echo $row->jumlah.',';
    }?>]
  }],
  annotations: {
    points: [{
      x: 'Bananas',
      seriesIndex: 0,
      label: {
        borderColor: '#775DD0',
        offsetY: 0,
        style: {
          color: '#fff',
          background: '#775DD0',
        },
        text: 'Bananas are good',
      }
    }]
  },
  chart: {
    height: 350,
    type: 'bar',
  },
  plotOptions: {
    bar: {
      borderRadius: 10,
      columnWidth: '50%',
    }
  },
  dataLabels: {
    enabled: false
  },
  stroke: {
    width: 0
  },
  grid: {
    row: {
      colors: ['#fff', '#f2f2f2']
    }
  },
  xaxis: {
    labels: {
      rotate: -45
    },
    categories: [<?php foreach ($gkecamatan as $row) {
      echo "'".$row->nama_wilayah."',";
    }?>
  ],
  tickPlacement: 'on'
},
yaxis: {
  title: {
    text: 'Jumlah Jaringan',
  },
},
fill: {
  type: 'gradient',
  gradient: {
    shade: 'light',
    type: "horizontal",
    shadeIntensity: 0.25,
    gradientToColors: undefined,
    inverseColors: true,
    opacityFrom: 0.85,
    opacityTo: 0.85,
    stops: [50, 0, 100]
  },
}
};

var chart = new ApexCharts(document.querySelector("#bar_chart"), options);
chart.render();
</script>
<?= $this->endSection() ?>
