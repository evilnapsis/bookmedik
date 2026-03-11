<?php
$thejson=null;
$events = ReservationData::getEvery();
foreach($events as $event){
	$thejson[] = array("title"=>$event->title,"url"=>"./?view=reservations&opt=edit&id=".$event->id,"start"=>$event->date_at."T".$event->time_at);
}
?>
<script>
	$(document).ready(function() {

		$('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
			defaultDate: '<?php echo date('Y-m-d');?>',
			editable: false,
			eventLimit: true, // allow "more" link when too many events
			events: <?php echo json_encode($thejson); ?>,
			monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
			monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
			dayNames: ['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'],
			dayNamesShort: ['Dom','Lun','Mar','Mié','Jue','Vie','Sáb'],
			buttonText: {
				today: 'hoy',
				month: 'mes',
				week: 'semana',
				day: 'día'
			}
		});
		
	});

</script>

          <div class="row">
            <div class="col-sm-6 col-lg-3">
              <div class="card mb-4 text-white bg-primary">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                  <div>
                    <div class="fs-4 fw-semibold"><?php echo count(MedicData::getAll()); ?> </div>
                    <div>Medicos</div>
                  </div>
                </div>
                <br>

              </div>
            </div>
            <div class="col-sm-6 col-lg-3">
              <div class="card mb-4 text-white bg-info">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                  <div>
                    <div class="fs-4 fw-semibold"><?php echo count(PacientData::getAll()); ?> </div>
                    <div>Pacientes</div>
                  </div>
                </div>
                <br>

              </div>
            </div>
            <!-- /.col-->
            <div class="col-sm-6 col-lg-3">
              <div class="card mb-4 text-white bg-warning">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                  <div>
                    <div class="fs-4 fw-semibold"><?php echo count(ReservationData::getAll()); ?> </div>
                    <div>Citas Ativas</div>
                  </div>
                </div>
                <br>

              </div>
            </div>
            <!-- /.col-->
            <div class="col-sm-6 col-lg-3">
              <div class="card mb-4 text-white bg-success">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                  <div>
                    <div class="fs-4 fw-semibold"><?php echo count(ReservationData::getOld());?></div>
                    <div>Citas Anteriores</div>
                  </div>
                </div>
                <br>

              </div>
            </div>
            <!-- /.col-->
          </div>




            <div class="row">

            <div class="col-md-12">
              <div class="card mb-4">
                <div class="card-header">Calendario de Citas</div>
                <div class="card-body">
                  <div id="calendar"></div>

                </div>
              </div>
            </div>
            <!-- /.col-->
          </div>