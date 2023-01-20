let counterPre = 1;
let counterNew = 1;
$(document).ready(function () {
    $('#addInputFieldsPre').click(function () {
        let attributes = counterPre;
        $('#addMoreInputFields').append('<div id="'+attributes+'" class="input-group">\n' +
            '    <input type="text" class="form-control" name="preSkill'+attributes+'" id="preSkill'+attributes+'" placeholder="Input Skill" value="" aria-label="" aria-describedby="basic-addon1">\n' +
            '    <div class="input-group-append">\n' +
            '        <button id="removeButtonPre" class="btn btn-danger" onclick="removeInputField()" type="button">Remove</button>\n' +
            '    </div>' +
            '</div>' +
            '<div id="lineBreak'+attributes+'"><br></div>');
        counterPre++;
    });
    $('#addInputFieldsNew').click(function () {
       let attributesNew = counterNew;
       $('#addMoreInputFieldsNew').append('<div id="'+attributesNew+'" class="input-group">\n' +
           '    <input type="text" class="form-control" name="newSkill'+attributesNew+'" id="newSkill'+attributesNew+'" placeholder="Input Skill" value="" aria-label="" aria-describedby="basic-addon1">\n' +
           '    <div class="input-group-append">\n' +
           '        <button id="button'+attributesNew+'" class="btn btn-danger" onclick="removeInputFieldNew()" type="button">Remove</button>\n' +
           '    </div>' +
           '</div>' +
           '<div id="lineBreak'+attributesNew+'"><br></div>');
       counterNew++;
    });
});

function removeInputField(){
    $(document).ready(function () {
        let inputField = '#' + (counterPre - 1);
        let lineBreak = '#lineBreak' + (counterPre - 1);
        $(inputField).remove();
        $(lineBreak).remove();
        counterPre--;
    });
}

function removeInputFieldNew(){
    $(document).ready(function () {
        let inputField = '#' + (counterNew - 1);
        let lineBreak = '#lineBreak' + (counterNew - 1);
        $(inputField).remove();
        $(lineBreak).remove();
        counterNew--;
    });
}

function calculateTime(){
    let timeEmployment = $('#timeStart').val();
    let start = new Date(timeEmployment);
    let startSeconds = Math.floor(start.getTime() / 1000);
    let end = new Date();
    let endSeconds = Math.floor(end.getTime() / 1000);
    let timeElapsedInSeconds = endSeconds-startSeconds;
    let seconds = timeElapsedInSeconds;
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
    let totalDisplay =  yearDisplay + monthDisplay + dayDisplay + hourDisplay + minuteDisplay + secondDisplay;
    let output = $('#timeOutput').html('Working since '+ totalDisplay);
    return output;
}
calculateTime();
setInterval(calculateTime, 1000);

function deleteDataAjax(id){
    const req = new XMLHttpRequest();
    req.onreadystatechange = function (){
        if (req.status === 200){
           let deleteId = document.getElementById(id);
           deleteId.remove();
        }
    }
    req.open('DELETE', 'http://localhost/Projekte/azubiManagement/index.php?controller=AzubiList&action=delete&delete-azubi-id='+id);
    req.send();
}

function deleteData(id){
    let confirmation = confirm('Are you sure you want to delete this Azubi?');
    if (confirmation){
        $.ajax({
            type: 'DELETE',
            url: 'http://localhost/Projekte/azubiManagement/index.php?controller=AzubiList&action=delete&delete-azubi-id='+id,
            data: {delete_id:id},
            statusCode: {
                200: function (){
                    alert('Successfully Deleted');
                }
            },
            success:function(){
                if (this.success){
                    $('#' + id).remove();
                }
            }
        });
    }
}

function showResult(str){
    if (str.length === 0){
        document.getElementById('livesearch').innerHTML = "";
        document.getElementById('livesearch').style.border = "0px";
        return;
    }
    const req = new XMLHttpRequest();
    req.onreadystatechange = function (e){
        if (this.readyState === 4 && this.status === 200){
            document.getElementById('livesearch').innerHTML = this.responseText;
            document.getElementById('livesearch').style.border = '';
        }
    }
    req.open("GET",'http://localhost/Projekte/azubiManagement/index.php?controller=SearchSuggest&search='+str, true);
    req.send();
}

function outputResult(name){
    let inputField = document.getElementById('searchInput');
    inputField.value = name;
    const req = new XMLHttpRequest();
    req.onreadystatechange = function (e){
        if (this.status === 200){
            document.getElementById('listDisplay').innerHTML = this.responseText;
        }
    }
    let requestedName = name.replace(' ', '%20');
    req.open('GET', 'http://localhost/Projekte/azubiManagement/index.php?controller=SearchDisplay&action=getSearchedData&search='+requestedName);
    req.send();
}

function outputPaginationResult(name){
    let inputField = document.getElementById('searchInput');
    inputField.value = name;
    const req = new XMLHttpRequest();
    req.onreadystatechange = function (e){
        if (this.status === 200){
            document.getElementById('paginationDisplay').innerHTML= this.responseText;
        }
    }
    req.open('GET', 'http://localhost/Projekte/azubiManagement/index.php?controller=PaginationDisplay&action=getNumberofPages&search='+name);
    req.send();
}

function submitForm(){
    document.getElementById('amountToDisplay').submit();
}










