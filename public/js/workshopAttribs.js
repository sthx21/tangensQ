'<tr id="attrRow' +i+ '" class="dynamic-attributes">'
+
'<td>'
+
'<select class="form-control w-full"  name="attrib['+ i +'][trainers][]">'
+
'<option selected></option>'
+
'</select>'
+
'<select class="form-control w-full"  name="attrib['+ i +'][trainers][]">'
+
'<option selected></option>'
+
'</select>'
+
'</td>'
+
'<td>'
+
'<input type="date" name="attrib['+ i +'][start_date]" class="form-control w-full" >'
+
'<input type="date" name="attrib['+ i +'][end_date]" class="form-control w-full" >'
+
'</td>'
+
'<td>'+
'<input type="time" name="attrib['+ i +'][start_time]" class="form-control w-full" >'+
' <input type="time" name="attrib['+ i +'][end_time]" class="form-control w-full" >'+
'</td>'
+
'<td>'+
'<input type="text" name="attrib['+ i + '][location]" class="form-control w-full" >' +
'</td>'+
'<td>'+
'<select class="form-control w-full"  name="attrib['+ i +'][cancel_days]">'+
'<option value="56">56 Tage</option>'+
'<option value="42">42 Tage</option>'+
'<option value="28">28 Tage</option>'+
'<option value="14">14 Tage</option>'+
'<option value="7" selected>7 Tage</option>'+
'<option value="112">112 Tage</option>'+
'<option value="84">84 Tage</option>'+
'</select>'+
'</td>'+
'<td>'
+
'<button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_removeWorkshop">X</button>' +
'</td>' +
'</tr>'
