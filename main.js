var projectCount = 1;
var lastOne = 0;
var indexCount = 1;
var removedNumbers = []

$(document).ready(() => {
    $('#code').val(Math.random().toString(36).slice(-6))

    
})
/*

var feed = readJSON('./info.JSON')
console.log(feed)
*/
function deleteProjectForm(num) {

    projectCount--;
    if (num == projectCount) {

    }
    $('#p' + num).remove()
}

function readJSON(file) {
    var request = new XMLHttpRequest();
    request.open('GET', file, false);
    request.send(null);
    if (request.status == 200)
        return request.responseText;
};

function testingLog(num) {
    console.log(num)
}

function addProject() {
    projectCount++;
    $("#projectCount").val(projectCount)
    lastOne = projectCount;
    var formPiece = ` <div class="border border-primary rounded p-3 mb-3" id="p` + projectCount + `">
            <div class="form-group">
                <div class="row">
                    <div class="col-lg-8">
                        <label for="title ` + projectCount + `">Project Title</label>
                        <input type="text" class="form-control" name="title` + projectCount + `" id="title` + projectCount + `" placeholder="Project Title">
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="coverImg` + projectCount + `">CoverImage</label>
                            <input type="file" class="form-control-file" name="coverImg` + projectCount + `" id="coverImg` + projectCount + `">
                        </div>
                    </div>
                </div>

            </div>

            <div class="form-group">
                <label for="slogan` + projectCount + `">Project Slogan</label>
                <input type="text" class="form-control" id="slogan` + projectCount + `"  name="slogan` + projectCount + `" placeholder="Exciting Slogan!">
            </div>

            <div class="form-group">
                <label for="date` + projectCount + `">Project Completion</label>
                <input type="text" class="form-control w-25" id="date` + projectCount + `" name="date` + projectCount + `" placeholder="YYYY" >
            </div>

            <div class="form-group">
                <label for="platform` + projectCount + `">Platform(s)</label>
                <input type="text" class="form-control" id="platforms` + projectCount + `"  name="platforms` + projectCount + `" placeholder="Comma Separated">
            </div>

            <div class="form-group">
                <label for="tools` + projectCount + `">Tool(s) Used</label>
                <input type="text" class="form-control" id="tools` + projectCount + `"  name="tools` + projectCount + `" placeholder="Comma Separated">
            </div>

            <div class="form-group">
                <label for="about` + projectCount + `">Project Description</label>
                <textarea class="form-control" id="about` + projectCount + `" name="about` + projectCount + `" rows="8"></textarea>
            </div>

            

            <div class="row">
                <div class="col-lg-10">

                </div>
                <div class="col-lg-2">
                    <button type="button" onclick="deleteProjectForm(` + projectCount + `)" class="btn btn-danger rounded-circle mb-3 ">-</button>
                </div>
            </div>
           
        </div>`
    $("#p" + (projectCount - 1)).after(formPiece)

    window.scrollTo(0, document.body.scrollHeight);
}



//Get the button:
mybutton = document.getElementById("myBtn");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function () { scrollFunction() };

function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        mybutton.style.display = "block";
    } else {
        mybutton.style.display = "none";
    }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
    document.body.scrollTop = 0; // For Safari
    document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
}

//TODO : Check that they are empty
function checkEmptyFields() {

}

function checkErr(field) {

    if ($('#' + field).val() == "") {
        $('#' + field).after(`<div class="alert alert-danger m-2" id="err" role="alert">
    Please Fill in This Field!
  </div>`)



        $('#submitBtn').before(`<div class="alert alert-danger m-2" id="err2" role="alert">
    Errors Exist, Scroll Up
  </div>`)

        setTimeout(function () {

            // Closing the alert 
           
            $('#err2').alert('close');
        }, 1500);
        return true
    }

    return false

}

//This function will make sure no fields are empty
function validateForm() {
    //If any errors before, clear them for next check
    $("#err").remove()
    $("#err2").remove()
    if (checkErr('fullName') || checkErr('headShot') || checkErr('resume') || checkErr('about')) {
        return false
    }

    for (var i = 1; i <= projectCount; i++) {
        if (checkErr('title' + i) || checkErr('coverImg' + i) || checkErr('slogan' + i) || checkErr('date' + i) || checkErr('platforms' + i) || checkErr('tools' + i) || checkErr('about' + i)) {
            return false
        }
    }


    return true

}

