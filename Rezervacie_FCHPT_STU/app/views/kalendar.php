<style media="screen">
	html, body {
		margin:0px;
		padding:0px;
		height:100%;
		overflow:hidden;
	}
	/* enabling marked timespans for month view */
	.dhx_scheduler_month .dhx_marked_timespan {
		display: block;
	}
	/* style to display special dates, e.g. holidays */
	.holiday {
		background-color: #fadcd3;
		text-align: center;
		font-size: 24px;
		opacity: 0.8;
		color: #e2b8ac;
	}
	/* if there are still pending tasks for some day */
	.pending {
		background: #fdffd3 url('data/imgs/!_yellow.png') no-repeat center center;
	}
	/* if all tasks for this day were completed */
	.completed {
		background: #d9f5db url('data/imgs/v_green.png') no-repeat center center;
	}
	/* we don't want to show that marked timespans on day and week views */
	.dhx_scheduler_day .pending, .dhx_scheduler_week .pending, .dhx_scheduler_day .completed, .dhx_scheduler_week .completed {
		display: none;
	}

</style>
<form method="post" action="" id="MAPA_FORM">
	<input id="ID_MAPA_SUBMIT" name="ID_MAPA_SUBMIT" type="hidden" value=""/>
	<input id="ID_Rezervacia_MAPA_SUBMIT" name="ID_Rezervacia_MAPA_SUBMIT" type="hidden" value="" />	
	<input id="Zaciatok_MAPA_SUBMIT" name="Zaciatok_MAPA_SUBMIT" type="hidden" value="" />	
	<input id="Koniec_MAPA_SUBMIT" name="Koniec_MAPA_SUBMIT" type="hidden" value="" />	
	<input id="Pocet_Osob_MAPA_SUBMIT" name="Pocet_Osob_MAPA_SUBMIT" type="hidden" value="" />	
	<input id="ID_Uzivatel_SUBMIT" name="ID_Uzivatel_SUBMIT" type="hidden" value="" />	
	<input id="ID_Miestnost_SUBMIT" name="ID_Miestnost_SUBMIT" type="hidden" value="" />	
	<input id="Ucel_SUBMIT" name="Ucel_SUBMIT" type="hidden" value="" />	
</form>
<form method="post" action="" id="MAPA_REZERVACIA_FORM_DELETE">
	<input id="ID_MAPA_SUBMIT_DELETE" name="ID_MAPA_SUBMIT_DELETE" type="hidden" value="" />	
	<input id="ID_REZERVACIA_SUBMIT_DELETE" name="ID_REZERVACIA_SUBMIT_DELETE" type="hidden" value="" />		
</form>
<input type="hidden" id="MaxRange" value="">
<label id="Details"></label>
<span style="color:red;"><?=$data['message']?></span>
<span style="color:green;"><?=$data['message2']?></span>
<script type="text/javascript" charset="utf-8">
	function init() {				
		scheduler.config.multi_day = false;		
		scheduler.config.drag_resize = false;
		scheduler.config.drag_move = false;
		scheduler.config.drag_create = false;
		scheduler.config.dblclick_create = false;
		scheduler.config.dblclick_create = false;	
		scheduler.config.cascade_event_display = true; // enable rendering, default value = false
        scheduler.config.cascade_event_count = 5; // how many events events will be displayed in cascade style (max), default value = 4
        scheduler.config.cascade_event_margin = 40; // margin between events, default value = 30		
		scheduler.config.xml_date="%Y-%m-%d %H:%i";			
		scheduler.templates.event_text=function(start,end,event){
			return "<b> "+event.miestnost_kapacita+"</b>,"+""+event.meno+" "+event.priezvisko+","+""+event.ucel;
		}		
		
		// Setting up holidays
		var holidays = [ ];
		for (var i=0; i<holidays.length; i++) {
			var date = holidays[i];
			var options = {
				start_date: date,
				end_date: scheduler.date.add(date, 1, "day"),
				type: "dhx_time_block", /* creating events on those dates will be disabled - dates are blocked */
				css: "holiday",
				html: "Holiday"
			};
			scheduler.addMarkedTimespan(options);
		}
		path = <?php echo json_encode("http://". DOMAIN."/".URL_BASE."/"); ?>;		
		var miestnosti_php = <?php $mysql = new Connection(); $result = $mysql->getAllRooms();		
			if($result == '')
			{
				echo json_encode("");				
			}
			else
			{
				$arr_length = count($result);
				$result_string = "";
				for($i=0; $i < $arr_length; $i++){
					$result_string = $result_string . $result[$i]['Nazov']. '|||' . $result[$i]['Kapacita'] . '|||' . $result[$i]['ID'] .'#';
				}
				echo json_encode($result_string);
			}
		?>;
		admin = <?php echo json_encode($this->user->admin);?>;
		
		loguser =  <?php echo json_encode($this->user->meno . " " . $this->user->priezvisko);?>;		
		//loguser = "Pavel Petrovic";
		
		var miestnosti_splitter = miestnosti_php.split('#');		
		var miestnosti = [];
		for(var t in miestnosti_splitter)
		{
			if(miestnosti_splitter[t]!="")
			{				
				var miestnost = miestnosti_splitter[t].split('|||');
				miestnosti.push({key:miestnost[0] + ":" + miestnost[2],label:miestnost[0] + "(" + miestnost[1] + ")"});
			}
		}
		
		scheduler.config.lightbox.sections = [
			{ name: "ID:", height: 50, type: "span", map_to: "ID"},		
			{ name: "Miestnost", height: 20, type:"select", options: miestnosti, map_to:"miestnost" },						
			{ name: "Uzivatel", height: 50, map_to: "uzivatel", type: "span"},						
			{ name: "Ucel", height: 50, map_to: "ucel", type: "textarea"},	
			{ name: "Pocet Osob", height: 20, map_to: "pocet_osob", type: "range"},				
			{ name: "Datum", height: 72, type: "time", map_to: "auto"}		
		];
		
		var rezervacie_php = <?php 
			$mysql = new Connection(); $result = $mysql->getRezervacie();		
			
			if($result == '')
			{
				echo json_encode("");				
			}
			else
			{
				$arr_length = count($result);
				
				$result_string = "";
				for($i=0; $i < $arr_length; $i++){
					$result_string = $result_string . $result[$i]['ID']. '|||'.$result[$i]['ID_Rezervacia']. '|||'.$result[$i]['Zaciatok']. '|||'.$result[$i]['Koniec']. '|||'.$result[$i]['Pocet_Osob']. '|||'
					.$result[$i]['ID_Uzivatel']. '|||' .$result[$i]['Meno']. '|||'.$result[$i]['Priezvisko']. '|||' .$result[$i]['login']. '|||' 
					.$result[$i]['ID_Miestnost']. '|||' .$result[$i]['Nazov']. '|||' .$result[$i]['Kapacita']. '|||' .$result[$i]['Ucel']. '#';
				}
				echo json_encode($result_string);
			}
		?>;				
		rezervacie = rezervacie_php.split('#');
		scheduler.init('scheduler_here', new Date(), "week");
		var reze = [
				];	
		for(var rez in rezervacie)
		{			
			if(rezervacie[rez]!="")
			{						
				var rezervacia = rezervacie[rez].split('|||');
				Uzivatel = rezervacia[6] + " " + rezervacia[7];
				TEXT = rezervacia[10] + ", " + Uzivatel + ", " + rezervacia[12];
				if(loguser == Uzivatel)
				{
					reze.push({start_date:rezervacia[2], end_date:rezervacia[3], ID:rez, meno:rezervacia[6], priezvisko:rezervacia[7], miestnost:rezervacia[10]+":"+rezervacia[9], uzivatel:rezervacia[8], pocet_osob:rezervacia[4], ucel:rezervacia[12], text:TEXT, miestnost_kapacita:rezervacia[10] + "(" + rezervacia[11] + ")" ,kapacita:rezervacie[11], color:"green"});
				}
				else
				{
					reze.push({start_date:rezervacia[2], end_date:rezervacia[3], ID:rez[0], meno:rezervacia[6], priezvisko:rezervacia[7], miestnost:rezervacia[10]+":"+rezervacia[9], uzivatel:rezervacia[8], pocet_osob:rezervacia[4], ucel:rezervacia[12], miestnost_kapacita:rezervacia[10] + "(" + rezervacia[11] + ")" ,kapacita:rezervacie[11], text:TEXT});
				}
			}
		}							
		scheduler.parse(reze,"json");								
	}
	
	function show_minical(){
		if (scheduler.isCalendarVisible())
			scheduler.destroyCalendar();
		else
			scheduler.renderCalendar({
				position:"dhx_minical_icon",
				date:scheduler._date,
				navigation:true,
				handler:function(date,calendar){
					scheduler.setCurrentView(date);
					scheduler.destroyCalendar()
				}
			});
	}
</script>
<div id="scheduler_here" class="dhx_cal_container" style='width:100%; height:100%;'>
  <div class="dhx_cal_navline">
   <div class="dhx_cal_prev_button">&nbsp;</div>
	 <div class="dhx_cal_next_button">&nbsp;</div>
	 <div class="dhx_cal_today_button"></div>
	 <div class="dhx_cal_date"></div>
	 <div class="dhx_minical_icon" id="dhx_minical_icon" onclick="show_minical()">&nbsp;</div>
	 <div class="dhx_cal_tab" name="day_tab" style="right:204px;"></div>
	 <div class="dhx_cal_tab" name="week_tab" style="right:140px;"></div>
	 <div class="dhx_cal_tab" name="month_tab" style="right:76px;"></div>	
	 <div class="dhx_cal_tab" name="Podrobnosti" style="width:100px;"></div>		 
  </div>
  <div class="dhx_cal_header">
  </div>
  <div class="dhx_cal_data">
  </div>
</div>