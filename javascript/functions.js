let counterPre = 1;
let counterNew = 1;
$(document).ready(function () {
    $('#addInputFieldsPre').click(function () {
        $('#addMoreInputFields').append('<div id="'+counterPre+'" class="input-group">\n' +
            '    <input type="text" class="form-control" name="preSkill'+counterPre+'" id="preSkill'+counterPre+'" placeholder="Input Skill" value="" aria-label="" aria-describedby="basic-addon1">\n' +
            '    <div class="input-group-append">\n' +
            '        <button id="removeButtonPre" class="btn btn-danger" onclick="removeInputField()" type="button">Remove</button>\n' +
            '    </div>' +
            '</div>' +
            '<div id="lineBreak'+counterPre+'"><br></div>');
        counterPre++;
    });
    $('#addInputFieldsNew').click(function () {
       $('#addMoreInputFieldsNew').append('<div id="'+counterNew+'" class="input-group">\n' +
           '    <input type="text" class="form-control" name="newSkill'+counterNew+'" id="newSkill'+counterNew+'" placeholder="Input Skill" value="" aria-label="" aria-describedby="basic-addon1">\n' +
           '    <div class="input-group-append">\n' +
           '        <button id="button'+counterNew+'" class="btn btn-danger" onclick="removeInputFieldNew()" type="button">Remove</button>\n' +
           '    </div>' +
           '</div>' +
           '<div id="lineBreak'+counterNew+'"><br></div>');
       counterNew++;
    });
});

function removeInputField(){
    $(document).ready(function () {
        $('#' + (counterPre - 1)).remove();
        $('#lineBreak' + (counterPre - 1)).remove();
        counterPre--;
    });
}

function removeInputFieldNew(){
    $(document).ready(function () {
        $('#' + (counterNew - 1)).remove();
        $('#lineBreak' + (counterNew - 1)).remove();
        counterNew--;
    });
}

function calculateTime(){
    let timeEmployment = $('#timeStart').val();
    let start = new Date(timeEmployment);
    let end = new Date();
    let seconds = Math.floor(end.getTime() / 1000) - Math.floor(start.getTime() / 1000);
    let year = Math.floor(seconds / 31536000);
    let month = Math.floor((seconds % 31536000) / 2628000);
    let day = Math.floor(((seconds % 31536000) % 2628000) / 86400);
    let hour = Math.floor((seconds % (3600 * 24)) / 3600);
    let minute = Math.floor((seconds % 3600) / 60);
    let second = Math.floor(seconds % 60);
    let yearDisplay = year > 0 ? year + (year === 1 ? " year " : " years ") : "";
    let monthDisplay = month > 0 ? month + (month === 1 ? " month " : " months ") : "";
    let dayDisplay = day > 0 ? day + (day === 1 ? " day " : " days ") : "";
    let hourDisplay = hour > 0 ? hour + (hour === 1 ? " hour " : " hours ") : "";
    let minuteDisplay = minute > 0 ? minute + (minute === 1 ? " minute " : " minutes ") : "";
    let secondDisplay = second > 0 ? second + (second === 1 ? " second" : " seconds ") : "";
    return $('#timeOutput').html('Working since '+ yearDisplay + monthDisplay + dayDisplay + hourDisplay + minuteDisplay + secondDisplay);
}
calculateTime();
setInterval(calculateTime, 1000);

function deleteData(id){
    let confirmation = confirm('Are you sure you want to delete this Azubi?');
    if (confirmation){
        $.ajax({
            method: 'DELETE',
            url: 'http://localhost/Projekte/azubiManagement/index.php?controller=AzubiList&action=delete&delete-azubi-id='+id,
            data: {delete_id:id},
            statusCode: {
                200: function (){
                    alert('Successfully Deleted');
                }
            },
            success:function(){
                $('#' + id).remove();
            }
        });
    }
}

function showResult(str){
    if (str.length === 0){
        $('#livesearch').html("").css('border', '0px');
        return;
    }
    $.ajax({
       method: 'GET',
       url: 'http://localhost/Projekte/azubiManagement/index.php?controller=SearchSuggest&search='+str,
       success:function (responseText){
            $('#livesearch').html(responseText).css('border', '');
       }
    });
}

function outputResult(name) {
    $('#searchInput').val(name);
    $.ajax({
        method: 'GET',
        url: 'http://localhost/Projekte/azubiManagement/index.php?controller=SearchDisplay&action=getSearchedData&search='+name.replace(' ', '%20'),
        success:function (responseText){
            $('#listDisplay').html(responseText);
            $('#livesearch').html('');
            $('#searchInput').val('');
        }
    });
}

function outputPaginationResult(name){
    $('#searchInput').val(name);
    $.ajax({
       method: 'GET',
       url: 'http://localhost/Projekte/azubiManagement/index.php?controller=PaginationDisplay&action=getNumberofPages&search='+name,
       success:function (responseText){
           $('#paginationDisplay').html(responseText);
       }
    });
}

function submitForm(){
    $('#amountToDisplay').submit();
}










