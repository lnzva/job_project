<html>
<head>
	<style type="text/css">
		@import url('https://fonts.googleapis.com/css?family=Raleway:100,200,300,400,600');
		@import url('https://fonts.googleapis.com/css?family=Roboto:300');
		body {
			background-color: black;
		}
		#information {
			margin-top: 80px;
			color: white;
			font-family: 'Raleway', sans-serif;
			font-weight: 300;
			font-size: 20px;
		}
		#Name {
			border-radius: 5px;
			font-size: 17px;
			font-family: 'Raleway', sans-serif;
			font-weight: 300;
		}
		#Salary {
			border-radius: 5px;
			font-size: 17px;
			font-family: 'Raleway', sans-serif;
			font-weight: 300;
		}
		#Exam_Minute_Duration {
			border-radius: 5px;
			font-size: 17px;
			font-family: 'Raleway', sans-serif;
			font-weight: 300;
		}
		#Description {
			display: inline-block;
			box-sizing: border-box;
			border-radius: 5px;
			font-size: 17px;
			font-family: 'Raleway', sans-serif;
			font-weight: 300;
			box-sizing: border-box;
		}
		#FormFields {
			color: white;
		}
		select {
			font-family: 'Raleway', sans-serif;
			font-size: 17px;
			padding: 1px 1px;
			border-radius: 5px;
			background-color: white;
		}
		input[type="submit"] {
		}

	</style>
</head>
<body>
	<script type="text/javascript">
		var numDays = {
                '1': 31, '2': 28, '3': 31, '4': 30, '5': 31, '6': 30,
                '7': 31, '8': 31, '9': 30, '10': 31, '11': 30, '12': 31
              };

		function setDays(oMonthSel, oDaysSel, oYearSel) {
			var nDays, oDaysSelLgth, opt, i = 1;
			nDays = numDays[oMonthSel[oMonthSel.selectedIndex].value];
			if (nDays == 28 && oYearSel[oYearSel.selectedIndex].value % 4 == 0)
				++nDays;
			oDaysSelLgth = oDaysSel.length;
			if (nDays != oDaysSelLgth) {
				if (nDays < oDaysSelLgth)
					oDaysSel.length = nDays;
				else
					for (i; i < nDays - oDaysSelLgth + 1; i++) {
					opt = new Option(oDaysSelLgth + i, oDaysSelLgth + i);
		                  	oDaysSel.options[oDaysSel.length] = opt;
					}
			}
			var oForm = oMonthSel.form;
			var month = oMonthSel.options[oMonthSel.selectedIndex].value;
			var day = oDaysSel.options[oDaysSel.selectedIndex].value;
			var year = oYearSel.options[oYearSel.selectedIndex].value;
		}

		function BuildFormFields($amount) {
			var
					$container = document.getElementById('FormFields'),
					$item, $field, $i;
			$container.innerHTML = '';$field = document.createElement('select')
			$item = document.createElement('div');
			$field = document.createElement('select');
			for ($i = 0; $i < 24; ++$i) {
				$field2 = document.createElement('option');

			}
			for ($i = 0; $i < $amount; $i++) {
				$item = document.createElement('div');


				$field = document.createElement('span');
				$field.innerHTML = 'Option 1:';
				$item.appendChild($field);
				$field = document.createElement('input');
				$field.name = 'Option1[' + $i + ']';
				$field.type = 'text';
				$item.appendChild($field);

				$field = document.createElement('span');
				$field.innerHTML = 'Question:';
				$item.appendChild($field);
				$field = document.createElement('input');
				$field.name = 'Question[' + $i + ']';
				$field.type = 'text';
				$item.appendChild($field);


				$field = document.createElement('span');
				$field.innerHTML = 'Option 2:';
				$item.appendChild($field);
				$field = document.createElement('input');
				$field.name = 'Option2[' + $i + ']';
				$field.type = 'text';
				$item.appendChild($field);

				$field = document.createElement('span');
				$field.innerHTML = 'Option 3:';
				$item.appendChild($field);
				$field = document.createElement('input');
				$field.name = 'Option3[' + $i + ']';
				$field.type = 'text';
				$item.appendChild($field);

				$field = document.createElement('span');
				$field.innerHTML = 'Option 4:';
				$item.appendChild($field);
				$field = document.createElement('input');
				$field.name = 'Option4[' + $i + ']';
				$field.type = 'text';
				$item.appendChild($field);

				$field = document.createElement('span');
				$field.innerHTML = 'Correct';
				$item.appendChild($field);
				$field = document.createElement('select');
				$field.name = 'Correct[' + $i + ']';
				$field2 = document.createElement('option');
				$field2.value = "1";
				$field2.innerHTML = "1";
				$field.appendChild($field2);
				$field2 = document.createElement('option');
				$field2.value = "2";
				$field2.innerHTML = "2";
				$field.appendChild($field2);
				$field2 = document.createElement('option');
				$field2.value = "3";
				$field2.innerHTML = "3";
				$field.appendChild($field2);
				$field2 = document.createElement('option');
				$field2.value = "4";
				$field2.innerHTML = "4";
				$field.appendChild($field2);

				$item.appendChild($field);


				$container.appendChild($item);
			}
		}
	</script>
	<div id = information>
		<form action = "make_job_posting.php" method = "post">
			Job Title: <br><input type="text" name = "Name" id = "Name"><br><br>
			Minimum Qualification:<br>
			<select name="MinQuali">
				<option value="1">School</option>
				<option value="2">High School</option>
				<option value="3">BSc</option>
				<option value="4">MSc</option>
				<option value="5">PhD</option>
			</select>
			<br>
			Field:<br>
			<select name="Field">
				<option value="1">Computer Science</option>
				<option value="2">Electrical Engineering</option>
				<option value="3">Mechanical Engineering</option>
				<option value="4">Civil Engineering</option>
				<option value="5">URP</option>
			</select>
			<br>
			<br>

			Salary: <br>
			<input type = "text" name = "Salary" id = "Salary"><br><br>

			Application Deadline:<br>
			<select name="dhour" id = "dhour">
				<option value="00">00</option>
				<option value="01">01</option>
				<option value="02">02</option>
				<option value="03">03</option>
				<option value="04">04</option>
				<option value="05">05</option>
				<option value="06">06</option>
				<option value="07">07</option>
				<option value="08">08</option>
				<option value="09">09</option>
				<option value="10">10</option>
				<option value="11">11</option>
				<option value="12">12</option>
				<option value="13">13</option>
				<option value="14">14</option>
				<option value="15">15</option>
				<option value="16">16</option>
				<option value="17">17</option>
				<option value="18">18</option>
				<option value="19">19</option>
				<option value="20">20</option>
				<option value="21">21</option>
				<option value="22">22</option>
				<option value="23">23</option>
			</select> : 
			<select name="dminute" id = "dhour">
				<option value="00">00</option>
				<option value="01">01</option>
				<option value="02">02</option>
				<option value="03">03</option>
				<option value="04">04</option>
				<option value="05">05</option>
				<option value="06">06</option>
				<option value="07">07</option>
				<option value="08">08</option>
				<option value="09">09</option>
				<option value="10">10</option>
				<option value="11">11</option>
				<option value="12">12</option>
				<option value="13">13</option>
				<option value="14">14</option>
				<option value="15">15</option>
				<option value="16">16</option>
				<option value="17">17</option>
				<option value="18">18</option>
				<option value="19">19</option>
				<option value="20">20</option>
				<option value="21">21</option>
				<option value="22">22</option>
				<option value="23">23</option>
				<option value="24">24</option>
				<option value="25">25</option>
				<option value="26">26</option>
				<option value="27">27</option>
				<option value="28">28</option>
				<option value="29">29</option>
				<option value="30">30</option>
				<option value="31">31</option>
				<option value="32">32</option>
				<option value="33">33</option>
				<option value="34">34</option>
				<option value="35">35</option>
				<option value="36">36</option>
				<option value="37">37</option>
				<option value="38">38</option>
				<option value="39">39</option>
				<option value="40">40</option>
				<option value="41">41</option>
				<option value="42">42</option>
				<option value="43">43</option>
				<option value="44">44</option>
				<option value="45">45</option>
				<option value="46">46</option>
				<option value="47">47</option>
				<option value="48">48</option>
				<option value="49">49</option>
				<option value="50">50</option>
				<option value="51">51</option>
				<option value="52">52</option>
				<option value="53">53</option>
				<option value="54">54</option>
				<option value="55">55</option>
				<option value="56">56</option>
				<option value="57">57</option>
				<option value="58">58</option>
				<option value="59">59</option>
			</select>
			<select name="dmonth" id="dmonth" onchange="setDays(this,dday,dyear)">
				<option value="1">January</option>
				<option value="2">February</option>
				<option value="3">March</option>
				<option value="4">April</option>
				<option value="5">May</option>
				<option value="6">June</option>
				<option value="7">July</option>
				<option value="8">August</option>
				<option value="9">September</option>
				<option value="10">October</option>
				<option value="11">November</option>
				<option value="12">December</option>
			</select>
			<select name="dday" id="dday" onchange="setDays(dmonth,this,dyear)">
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				<option value="5">5</option>
				<option value="6">6</option>
				<option value="7">7</option>
				<option value="8">8</option>
				<option value="9">9</option>
				<option value="10">10</option>
				<option value="11">11</option>
				<option value="12">12</option>
				<option value="13">13</option>
				<option value="14">14</option>
				<option value="15">15</option>
				<option value="16">16</option>
				<option value="17">17</option>
				<option value="18">18</option>
				<option value="19">19</option>
				<option value="20">20</option>
				<option value="21">21</option>
				<option value="22">22</option>
				<option value="23">23</option>
				<option value="24">24</option>
				<option value="25">25</option>
				<option value="26">26</option>
				<option value="27">27</option>
				<option value="28">28</option>
				<option value="29">29</option>
				<option value="30">30</option>
				<option value="31">31</option>
			</select>
			<select name="dyear" id="dyear" onchange="setDays(dmonth,dday,this)">
				<option value="2017">2017</option>
				<option value="2018">2018</option>
				<option value="2019">2019</option>
				<option value="2020">2020</option>
			</select>
			<br>
			<br>
			Exam Time <br>
			<select name="ehour" id = "dhour">
				<option value="00">00</option>
				<option value="01">01</option>
				<option value="02">02</option>
				<option value="03">03</option>
				<option value="04">04</option>
				<option value="05">05</option>
				<option value="06">06</option>
				<option value="07">07</option>
				<option value="08">08</option>
				<option value="09">09</option>
				<option value="10">10</option>
				<option value="11">11</option>
				<option value="12">12</option>
				<option value="13">13</option>
				<option value="14">14</option>
				<option value="15">15</option>
				<option value="16">16</option>
				<option value="17">17</option>
				<option value="18">18</option>
				<option value="19">19</option>
				<option value="20">20</option>
				<option value="21">21</option>
				<option value="22">22</option>
				<option value="23">23</option>
			</select> : 
			<select name="eminute" id = "dhour">
				<option value="00">00</option>
				<option value="01">01</option>
				<option value="02">02</option>
				<option value="03">03</option>
				<option value="04">04</option>
				<option value="05">05</option>
				<option value="06">06</option>
				<option value="07">07</option>
				<option value="08">08</option>
				<option value="09">09</option>
				<option value="10">10</option>
				<option value="11">11</option>
				<option value="12">12</option>
				<option value="13">13</option>
				<option value="14">14</option>
				<option value="15">15</option>
				<option value="16">16</option>
				<option value="17">17</option>
				<option value="18">18</option>
				<option value="19">19</option>
				<option value="20">20</option>
				<option value="21">21</option>
				<option value="22">22</option>
				<option value="23">23</option>
				<option value="24">24</option>
				<option value="25">25</option>
				<option value="26">26</option>
				<option value="27">27</option>
				<option value="28">28</option>
				<option value="29">29</option>
				<option value="30">30</option>
				<option value="31">31</option>
				<option value="32">32</option>
				<option value="33">33</option>
				<option value="34">34</option>
				<option value="35">35</option>
				<option value="36">36</option>
				<option value="37">37</option>
				<option value="38">38</option>
				<option value="39">39</option>
				<option value="40">40</option>
				<option value="41">41</option>
				<option value="42">42</option>
				<option value="43">43</option>
				<option value="44">44</option>
				<option value="45">45</option>
				<option value="46">46</option>
				<option value="47">47</option>
				<option value="48">48</option>
				<option value="49">49</option>
				<option value="50">50</option>
				<option value="51">51</option>
				<option value="52">52</option>
				<option value="53">53</option>
				<option value="54">54</option>
				<option value="55">55</option>
				<option value="56">56</option>
				<option value="57">57</option>
				<option value="58">58</option>
				<option value="59">59</option>
			</select>
			<select name="emonth" id="emonth" onchange="setDays(this,eday,eyear)">
				<option value="1">January</option>
				<option value="2">February</option>
				<option value="3">March</option>
				<option value="4">April</option>
				<option value="5">May</option>
				<option value="6">June</option>
				<option value="7">July</option>
				<option value="8">August</option>
				<option value="9">September</option>
				<option value="10">October</option>
				<option value="11">November</option>
				<option value="12">December</option>
			</select>
			<select name="eday" id="eday" onchange="setDays(emonth,this,eyear)">
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				<option value="5">5</option>
				<option value="6">6</option>
				<option value="7">7</option>
				<option value="8">8</option>
				<option value="9">9</option>
				<option value="10">10</option>
				<option value="11">11</option>
				<option value="12">12</option>
				<option value="13">13</option>
				<option value="14">14</option>
				<option value="15">15</option>
				<option value="16">16</option>
				<option value="17">17</option>
				<option value="18">18</option>
				<option value="19">19</option>
				<option value="20">20</option>
				<option value="21">21</option>
				<option value="22">22</option>
				<option value="23">23</option>
				<option value="24">24</option>
				<option value="25">25</option>
				<option value="26">26</option>
				<option value="27">27</option>
				<option value="28">28</option>
				<option value="29">29</option>
				<option value="30">30</option>
				<option value="31">31</option>
			</select>
			<select name="eyear" id="eyear" onchange="setDays(emonth,eday,this)">
				<option value="2017">2017</option>
				<option value="2018">2018</option>
				<option value="2019">2019</option>
				<option value="2020">2020</option>
			</select>
			<br>
			Exam Duration in Minutes:<br> 
			<input type="text" name = "Exam_Minute_Duration" id = "Exam_Minute_Duration">
			<br><br>
			Description:<br> <textarea name = "Description" id = "Description" rows="4" cols="50"> </textarea><br>
			<br> How many questions for online exam?<br>
			<input type="text" name="Question_Number" onkeyup="BuildFormFields(parseInt(this.value, 10));">
			<div id = "FormFields"></div>
			<input type="submit">
		</form>
	</div>
</body>
</html>