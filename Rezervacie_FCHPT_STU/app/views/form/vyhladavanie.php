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
<hr>
<h3 class="text-center">Vyhľadávanie</h3>
<hr>
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
<script type="text/javascript" charset="utf-8">
	function init() {				
			init_kalendar();
		//scheduler.destroyCalendar();
	}
	function init_kalendar() {				
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
		
		admin = <?php if($this->user != null){ echo json_encode($this->user->admin); } else { echo json_encode(""); }?>;
		
		loguser =  <?php if($this->user != null){ echo json_encode($this->user->meno . " " . $this->user->priezvisko); } else { echo json_encode(""); }?>;	
		
		path = <?php echo json_encode("http://". DOMAIN."/".URL_BASE."/"); ?>;		
		
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

		miestnosti_php = <?php $mysql = new Connection(); $result = $mysql->getAllRooms();		
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
		
		miestnosti_splitter = miestnosti_php.split('#');		
		miestnosti = [];
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
		
		rezervacie_php = <?php 
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
		reze = [
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
		zobraz_rezervacie();							
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
	
	function showMiestnosti(){	
		var select = document.getElementById("miestnsoti_SELECT");				
		for(var t in miestnosti)
		{
			var option = document.createElement("option");
			option.text = miestnosti[t].label;
			option.val = miestnosti[t].key;
			select.add(option);		
		}
		setKalendarByMiestnosti();
	}
	
	function selectOptions(){		
		var box = document.getElementById('vyhladavanie_SELECT');
		var selected_value = box.options[box.selectedIndex].value;	
		var select = document.getElementById("miestnsoti_SELECT");			
		if(selected_value == "M"){
			showMiestnosti();	
			select.style.visibility = "";
			document.getElementById("vyhladavanie_TEXT").type = "hidden";
			document.getElementById("vyhladaj").type = "hidden";			
		}
		else{			
					
			var i;
			for(i=select.options.length-1;i>=0;i--)
			{
				select.remove(i);
			}
			select.style.visibility = "hidden";
			document.getElementById("vyhladavanie_TEXT").type = "text";
			document.getElementById("vyhladaj").type = "button";
			
			if(selected_value == "KLS")
			{
				showByKlucoveSlovo("");
			}
			if(selected_value == "U")
			{
				showByUcitel("");
			}			
		}
	}
	
	function setKalendarByMiestnosti(){
		var box = document.getElementById('miestnsoti_SELECT');
		var selected_value = box.options[box.selectedIndex].value;	
		var selected_miestnost = selected_value;
		
		reze = [
				];	
		for(var rez in rezervacie)
		{			
			if(rezervacie[rez]!="")
			{						
				var rezervacia = rezervacie[rez].split('|||');
				var miestnost_kap = rezervacia[10] + "(" + rezervacia[11] + ")";
				if(selected_miestnost == miestnost_kap)
				{
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
		}			
		zobraz_rezervacie();
	}	
	
	function showByKlucoveSlovo(klucove_slovo){		
		klucove_slovo = klucove_slovo.toLowerCase();
		reze = [
				];	
		for(var rez in rezervacie)
		{			
			if(rezervacie[rez]!="")
			{						
				var rezervacia = rezervacie[rez].split('|||');
				var ucel = rezervacia[12];
				ucel_LowerCase = ucel.toLowerCase();
				if(ucel_LowerCase.indexOf(klucove_slovo) > -1)
				{
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
		}	
		zobraz_rezervacie();
	}
	
	function showByUcitel(ucitel){		
		ucitel = ucitel.toLowerCase();
		reze = [
				];	
		for(var rez in rezervacie)
		{			
			if(rezervacie[rez]!="")
			{						
				var rezervacia = rezervacie[rez].split('|||');
				var Uzivatel = rezervacia[6] + " " + rezervacia[7];
				Uzivatel_LoverCase = Uzivatel.toLowerCase();				
				if(Uzivatel_LoverCase.indexOf(ucitel) > -1)
				{					
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
		}	
		zobraz_rezervacie();
	}
	function vyhladajFunction(){		
		var box = document.getElementById('vyhladavanie_SELECT');
		var selected_value = box.options[box.selectedIndex].value;		
		if(selected_value == "KLS"){
			showByKlucoveSlovo(document.getElementById("vyhladavanie_TEXT").value);
		}	
		if(selected_value == "U"){
			showByUcitel(document.getElementById("vyhladavanie_TEXT").value);
		}			
	}
	
	function zobraz_rezervacie(){
		scheduler.clearAll();
		if(reze.length == 0)
		{						
			document.getElementById("message1").innerHTML = "Nenašli sa žiadne rezervácie";
			document.getElementById("message2").innerHTML = "";	
			document.getElementById('Details').innerText = "";		
		}
		else
		{
			document.getElementById("message1").innerHTML = "";	
			document.getElementById("message2").innerHTML = "Počet nájdených rezervácií:" + reze.length;	
			document.getElementById('Details').innerText = "";					
		}
		scheduler.parse(reze,"json");			
	}
</script>	
<form role="form" class="form-horizontal">	
<div class="col-md-4"></div>
<div class="col-md-4">
<div class="form-group">
	<select class="form-control" id="vyhladavanie_SELECT" name="vyhladavanie_SELECT" onchange="selectOptions();">
		<option value="KLS">Podľa kľúčového slova</option>		
		<option value="M">Podľa miestnosti</option>
		<option value="U">Podľa učiteľa</option>
	</select>		
	<br />
	<input class="form-control" type="text" name="vyhladavanie_TEXT" id="vyhladavanie_TEXT"/>	
</div>
<div class="form-group">
	<input class="form-control input-lg btn-info" type="button" name="vyhladaj" id="vyhladaj" onclick="vyhladajFunction();" value="Vyhľadaj"/>	
	<select class="form-control" name="miestnsoti_SELECT" id="miestnsoti_SELECT" style="visibility:hidden;" onchange="setKalendarByMiestnosti();"></select>	
</div>
	<label class="control-label" id="Details"></label>
	<span style="color:red;" id="message1" style="float:right;"><?=$data['message']?></span>
	<span style="color:green;" id="message2" style="float:right;"><?=$data['message2']?></span>
</div>
<div class="col-md-4"></div>
</form>

<div id="scheduler_here" class="dhx_cal_container" style='width:100%; height:55%;'>
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

